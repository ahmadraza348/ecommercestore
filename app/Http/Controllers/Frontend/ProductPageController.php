<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductVariationService;
use App\Services\ProductColorService;
use App\Services\ProductGalleryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductPageController extends Controller
{
    // public function __construct(
    //     private ProductVariationService $variationService,
    //     private ProductColorService $colorService,
    //     private ProductGalleryService $galleryService
    // ) {}




    public function index($slug)
    {

        $product = Product::where(['slug'=> $slug])
            ->with(['gallery_images', 'colors'])
            ->firstOrFail();
        return view('frontend.pro-detail', [
            'product' => $product,
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