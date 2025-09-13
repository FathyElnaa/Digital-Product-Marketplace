<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class RecentOrders extends Component
{
    use \Livewire\WithPagination;
    public $search = '';

    public function render()
    {
        $recentOrders = OrderItem::with(['product', 'order.user'])
        ->WhereHas('order.user', function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->orWhereHas('product', function ($q) {
            $q->where('title', 'like', '%' . $this->search . '%');
        })->orWhere('status','like', '%' . $this->search . '%')->latest()
            ->paginate(10);
        return view('livewire.recent-orders', compact('recentOrders'));
    }
}
