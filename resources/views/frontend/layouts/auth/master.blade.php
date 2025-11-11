<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - {{ \App\Helpers\Helper::getCompanyName() }}</title>
    @include('frontend.layouts.meta')
    @include('frontend.layouts.css')
    @yield('css')
    <style>
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.7rem;
            margin-top: 0.25rem;
            font-weight: 400;
            line-height: 1.4;
        }

        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        }
    </style>
</head>

<body class="">
    <div class="container min-h-dvh relative overflow-hidden py-8 px-6 dark:text-white dark:bg-color1">
        <!-- Absolute Items Start -->
        <img src="{{ asset('frontAssets/images/header-bg-2.png') }}" alt=""
            class="absolute top-0 left-0 right-0 -mt-6" />
        <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
        <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
        <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
        <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
        <!-- Absolute Items End -->

        @yield('content')
    </div>

    <!-- ==== js dependencies start ==== -->
    @include('frontend.layouts.script')
    @yield('script')
</body>

</html>
