<?php

namespace App\Livewire;

use Livewire\Component;

class RefundFilter extends Component
{
    public $status = '';

    public function approve($refundRequestId)
    {
        $refundRequest = \App\Models\RefundRequest::find($refundRequestId);
        if ($refundRequest) {
            $refundRequest->update(['status' => 'approved']);
            $orderItem = $refundRequest->orderItem;
            $orderItem->update(['status' => 'refunded', 'payment_status' => 'refunded']);
            session()->flash('success', 'تمت الموافقة على طلب الاسترداد بنجاح.');
        }
    }
    public function reject($refundRequestId)
    {
        $refundRequest = \App\Models\RefundRequest::find($refundRequestId);
        if ($refundRequest) {
            $refundRequest->update(['status' => 'rejected']);
            session()->flash('success', 'تم رفض طلب الاسترداد بنجاح.');
        }
    }
    public function render()
    {
        $refund_requests = \App\Models\RefundRequest::when($this->status, function ($query) {
            $query->where('status', $this->status);
        })->orderBy('id', 'asc')->paginate(10);
        return view('livewire.refund-filter', compact('refund_requests'));
    }
}
