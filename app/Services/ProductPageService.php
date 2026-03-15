<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProAttributeValue;

class ProductPageService
{
    public function get_data($slug)
    {
        $data['product'] = Product::where('slug', $slug)
            ->with([
                'gallery_images',
                'proAttributeValuesRecords',
            ])->firstOrFail();

        $data['variants'] = ProAttributeValue::where('product_id', $data['product']->id)
            ->with(['attribute_value.attribute', 'color'])
            ->get()
            ->groupBy('color_id');

        return $data;
    }
}
