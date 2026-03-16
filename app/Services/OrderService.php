<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendOrderEmailJob;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\ProAttributeValue;


class OrderService
{
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::with(['items.product', 'items.proColor', 'items.proAttribute.attribute'])
                ->where('user_id', Auth::id())
                ->first();
        }

        return Cart::with(['items.product', 'items.proColor', 'items.proAttribute.attribute'])
            ->where('session_id', Session::getId())
            ->first();
    }

    public function createOrder($request, $cart)
    {
        $subtotal = $cart->items->sum('line_total');
        $shipping = 250;
        $discount = session('coupon_discount', 0);
        $total = max(0, ($subtotal + $shipping) - $discount);

        $order = Order::create([
            'user_id' => Auth::id(),
            'session_id' => Session::getId(),

            // Billing
            'billing_first_name' => $request->billing['first_name'],
            'billing_last_name'  => $request->billing['last_name'],
            'billing_email'      => $request->billing['email'],
            'billing_company'    => $request->billing['company'] ?? null,
            'billing_country'    => $request->billing['country'],
            'billing_address_1'  => $request->billing['address_1'],
            'billing_address_2'  => $request->billing['address_2'] ?? null,
            'billing_city'       => $request->billing['city'],
            'billing_state'      => $request->billing['state'] ?? null,
            'billing_postcode'   => $request->billing['postcode'],
            'billing_phone'      => $request->billing['phone'] ?? null,

            // Shipping
            'different_shipping' => $request->has('different_shipping'),
            'shipping_first_name' => $request->shipping['first_name'] ?? null,
            'shipping_last_name' => $request->shipping['last_name'] ?? null,
            'shipping_email'     => $request->shipping['email'] ?? null,
            'shipping_country'   => $request->shipping['country'] ?? null,
            'shipping_address_1' => $request->shipping['address_1'] ?? null,
            'shipping_address_2' => $request->shipping['address_2'] ?? null,
            'shipping_city'      => $request->shipping['city'] ?? null,
            'shipping_state'     => $request->shipping['state'] ?? null,
            'shipping_postcode'  => $request->shipping['postcode'] ?? null,

            'subtotal'        => $subtotal,
            'shipping_charge' => $shipping,
            'discount'        => $discount,
            'total_amount'    => $total,

            'order_note'     => $request->order_note ?? null,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status'   => 'pending',
        ]);

        foreach ($cart->items as $item) {

            // Variant Product
            if ($item->attribute_value_id) {

                $variant = ProAttributeValue::where('product_id', $item->product_id)
                    ->where('color_id', $item->color_id)
                    ->where('attribute_value_id', $item->attribute_value_id)
                    ->lockForUpdate()
                    ->first();

                if (!$variant) {
                    throw new \Exception("Product variant not found for {$item->product_name}");
                }

                if ($variant->stock < $item->quantity) {
                    throw new \Exception("Insufficient stock for {$item->product_name}");
                }

                $variant->decrement('stock', $item->quantity);
            }
            // Simple Product
            else {

                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Insufficient stock for {$item->product->name}");
                }

                $item->product->decrement('stock', $item->quantity);
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'price'      => $item->price,
                'quantity'   => $item->quantity,
                'line_total' => $item->line_total,
                'color_id'   => $item->color_id,
                'color_name' => $item->proColor->name ?? null,
                'attribute_id'   => $item->proAttribute->attribute->id ?? null,
                'attribute_name' => $item->proAttribute->attribute->name ?? null,
                'attribute_value' => $item->proAttribute->name ?? null,
            ]);
        }
        // Clear cart
        $cart->items()->delete();
        $cart->delete();
        session()->forget('coupon_discount');

        SendOrderEmailJob::dispatch($order->id)->afterCommit();

        return $order;
    }

    public function processStripePayment($order, $token)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $order->total_amount * 100, // Amount in cents (PKR 252 = 25200)
                'currency' => 'pkr', // Use 'pkr' or 'usd' depending on your Stripe account region
                'description' => 'Order #' . $order->order_number,
                'source' => $token,
                'metadata' => ['order_id' => $order->id],
            ]);

            if ($charge->status === 'succeeded') {
                $order->update([
                    'payment_status' => 'paid',
                    'transaction_id' => $charge->id // Good practice to store this
                ]);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            // If payment fails, we throw an exception so the Controller can roll back the DB
            throw new \Exception("Stripe Payment Failed: " . $e->getMessage());
        }
    }
}
