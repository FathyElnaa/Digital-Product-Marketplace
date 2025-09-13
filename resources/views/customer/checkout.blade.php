@extends('customer.layouts.app')

@section('title', 'checkout')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>إتمام الطلب</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('customer.dashboard') }}">الرئيسية</a> /
                    <span class="text-gray">إتمام الطلب</span>
                </div>
            </div>
        </section>

        <section class="section-container my-5 py-5 d-lg-flex">
            {{-- <div class="checkout__form-cont w-50 px-3 mb-5">
                <h4>بيانات العميل </h4>

            </div> --}}

            <div class="checkout__order-details-cont w-100 px-3">
                <h2>طلبك</h2>
                <div>
                    <table class="w-100 checkout__table">

                        <thead>
                            <tr class="border-0">
                                <th>المنتج</th>
                                <th>صورة</th>
                                <th>السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart as $item)
                                <tr>
                                    <td>{{ $item->product->title }}</td>
                                    <td><img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt=""
                                            width="50"></td>
                                    <td>
                                        <span class="product__price">{{ $item->product->price }} $ </span>
                                    </td>
                                </tr>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center py-4">
                                        سلة التسوق الخاصة بك فارغة. </div>
                                </div>
                            @endforelse
                            <tr>
                                <th>المجموع</th>
                                <th></th>
                                <td class="fw-bolder">{{ number_format($totalAmount, 2) }} $</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form class="checkout__form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    {{-- <div class="d-flex gap-3 mb-3">
                    <div class="w-50">
                        <label for="first-name">الاسم الأول <span class="required">*</span></label>
                        <input class="form__input" type="text" id="first-name" name="name" required
                            value="{{ old('name', Auth::user()->name ?? '') }}" />
                    </div>
                    <div class="w-50">
                        <label for="email">البريد الإلكتروني <span class="required">*</span></label>
                        <input class="form__input" type="email" id="email" name="email"
                            value="{{ old('email', Auth::user()->email ?? '') }}" required />

                    </div>
                </div> --}}
                    <button class="primary-button w-100 py-2">تأكيد الطلب</button>
                </form>
            </div>
        </section>
    </main>
@endsection
