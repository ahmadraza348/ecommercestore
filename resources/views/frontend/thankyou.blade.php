@extends('frontend.layouts.layout')
@section('content')


<div class="page-main-wrapper">
    <div class="container">
        <div class="row">
            <h1>Thankyou for your order</h1>

            <a href="{{ route('order.invoice', $order->id) }}" target="_blank">
                View Invoice
            </a>

            <a href="{{ route('order.invoice.pdf', $order->id) }}">
                Download Invoice (PDF)
            </a>


        </div>
    </div>
</div>
@endsection