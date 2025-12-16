<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProAttributeValue;
use App\Services\CartService;


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



    public function addToCart(Request $request, CartService $cartService)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'pro_qty' => 'required|integer|min:1',
            'color' => 'nullable|exists:colors,id',
            'attribute_value_id' => 'nullable|exists:attribute_values,id',
        ]);

        try {
            $cartService->add($request->all());
            toastr()->success('Product added to cart successfully');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

        return back();
    }
}
