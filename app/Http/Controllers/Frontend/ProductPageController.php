<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index($slug){
        $pro_detail = Product::with('attributes')->where('slug', $slug)->first();
//   dd($pro_detail);
        return view('frontend.product-detail', [
            'pro_detail' => $pro_detail,
        ]);
    }
    public function getAttributes(Request $request)
{
    $attribute = $request->attribute;
    $colorId = $request->color_id;
    $sizeId = $request->size_id;

    if ($attribute === 'size' && $colorId) {
        $sizes = AttributeValue::where('attribute_id', 2) // Assuming "size" attribute ID is 2
            ->where('color_id', $colorId)
            ->get();

        return response()->json(['sizes' => $sizes]);
    }

    if ($attribute === 'fabric' && $sizeId) {
        $fabrics = AttributeValue::where('attribute_id', 3) // Assuming "fabric" attribute ID is 3
            ->where('size_id', $sizeId)
            ->get();

        return response()->json(['fabrics' => $fabrics]);
    }

    return response()->json(['message' => 'Invalid request'], 400);
}

}
