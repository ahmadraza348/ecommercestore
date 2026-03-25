<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\HomePageService;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    protected $homeService;

    public function __construct(HomePageService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = $this->homeService->get_data();

        return view('frontend.index', $data);
    }

    public function search(Request $request)
    {
        $data = $this->homeService->search($request);

        return $data->isEmpty() ? view('frontend.search_results', ['message' => 'No products found.']) : view('frontend.search_results', ['products' => $data]);
    }

    // quick view product
    public function getProduct($id)
    {
        $product = Product::where('id', $id)->where('status', 1)->with('gallery_images')->firstOrFail();

        return response()->json($product);
    }

    public function getCategoryProducts($id)
    {
        $products = Product::whereHas('categories', function ($query) use ($id) {
            $query->where('categories.id', $id);
        })
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        return response()->json([
            'html' => view('frontend.partials.pro_slide_list', compact('products'))->render(),
        ]);
    }
}
