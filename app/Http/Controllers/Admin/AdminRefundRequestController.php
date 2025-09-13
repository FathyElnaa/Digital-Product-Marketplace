<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Http\Controllers\Controller;

class AdminRefundRequestController extends Controller
{
    public function index()
    {
        // $refund_requests = RefundRequest::orderBy('id', 'asc')->paginate(10);
        return view('admin.refund_requests.index');
    }

    // public function approve(RefundRequest $refund_request)
    // {
    //     $refund_request->update(['status' => 'approved']);
    //     $orderItem = $refund_request->orderItem;
    //     $orderItem->update(['status' => 'refunded', 'payment_status' => 'refunded']);
    //     return redirect()->route('admin.refund_requests.index')->with('success', 'تمت الموافقة على طلب الاسترداد بنجاح.');
    // }
    // public function reject(RefundRequest $refund_request)
    // {
    //     $refund_request->update(['status' => 'rejected']);
    //     return redirect()->route('admin.refund_requests.index')->with('success', 'تم رفض طلب الاسترداد بنجاح.');
    // }
}
