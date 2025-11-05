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
    $current_product =  Product::find($pro_detail->id);
    $uniqueColors = $current_product->colors->unique('color_id');

    // dd($uniqueColors);
    return view('frontend.product-detail', [
      'pro_detail' => $pro_detail,
      'uniqueColors' => $uniqueColors,
    ]);
  }
}
