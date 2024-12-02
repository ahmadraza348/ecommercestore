<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProAttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','attribute_id','attribute_value_id','itemcode','stock','price',
    ];
}
