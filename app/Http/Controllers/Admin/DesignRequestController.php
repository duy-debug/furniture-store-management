<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DesignRequestController extends Controller
{
    public function index(Request $request): View
    {
        $query = DesignRequest::query()
            ->with(['user', 'assignedStaff'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('space_type'), fn ($query) => $query->where('space_type', $request->string('space_type')->toString()))
            ->when($request->filled('date_from'), fn ($query) => $query->whereDate('created_at', '>=', $request->date('date_from')))
            ->when($request->filled('date_to'), fn ($query) => $query->whereDate('created_at', '<=', $request->date('date_to')))
            ->when($request->filled('budget_min'), fn ($query) => $query->where('budget_amount', '>=', (float) $request->input('budget_min')))
            ->when($request->filled('budget_max'), fn ($query) => $query->where('budget_amount', '<=', (float) $request->input('budget_max')))
            ->latest('created_at');

        $designRequests = $query->paginate(15)->withQueryString();

        return view('admin.design-requests.index', [
            'designRequests' => $designRequests,
            'statusLabels' => DesignRequest::STATUS_LABELS,
            'spaceTypeLabels' => DesignRequest::SPACE_TYPE_LABELS,
            'stats' => [
                'total' => DesignRequest::count(),
                'new' => DesignRequest::where('status', 'new')->count(),
                'processing' => DesignRequest::whereIn('status', ['contacting', 'surveyed', 'designing', 'sent_design', 'approved', 'constructing'])->count(),
                'completed' => DesignRequest::where('status', 'completed')->count(),
            ],
        ]);
    }

    public function show(Request $request, DesignRequest $designRequest): View
    {
        $designRequest->load(['user', 'assignedStaff']);

        $staffOptions = User::query()
            ->whereHas('roles', fn ($query) => $query->whereIn('code', ['staff', 'admin']))
            ->where(function ($query) use ($designRequest) {
                $query->where('status', 'active');

                if ($designRequest->assignedStaff) {
                    $query->orWhere('id', $designRequest->assignedStaff->id);
                }
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'status']);

        $allowedStatuses = array_values(array_unique(array_merge([$designRequest->status], $designRequest->adminAllowedStatuses())));

        return view('admin.design-requests.show', [
            'designRequest' => $designRequest,
            'staffOptions' => $staffOptions,
            'statusLabels' => DesignRequest::STATUS_LABELS,
            'allowedStatuses' => $allowedStatuses,
        ]);
    }

    public function updateStatus(Request $request, DesignRequest $designRequest): RedirectResponse
    {
        if ($designRequest->isTerminalStatus()) {
            throw ValidationException::withMessages([
                'status' => 'Yêu cầu này đã ở trạng thái cuối và không thể cập nhật.',
            ]);
        }

        $allowedStatuses = array_values(array_unique(array_merge([$designRequest->status], $designRequest->adminAllowedStatuses())));

        $validated = $request->validate([
            'status' => ['required', Rule::in($allowedStatuses)],
            'assigned_staff_id' => ['nullable', 'integer', 'exists:users,id'],
            'cancel_reason' => [
                Rule::requiredIf(fn () => $request->input('status') === 'cancelled'),
                'nullable',
                'string',
                'min:3',
                'max:5000',
            ],
        ]);

        DB::transaction(function () use ($designRequest, $validated, $request) {
            $designRequest = DesignRequest::query()->withTrashed()->lockForUpdate()->findOrFail($designRequest->id);

            if ($designRequest->isTerminalStatus()) {
                throw ValidationException::withMessages([
                    'status' => 'Yêu cầu này đã ở trạng thái cuối và không thể cập nhật.',
                ]);
            }

            $nextStatus = $validated['status'];
            $allowedStatuses = array_values(array_unique(array_merge([$designRequest->status], $designRequest->adminAllowedStatuses())));

            if (! in_array($nextStatus, $allowedStatuses, true)) {
                throw ValidationException::withMessages([
                    'status' => 'Trạng thái được chọn không hợp lệ với luồng xử lý hiện tại.',
                ]);
            }

            $staffId = $validated['assigned_staff_id'] ?? null;
            if ($staffId) {
                $staff = User::query()
                    ->whereKey($staffId)
                    ->where('status', 'active')
                    ->whereHas('roles', fn ($query) => $query->whereIn('code', ['staff', 'admin']))
                    ->first();

                if (! $staff) {
                    throw ValidationException::withMessages([
                        'assigned_staff_id' => 'Nhân viên phụ trách không hợp lệ hoặc không hoạt động.',
                    ]);
                }

                $designRequest->assigned_staff_id = $staff->id;
            } else {
                $designRequest->assigned_staff_id = null;
            }

            if ($nextStatus === 'cancelled') {
                $designRequest->cancel_reason = trim((string) $validated['cancel_reason']);
                $designRequest->cancelled_at = now();
            } else {
                $designRequest->cancel_reason = null;
            }

            $timestampField = $designRequest->statusTimestampField($nextStatus);
            if ($timestampField) {
                $designRequest->{$timestampField} = now();
            }

            $designRequest->status = $nextStatus;
            $designRequest->save();
        });

        return back()->with('success', 'Đã cập nhật trạng thái yêu cầu thiết kế.');
    }
}
