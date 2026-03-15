<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order CConfirmation Email - {{ $order->id }}</title>
</head>
<body>

Hello {{ $order->billing_first_name }},

Thank you for your order.

Order Number: {{ $order->order_number }}
Total Amount: {{ number_format($order->total_amount) }}

Your invoice is attached to this email.

Thanks,
{{ config('app.name') }}

</body>
</html>