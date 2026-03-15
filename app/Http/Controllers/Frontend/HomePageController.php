<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\HomePageService;

class HomePageController extends Controller
{
    public function index( HomePageService $homeService)
    {
     $data = $homeService->get_data();
        return view('frontend.index', $data);
    }
    // quick view product
    public function getProduct($id)
    {
        $product = Product::where('id', $id)->where('status', 1)->with('gallery_images')->firstOrFail();
        return response()->json($product);
    }
}
