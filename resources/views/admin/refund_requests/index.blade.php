@extends('admin.layouts.app')
@section('title', 'Refunds Management')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>جدول الاسترداد</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Refunds</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="mb-3">
            <livewire:refund-filter />
        </div>

        {{-- <table class="table">
            <thead>
                <tr>
                    <th>الطلب</th>
                    <th>المستخدم</th>
                    <th>المنتج</th>
                    <th>السبب</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($refund_requests as $refund_request)
                    <tr>
                        <td>#{{ $refund_request->orderItem->id }}</td>
                        <td>{{ $refund_request->user->name }}</td>
                        <td>{{ $refund_request->orderItem->product->title }}</td>
                        <td>{{ $refund_request->reason }}</td>
                        <td>
                            @if ($refund_request->status == 'pending')
                                <span class="badge bg-warning text-dark">قيد الانتظار</span>
                            @elseif ($refund_request->status == 'approved')
                                <span class="badge bg-success">موافق عليه</span>
                            @elseif ($refund_request->status == 'rejected')
                                <span class="badge bg-danger">مرفوض</span>
                            @endif
                        </td>
                        <td>
                        @if ($refund_request->status == 'pending')
                            <form action="{{ route('admin.refunds.approve', $refund_request->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">موافقة</button>
                            </form>

                            <form action="{{ route('admin.refunds.reject', $refund_request->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger">رفض</button>
                            </form>
                        @else
                            {{ $refund_request->status }}
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </main>
@endsection
