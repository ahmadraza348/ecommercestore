<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coupon extends Model
{
    protected $fillable = [
        'label',
        'discount_type',
        'amount',
        'code',
        'starting_from',
        'ending_at',
        'status',
    ];

    protected $casts = [
        'starting_from' => 'datetime',
        'ending_at'     => 'datetime',
    ];

    // Status constants
    const STATUS_ACTIVE = 'active';

    // ----- Business logic -----
    public function isActive(): bool
    {
        // Compare normalized lowercase status to constant
        return strtolower(trim($this->status)) === self::STATUS_ACTIVE;
    }

    // Check if coupon is currently valid (within start/end dates)
    public function isValid(): bool
    {
        $now = now();
        return $this->isActive()
            && (! $this->starting_from || $now->greaterThanOrEqualTo($this->starting_from))
            && (! $this->ending_at   || $now->lessThanOrEqualTo($this->ending_at->endOfDay()));
    }

    // ----- Accessors -----
    
    // Label formatting
    public function getLabelAttribute($value): string
    {
        return Str::title(str_replace('_', ' ', $value));
    }

    // Discount type formatting
    public function getDiscountTypeAttribute($value): string
    {
        return Str::title(str_replace('_', ' ', $value));
    }

    // Status formatting for display (keep raw in DB)
    public function getStatusForDisplayAttribute(): string
    {
        return Str::title($this->status);
    }

    // Amount formatting
    public function getAmountFormattedAttribute(): string
    {
        return number_format($this->amount, 2);
    }

    // Dates formatting for display
    public function getStartingFromFormattedAttribute(): ?string
    {
        return $this->starting_from ? $this->starting_from->format('M d, Y') : null;
    }

    public function getEndingAtFormattedAttribute(): ?string
    {
        return $this->ending_at ? $this->ending_at->format('M d, Y') : null;
    }
}
