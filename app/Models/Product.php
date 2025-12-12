<?php

namespace App\Models;

use App\Models\ProImages;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'product_variation_type',
        'status',
        'sale_price',
        'previous_price',
        'purchase_price',
        'barcode',
        'stock',
        'tags',
        'label',
        'is_featured',
        'short_description',
        'long_description',
        'video',
        'brand_id',
        'attribute_id'
    ];

    // for detail page to show colors and sizes
    public function proAttributeValuesRecords()
    {
        return $this->hasMany(ProAttributeValue::class, 'product_id');
    }

    public function gallery_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    // for admin panel to show attributes linked to product
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'pro_attribute_values')
            ->withPivot(['attribute_value_id', 'color_id', 'itemcode', 'stock', 'price'])
            ->withTimestamps();
    }
      public function categories()
    {
        return $this->belongsToMany(Category::class, 'relational_categories', 'product_id', 'category_id')
            ->withTimestamps();
    }


    public function metaTag()
    {
        return $this->morphOne(MetaTag::class, 'metaable');
    }
  
    // if we delete product then all its meta tags will also be deleted
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->metaTag()->delete();
            $product->categories()->detach();
        });
    }
    public function categoryCount()
    {
        return $this->categories()->count();
    }


    // public function getPriceForAttributes($selectedAttributes)
    // {
    //     // Example logic: Fetch price based on attributes
    //     $priceQuery = $this->prices();

    //     foreach ($selectedAttributes as $attribute => $value) {
    //         $priceQuery->whereHas('attributesValues', function ($query) use ($attribute, $value) {
    //             $query->where('attribute_name', $attribute)->where('id', $value);
    //         });
    //     }

    //     return $priceQuery->value('price');
    // }
}
