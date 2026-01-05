<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>

<h2>INVOICE</h2>

<p>
    Order #: {{ $order->order_number }} <br>
    Date: {{ $order->created_at->format('d M Y') }}
</p>

<h4>Billing Details</h4>
<p>
    {{ $order->billing_first_name }} {{ $order->billing_last_name }}<br>
    {{ $order->billing_address_1 }}<br>
    {{ $order->billing_city }}<br>
    {{ $order->billing_email }}
</p>

<h4>Order Items</h4>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price) }}</td>
                <td>{{ number_format($item->line_total) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>
    Subtotal: {{ number_format($order->subtotal) }} <br>
    Shipping: {{ number_format($order->shipping_charge) }} <br>
    Discount: {{ number_format($order->discount) }} <br>
    <strong>Total: {{ number_format($order->total_amount) }}</strong>
</p>

</body>
</html>
