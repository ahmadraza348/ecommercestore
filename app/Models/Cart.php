<?php

namespace App\Models;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
        'discount',
        'total'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
