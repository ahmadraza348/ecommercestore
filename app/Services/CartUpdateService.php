<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProAttributeValue;
use App\Models\Coupon;

class CartUpdateService
{
    public function updateCartItems(array $data): void
    {
        $itemIds    = $data['ItemId'] ?? [];
        $quantities = $data['quantity'] ?? [];

        $cartItems = CartItem::with('product')
            ->whereIn('id', $itemIds)
            ->get();

        if ($cartItems->isEmpty()) {
            throw new \Exception("Invalid cart items.");
        }

        $cartIds = $cartItems->pluck('cart_id')->unique();

        if ($cartIds->count() !== 1) {
            throw new \Exception("Invalid cart state detected.");
        }

        foreach ($cartItems as $cartItem) {

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

            if ($qty === 0) {
                $cartItem->delete();
                continue;
            }

            $stock = $this->resolveStock($cartItem);

            if ($qty > $stock) {
                throw new \Exception(
                    "{$cartItem->product->name} only has {$stock} item(s) in stock."
                );
            }

            $cartItem->update([
                'quantity'   => $qty,
                'line_total' => bcmul($qty, $cartItem->price, 2),
            ]);
        }

        $this->recalculateCart($cartIds->first());
    }

    public function removeItem(int $id): void
    {
        $cartItem = CartItem::findOrFail($id);
        $cartId   = $cartItem->cart_id;

        $cartItem->delete();

        $this->recalculateCart($cartId);
    }

    public function applyCoupon(string $couponCode, string $sessionId): void
    {
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            throw new \Exception("Invalid coupon code.");
        }

        if (!$coupon->isActive()) {
            throw new \Exception("Coupon is not active.");
        }

        if (now()->greaterThan($coupon->ending_at)) {
            throw new \Exception("Coupon has expired.");
        }

        $cart = Cart::with('items')
            ->where('session_id', $sessionId)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            throw new \Exception("Cart is empty.");
        }

        if ($cart->coupon_id) {
            throw new \Exception("Coupon already applied.");
        }

        $subtotal = $cart->items->sum('line_total');

        if ($subtotal <= 0) {
            throw new \Exception("Invalid cart total.");
        }

        if ($coupon->discount_type === 'fixed_amount') {
            $discount = min($coupon->amount, $subtotal);
        } else {
            $discount = round(($subtotal * $coupon->amount) / 100, 2);
        }

        $total = max(0, $subtotal - $discount);

        $cart->update([
            'subtotal'  => $subtotal,
            'discount'  => $discount,
            'total'     => $total,
            'coupon_id' => $coupon->id,
        ]);
    }

    private function resolveStock($cartItem): int
    {
        if ($cartItem->color_id || $cartItem->attribute_value_id) {

            $variant = ProAttributeValue::where([
                'product_id'         => $cartItem->product_id,
                'color_id'           => $cartItem->color_id,
                'attribute_value_id' => $cartItem->attribute_value_id,
            ])->first();

            if (!$variant) {
                throw new \Exception("Product variation no longer exists.");
            }

            return (int) $variant->stock;
        }

        return (int) $cartItem->product->stock;
    }

    /**
     * 🔥 IMPORTANT:
     * Any cart change invalidates coupon completely.
     */
    private function recalculateCart(int $cartId): void
    {
        $cart = Cart::with('items')->findOrFail($cartId);

        $subtotal = $cart->items->sum('line_total');

        // Invalidate coupon on ANY cart change
        $cart->update([
            'subtotal'  => $subtotal,
            'discount'  => 0,
            'coupon_id' => null,
            'total'     => $subtotal,
        ]);
    }
}