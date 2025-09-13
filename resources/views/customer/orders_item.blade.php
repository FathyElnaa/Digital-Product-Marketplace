@extends('customer.layouts.app')

@section('title', 'Orders Item')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center ">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="index.html">الرئيسية</a> /
                    <span class="text-gray">حسابي</span>
                </div>
            </div>
        </section>

        <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
            <div class="profile__left mt-4 mt-md-0 w-100">
                <div class="profile__tab-content orders active">
                    <table class="orders__table w-100">
                        <thead>
                            <th class="d-none d-md-table-cell">الطلب</th>
                            <th class="d-none d-md-table-cell">الاسم</th>
                            <th class="d-none d-md-table-cell">التاريخ</th>
                            <th class="d-none d-md-table-cell">الحالة</th>
                            <th class="d-none d-md-table-cell">السعر</th>
                            <th class="d-none d-md-table-cell">اجراءات</th>
                        </thead>
                        <tbody>
                            @forelse ($orderItems as $orderItem)
                                <tr class="order__item">
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">الطلب:</div>
                                        <div><a href="">{{ $orderItem->id }}#</a></div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">الاسم:</div>
                                        <div><a
                                                href="{{ route('customer.product_preview', $orderItem->product) }}">{{ $orderItem->product->title }}</a>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">التاريخ:</div>
                                        <div>{{ $orderItem->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">الحالة:</div>
                                        @if ($orderItem->status == 'completed')
                                            <div class="badge text-bg-success">{{ $orderItem->status }}</div>
                                        @elseif ($orderItem->status == 'pending')
                                            <div class="badge text-bg-warning">{{ $orderItem->status }}</div>
                                        @elseif ($orderItem->status == 'cancelled')
                                            <div class="badge text-bg-danger">{{ $orderItem->status }}</div>
                                        @else
                                            <div class="badge text-bg-secondary">{{ $orderItem->status }}</div>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">السعر:</div>
                                        <div>{{ $orderItem->price }}</div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">اجراءات:</div>
                                        <div><a class="primary-button"
                                                href="{{ route('customer.OneOrder', ['order' => $order, 'order_item' => $orderItem]) }}">
                                                عرض
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="orders__none d-flex justify-content-between align-items-center py-3 px-4">
                                    <p class="m-0">لم يتم تنفيذ اي طلب بعد.</p>
                                    <a href="{{ route('customer.all_products') }}">
                                        <button class="primary-button">تصفح المنتجات</button>

                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
