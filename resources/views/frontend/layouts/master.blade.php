<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ \App\Helpers\Helper::getCompanyName() }} - @yield('title')</title>
    @include('frontend.layouts.meta')
    @include('frontend.layouts.css')
    @yield('css')
</head>

<body class="">
    <div class="container bg-white h-screen relative dark:bg-black dark:text-white">
        <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
        <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
        <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
        <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>

        <div class="absolute left-0 bottom-[45%]">
            <img src="{{ asset('frontAssets/images/icon-1.png') }}" alt="" />
        </div>
        <div class="absolute right-0 bottom-[35%]">
            <img src="{{ asset('frontAssets/images/icon-2.png') }}" alt="" />
        </div>
        <div class="relative z-10">
            <img src="{{ asset('frontAssets/images/onboarding-img.png') }}" alt="" />
        </div>
        <section class="pt-24">
            @yield('content')
        </section>
    </div>

    <!-- ==== js dependencies start ==== -->
    @include('frontend.layouts.script')
</body>

</html>
