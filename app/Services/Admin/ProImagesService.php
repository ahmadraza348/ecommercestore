<?php

namespace App\Services\Admin;

use App\Models\ProductImages;
use App\Models\Product;
use App\Models\Color;

class ProImagesService
{
    public function add($product_id)
    {
        $data['product'] = Product::findOrFail($product_id);
        $data['colors'] = Color::where('status', 1)->get();
        $data['images'] = ProductImages::where('product_id', $product_id)
            ->orderBy('sort_order', 'asc')
            ->get();
        return $data;
    }
}
