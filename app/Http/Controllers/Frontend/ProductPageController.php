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
            ->with(['attribute_value'])
            ->get()
            ->groupBy('color_id');

        return view('frontend.pro-detail', [
            'product'  => $product,
            'variants' => $variants
        ]);
    }
















    public function colorsData(Product $product): JsonResponse
    {
        $colors = $this->colorService->getColorsData($product);

        return response()->json([
            'status' => 'success',
            'data' => $colors,
        ]);
    }

    public function colorVariants(Request $request, Product $product): JsonResponse
    {
        $colorId = $request->query('color_id');

        if (!$colorId) {
            return response()->json([
                'status' => 'error',
                'message' => 'color_id required'
            ], 400);
        }

        $variantsData = $this->colorService->getColorVariants($product, $colorId);

        return response()->json([
            'status' => 'success',
            'data' => $variantsData,
        ]);
    }

    public function colorImages(Request $request, Product $product): JsonResponse
    {
        $colorId = $request->query('color_id');

        if (!$colorId) {
            return response()->json([
                'status' => 'error',
                'message' => 'color_id required'
            ], 400);
        }

        $images = $this->galleryService->getColorImages($product, $colorId);

        return response()->json([
            'status' => 'success',
            'data' => $images
        ]);
    }
}
