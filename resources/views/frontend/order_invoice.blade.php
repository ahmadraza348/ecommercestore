<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation - Raza Mall</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f4f7ff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f4f7ff; padding-bottom: 40px; }
        .main { background-color: #ffffff; width: 100%; max-width: 600px; margin: 0 auto; border-spacing: 0; color: #444444; border-radius: 8px; overflow: hidden; margin-top: 20px; }
        .content { padding: 30px; }
        .status-pill { background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .item-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .item-table th { border-bottom: 2px solid #7367f0; text-align: left; padding: 10px; color: #7367f0; font-size: 13px; }
        .item-table td { padding: 15px 10px; border-bottom: 1px solid #edf2f7; font-size: 14px; }
        .total-box { background: #f8f9fa; padding: 20px; border-radius: 8px; }
        .social-icons { padding: 20px 0; text-align: center; }
        .social-icons img { width: 30px; margin: 0 8px; }
        .footer { text-align: center; font-size: 12px; color: #a0aec0; padding: 20px; }
    </style>
</head>
<body>
    <center class="wrapper">
        <table class="main">
               <tr>
                <td class="content">
                    <table width="100%">
                        <tr>
                            <td>
                                <h1 style="margin:0; font-size: 24px; color: #1a202c;">Thank you for your order!</h1>
                                <p style="color: #718096;">Hi {{ $order->billing_first_name }}, we've received your order and it's being processed.</p>
                            </td>
                            <td style="text-align: right; vertical-align: top;">
                                <span class="status-pill">{{ str_replace('_', ' ', $order->order_status) }}</span>
                            </td>
                        </tr>
                    </table>

                    <hr style="border: 0; border-top: 1px solid #edf2f7; margin: 20px 0;">

                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%" style="vertical-align: top;">
                                <h4 style="color: #7367f0; margin-bottom: 4px;">Delivery Address</h4>
                                <p style="font-size: 13px; line-height: 1.5; margin: 0;">
                                    {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                                    {{ $order->shipping_address_1 }}<br>
                                    {{ $order->shipping_city }}, {{ $order->shipping_postcode }}<br>
                                    {{ $order->shipping_phone }}
                                </p>
                            </td>
                            <td width="50%" style="vertical-align: top; padding-left: 20px;">
                                <h4 style="color: #7367f0; margin-bottom: 4px;">Order Summary</h4>
                                <p style="font-size: 13px; line-height: 1.5; margin: 0;">
                                    <strong>Order ID:</strong> #{{ $order->order_number }}<br>
                                    <strong>Date:</strong> {{ $order->created_at->format('d M Y') }}<br>
                                    <strong>Payment:</strong> {{ str_replace('_', ' ', $order->payment_method ?? 'COD') }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table class="item-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: bold; color: #2d3748;">{{ $item->product_name }}</div>
                                    <div style="font-size: 12px; color: #718096;">
                                        {{ $item->color_name }} | {{ $item->attribute_value }}
                                    </div>
                                </td>
                                <td style="text-align: center;">{{ $item->quantity }}</td>
                                <td style="text-align: right; font-weight: bold;">Rs. {{ number_format($item->line_total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table width="100%" class="total-box">
                        <tr>
                            <td style="font-size: 14px; padding-bottom: 5px;">Subtotal</td>
                            <td style="text-align: right; font-size: 14px; padding-bottom: 5px;">Rs. {{ number_format($order->subtotal) }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px; padding-bottom: 5px;">Shipping</td>
                            <td style="text-align: right; font-size: 14px; padding-bottom: 5px;">Rs. {{ number_format($order->shipping_charge) }}</td>
                        </tr>
                        @if($order->discount > 0)
                        <tr>
                            <td style="font-size: 14px; color: #e53e3e;">Discount</td>
                            <td style="text-align: right; font-size: 14px; color: #e53e3e;">- Rs.{{ number_format($order->discount) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="font-size: 18px; font-weight: bold; padding-top: 10px; border-top: 1px solid #d1d5db;">Total Amount</td>
                            <td style="text-align: right; font-size: 18px; font-weight: bold; padding-top: 10px; border-top: 1px solid #d1d5db; color: #7367f0;">
                                Rs. {{ number_format($order->total_amount) }}
                            </td>
                        </tr>
                    </table>

                    @if($order->order_note)
                    <div >
                        <strong>Note:</strong> {{ $order->order_note }}
                    </div>
                    @endif
                </td>
            </tr>

            <tr>
                <td class="footer">
                    <div class="social-icons">
                        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
                        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"></a>
                        <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
                    </div>
                    <p style="margin-bottom: 5px;">&copy; {{ date('Y') }} Raza Mall. All rights reserved.</p>
                    <p>Gojra, Punjab, Pakistan | Support: support@razamall.com</p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>