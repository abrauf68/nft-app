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
    <div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-color1">
        <!-- Absolute Items Start -->
        <img src="{{ asset('frontAssets/images/header-bg-1.png') }}" alt="" class="absolute top-0 left-0 right-0 -mt-20" />
        <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
        <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
        <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
        <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
        <!-- Absolute Items End -->

        <!-- Page Title Start -->
        <div class="relative z-10 px-6">
            <div class="flex justify-between items-center gap-4">
                <div class="flex justify-start items-center gap-4">
                    <a href="{{ route('frontend.home') }}"
                        class="bg-white size-8 rounded-full flex justify-center items-center text-xl dark:bg-color10">
                        <i class="ph ph-caret-left"></i>
                    </a>
                    <h2 class="text-2xl font-semibold text-white">@yield('title')</h2>
                </div>
                <div class="flex justify-start items-center gap-2">
                    <div class="relative">
                        <button
                            class="border border-color24 p-2 rounded-full flex justify-center items-center bg-color24 relative quizDetailsMoreOptionsModalOpenButton">
                            <i class="ph ph-dots-three text-white"></i>
                        </button>
                        <div class="absolute top-12 right-0 z-40 min-w-48 modalClose duration-500 bg-white dark:bg-color9 p-5 rounded-xl shadow6 quizDetailsMoreOptionsModal">
                            <a href="{{ route('frontend.profile.edit') }}">
                                <div class="flex justify-start items-center gap-3 pb-3 cursor-pointer">
                                    <div
                                        class="text-p2 dark:text-white dark:bg-color24 dark:border-color18 border border-color16 p-2 rounded-full flex justify-center items-center bg-color14 text-sm">
                                        <i class="ph ph-user"></i>
                                    </div>
                                    <p class="text-sm">Edit Profile</p>
                                </div>
                            </a>
                            <a href="{{ route('frontend.settings') }}">
                                <div
                                    class="flex justify-start items-center gap-3 pt-3 border-y border-dashed border-color21 dark:border-color24 pb-3 cursor-pointer">
                                    <div
                                        class="text-p2 dark:text-white dark:bg-color24 dark:border-color18 border border-color16 p-2 rounded-full flex justify-center items-center bg-color14 text-sm">
                                        <i class="ph ph-gear"></i>
                                    </div>
                                    <p class="text-sm text-nowrap">Settings</p>
                                </div>
                            </a>
                            <div class="flex justify-start items-center gap-3 py-3 cursor-pointer">
                                <div
                                    class="text-p2 dark:text-white dark:bg-color24 dark:border-color18 border border-color16 p-2 rounded-full flex justify-center items-center bg-color14 text-sm">
                                    <i class="ph ph-scroll"></i>
                                </div>
                                <p class="text-sm text-nowrap">Privacy Policy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Title End -->

            @yield('content')
        </div>
    </div>

    <!-- ==== js dependencies start ==== -->
    @include('frontend.layouts.script')
    @yield('script')
</body>

</html>
