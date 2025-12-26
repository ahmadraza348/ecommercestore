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
    'starting_from' => 'date',
    'ending_at'     => 'date',
];


      public function getLabelAttribute($value)
    {
        return Str::title(str_replace('_', ' ', $value));
    }
      // Discount type
    public function getDiscountTypeAttribute($value)
    {
        return Str::title(str_replace('_', ' ', $value  ));
    }

    // Status
    public function getStatusAttribute($value)
    {
        return Str::title($value);
    }

     // Dates
    public function getStartingFromAttribute($value)
    {
        return $value ? date('M d, Y', strtotime($value)) : null;
    }

    public function getEndingAtAttribute($value)
    {
        return $value ? date('M d, Y', strtotime($value)) : null;
    }
    // Amount (money formatting)
     public function getAmountAttribute($value)
    {
        return number_format($value, 2);
    }
}
