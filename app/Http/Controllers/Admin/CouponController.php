<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use App\Services\Admin\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data['coupons'] = Coupon::all();
        return view('backend.coupons.index', $data);
    }

    public function store(CouponRequest $request)
    {
        $this->service->create($request->validated());
        toastr()->success('Coupon created successfully.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        toastr()->success('Coupon Updated successfully.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        toastr()->success('Coupon Deleted successfully.');

        return redirect()->back();
    }
}
