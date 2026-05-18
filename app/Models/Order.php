<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_LABELS = [
        'pending' => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'preparing' => 'Đang chuẩn bị',
        'shipping' => 'Đang giao hàng',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
        'returned' => 'Đã trả hàng',
    ];

    public const PAYMENT_METHOD_LABELS = [
        'cod' => 'Thanh toán khi nhận hàng',
        'bank_transfer' => 'Chuyển khoản ngân hàng',
    ];

    public const ADMIN_STATUS_FLOW = [
        'pending' => ['processing', 'cancelled'],
        'processing' => ['preparing', 'cancelled', 'returned'],
        'preparing' => ['shipping', 'cancelled', 'returned'],
        'shipping' => ['completed', 'cancelled', 'returned'],
    ];

    protected $fillable = [
        'user_id',
        'order_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'shipping_address',
        'shipping_note',
        'payment_method',
        'payment_status',
        'status',
        'subtotal',
        'tax_amount',
        'shipping_fee',
        'discount_amount',
        'total_amount',
        'cancel_reason',
        'placed_at',
        'processed_at',
        'completed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'subtotal' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'shipping_fee' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'placed_at' => 'datetime',
            'processed_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function paymentMethodLabel(): string
    {
        return self::PAYMENT_METHOD_LABELS[$this->payment_method] ?? $this->payment_method;
    }

    public function statusBadgeClasses(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-50 text-yellow-700',
            'processing' => 'bg-blue-50 text-blue-700',
            'preparing' => 'bg-indigo-50 text-indigo-700',
            'shipping' => 'bg-sky-50 text-sky-700',
            'completed' => 'bg-green-50 text-green-700',
            'cancelled' => 'bg-red-50 text-red-700',
            'returned' => 'bg-rose-50 text-rose-700',
            default => 'bg-gray-50 text-gray-700',
        };
    }
}
