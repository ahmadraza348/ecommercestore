<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
  public function index($slug)
{
    $product = Product::where('slug', $slug)->first();
    $attributes = $product->attributes;
    return view('frontend.product-detail', [
        'pro_detail' => $product,
        'attributes' => $attributes, 
    ]);
}

}
