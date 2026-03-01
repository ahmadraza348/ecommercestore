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
            session()->forget(['coupon_code', 'coupon_discount', 'coupon_subtotal', 'coupon_total']);
            toastr()->success('Product added to cart successfully');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

        return back();
    }
}
