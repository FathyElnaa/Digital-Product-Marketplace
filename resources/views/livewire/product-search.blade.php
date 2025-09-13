<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="filter__search position-relative w-100">
            <input wire:model.live="search" class="w-100 py-1 ps-2" type="text" placeholder="بتدور علي ايه؟" />
            <div
                class="filter__search-icon position-absolute h-100 top-0 end-0 p-2 d-flex justify-content-center align-items-center">
                {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
            </div>
        </div>
    </div>

    <div class="row products__list">
        @foreach ($products as $product)
            <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
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
                <div class="product__author text-center">{{ $product?->vendor?->name }}</div>
                <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
                    {{-- <span class="product__price product__price--old">
                                550.00 جنيه
                            </span> --}}
                    <span class="product__price"> {{ $product->price }}</span>
                </div>
            </div>
        @endforeach
    </div>
    {{ $products->links('pagination::bootstrap') }}
