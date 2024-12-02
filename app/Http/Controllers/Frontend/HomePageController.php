<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HomePageController extends Controller
{
    public function index(){
        $data['featured_categories'] = Category::where(['status'=>1,'is_featured'=>1 ])->with('products')->get();
        return view('frontend.index', $data);
    }
}
