<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendOrderEmailJob;
use Illuminate\Support\Facades\Log;

use function Flasher\Toastr\Prime\toastr;

class CheckoutPageController extends Controller
{
    public function index()
    {
        $cartData = $this->getCartData();

        if (!$cartData || $cartData->items->isEmpty()) {
            toastr('Your cart is empty!', 'error');
            return redirect()->route('cartPage');
        }

        return view('frontend.checkout', compact('cartData'));
    }

    public function placeOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'billing.first_name' => 'required|string|max:255',
            'billing.last_name' => 'required|string|max:255',
            'billing.email' => 'required|email|max:255',
            'billing.company' => 'nullable|string|max:255',
            'billing.country' => 'required|string|max:255',
            'billing.address_1' => 'required|string|max:500',
            'billing.address_2' => 'nullable|string|max:500',
            'billing.city' => 'required|string|max:255',
            'billing.state' => 'nullable|string|max:255',
            'billing.postcode' => 'required|string|max:20',
            'billing.phone' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash,paypal',
            'order_note' => 'nullable|string|max:1000',

            // Shipping validation if different shipping is selected
            'different_shipping' => 'sometimes|boolean',
            'shipping.first_name' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.last_name' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.email' => 'required_if:different_shipping,1|nullable|email|max:255',
            'shipping.company' => 'nullable|string|max:255',
            'shipping.country' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.address_1' => 'required_if:different_shipping,1|nullable|string|max:500',
            'shipping.address_2' => 'nullable|string|max:500',
            'shipping.city' => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping.state' => 'nullable|string|max:255',
            'shipping.postcode' => 'required_if:different_shipping,1|nullable|string|max:20',
        ]);

        // Get cart data
        $cartData = $this->getCartData();

        if (!$cartData || $cartData->items->isEmpty()) {
            return redirect()->route('cartPage')->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $subtotal = $cartData->items->sum('line_total');
        $shipping = 250; // Fixed shipping charge
        $discount = session('coupon_discount', 0);
        $total = max(0, ($subtotal + $shipping) - $discount);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'session_id' => Session::getId(),

                // Billing Information
                'billing_first_name' => $request['billing']['first_name'],
                'billing_last_name' => $request['billing']['last_name'],
                'billing_email' => $request['billing']['email'],
                'billing_company' => $request['billing']['company'] ?? null,
                'billing_country' => $request['billing']['country'],
                'billing_address_1' => $request['billing']['address_1'],
                'billing_address_2' => $request['billing']['address_2'] ?? null,
                'billing_city' => $request['billing']['city'],
                'billing_state' => $request['billing']['state'] ?? null,
                'billing_postcode' => $request['billing']['postcode'],
                'billing_phone' => $request['billing']['phone'] ?? null,

                // Shipping Information
                'different_shipping' => $request->has('different_shipping'),
                'shipping_first_name' => $request['shipping']['first_name'] ?? null,
                'shipping_last_name' => $request['shipping']['last_name'] ?? null,
                'shipping_email' => $request['shipping']['email'] ?? null,
                'shipping_company' => $request['shipping']['company'] ?? null,
                'shipping_country' => $request['shipping']['country'] ?? null,
                'shipping_address_1' => $request['shipping']['address_1'] ?? null,
                'shipping_address_2' => $request['shipping']['address_2'] ?? null,
                'shipping_city' => $request['shipping']['city'] ?? null,
                'shipping_state' => $request['shipping']['state'] ?? null,
                'shipping_postcode' => $request['shipping']['postcode'] ?? null,

                // Order Totals
                'subtotal' => $subtotal,
                'shipping_charge' => $shipping,
                'discount' => $discount,
                'total_amount' => $total,

                // Additional Info
                'order_note' => $request['order_note'] ?? null,
                'payment_method' => $request['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            // Create order items from cart items
            foreach ($cartData->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product_name,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                    'line_total' => $cartItem->line_total,
                    'color_id' => $cartItem->color_id,
                    'color_name' => $cartItem->proColor->name ?? null,
                    'attribute_id' => $cartItem->proAttribute->attribute->id ?? null,
                    'attribute_name' => $cartItem->proAttribute->attribute->name ?? null,
                    'attribute_value' => $cartItem->proAttribute->name ?? null,
                ]);

                // Update product stock if needed
                if ($cartItem->product) {
                    $cartItem->product->decrement('stock', $cartItem->quantity);
                }
            }

            // Clear the cart
            $cartData->items()->delete();
            $cartData->delete();

            // Clear coupon session
            session()->forget('coupon_discount');

            // Commit transaction
            DB::commit();

            try {
                SendOrderEmailJob::dispatch($order->id)->afterCommit();
            } catch (\Exception $e) {
                Log::error('Order email failed to send: ' . $e->getMessage());
            }

            // Send email notification (you can implement this later)
            // $this->sendOrderConfirmationEmail($order);

            // Redirect to thank you page

            toastr()->success('Order placed successfully!');
            return redirect()->route('order.thankyou', $order->order_number);
        } catch (\Exception $e) {
            DB::rollBack();
            toastr('An error occurred while placing your order: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }


    public function order_thankyou($order_number)
    {
        return view('frontend.thankyou', compact('order_number'));
    }

    private function getCartData()
    {
        if (Auth::check()) {
            return Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
                ->where('user_id', Auth::id())
                ->first();
        }

        return Cart::with(['items.product.gallery_images', 'items.proColor', 'items.proAttribute.attribute'])
            ->where('session_id', Session::getId())
            ->first();
    }
}
