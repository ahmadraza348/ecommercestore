<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $data['coupons'] = Coupon::all();
        return view('backend.coupons.index', $data);
    }
    public function create(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'discount_type' => 'required',
            'amount' => 'required|numeric',
            'code' => 'required|string',
            'starting_from' => 'required|date',
            'ending_at' => 'required|date',
            'status' => 'required|string',
        ]);

        Coupon::create([
            'label' => $request->label,
            'discount_type' => $request->discount_type,
            'amount' => $request->amount,
            'code' => $request->code,
            'starting_from' => $request->starting_from,
            'ending_at' => $request->ending_at,
            'status' => $request->status,
        ]);
        toastr()->success('Coupon created successfully.');
        return redirect()->back();
    }
    
}
