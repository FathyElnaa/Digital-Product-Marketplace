@extends('customer.layouts.app')

@section('title', 'All Orders')

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
            <div class="profile__right">
                <div class="profile__user mb-3 d-flex gap-3 align-items-center">
                    <div class="profile__user-img rounded-circle overflow-hidden">
                        <img class="w-100" src="assets/images/user.png" alt="">
                    </div>
                    <div class="profile__user-name">{{ Str::upper($user->name) }}</div>
                </div>
                @include('customer.layouts.profile-nav')

            </div>
            <div class="profile__left mt-4 mt-md-0 w-100">
                <div class="profile__tab-content orders active">
                    <table class="orders__table w-100">
                        <thead>
                            <th class="d-none d-md-table-cell">الطلب</th>
                            <th class="d-none d-md-table-cell">التاريخ</th>
                            <th class="d-none d-md-table-cell">الحالة</th>
                            <th class="d-none d-md-table-cell">اجمالي السعر</th>
                            <th class="d-none d-md-table-cell">اجراءات</th>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="order__item">
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">الطلب:</div>
                                        <div><a href="">{{ $order->id }}#</a></div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">التاريخ:</div>
                                        <div>{{ $order->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">الحالة:</div>
                                        @if ($order->status == 'completed')
                                            <div class="badge text-bg-success">{{ $order->status }}</div>
                                        @elseif ($order->status == 'pending')
                                            <div class="badge text-bg-warning">{{ $order->status }}</div>
                                        @elseif ($order->status == 'cancelled')
                                            <div class="badge text-bg-danger">{{ $order->status }}</div>
                                        @else
                                            <div class="badge text-bg-secondary">{{ $order->status }}</div>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">السعر:</div>
                                        <div>{{ $order->total_price }}</div>
                                    </td>
                                    <td class="d-flex justify-content-between d-md-table-cell">
                                        <div class="fw-bolder d-md-none">اجراءات:</div>
                                        <div><a class="primary-button"
                                                href="{{ route('orders.OrderItem', $order) }}">عرض</a></div>
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
