<!-- Header Content Start -->
<div>
    <div class="header-container fixed-top border-bottom">
        {{-- <header>
            <div class="section-container d-flex justify-content-between">
                <div class="header__email d-flex gap-2 align-items-center">
                    <i class="fa-regular fa-envelope"></i>
                    coding.arabic@gmail.com
                </div>
                <div class="header__info d-none d-lg-block">
                    شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
                </div>
                <div class="header__branches d-flex gap-2 align-items-center">
                    <a class="text-white text-decoration-none" href="branches.html">
                        <i class="fa-solid fa-location-dot"></i>
                        فروعنا
                    </a>
                </div>
            </div>
        </header> --}}
        <!-- Alerts Start -->
        @include('customer.layouts.nav')


        <div class="section-container mt-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>


    <!-- News Content Start -->
    <section class="sales text-center p-2 d-block d-lg-none">
        شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
    </section>
    <!-- News Content End -->
</div>
<!-- Header Content End -->
