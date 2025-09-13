<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundRequestController extends Controller
{
    public function create(Order $order,OrderItem $order_item){
        return view('customer.refund',compact('order','order_item'));
    }

    public function store(Request $request, Order $order,OrderItem $order_item)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        

        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::id() || $order_item->order_id !== $order->id) {
            return redirect()->route('orders.index')->with('error', 'لا يحق لك طلب استرداد الأموال لهذا العنصر من الطلب.');
        }

        // Check if a refund request already exists for this order item
        if ($order_item->refundRequest) {
            return redirect()->route('orders.index')->with('error', 'لقد تم بالفعل تقديم طلب استرداد الأموال لهذا العنصر.');
        }

        // Create the refund request
        $order_item->refundRequest()->create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'لقد تم تقديم طلب استرداد المبلغ الخاص بك بنجاح.');
    }
}
