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

}
