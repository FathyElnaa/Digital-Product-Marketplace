@extends('customer.layouts.app')

@section('title', 'Home')

@section('content')
    <main class="pt-4">
        <!-- Hero Section Start -->
        <section class="section-container hero">
            <div class="owl-carousel hero__carousel owl-theme">
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('customer/assets/images/carousel-2.png') }}" alt="">
                </div>
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('customer/assets/images/carousel-2.png') }}" alt="">
                </div>
                <div class="hero__item">
                    <img class="hero__img" src="{{ asset('customer/assets/images/carousel-2.png') }}" alt="">
                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Offer Section Start -->
        {{-- <section class="section-container mb-5 mt-3">
            <div class="offer d-flex align-items-center justify-content-between rounded-3 p-3 text-white">
                <div class="offer__title fw-bolder">
                    عروض اليوم
                </div>
                <div class="offer__time d-flex gap-2 fs-6">
                    <div class="d-flex flex-column align-items-center">
                        <span class="fw-bolder">06</span>
                        <div>ساعات</div>
                    </div>:
                    <div class="d-flex flex-column align-items-center">
                        <span class="fw-bolder">10</span>
                        <div>دقائق</div>
                    </div>:
                    <div class="d-flex flex-column align-items-center">
                        <span class="fw-bolder">13</span>
                        <div>ثواني</div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Offer Section End -->

        <!-- Products Section Start -->
        <section class="section-container mb-4">
            <div class="owl-carousel products__slider owl-theme">
                @foreach ($products as $product)
                    <div class="products__item">

                        <div class="product__header mb-3">
                            <a href="{{ route('customer.product_preview', $product) }}">
                                <div class="product__img-cont">
                                    @if ($product->thumbnail)
                                        <img class="product__img w-100 h-100 object-fit-cover"
                                            src="{{ asset('storage/' . $product->thumbnail) }}" data-id="white">
                                    @else
                                        لا يوجد صورة
                                    @endif
                                </div>
                            </a>
                            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                                وفر 10%
                            </div>
                            <form action="{{ route('wishlist.store', $product->id) }}" method="POST"
                                class="m-0 p-0 position-absolute top-0 end-0 m-1">
                                @csrf
                                <button type="submit"
                                    class="rounded-circle d-flex justify-content-center align-items-center bg-white border-0 p-2"
                                    style="cursor: pointer; width: 35px; height: 35px;">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>

                        </div>
                        <div class="product__title text-center">
                            <a class="text-black text-decoration-none" href="single-product.html">
                                {{ $product->title }}
                            </a>
                        </div>
                        <div class="product__author text-center">
                            {{ $product?->vendor?->name }}
                        </div>
                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">

                            <span class="product__price">
                                {{ $product->price }} $
                            </span>
                        </div>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="single-product__add-to-cart primary-button w-100">
                                أضف إلى السلة
                            </button>
                        </form>
                    </div>
                @endforeach

            </div>
        </section>
        <!-- Products Section End -->

        <!-- Categories Section Start -->
        <section class="section-container mb-5">
            <div class="categories row gx-4">
                <div class="col-md-6 p-2">
                    <div class="p-4 border rounded-3">
                        <img class="w-100" src="assets/images/category-1.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="p-4 border rounded-3">
                        <img class="w-100" src="assets/images/category-2.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->

        <!-- Best Sales Section Start -->
        <section class="section-container mb-5">
            <div class="products__header mb-4 d-flex align-items-center justify-content-between">
                <h4 class="m-0">الاكثر مبيعا</h4>
                <button class="products__btn py-2 px-3 rounded-1">تسوق الأن</button>
            </div>
            <div class="owl-carousel products__slider owl-theme">

                {{-- --------------- --}}



                @foreach ($topSellings as $topSelling)
                    <div class="products__item">
                        <div class="product__header mb-3">
                            <a href="{{ route('customer.product_preview',$product) }}">
                                <div class="product__img-cont">
                                    <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ asset('storage/' . $topSelling->thumbnail) }}" data-id="white">
                                </div>
                            </a>

                            <div
                                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                        <div class="product__title text-center">
                            <a class="text-black text-decoration-none" href="{{ route('customer.product_preview',$product) }}">
                                {{ $topSelling->title }}
                            </a>
                        </div>
                        <div class="product__author text-center">
                            {{ $topSelling?->vendor?->name }}
                        </div>
                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">

                            <span class="product__price">
                                {{ $topSelling->price }} $
                            </span>
                        </div>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="single-product__add-to-cart primary-button w-100">
                                أضف إلى السلة
                            </button>
                        </form>
                    </div>
                @endforeach


            </div>
        </section>
        <!-- Best Sales Section End -->

        <!-- Newest Section Start -->
        {{-- <section class="section-container mb-5">
            <div class="products__header mb-4 d-flex align-items-center justify-content-between">
                <h4 class="m-0">وصل حديثا</h4>
                <button class="products__btn py-2 px-3 rounded-1">تسوق الأن</button>
            </div>
            <div class="owl-carousel products__slider owl-theme">


                @foreach ($newArrival as $topSelling)
                <div class="products__item">
                        <div class="product__header mb-3">
                            <a href="single-product.html">
                                <div class="product__img-cont">
                                    <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ asset('storage/'.$topSelling->thumbnail) }}" data-id="white">
                                </div>
                            </a>
                            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                                وفر 10%
                            </div>
                            <div
                                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                        <div class="product__title text-center">
                            <a class="text-black text-decoration-none" href="single-product.html">
                                {{ $topSelling->title }}
                            </a>
                        </div>
                        <div class="product__author text-center">
                            {{ $topSelling?->vendor?->name }}
                        </div>
                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
                             <span class="product__price product__price--old">
                                550.00 $
                            </span>
                            <span class="product__price">
                                {{ $topSelling->price }} $
                            </span>
                        </div>
                    </div>
                    @endforeach


            </div>
        </section> --}}
        <!-- Newest Section End -->
    </main>
@endsection
