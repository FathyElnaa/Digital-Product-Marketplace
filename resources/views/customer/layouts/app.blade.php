<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Digital Product')</title>
    <link rel="icon" href="{{ asset('customer/assets/images/logo-d.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('customer/assets/css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/vendors/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/vendors/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/vendors/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/assets/css/main.min.css') }}">
    @livewireStyles
</head>

<body>
    @include('customer.layouts.header')

    <!-- Page Content Start -->
    @yield('content')
    <!-- Page Content End -->

    @include('customer.layouts.footer')

    @include('customer.layouts.scripts')
    @livewireScripts

</body>

</html>
