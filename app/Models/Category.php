<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_LABELS = [
        'active' => 'Đang hiển thị',
        'hidden' => 'Đã ẩn',
    ];

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image_path',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id')->withTrashed();
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function childrenCategories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function statusBadgeClasses(): string
    {
        return match ($this->status) {
            'active' => 'bg-green-50 text-green-700',
            'hidden' => 'bg-gray-50 text-gray-700',
            default => 'bg-gray-50 text-gray-700',
        };
    }

    public function hasProducts(): bool
    {
        return $this->products()->exists();
    }
}
