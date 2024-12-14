<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttributeValue extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
    
}
