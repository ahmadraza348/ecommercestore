@extends('frontend.layouts.layout')
@section('content')
    <div class="page-main-wrapper">
        <div class="container">
            <div class="row">
                <div class="container">
                    <h1>Thank You for Your Order!</h1>
                    <p>Your Order ID is: <strong>#{{ $order_number }}</strong></p>
                    <p>We have sent a confirmation email with your invoice.</p>
                </div>

            </div>
        </div>
    </div>
@endsection
