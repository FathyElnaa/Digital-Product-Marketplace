@extends('vendor.layouts.app')

@section('title', 'Products Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products Management</h5>
                            <a href="{{ route('vendor.products.create') }}" type="button"
                                class="btn btn-outline-primary">Add
                                New Product</a>
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>File path</th>
                                            <th>thumbnail</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Create At</th>
                                            <th>Action</th>
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
                                                <td>{{ $product->slug }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ number_format($product->price, 2) }} $</td>
                                                <td>
                                                    @if ($product->status == 'pending')
                                                        <span class="badge bg-warning">قيد المراجعة</span>
                                                    @elseif($product->status == 'approved')
                                                        <span class="badge bg-success">مقبول</span>
                                                    @else
                                                        <span class="badge bg-danger">مرفوض</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $product->file_path) }}"
                                                        target="_blank">تحميل الملف</a>
                                                </td>
                                                <td>
                                                    @if ($product->thumbnail)
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                            alt="Thumbnail" width="50">
                                                    @else
                                                        لا يوجد صورة
                                                    @endif
                                                </td>
                                                <td>{{ $product->created_at->format('Y/m/d') }}</td>
                                                <td>
                                                    <a href="{{ route('vendor.products.edit', $product->id) }}"
                                                        type="button" class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('vendor.products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"class="btn btn-outline-danger">Delete</button>
                                                    </form>
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
