<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
        'discount',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Ensure items are deleted when a cart is deleted
    protected static function booted()
    {
        static::deleting(function ($cart) {
            $cart->items()->delete();
        });
    }
}
