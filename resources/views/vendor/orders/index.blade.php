@extends('vendor.layouts.app')

@section('title', 'Orders Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Orders Management</h5>
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Create At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ number_format($order->total_price, 2) }} $</td>
                                                <td>
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-warning">pending</span>
                                                    @elseif($order->status == 'completed')
                                                        <span class="badge bg-success">completed</span>
                                                    @elseif($order->status == 'cancelled')
                                                        <span class="badge bg-danger">cancelled</span>
                                                    @elseif($order->status == 'refunded')
                                                        <span class="badge bg-black">refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <!-- End Table with stripped rows -->
                                {{ $orders->links('pagination::bootstrap-5') }}

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
