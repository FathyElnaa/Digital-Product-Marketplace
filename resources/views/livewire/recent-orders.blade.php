<div>
    <div class="mb-3">
        <input type="text" wire:model.live="search" class="form-control" placeholder="Seacrh ....">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $recentOrder)
                <tr>
                    <th scope="row">#{{ $recentOrder->id }}</th>
                    <td>{{ $recentOrder?->order->user?->name }}</td>
                    <td>{{ $recentOrder->product->title }}</td>
                    <td>${{ $recentOrder->price }}</td>
                    <td>
                        @if ($recentOrder->status == 'completed')
                            <span class="badge bg-success">completed</span>
                        @elseif($recentOrder->status == 'pending')
                            <span class="badge bg-warning">pending</span>
                        @elseif($recentOrder->status == 'cancelled')
                            <span class="badge bg-danger">cancelled</span>
                        @elseif ($recentOrder->status == 'refunded')
                            <span class="badge bg-dark">refunded</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">لم يتم العثور على أي طلبات حديثة.</td>
                </tr>
            @endforelse
        </tbody>
        <tr>
            <td colspan="5">
                {{ $recentOrders->links('pagination::bootstrap') }}
            </td>
        </tr>
    </table>
</div>
