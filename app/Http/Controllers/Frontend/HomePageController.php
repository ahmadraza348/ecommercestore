<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class HomePageController extends Controller
{
    public function index()
    {
        $data['featured_categories'] = Category::where(['status' => 1, 'is_featured' => 1])->take(6)->with('products')->get();
        $data['featured_pro'] = Product::where(['status' => 1, 'is_featured' => 1])->take(8)->get();
        $data['hot_deals_pro'] = Product::where(['status' => 1, 'label' => 'hot'])->take(6)->get();
        $data['sale_pro'] = Product::where(['status' => 1, 'label' => 'sale'])->take(6)->get();
        $data['new_arrival_pro'] = Product::where(['status' => 1, 'label' => 'new'])->take(6)->get();
        $data['brands'] = Brand::where(['status' => 1])->take(8)->get();
        return view('frontend.index', $data);
    }
    // quick view product
    public function getProduct($id)
    {
        $product = Product::where('id', $id)->where('status', 1)->with('gallery_images')->firstOrFail();
        return response()->json($product);
    }
}
