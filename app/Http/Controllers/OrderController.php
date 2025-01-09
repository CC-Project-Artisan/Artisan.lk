<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderCourierDetails;

class OrderController extends Controller
{

    // Show All Orders for Vendor
    public function showVendorOrderDetails($orderId)
    {
        $order = Order::with('orderItems.product', 'courierDetail')->findOrFail($orderId);
        return view('components.vendor.vendor-order-details', compact('order'));
    }

    // Vendor Update Order Status
    public function updateStatus(Request $request, Order $order)
    {
        $order->order_status = $request->input('order_status');
        $order->save();

        if ($order->order_status == 'shipped') {
            $request->validate([
                'courier_name' => 'required|string|max:255',
                'courier_contact_number' => 'required|string|max:255',
                'tracking_number' => 'required|string|max:255',
                'delivery_date' => 'required|date',
            ]);

            $courierDetail = $order->courierDetail ?? new OrderCourierDetails();
            $courierDetail->order_id = $order->id;
            $courierDetail->courier_name = $request->input('courier_name');
            $courierDetail->courier_contact_number = $request->input('courier_contact_number');
            $courierDetail->tracking_number = $request->input('tracking_number');
            $courierDetail->delivery_date = $request->input('delivery_date');
            $courierDetail->save();
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // Delete Order for Customer
    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
