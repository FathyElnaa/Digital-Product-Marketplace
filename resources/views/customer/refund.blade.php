@extends('customer.layouts.app')

@section('title', 'Refund')

@section('content')
    <main>
        <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
            <div class="page-top__overlay"></div>
            <div class="position-relative">
                <div class="page-top__title mb-3">
                    <h2>طلب استرداد</h2>
                </div>
                <div class="page-top__breadcrumb">
                    <a class="text-gray" href="{{ route('customer.dashboard') }}">الرئيسية</a> /
                    <span class="text-gray">طلب استرداد</span>
                </div>
            </div>
        </div>
        <section class="section-container my-5 py-5">
            <form action="{{ route('customer.refund.store', [$order,$order_item]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="reason" class="form-label">سبب الاسترداد</label>
                    <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="أدخل سبب طلب الاسترداد">{{ old('reason') }}</textarea>
                    @error('reason')
                        <span class="text-danger d-block mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">إرسال طلب الاسترداد</button>
            </form>
        </section>
    </main>
@endsection
