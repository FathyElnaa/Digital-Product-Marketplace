<div>
    <!-- Dropdown لاختيار الحالة -->
    <div class="mb-3">
        <select wire:model.live="status" class="form-select w-auto">
            <option value="">كل الحالات</option>
            <option value="pending">قيد المراجعة</option>
            <option value="approved">تمت الموافقة</option>
            <option value="rejected">تم الرفض</option>
        </select>
    </div>

    <!-- جدول الطلبات -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>المنتج</th>
                <th>الحالة</th>
                <th>تاريخ الطلب</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($refund_requests as $refund)
                <tr>
                    <td>{{ $refund->orderItem->order->user->name }}</td>
                    <td>{{ $refund->orderItem->product->title }}</td>
                    <td>
                        <span
                            class="badge
                            @if ($refund->status == 'pending') bg-warning
                            @elseif($refund->status == 'approved') bg-success
                            @else bg-danger @endif">
                            {{ $refund->status }}
                        </span>
                    </td>
                    <td>{{ $refund->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if ($refund->status == 'pending')
                            <button wire:click="approve({{ $refund->id }})" class="btn btn-sm btn-success">
                                موافقة
                            </button>
                            <button wire:click="reject({{ $refund->id }})" class="btn btn-sm btn-danger">
                                رفض
                            </button>
                        @else
                            <b>تمت المعالجة</b>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">لا توجد طلبات استرجاع</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $refund_requests->links('pagination::bootstrap') }}
    </div>
</div>
