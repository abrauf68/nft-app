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
    <div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-black">
        <!-- Absolute Items Start -->
        <img src="{{ asset('frontAssets/images/header-bg-1.png') }}" alt=""
            class="absolute top-0 left-0 right-0 -mt-6" />
        <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
        <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
        <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
        <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
        <!-- Absolute Items End -->

        <!-- Page Title Start -->
        <div class="relative z-10 pb-20">
            <div class="flex justify-between items-center gap-4 px-6 relative z-20">
                <div class="flex justify-start items-center gap-2">
                    <button class="sidebarModalOpenButton text-2xl text-white !leading-none">
                        <i class="ph ph-list"></i>
                    </button>
                    <h2 class="text-2xl font-semibold text-white">@yield('title')</h2>
                </div>
                <div class="flex justify-start items-center gap-2">
                    <a href=""
                        class="text-white border border-color24 p-2 rounded-full flex justify-center items-center bg-color24">
                        <i class="ph ph-bell"></i>
                    </a>
                    <a href="{{ route('frontend.profile') }}"
                        class="text-white border border-color24 p-2 rounded-full flex justify-center items-center bg-color24">
                        <i class="ph ph-user"></i>
                    </a>
                </div>
            </div>
            <!-- Page Title End -->

            @yield('content')
        </div>
    </div>

    <!-- Bottom Tab Start -->
    @include('frontend.layouts.header')
    <!-- Bottom Tab End -->

    <!-- Sidebar Start -->
    @include('frontend.layouts.sidebar')
    <!-- Sidebar End -->

    <!-- Logout Modal Start -->
    <div class="hidden inset-0 withdrawModal z-50">
        <div class="bg-black opacity-40 absolute inset-0 container"></div>
        <div class="flex justify-end items-end flex-col h-full">
            <div class="container relative">
                <img src="{{ asset('frontAssets/images/modal-bg-white.png') }}" alt="" class="dark:hidden" />
                <img src="{{ asset('frontAssets/images/modal-bg-black.png') }}" alt=""
                    class="hidden dark:block" />
                <div class="bg-white dark:bg-color1 relative z-40 overflow-auto pb-8">
                    <div class="px-6 pt-8 border-b border-color21 dark:border-color24 border-dashed pb-5 mx-6">
                        <p class="text-2xl text-p1 text-center font-semibold">Log Out</p>
                    </div>

                    <div class="pt-5 px-6">
                        <p class="text-color5 dark:text-white pb-8 text-center">
                            Are you sure you want to log out?
                        </p>
                        <div class="flex justify-between items-center gap-3">
                            <button
                                class="withdrawModalCloseButton border border-color16 bg-color14 rounded-full py-3 text-p2 text-sm font-semibold text-center block dark:border-p1 w-full dark:text-white">
                                Cancel
                            </button>
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block dark:bg-p1 w-full">
                                Yes, Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout Modal End -->

    <!-- ==== js dependencies start ==== -->
    @include('frontend.layouts.script')
    @yield('script')
</body>

</html>
