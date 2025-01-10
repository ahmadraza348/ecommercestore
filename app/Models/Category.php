<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function getImageNameAttribute($value)
{

        return public_path($value);
}

    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'is_featured', 'description', 'status'];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('subcategories'); // Recursive relationship
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function metaTag()
    {
        return $this->morphOne(MetaTag::class, 'metaable');
    }

    // if we delete category then all its meta tags will also be deleted
    public static function boot()
{
    parent::boot();

    static::deleting(function ($category) {
        $category->metaTag()->delete();
    });
}

public function products()
{
    return $this->belongsToMany(Product::class, 'relational_categories', 'category_id', 'product_id');
}

}
