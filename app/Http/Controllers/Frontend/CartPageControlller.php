<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProAttributeValue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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


    public function cart_update(Request $request)
    {
        $itemIds    = $request->input('ItemId', []);
        $quantities = $request->input('quantity', []);

        DB::transaction(function () use ($itemIds, $quantities) {

            foreach ($itemIds as $itemId) {

                if (!isset($quantities[$itemId])) {
                    continue;
                }

                $qty = (int) $quantities[$itemId];

                // Remove item if qty <= 0
                if ($qty <= 0) {
                    CartItem::where('id', $itemId)->delete();
                    continue;
                }

                $cartItem = CartItem::with(['product'])->find($itemId);

                if (!$cartItem) {
                    continue;
                }

                // -------------------------
                // Stock resolution (same rule as add)
                // -------------------------
                $stock = $cartItem->product->stock;

                if ($cartItem->color_id || $cartItem->attribute_value_id) {

                    $variant = ProAttributeValue::where('product_id', $cartItem->product_id)
                        ->when(
                            $cartItem->color_id,
                            fn($q) =>
                            $q->where('color_id', $cartItem->color_id)
                        )
                        ->when(
                            $cartItem->attribute_value_id,
                            fn($q) =>
                            $q->where('attribute_value_id', $cartItem->attribute_value_id)
                        )
                        ->first();

                    if (!$variant) {
                        toastr()->error("Invalid variant detected in cart.");
                        return redirect()->back();
                    }

                    $stock = $variant->stock ?? 0;
                }

                if ($qty > $stock) {
                    toastr()->error("Only {$stock} item(s) available.");
                    return redirect()->back();
                }

                // -------------------------
                // Quantity & price update
                // -------------------------
                $cartItem->update([
                    'quantity'   => $qty,
                    'line_total' => $qty * $cartItem->price, // price stays frozen
                ]);
            }

            // -------------------------
            // Recalculate cart totals
            // -------------------------
            $cartId = CartItem::whereIn('id', $itemIds)->value('cart_id');

            if ($cartId) {
                $cart = Cart::find($cartId);
                $subtotal = $cart->items()->sum('line_total');

                $cart->update([
                    'subtotal' => $subtotal,
                    'total'    => $subtotal - $cart->discount,
                ]);
            }
        });
        toastr()->success("Cart updated successfully");
        return redirect()->back();
    }
}
