<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class HomePageService
{
    public function get_data()
    {
        $data['featured_categories'] = Category::where(['status' => 1, 'is_featured' => 1])->take(6)->with('products')->get();
        $data['featured_pro'] = Product::where(['status' => 1, 'is_featured' => 1])->take(8)->get();
        $data['hot_deals_pro'] = Product::where(['status' => 1, 'label' => 'hot'])->take(6)->get();
        $data['sale_pro'] = Product::where(['status' => 1, 'label' => 'sale'])->take(6)->get();
        $data['new_arrival_pro'] = Product::where(['status' => 1, 'label' => 'new'])->take(6)->get();
        $data['brands'] = Brand::where(['status' => 1])->take(8)->get();
        return $data;
    }

    public function search($request)
    {
        $query = $request->input('query');
        $products = Product::search($query)->paginate(12); // Must be paginate
        return $products;
    }
}
