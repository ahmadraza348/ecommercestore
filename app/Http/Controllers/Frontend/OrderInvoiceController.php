<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderInvoiceController extends Controller
{
 public function show(Order $order)
{
    if ($order->user_id && $order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('frontend.order_invoice', compact('order'));
}


    public function download(Order $order)
    {
        $pdf = Pdf::loadView('frontend.order_invoice', compact('order'));

        return $pdf->download('invoice-'.$order->order_number.'.pdf');
    }
}
