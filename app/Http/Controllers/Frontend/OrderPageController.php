<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PlaceOrderRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderPageController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cartData = $this->orderService->getCart();

        if (!$cartData || $cartData->items->isEmpty()) {
            toastr('Your cart is empty!', 'error');
            return redirect()->route('cartPage');
        }

        return view('frontend.checkout', compact('cartData'));
    }

public function placeOrder(PlaceOrderRequest $request)
{
    $cart = $this->orderService->getCart();

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cartPage')->with('error', 'Your cart is empty!');
    }

    DB::beginTransaction(); 

    try {
        // 1. Create the Order and reduce stock
        $order = $this->orderService->createOrder($request, $cart);

        // 2. If Stripe, charge the card immediately
        if ($request->payment_method === 'stripe') {
            if (!$request->stripeToken) {
                throw new \Exception("Payment token is missing.");
            }
            
            $this->orderService->processStripePayment($order, $request->stripeToken);
        }

        DB::commit();

        toastr()->success('Order placed successfully!');
        return redirect()->route('order.thankyou', $order->order_number);

    } catch (\Throwable $e) {
        DB::rollBack();
        
        // Log the actual error for debugging
        Log::error('Order Placement Error: ' . $e->getMessage());

        toastr($e->getMessage(), 'error');
        return back()->withInput();
    }
}

    public function order_thankyou($order_number)
    {
        return view('frontend.thankyou', compact('order_number'));
    }
}