<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CartupdateRequest;
use App\Services\CartUpdateService;

class CartPageController extends Controller
{
    protected $cartUpdateService;
    public function __construct(CartUpdateService $cartUpdateService)
    {
        $this->cartUpdateService = $cartUpdateService;
    }
    public function cart()
    {
        return view('frontend.cart');
    }

    public function cart_update(CartupdateRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->cartUpdateService
                    ->updateCartItems($request->validated());
            });

            toastr()->success("Cart updated successfully.");
            return back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }
    
    public function cart_remove($id)
    {
        try {

            DB::transaction(function () use ($id) {
                $this->cartUpdateService->removeItem($id);
            });

            toastr()->success("Item removed successfully.");
            return back();
        } catch (\Exception $e) {

            toastr()->error($e->getMessage());
            return back();
        }
    }

  public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string'
    ]);

    try {

        DB::transaction(function () use ($request) {
            $this->cartUpdateService->applyCoupon(
                $request->coupon_code,
                session()->getId()
            );
        });

        toastr()->success("Coupon applied successfully.");
        return back();

    } catch (\Exception $e) {

        toastr()->error($e->getMessage());
        return back();
    }
}
}
