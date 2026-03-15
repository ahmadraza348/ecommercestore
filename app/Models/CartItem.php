<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'color_id',
        'attribute_value_id',
        'product_name',
        'price',
        'quantity',
        'line_total'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function proColor(){
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function proAttribute(){
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
