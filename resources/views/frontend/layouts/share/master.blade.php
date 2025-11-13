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

<body>
    <div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-color1">
        <!-- Absolute Items Start -->
        <img src="{{ asset('frontAssets/images/header-bg-2.png') }}" alt=""
            class="absolute top-0 left-0 right-0 -mt-6" />
        <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
        <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
        <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
        <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
        <!-- Absolute Items End -->

        <!-- Page Title Start -->
        <div class="relative z-10 px-6 pb-20">
            <div class="flex justify-between items-center gap-4">
                <div class="flex justify-start items-center gap-4">
                    <a href="{{ route('frontend.home') }}"
                        class="bg-white size-8 rounded-full flex justify-center items-center text-xl dark:bg-color10">
                        <i class="ph ph-caret-left"></i>
                    </a>
                    <h2 class="text-2xl font-semibold text-white">@yield('title')</h2>
                </div>
            </div>
            <!-- Page Title End -->

            @yield('content')
        </div>
    </div>

    <!-- Bottom Tab Start -->
    @include('frontend.layouts.header')
    <!-- Bottom Tab End -->

        <div class="hidden inset-0 z-50 withdrawModal">
        <div class="bg-black opacity-40 absolute inset-0 container"></div>
        <div class="flex justify-end items-end flex-col h-full">
            <div class="container relative">
                <img src="{{ asset('frontAssets/images/modal-bg-white.png') }}" alt="" class="dark:hidden" />
                <img src="{{ asset('frontAssets/images/modal-bg-black.png') }}" alt="" class="hidden dark:block" />
                <div class="bg-white dark:bg-color1 relative z-40 overflow-auto pb-8">
                    <div class="flex justify-between items-center px-6 pt-10">
                        <p class="text-2xl text-color9 font-semibold dark:text-white">
                            Withdraw
                        </p>
                        <button
                            class="p-2 rounded-full border flex justify-center items-center withdrawModalCloseButton dark:text-white">
                            <i class="ph ph-x"></i>
                        </button>
                    </div>
                    <div class="mt-6 mx-6 flex justify-start items-center gap-2 bg-p1 py-3 px-4 rounded-xl">
                        <div class="flex justify-center items-center p-2 bg-white rounded-full text-p1">
                            <i class="ph ph-wallet"></i>
                        </div>
                        <p class="text-white">
                            Wallet Balance : <span class="font-semibold">$0.00</span>
                        </p>
                    </div>
                    <div class="px-6 pt-5">
                        <p class="pb-2 dark:text-white">Select Amount to withdraw</p>
                        <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                            <input type="text" placeholder="$50"
                                class="outline-none bg-transparent w-full placeholder:text-color9 font-bold" />
                        </div>
                    </div>
                    <div class="px-6 pt-5">
                        <p class="pb-2 dark:text-white">Recommended</p>
                        <div class="flex justify-start items-center gap-2">
                            <div class="py-2 px-4 rounded-xl text-white bg-p2 text-sm">
                                $20
                            </div>
                            <div class="py-2 px-4 rounded-xl text-sm bg-white border border-color21 text-color1">
                                $50
                            </div>
                            <div class="py-2 px-4 rounded-xl bg-white text-sm border border-color21 text-color1">
                                $100
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pt-5">
                        <p class="pb-2 dark:text-white">Select payment method</p>
                        <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                            <input type="text" placeholder="Paypal"
                                class="outline-none bg-transparent w-full placeholder:text-color9 font-bold" />
                        </div>
                    </div>
                    <div class="pt-5 px-6">
                        <a href=""
                            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block dark:bg-p1">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==== js dependencies start ==== -->
    @include('frontend.layouts.script')
    @yield('script')
</body>

</html>
