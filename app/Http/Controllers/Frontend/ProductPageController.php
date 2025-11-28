<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ProAttributeValue;

class ProductPageController extends Controller
{

    public function index($slug)
    {
        //showing gallery images and colors in product detail page
        $product = Product::where('slug', $slug)
            ->with([
                'gallery_images',
                'proAttributeValuesRecords',
            ])
            ->firstOrFail();

        // Load color based varients with values like sizes with values ,fabrics with values etc
        $variants = ProAttributeValue::where('product_id', $product->id)
            ->with(['attribute_value.attribute'])
            ->get()
            ->groupBy('color_id');

        return view('frontend.pro-detail', [
            'product'  => $product,
            'variants' => $variants
        ]);
    }

}
