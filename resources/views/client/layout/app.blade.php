<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Home')</title>
    @section('style')
        @include('client.layout.style')
    @show
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>

<body data-anm=".anm">
    <div class="page-wrapper">
        <div class="preloader"></div>
        @include('client.layout.header')
        @yield('content')
        @if (!isset($excludeFooter))
            @include('client.layout.footer')
        @endif
        <!-- End Main Footer -->
    </div>
    @section('script')
        @include('client.layout.script')
        @include('admin.layout.toastr')
    @show
    {{-- @include('admin.layout.toastr') --}}
</body>

</html>
