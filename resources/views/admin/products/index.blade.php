@extends('admin.layouts.app')

@section('title', 'Products Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>جدول المنتجات</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Management</h5>
                            {{-- <a href="{{ route('admin.products.create') }}" type="button"
                                class="btn btn-outline-primary">Add
                                New Product</a> --}}
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>title</th>
                                            <th>Vendor</th>
                                            <th>category</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $product->title }}</td>
                                                <td>{{ $product->vendor->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    <a href="{{ route('admin.products.approve', $product->id) }}"
                                                        class="btn btn-success">موافقة</a>
                                                    <a href="{{ route('admin.products.reject', $product->id) }}"
                                                        class="btn btn-danger">رفض</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <!-- End Table with stripped rows -->
                                {{ $products->links('pagination::bootstrap-5') }}

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
