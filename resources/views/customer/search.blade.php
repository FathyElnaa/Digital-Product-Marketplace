@extends('customer.layouts.app')

@section('title', 'Search Results')
@section('content')
    <main class="pt-4">
        <div class="container">
            <h4>نتائج البحث عن: <strong>{{ $searchTerm }}</strong></h4>
            <h4>عدد نتائج البحث: <strong>{{ $products->count()}}</strong></h4>

            @if ($products->count())
                <div class="row mt-3">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <a href="{{ route('customer.product_preview', $product) }}">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="card-img-top"
                                        alt="{{ $product->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->title }}</h5>
                                        <p class="card-text">{{ Str::limit($product->description, 20) }}</p>
                                        <p class="fw-bold">{{ $product->price }} $</p>
                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $products->links('pagination::bootstrap-5') }}
            @else
                <p class="mt-4">لا يوجد نتائج مطابقة.</p>
            @endif
        </div>
    </main>
@endsection
