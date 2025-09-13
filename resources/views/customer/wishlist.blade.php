@extends('customer.layouts.app')

@section('title', 'Wishlist')

@section('content')
    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>المفضلة</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('customer.dashboard') }}">الرئيسية</a> /
                    <span class="text-gray">المفضلة</span>
                </div>
            </div>
        </div>

        <div class="my-5 py-5">
            <section class="section-container favourites">
                <table class="w-100">
                    <thead>
                        <th class="d-none d-md-table-cell"></th>
                        <th class="d-none d-md-table-cell">الصورة</th>
                        <th class="d-none d-md-table-cell">الاسم</th>
                        <th class="d-none d-md-table-cell">السعر</th>
                        <th class="d-none d-md-table-cell">تاريخ الاضافه</th>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($wishlist as $wishlisti)
                            <tr>
                                <td class="d-block d-md-table-cell">
                                    <form action="{{ route('wishlist.destroy', $wishlisti->id) }}" method="POST"
                                        class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="favourites__remove m-auto border-0 bg-transparent p-0"
                                            style="cursor: pointer;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="d-block d-md-table-cell favourites__img">
                                    <img src="{{ asset('storage/' . $wishlisti->product->thumbnail) }}" alt="" />
                                </td>
                                <td class="d-block d-md-table-cell">
                                    {{ $wishlisti->product->title }}
                                </td>
                                <td class="d-block d-md-table-cell">
                                    {{-- <span class="product__price product__price--old">550 جنية</span> --}}
                                    <span class="product__price">{{ $wishlisti->product->price }}</span>
                                </td>
                                <td class="d-block d-md-table-cell">{{ $wishlisti->created_at }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </main>
@endsection
