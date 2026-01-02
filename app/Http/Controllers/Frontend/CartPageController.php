<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProAttributeValue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function cart()
    {
        return view('frontend.cart');
    }


    public function cart_update(Request $request)
    {
        $request->validate([
            'ItemId'   => 'required|array',
            'ItemId.*' => 'integer|exists:cart_items,id',
            'quantity' => 'required|array',
        ]);
        Session()->forget(['coupon_code', 'coupon_discount', 'coupon_subtotal', 'coupon_total']);


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
        Session()->forget(['coupon_code', 'coupon_discount', 'coupon_subtotal', 'coupon_total']);

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

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon_code = $request->coupon_code;

        $coupon = Coupon::where('code', $coupon_code)->first();
        if (!$coupon) {
            toastr()->error('Invalid coupon code.');
            return back();
        }

        if (! $coupon->isActive()) {
            toastr()->error('Coupon is not active.');
            return back();
        }

        // Check expiry using endOfDay for today-inclusive validity
        if (now()->greaterThan($coupon->ending_at->endOfDay())) {
            toastr()->error('Coupon has expired.');
            return back();
        }

        // Check cart exists
        $session_id = session()->getId();
        $cart = Cart::where('session_id', $session_id)->first();

        if (!$cart || $cart->items()->count() === 0) {
            toastr()->error('Cart is empty.');
            return back();
        }

        // Check if a coupon is already applied in session
        if (session()->has('coupon_code')) {
            toastr()->error('A coupon is already applied.');
            return back();
        }

        // Recalculate subtotal
        $subtotal = $cart->items()->sum('line_total');
        if ($subtotal <= 0) {
            toastr()->error('Invalid cart total.');
            return back();
        }

        // Calculate discount
        if ($coupon->discount_type === 'fixed_amount') {
            $discount = min($coupon->amount, $subtotal);
        } else {
            $discount = round(($subtotal * $coupon->amount) / 100, 2);
        }

        // Store coupon details in session
        session([
            'coupon_code' => $coupon->code,
            'coupon_discount' => $discount,
            'coupon_subtotal' => $subtotal,
            'coupon_total' => $subtotal - $discount,
        ]);

        toastr()->success('Coupon applied successfully.');
        return back();
    }
}
