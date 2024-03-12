<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/admin-bower/plugins/select2-master/select2.min.css') !!}" />
    @section('style')
        @include('company.layout.style')
    @show
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

    <div class="page-wrapper dashboard ">
        <div class="preloader"></div>

        <!-- Header Span -->
        <span class="header-span"></span>
        @include('company.layout.header')

        <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop"></div>

        @include('company.layout.sidebar')

        <!-- Dashboard -->
        <section class="user-dashboard">
            <div class="dashboard-outer">
              @yield('content')
            </div>
        </section>
        <!-- End Dashboard -->

    </div><!-- End Page Wrapper -->
    @section('script')
        @include('company.layout.script')
        <script>
            $('.select2').select2({
                'width' : '100%',
            });
        </script>
        @include('admin.layout.toastr')
    @show
</body>


</html>
