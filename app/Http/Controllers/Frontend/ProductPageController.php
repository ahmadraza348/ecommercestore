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

        $product = Product::where('slug', $slug)
            ->with([
                'gallery_images',
                'proAttributeValuesRecords', 
            ])->firstOrFail();

        $variants = ProAttributeValue::where('product_id', $product->id)
            ->with(['attribute_value.attribute', 'color'])
            ->get()
            ->groupBy('color_id');

        return view('frontend.pro-detail', compact('product', 'variants'));
    }


    public function addToCart(request $request)
    {
        dd($request->all());
    }
}
