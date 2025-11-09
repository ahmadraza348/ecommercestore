<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProImages extends Model
{
    use HasFactory;
  protected $fillable = [
        'product_id',
        'image',
        'color_id',
        
    ];
        public function color()
    {
        return $this->belongsTo(AttributeValue::class, 'color_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
