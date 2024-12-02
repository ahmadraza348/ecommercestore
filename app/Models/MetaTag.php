<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $fillable = ['meta_title', 'meta_keywords', 'meta_description', 'metaable_id', 'metaable_type'];

    public function metaable()
    {
        return $this->morphTo();
    }
}
