<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProAttributeValue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CartPageController extends Controller
{
    public function cart()
    {
        return view('frontend.cart');
    }


public function cart_update(Request $request)
{
    // -------------------------
    // Basic request validation
    // -------------------------
    $request->validate([
        'ItemId'   => 'required|array',
        'ItemId.*' => 'integer|exists:cart_items,id',
        'quantity' => 'required|array',
    ]);

    try {

        DB::transaction(function () use ($request) {

            $itemIds    = $request->ItemId;
            $quantities = $request->quantity;

            // Fetch all cart items in one query
            $cartItems = CartItem::with(['product'])
                ->whereIn('id', $itemIds)
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception("Invalid cart items.");
            }

            // Ensure all items belong to ONE cart
            $cartId = $cartItems->pluck('cart_id')->unique();

            if ($cartId->count() !== 1) {
                throw new \Exception("Invalid cart state detected.");
            }

            foreach ($cartItems as $cartItem) {

                // Quantity must exist for every item
                if (!isset($quantities[$cartItem->id])) {
                    throw new \Exception("Quantity missing for cart item.");
                }

                $qty = filter_var(
                    $quantities[$cartItem->id],
                    FILTER_VALIDATE_INT,
                    ['options' => ['min_range' => 0]]
                );

                if ($qty === false) {
                    throw new \Exception("Invalid quantity value.");
                }

                // Remove item if qty = 0
                if ($qty === 0) {
                    $cartItem->delete();
                    continue;
                }

                // -------------------------
                // Resolve stock
                // -------------------------
                $stock = $cartItem->product->stock;

                if ($cartItem->color_id || $cartItem->attribute_value_id) {

                    $variant = ProAttributeValue::where([
                            'product_id'          => $cartItem->product_id,
                            'color_id'            => $cartItem->color_id,
                            'attribute_value_id'  => $cartItem->attribute_value_id,
                        ])->first();

                    if (!$variant) {
                        throw new \Exception("Product variation no longer exists.");
                    }

                    $stock = (int) $variant->stock;
                }

                if ($qty > $stock) {
                    throw new \Exception(
                        "Updated Cart Item of {$cartItem->product->name} only has {$stock} item(s) in stock."
                    );
                }

                // -------------------------
                // Update cart item
                // -------------------------
                $cartItem->update([
                    'quantity'   => $qty,
                    'line_total' => bcmul($qty, $cartItem->price, 2),
                ]);
            }

            // -------------------------
            // Recalculate cart totals
            // -------------------------
            $cart = Cart::findOrFail($cartId->first());

            $subtotal = $cart->items()->sum('line_total');
            $discount = min($cart->discount ?? 0, $subtotal);

            $cart->update([
                'subtotal' => $subtotal,
                'total'    => $subtotal - $discount,
            ]);
        });

    } catch (\Exception $e) {

        toastr()->error($e->getMessage());
        return redirect()->back();
    }

    toastr()->success("Cart updated successfully.");
    return redirect()->back();
}

public function cart_remove($id)
{
    try {
        DB::transaction(function () use ($id) {

            $cartItem = CartItem::findOrFail($id);
            $cartId = $cartItem->cart_id;

            // Delete the cart item
            $cartItem->delete();

            // Recalculate cart totals
            $cart = Cart::findOrFail($cartId);

            $subtotal = $cart->items()->sum('line_total');
            $discount = min($cart->discount ?? 0, $subtotal);

            $cart->update([
                'subtotal' => $subtotal,
                'total'    => $subtotal - $discount,
            ]);
        });

    } catch (\Exception $e) {

        toastr()->error($e->getMessage());
        return redirect()->back();
    }

    toastr()->success("Item removed from cart successfully.");
    return redirect()->back();

}
}
