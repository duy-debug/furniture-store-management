<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    use HasFactory, SoftDeletes;

    public const SPACE_TYPE_LABELS = [
        'living_room' => 'Phòng khách',
        'bedroom' => 'Phòng ngủ',
        'kitchen' => 'Nhà bếp',
        'whole_house' => 'Toàn bộ căn nhà',
        'office' => 'Văn phòng',
        'cafe' => 'Quán cafe',
        'apartment' => 'Căn hộ',
        'other' => 'Khác',
    ];

    public const STATUS_LABELS = [
        'new' => 'Mới',
        'contacting' => 'Đang liên hệ',
        'surveyed' => 'Đã khảo sát',
        'designing' => 'Đang thiết kế',
        'sent_design' => 'Đã gửi bản thiết kế',
        'approved' => 'Đã duyệt',
        'constructing' => 'Đang thi công',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
    ];

    public const ADMIN_STATUS_FLOW = [
        'new' => ['contacting', 'cancelled'],
        'contacting' => ['surveyed', 'cancelled'],
        'surveyed' => ['designing', 'cancelled'],
        'designing' => ['sent_design', 'cancelled'],
        'sent_design' => ['approved', 'cancelled'],
        'approved' => ['constructing', 'cancelled'],
        'constructing' => ['completed', 'cancelled'],
    ];

    protected $fillable = [
        'user_id',
        'assigned_staff_id',
        'request_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'space_address',
        'space_type',
        'space_area',
        'ceiling_height',
        'room_count',
        'style_preference',
        'main_color',
        'budget_amount',
        'desired_completion_date',
        'requirements',
        'status',
        'cancel_reason',
        'contacted_at',
        'surveyed_at',
        'completed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'assigned_staff_id' => 'integer',
            'space_area' => 'decimal:2',
            'ceiling_height' => 'decimal:2',
            'room_count' => 'integer',
            'budget_amount' => 'decimal:2',
            'desired_completion_date' => 'date',
            'contacted_at' => 'datetime',
            'surveyed_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_staff_id')->withTrashed();
    }

    public function spaceTypeLabel(): string
    {
        return self::SPACE_TYPE_LABELS[$this->space_type] ?? $this->space_type;
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function statusBadgeClasses(): string
    {
        return match ($this->status) {
            'new' => 'bg-sky-50 text-sky-700',
            'contacting' => 'bg-blue-50 text-blue-700',
            'surveyed' => 'bg-indigo-50 text-indigo-700',
            'designing' => 'bg-violet-50 text-violet-700',
            'sent_design' => 'bg-emerald-50 text-emerald-700',
            'approved' => 'bg-green-50 text-green-700',
            'constructing' => 'bg-amber-50 text-amber-700',
            'completed' => 'bg-emerald-50 text-emerald-700',
            'cancelled' => 'bg-red-50 text-red-700',
            default => 'bg-gray-50 text-gray-700',
        };
    }

    public function statusTimestampField(string $status): ?string
    {
        return match ($status) {
            'contacting' => 'contacted_at',
            'surveyed' => 'surveyed_at',
            'completed' => 'completed_at',
            'cancelled' => 'cancelled_at',
            default => null,
        };
    }

    public function adminAllowedStatuses(): array
    {
        return self::ADMIN_STATUS_FLOW[$this->status] ?? [];
    }

    public function isTerminalStatus(): bool
    {
        return in_array($this->status, ['completed', 'cancelled'], true);
    }
}
