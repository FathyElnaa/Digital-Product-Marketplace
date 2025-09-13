<nav class="nav">
    <div class="section-container w-100 d-flex align-items-center gap-4 h-100">
        <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
            <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
            </button>
        </div>
        <div class="nav__logo">
            <a href="{{ route('customer.dashboard') }}">
                <img class="h-100" src="{{ asset('customer/assets/images/logo-d.png') }}" alt="">
            </a>
        </div>
        <div class="nav__search w-100">
            <form action="{{ route('products.search') }}" method="GET" class="d-flex w-100">
                <input class="nav__search-input w-100" type="search" name="search"
                    placeholder="أبحث هنا عن اي شئ تريده..." value="{{ request('search') }}">
                <button type="submit" class="nav__search-icon border-0 bg-transparent">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">
            @if (Auth::user())
                <li class="nav__link nav__link-user">
                    <a class="d-flex align-items-center gap-2">
                        حسابي
                        <i class="fa-regular fa-user"></i>
                        <i class="fa-solid fa-chevron-down fa-2xs"></i>
                    </a>
                    <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
                        <li class="nav__link nav__user-link"><a href="{{ route('customer.profile') }}">لوحة التحكم</a>
                        </li>
                        <li class="nav__link nav__user-link"><a href="{{ route('orders.index') }}">الطلبات</a></li>
                        <li class="nav__link nav__user-link"><a href="{{ route('customer.account_details') }}">تفاصيل
                                الحساب</a></li>
                        <li class="nav__link nav__user-link"><a href="{{ route('customer.wishlist') }}">المفضلة</a></li>

                        <li class="nav__link nav__user-link">
                            <a href="{{ route('customer.logout') }}"
                                onclick="event.preventDefault(); this.closest('li').querySelector('form').submit();">
                                تسجيل الخروج
                            </a>
                            <form method="POST" action="{{ route('customer.logout') }}" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </li>
                <li class="nav__link">
                    <a class="d-flex align-items-center gap-2" href="{{ route('customer.wishlist') }}">
                        المفضلة
                        <div class="position-relative">
                            <i class="fa-regular fa-heart"></i>
                            <div class="nav__link-floating-icon">

                                {{ $wishlistCount }}

                            </div>
                        </div>
                    </a>
                </li>
            @else
                <li class="nav__link">
                    <a class="d-flex align-items-center gap-2" href="{{ route('customer.login') }}">
                        تسجيل الدخول
                        <i class="fa-regular fa-user"></i>
                    </a>
                </li>
            @endif

            <li class="nav__link">
                <a class="d-flex align-items-center gap-2" data-bs-toggle="offcanvas" data-bs-target="#nav__cart">
                    عربة التسوق
                    <div class="position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <div class="nav__link-floating-icon">
                            {{ $cartCount }}
                        </div>
                    </div>
                </a>

            </li>
        </ul>
    </div>
    <div class="nav-mobile fixed-bottom d-block d-lg-none">
        <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled  m-0 border-top">
            <li class="nav-mobile__link">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none"
                    href="{{ route('customer.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    الرئيسية
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__categories">
                <i class="fa-solid fa-align-center fa-rotate-180"></i>
                الاقسام
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="profile.html">
                    <i class="fa-regular fa-user"></i>
                    حسابي
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
                <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="favourites.html">
                    <i class="fa-regular fa-heart"></i>
                    المفضلة
                </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
                data-bs-target="#nav__cart">
                <i class="fa-solid fa-cart-shopping"></i>
                السلة
            </li>
        </ul>
        <!--  -->
    </div>
</nav>
<div class="nav__categories offcanvas offcanvas-start px-4 py-2" tabindex="-1" id="nav__categories"
    aria-labelledby="nav__categories">
    <div class="nav__categories-header offcanvas-header justify-content-end">
        <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
        </button>
    </div>
    <div class="nav__categories-body offcanvas-body pt-0">
        <div class="nav__side-logo mb-2">
            <img class="w-100" src="assets/images/logo.png" alt="">
        </div>
        <ul class="nav__list list-unstyled">
            <li class="nav__link nav__side-link"><a href="{{ route('customer.all_products') }}" class="py-3">جميع
                    المنتجات</a>
            </li>
            @foreach ($categories as $category)
                <li class="nav__link nav__side-link"><a
                        href="{{ route('customer.ProductsByCategroy', $category->id) }}"
                        class="py-3">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>

<div class="nav__cart offcanvas offcanvas-end px-3 py-2" tabindex="-1" id="nav__cart" aria-labelledby="nav__cart">
    <div class="nav__categories-header offcanvas-header align-items-center">
        <h5>سلة التسوق</h5>
        <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
        </button>
    </div>
    <div class="nav__categories-body offcanvas-body pt-4">
        {{-- <p>لا توجد منتجات في سلة المشتريات.</p> --}}

        <div class="cart-products">

            @php
                $total = 0;
            @endphp
            <ul class="nav__list list-unstyled">
                @forelse($cartItems as $item)
                    @php
                        $total += $item->product->price;
                    @endphp
                    <li class="cart-products__item d-flex justify-content-between gap-2">
                        <div class="d-flex gap-2">
                            <div>

                                <form action="{{ route('cart.remove', $item->product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="cart-products__remove">x</button>
                                </form>

                            </div>
                            <div>
                                <p class="cart-products__name m-0 fw-bolder">{{ $item->product->title }}</p>
                                <p class="cart-products__price m-0">{{ $item->product->price }} $</p>
                            </div>
                        </div>
                        <div class="cart-products__img">
                            <img class="w-100" src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                alt="">
                        </div>
                    </li>
                @empty
                    <p>لا توجد منتجات في سلة المشتريات.</p>
                @endforelse

            </ul>
            <div class="d-flex justify-content-between">
                <p class="fw-bolder">المجموع:</p>
                <p>{{ $total }} جنيه</p>
            </div>
        </div>

        <a href="{{ route('checkout.index') }}">
            <button class="nav__cart-btn text-center text-white w-100 border-0 mb-3 py-2 px-3 bg-success">اتمام
                الطلب</button>
        </a>
        <a href="{{ route('customer.dashboard') }}">
            <button class="nav__cart-btn text-center w-100 py-2 px-3 bg-transparent">تابع التسوق</button>
        </a>
    </div>
</div>
