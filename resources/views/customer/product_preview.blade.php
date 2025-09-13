@extends('customer.layouts.app')

@section('title')

@section('content')
    <main>
        <!-- Product details Start -->
        <section class="section-container my-5 pt-5 d-md-flex gap-5">
            <div class="single-product__img w-100" id="main-img">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
            </div>
            <div class="single-product__details w-100 d-flex flex-column justify-content-between">
                <div>
                    <h4>{{ $product->title }}</h4>
                    <div class="product__author">{{ $product->vendor->name }}</div>
                    <div class="product__price mb-3 text-center d-flex gap-2">
                        {{-- <span class="product__price product__price--old fs-6 ">
                            450.00 $
                        </span> --}}
                        <span class="product__price fs-5">
                            {{ $product->price }}$
                        </span>
                    </div>
                    <div class="d-flex w-100 gap-2 mb-3">

                        <form action="{{ route('cart.add', $product) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="single-product__add-to-cart primary-button w-100">
                                أضف إلى السلة
                            </button>
                        </form>

                        <form action="{{ route('orders.store', $product->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="single-product__add-to-cart btn btn-secondary w-100">
                                اشتري الأن
                            </button>
                        </form>
                    </div>

                    <form action="{{ route('wishlist.store', $product->id) }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit"
                            class="single-product__favourite d-flex align-items-center gap-2 mb-4 border-0 bg-transparent p-0"
                            style="cursor: pointer;">
                            <i class="fa-regular fa-heart"></i>
                            اضافة للمفضلة
                        </button>
                    </form>

                    <div class="single-product__categories">
                        <div>
                            <span>التصنيفات: </span><a href="shop.html">{{ $product?->category?->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product details End -->

        <!-- Description and questions Start -->
        <section class="section-container">
            <nav class="mb-0 ">
                <div class="nav nav-tabs single-product__nav pb-0 gap-2" id="nav-tab" role="tablist">
                    <button class="single-product__tab nav-link active" id="single-product__describtion-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        الوصف
                    </button>
                    <button class="single-product__tab nav-link" id="single-product__questions-tab" data-bs-toggle="tab"
                        data-bs-target="#single-product__questions" type="button" role="tab"
                        aria-controls="nav-profile" aria-selected="false">
                        الاسئلة الشائعة
                    </button>
                </div>
            </nav>
            <div class="tab-content pt-4" id="nav-tabContent">
                <div class="tab-pane show active" id="nav-description" role="tabpanel"
                    aria-labelledby="single-product__describtion-tab" tabindex="0">
                    {{ $product->description }}
                </div>
                <div class="questions tab-pane" id="single-product__questions" role="tabpanel"
                    aria-labelledby="single-product__questions-tab" tabindex="0">
                    <div class="questions__list accordion" id="question__list">
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="question1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    الشحن بيوصل خلال قد ايه؟
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="question1"
                                data-bs-parent="#question__list">
                                <div class="accordion-body">
                                    خلال 3 ايام داخل القاهرة والجيزة و7 ايام خارج القاهرة والجيزة.
                                </div>
                            </div>
                        </div>
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    خامات التصنيع؟
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#question__list">
                                <div class="accordion-body">
                                    خامات مصرية عالية الجودة.
                                </div>
                            </div>
                        </div>
                        <div class="questions__item accordion-item">
                            <h2 class="questions__header accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    متاح استبدال او استرجاع المنتج
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#question__list">
                                <div class="accordion-body">
                                    نعم، متاح الاستبدال والاسترجاع خلال 7 ايام، برجاء مراجعة <a class="text-danger"
                                        href="refund-policy.html">سياسة الاسترجاع والاستبدال</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Description and questions End -->

        <!-- Features Start -->
        <section class="section-container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-1.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">تحميل فوري</h6>
                            <p class="features__item-text m-0">احصل على منتجك الرقمي مباشرة بعد إتمام عملية الدفع دون
                                انتظار.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-2.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">جودة مضمونة</h6>
                            <p class="features__item-text m-0">جميع المنتجات يتم مراجعتها والتحقق من جودتها قبل عرضها في
                                المنصة.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-3.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">دفع آمن</h6>
                            <p class="features__item-text m-0">طرق دفع متعددة وآمنة تحافظ على بياناتك المالية في أمان تام.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="features__item d-flex align-items-center gap-2">
                        <div class="features__img">
                            <img class="w-100" src="assets/images/feature-4.png" alt="">
                        </div>
                        <div>
                            <h6 class="features__item-title m-0">دعم فني سريع</h6>
                            <p class="features__item-text m-0">فريق دعم متاح على مدار الساعة لمساعدتك في أي مشكلة أو
                                استفسار.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features End -->
        <section class="section-container mb-5">
            <h5 class="mb-3">التقييمات</h5>
            @forelse ($product->reviews as $review)
                <div class="border p-3 mb-2 rounded">
                    {{-- ✅ بيانات الريفيو --}}
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-warning">
                        @for ($i = 1; $i <= $review->rating; $i++)
                            ★
                        @endfor
                    </span>
                    <p>{{ $review->comment }}</p>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>

                    {{-- ✅ رد البائع --}}
                    @if ($review->reply)
                        <div class="mt-3 p-2 rounded bg-light border-start border-3 border-primary">
                            <strong>رد البائع:</strong>
                            <p class="mb-0">{{ $review->reply }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center py-4">
                        لا يوجد تقييمات بعد.
                    </div>
                </div>
            @endforelse
        </section>

        @auth
            <section class="section-container mb-5">
                <h5 class="mb-3">أضف تقييمك</h5>
                <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating">التقييم (من 1 لـ 5)</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">اختر التقييم</option>
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment">تعليقك</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                </form>
            </section>
        @endauth


        <!-- Related products Start -->
        <section class="section-container">
            <div class="d-flex gap-4 align-items-center w-100 mb-4">
                <h5 class="m-0">منتجات ذات صلة</h5>
                <hr class="flex-grow-1">
            </div>
            <div class="row">
                @foreach ($Related_Products as $Related_Product)
                    <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
                        <div class="product__header mb-3">
                            <a href="{{ route('customer.product_preview', $Related_Product->id) }}">
                                <div class="product__img-cont">
                                    <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ asset('storage/' . $Related_Product->thumbnail) }}" data-id="white">
                                </div>
                            </a>
                            {{-- <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                                وفر 10%
                            </div> --}}
                            <div
                                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </div>
                        <div class="product__title text-center">
                            <a class="text-black text-decoration-none" href="single-product.html">
                                {{ $Related_Product->name }}
                            </a>
                        </div>
                        <div class="product__author text-center">
                            {{ $Related_Product->vendor->name }}
                        </div>
                        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
                            {{-- <span class="product__price product__price--old">
                            550.00 $
                        </span> --}}
                            <span class="product__price">
                                {{ $Related_Product->price }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Related products End -->

        <!-- Users comments Start -->

        <section class="section-container comments mb-5">
            <div class="d-flex gap-4 align-items-center w-100 mb-4">
                <h5 class="m-0">أعرف آراء عملاؤنا</h5>
                <hr class="flex-grow-1">
            </div>

            @forelse ($reviews as $review)
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="comments__item border rounded p-3 h-100 shadow-sm text-center">
                            <div class="comments__icon mb-3">
                                <img width="40" src="{{ asset('customer/assets/images/quote.png') }}"
                                    alt="">
                            </div>
                            <div class="comments__text mb-3">
                                {{ $review->comment }}
                            </div>
                            <div class="comments__author d-flex justify-content-center align-items-center gap-2">
                                <div class="comments__author-dash bg-primary" style="width:30px;height:2px;"></div>
                                <div class="comments__author-name fw-bolder">
                                    {{ $review?->user?->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center py-4">
                            لا يوجد آراء بعد. </div>
                    </div>
            @endforelse


            </div>
        </section>


        {{-- <section class="section-container comments mb-5">
            <div class="d-flex gap-4 align-items-center w-100 mb-4">
                <h5 class="m-0">أعرف اراء عملاؤنا</h5>
                <hr class="flex-grow-1">
            </div>
            <div class="comments__slider owl-carousel owl-theme">
                <div class="comments__item">
                    <div class="comments__icon">
                        <img class="w-100" src="{{ asset('customer/assets/images/quote.png') }}" alt="">
                    </div>
                    <div class="comments__text mb-3">
                        الكتاب جميل جدا
                    </div>
                    <div class="comments__author d-flex align-items-center gap-2">
                        <div class="comments__author-dash"></div>
                        <div class="comments__author-name fw-bolder">
                            Moamen Sherif
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Users comments End -->
    </main>
@endsection
