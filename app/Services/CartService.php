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

        $userId = Auth::id();
        $sessionId = Session::getId();

        $cart = Cart::firstOrCreate(
            [
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
            ],
            [
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0,
            ]
        );

        // Default price & stock (simple product)
        $price = $product->sale_price;
        $stock = $product->stock;

        // Variant logic
        if (!empty($data['color']) || !empty($data['attribute_value_id'])) {

            $variant = ProAttributeValue::where('product_id', $product->id)
                ->where('color_id', $data['color'] ?? null)
                ->where('attribute_value_id', $data['attribute_value_id'] ?? null)
                ->first();

            if (!$variant) {
                throw new Exception('Invalid product variant selected.');
            }

            $price = $variant->price ?? $price;
            $stock = $variant->stock ?? 0;
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('color_id', $data['color'] ?? null)
            ->where('attribute_value_id', $data['attribute_value_id'] ?? null)
            ->first();

        $qty = $data['pro_qty'];

        if ($cartItem) {
            $newQty = $cartItem->quantity + $qty;

            if ($newQty > $stock) {
                throw new Exception("Only {$stock} item(s) available.");
            }

            $cartItem->update([
                'quantity' => $newQty,
                'line_total' => $newQty * $price,
            ]);
        } else {
            if ($qty > $stock) {
                throw new Exception("Only {$stock} item(s) available.");
            }

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'color_id' => $data['color'] ?? null,
                'attribute_value_id' => $data['attribute_value_id'] ?? null,
                'price' => $price,
                'quantity' => $qty,
                'line_total' => $price * $qty,
            ]);
        }

        $cart->update([
            'subtotal' => $cart->items()->sum('line_total'),
            'total' => $cart->subtotal - $cart->discount,
        ]);

        return true;
    }
}
