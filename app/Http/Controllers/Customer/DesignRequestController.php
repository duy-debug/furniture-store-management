<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DesignRequestController extends Controller
{
    public function index(Request $request): View
    {
        $designRequests = DesignRequest::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('customer.design-requests.index', compact('designRequests'));
    }

    public function create(Request $request): View
    {
        return view('customer.design-requests.create', [
            'spaceTypeLabels' => DesignRequest::SPACE_TYPE_LABELS,
            'customer' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'space_type' => ['required', 'in:' . implode(',', array_keys(DesignRequest::SPACE_TYPE_LABELS))],
            'space_area' => ['required', 'numeric', 'min:0.01'],
            'space_address' => ['required', 'string', 'max:255'],
            'style_preference' => ['required', 'string', 'max:255'],
            'main_color' => ['required', 'string', 'max:255'],
            'budget_amount' => ['required', 'numeric', 'min:0'],
            'desired_completion_date' => ['required', 'date', 'after_or_equal:today'],
            'requirements' => ['required', 'string', 'max:5000'],
        ]);

        $user = $request->user();

        if (blank($user->name) || blank($user->phone)) {
            throw ValidationException::withMessages([
                'profile' => 'Vui lòng cập nhật họ tên và số điện thoại trong hồ sơ trước khi gửi yêu cầu thiết kế.',
            ]);
        }

        $designRequest = DB::transaction(function () use ($user, $validated) {
            $requestCode = $this->generateRequestCode();

            return DesignRequest::create([
                'user_id' => $user->id,
                'request_code' => $requestCode,
                'customer_name' => $user->name,
                'customer_phone' => $user->phone,
                'customer_email' => $user->email,
                'space_address' => $validated['space_address'],
                'space_type' => $validated['space_type'],
                'space_area' => $validated['space_area'],
                'style_preference' => $validated['style_preference'],
                'main_color' => $validated['main_color'],
                'budget_amount' => $validated['budget_amount'],
                'desired_completion_date' => $validated['desired_completion_date'],
                'requirements' => $validated['requirements'],
                'status' => 'new',
            ]);
        });

        return redirect()
            ->route('design-requests.show', $designRequest)
            ->with('success', "Đã gửi yêu cầu thiết kế thành công. Mã yêu cầu: {$designRequest->request_code}");
    }

    public function show(Request $request, DesignRequest $designRequest): View
    {
        if ($designRequest->user_id !== $request->user()->id && !$request->user()->hasPermission('design_request.detail')) {
            abort(403, 'Bạn không có quyền xem yêu cầu thiết kế này.');
        }

        $designRequest->load(['user', 'assignedStaff']);

        return view('customer.design-requests.show', compact('designRequest'));
    }

    private function generateRequestCode(): string
    {
        do {
            $code = 'DRQ-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
        } while (DesignRequest::where('request_code', $code)->exists());

        return $code;
    }
}
