<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\ProAttributeValue;
use Illuminate\Support\Facades\DB;

class SalesService
{
    public function getsales()
    {
        return Order::with('items')->get();
    }

    public function updateOrderStatus(Order $order)
    {
        $order->order_status = request('order_status');
        $order->order_comment = request('order_comment');
        $order->save();
    }

    public function cancelOrder(Order $order)
    {
        // Wrap in a transaction to ensure data integrity
        DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                // 1. Handle Variant Product Restocking
                // Check if the order item has variant identifiers (color or attribute)
                if ($item->color_id || $item->attribute_id) {
                    
                    $variant = ProAttributeValue::where('product_id', $item->product_id)
                        ->where('color_id', $item->color_id)
                        // Note: Using attribute_id from OrderItem. 
                        // Ensure this matches your ProAttributeValue schema
                        ->where('attribute_value_id', $item->attribute_id) 
                        ->first();

                    if ($variant) {
                        $variant->increment('stock', $item->quantity);
                    }
                } 
                // 2. Handle Simple Product Restocking
                else {
                    if ($item->product) {
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }

            // Update status to cancelled
            $order->update([
                'order_status' => 'cancelled',
                'payment_status' => ($order->payment_status == 'paid') ? 'refunded' : $order->payment_status
            ]);
        });
    }
}