    @extends('admin.layouts.app')

    @section('title', 'Admin Dashboard')

    @section('content')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Sales <span>| Today</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalOrders }}</h6>
                                                <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                    class="text-muted small pt-2 ps-1">increase</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.dashboard.totalSalesToday') }}">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>${{ $totalSales }}</h6>
                                                <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                    class="text-muted small pt-2 ps-1">increase</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-4 col-xl-12">

                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Customers </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $TotalCustomers }}</h6>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Customers Card -->
                            <div class="col-xxl-4 col-xl-12">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Vendors </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $TotalVendors }}</h6>
                                                {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                    class="text-muted small pt-2 ps-1">decrease</span> --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Customers Card -->

                            <!-- total Products Card -->
                            <div class="col-xxl-4 col-xl-12">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Products </h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $totalProducts }}</h6>
                                                {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                    class="text-muted small pt-2 ps-1">decrease</span> --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End total Products Card -->

                            <!-- Recent Sales -->


                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Sales</h5>
                                        <!-- Default Table -->
                                        @livewire('recent-orders')

                                    </div>
                                </div>
                            </div><!-- End Recent Sales -->

                            <!-- Top Selling -->
                            <div class="col-12">
                                <div class="card top-selling overflow-auto">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Preview</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Sold</th>
                                                    <th scope="col">Revenue</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($topSellings as $topSelling)
                                                    <tr>
                                                        <th scope="row"><a href="#"><img
                                                                    src="{{ asset('storage/' . $topSelling->thumbnail) }}"
                                                                    alt="{{ $topSelling->thumbnail }}"></a></th>
                                                        <td><a href="#"
                                                                class="text-primary fw-bold">{{ $topSelling->title }}</a>
                                                        </td>
                                                        <td>${{ $topSelling->price }}</td>
                                                        <td class="fw-bold">{{ $topSelling->order_items_count }}</td>
                                                        <td>${{ $topSelling->price * $topSelling->order_items_count }}</td>
                                                    </tr>
                                                @empty
                                                    لم يتم العثور على المنتجات الأكثر مبيعا.
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div><!-- End Top Selling -->

                        </div>
                    </div><!-- End Left side columns -->
                </div>
            </section>

        </main><!-- End #main -->
    @endsection
