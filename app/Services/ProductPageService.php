<?php

namespace App\Services;

use App\Models\ProAttributeValue;
use App\Models\Product;

class ProductPageService
{
    public function get_data($slug)
    {
        $product = Product::where('slug', $slug)
            ->with([
                'gallery_images',
                'proAttributeValuesRecords',
                'categories', // Make sure to load categories here
            ])->firstOrFail();

        $data['product'] = $product;

        $data['variants'] = ProAttributeValue::where('product_id', $data['product']->id)
            ->with(['attribute_value.attribute', 'color'])
            ->get()
            ->groupBy('color_id');

        $categoryIds = $product->categories->pluck('id');

       $data['related_pro'] = Product::where('id', '!=', $product->id) // Exclude current product
            ->where('status', 'active')
            // Only search categories if the current product actually has categories
            ->when($categoryIds->isNotEmpty(), function ($query) use ($categoryIds) {
                $query->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                });
            })
            ->with('categories')
            ->latest()
            ->limit(8)
            ->get();

            
        return $data;
    }
}
