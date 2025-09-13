@extends('customer.layouts.app')

@section('title', 'Dashboard - My Profile')

@section('content')
    <main>
        <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>حسابي</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('customer.dashboard') }}">الرئيسية</a> /
                    <span class="text-gray">حسابي</span>
                </div>
            </div>
        </section>

        <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
            <div class="profile__right mb-5">
                <div class="profile__user mb-3 d-flex gap-3 align-items-center">
                    <div class="profile__user-img rounded-circle overflow-hidden">
                        <img class="w-100" src="{{ asset('customer/assets/images/user.png') }}" alt="" />
                    </div>
                    <div class="profile__user-name">{{ Str::upper($user->name) }}</div>
                </div>
                @include('customer.layouts.profile-nav')
            </div>
            <div class="profile__left mt-4 mt-md-0 w-100">
                <div class="profile__tab-content active">
                    <p class="mb-5">
                        مرحبا <span class="fw-bolder">{{ Str::upper($user->name) }}</span> (لست
                        <span class="fw-bolder">{{ Str::upper($user->name) }}</span>?
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-danger bg-transparent border-0 p-0">
                            تسجيل الخروج
                        </button>
                    </form>)
                    </p>

                    <p>
                        من خلال لوحة تحكم الحساب الخاص بك، يمكنك استعراض
                        <a class="text-danger" href="orders.html">أحدث الطلبات</a>،
                        والفواتير
                        الخاصة بك، بالإضافة إلى
                        <a class="text-danger" href="{{ route('customer.account_details') }}">تعديل كلمة المرور وتفاصيل
                            حسابك</a>.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
