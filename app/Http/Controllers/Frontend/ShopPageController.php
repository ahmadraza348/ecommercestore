<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ShopPageController extends Controller
{
    public function index(){
        return view('frontend.shop');
    }
}
