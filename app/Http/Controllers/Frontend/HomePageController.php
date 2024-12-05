<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $data['featured_categories'] = Category::where(['status' => 1, 'is_featured' => 1])->take(6)->with('products')->get();
        $data['featured_pro'] = Product::where(['status' => 1, 'is_featured' => 1])->take(8)->get();
        $data['hot_deals_pro'] = Product::where(['status' => 1, 'label' => 'hot'])->take(6)->get();
        $data['sale_pro'] = Product::where(['status' => 1, 'label' => 'sale'])->take(6)->get();
        $data['new_arrival_pro'] = Product::where(['status' => 1, 'label' => 'new'])->take(6)->get();
=======

    public function index()
    {
        $data['featured_categories'] = Category::where(['status' => 1, 'is_featured' => 1])->with('products')->get();
        $data['featured_pro'] = Product::where(['status' => 1, 'is_featured' => 1])->take(8)->get();
        $data['hot_deals_pro'] = Product::where(['status' => 1, 'label' => 'hot'])->take(3)->get();
>>>>>>> 9a5891377537a7dcddf040b1d66faed7a6f320d4
        return view('frontend.index', $data);
    }
}
