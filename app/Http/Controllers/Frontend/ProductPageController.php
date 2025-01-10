<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
  public function index($slug)
{
    $pro_detail = Product::where('slug', $slug)->first();
    $attributes = $pro_detail->attributes;
    return view('frontend.product-detail', [
        'pro_detail' => $pro_detail,
        'attributes' => $attributes, 
    ]);
}

}
