<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartPageControlller extends Controller
{
    public function cart()
    {

        if (Auth::check()) {
            $data['cartData'] = Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
                ->where('user_id', Auth::id())
                ->first();
        } else {
            $data['cartData'] = Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
                ->where('session_id', Session::getId())
                ->first();
        }
        return view('frontend.cart');
    }

    public function cart_update(request $request)
    {
        dd($request->all());
    }
}
