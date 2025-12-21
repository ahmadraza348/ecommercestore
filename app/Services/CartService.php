<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProAttributeValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;

class CartService
{
    public function add(array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        // -------------------------
        // 1. Resolve cart identity
        // -------------------------
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                [
                    'subtotal' => 0,
                    'discount' => 0,
                    'total' => 0,
                ]
            );
        } else {
            $cart = Cart::firstOrCreate(
                ['session_id' => Session::getId()],
                [
                    'subtotal' => 0,
                    'discount' => 0,
                    'total' => 0,
                ]
            );
        }

        // -------------------------
        // 2. Base price & stock
        // -------------------------
        $price = $product->sale_price;
        $stock = $product->stock;

        // -------------------------
        // 3. Variant handling
        // -------------------------
        if (!empty($data['color']) || !empty($data['attribute_value_id'])) {

            $variantQuery = ProAttributeValue::where('product_id', $product->id);

            if (!empty($data['color'])) {
                $variantQuery->where('color_id', $data['color']);
            }

            if (!empty($data['attribute_value_id'])) {
                $variantQuery->where('attribute_value_id', $data['attribute_value_id']);
            }

            $variant = $variantQuery->first();

            if (!$variant) {
                throw new Exception('Invalid product variant selected.');
            }

            $price = $variant->price ?? $price;
            $stock = $variant->stock ?? 0;
        }

        // -------------------------
        // 4. Existing cart item?
        // -------------------------
        $cartItemQuery = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id);

        if (!empty($data['color'])) {
            $cartItemQuery->where('color_id', $data['color']);
        } else {
            $cartItemQuery->whereNull('color_id');
        }

        if (!empty($data['attribute_value_id'])) {
            $cartItemQuery->where('attribute_value_id', $data['attribute_value_id']);
        } else {
            $cartItemQuery->whereNull('attribute_value_id');
        }

        $cartItem = $cartItemQuery->first();

        $qty = (int) $data['pro_qty'];

        // -------------------------
        // 5. Quantity & stock check
        // -------------------------
        if ($cartItem) {
            $newQty = $cartItem->quantity + $qty;

            if ($newQty > $stock) {
                throw new Exception("Only {$stock} item(s) available.");
            }

            $cartItem->update([
                'quantity'   => $newQty,
                'line_total' => $newQty * $price,
            ]);
        } else {
            if ($qty > $stock) {
                throw new Exception("Only {$stock} item(s) available.");
            }

            CartItem::create([
                'cart_id'            => $cart->id,
                'product_id'         => $product->id,
                'product_name'       => $product->name,
                'color_id'           => $data['color'] ?? null,
                'attribute_value_id' => $data['attribute_value_id'] ?? null,
                'price'              => $price,
                'quantity'           => $qty,
                'line_total'         => $price * $qty,
            ]);
        }

        // -------------------------
        // 6. Recalculate totals
        // -------------------------
        $subtotal = $cart->items()->sum('line_total');

        $cart->update([
            'subtotal' => $subtotal,
            'total'    => $subtotal - $cart->discount,
        ]);

        return true;
    }
}
