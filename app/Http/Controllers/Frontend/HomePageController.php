<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {
        $data['featured_categories'] = Category::where(['status' => 1, 'is_featured' => 1])->with('products')->get();
        $data['hot_deals_pro'] = Product::where(['status' => 1, 'label' => 'hot'])->take(3)->get();
        return view('frontend.index', $data);
    }
}
