@extends('customer.layouts.app')

@section('title', 'Order Details')

@section('content')
    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>تتبع طلبك</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('customer.dashboard') }}">الرئيسية</a> /
                    <span class="text-gray">تتبع طلبك</span>
                </div>
            </div>
        </div>

        <section class="section-container my-5 py-5">
            {{-- <p>
                الطلب رقم # {{ $order_item->id }}  في  ------ {{ $order_item->created_at->diffForHumans() }} ------
            </p> --}}

            <section>
                <h2>تفاصيل الطلب</h2>
                <table class="success__table w-100 mb-5">
                    <thead>
                        <tr class="border-0 bg-danger text-white">
                            <th>المنتج</th>
                            <th>الحالة</th>
                            <th>تحميل</th>
                            <th class="d-none d-md-table-cell">السعر</th>
                            <th class="d-none d-md-table-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div>
                                    <a
                                        href="{{ route('customer.product_preview', $order_item->product) }}">{{ $order_item->product->title }}</a>
                                </div>
                            </td>
                            <td>
                                @if ($order_item->status == 'completed')
                                    <div class="badge text-bg-success">{{ $order_item->status }}</div>
                                @elseif ($order_item->status == 'pending')
                                    <div class="badge text-bg-warning">{{ $order_item->status }}</div>
                                @elseif ($order_item->status == 'cancelled')
                                    <div class="badge text-bg-danger">{{ $order_item->status }}</div>
                                @else
                                    <div class="badge text-bg-secondary">{{ $order_item->status }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($order_item->status === 'completed' && $order_item->payment_status === 'paid')
                                    <a href="{{ asset('storage/' . $order_item->product->file_path) }}" target="_blank">
                                        تحميل الملف
                                    </a>
                                @else
                                    <span class="text-muted">لم يكتمل الدفع</span>
                                @endif
                            </td>
                            <td>{{ $order_item->price }} $</td>
                            @if ($order_item->status === 'completed' && $order_item->payment_status === 'paid')
                                <td><a href="{{ route('customer.refund.create', [$order, $order_item]) }}" type="button"
                                        class="btn btn-outline-primary">استرد طلب
                                    </a></td>
                            @else
                                <td><span class="text-muted">غير متاح</span></td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </section>
    </main>
@endsection
