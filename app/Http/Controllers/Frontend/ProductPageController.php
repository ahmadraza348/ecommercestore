<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProAttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductPageController extends Controller
{

    public function index($slug)
    {

        $product = Product::where('slug', $slug)
            ->with([
                'gallery_images',
                'proAttributeValuesRecords',
            ])->firstOrFail();

        $variants = ProAttributeValue::where('product_id', $product->id)
            ->with(['attribute_value.attribute', 'color'])
            ->get()
            ->groupBy('color_id');

        return view('frontend.pro-detail', compact('product', 'variants'));
    }


    public function addToCart(request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'final_price' => 'required|numeric',
            'pro_qty' => 'required|integer|min:1',
            'color' => 'nullable|exists:colors,id',
            'attribute_value_id' => 'nullable|exists:attribute_values,id',
        ]);

        // Get Product
        $product = Product::findOrFail($request->product_id);

        // 2. Identify cart owner
        $sessionId = Session::getId();
        $userId = Auth::id();

        // 3. Find or create cart
        $cart = Cart::firstOrCreate(
            [
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId
            ],
            [
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0
            ]
        );

        // 4. Check if same item already exists
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('color_id', $request->color)
            ->where('attribute_value_id', $request->attribute_value_id)
            ->first();

        $qty = $request->pro_qty;
        $price = $request->final_price;

        if ($cartItem) {
            // update quantity
            $cartItem->quantity += $qty;
            $cartItem->line_total = $cartItem->quantity * $price;
            $cartItem->save();
        } else {
            // create new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'color_id' => $request->color,
                'attribute_value_id' => $request->attribute_value_id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $qty,
                'line_total' => $price * $qty,
            ]);
        }
        // 5. Recalculate cart totals
        $cart->subtotal = $cart->items()->sum('line_total');
        $cart->total = $cart->subtotal - $cart->discount;
        $cart->save();
        toastr()->success('Product added to cart successfully');
        return redirect()->back();
    }
}
