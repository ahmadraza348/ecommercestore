<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProductCartRequest;
use App\Services\CartService;
use App\Services\ProductPageService;


class ProductPageController extends Controller
{
    protected $productPageService;

    public function __construct(ProductPageService $productPageService)
    {
        $this->productPageService = $productPageService;
    }

    public function index($slug)
    {
        $data = $this->productPageService->get_data($slug);
        
        return view('frontend.pro-detail', $data);
    }

public function addToCart(ProductCartRequest $request, CartService $cartService)
{       
    try {
        $cartService->add($request->validated());
        
        // Reset coupon session data since cart content changed
        session()->forget(['coupon_code', 'coupon_discount', 'coupon_subtotal', 'coupon_total']);

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully',
                'cart_count' => $cartService->getCount(), // Assuming your service has a getCount method
                'cart_total' => $cartService->getTotal()  // Optional: total price
            ]);
        }

        toastr()->success('Product added to cart successfully');
        return back();

    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }

        toastr()->error($e->getMessage());
        return back();
    }
}
}
