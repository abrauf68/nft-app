@extends('frontend.layouts.profile.master')

@section('title', 'Profile')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <!-- User Profile Image Start -->
    <div class="flex justify-center items-end pt-16 gap-8">
        <div class="relative size-40 flex justify-center items-center">
            <img src="{{ asset(Auth::user()->profile->profile_image ?? 'frontAssets/images/user-img.png') }}" alt="" class="size-32 bg-[#B190B6] rounded-full overflow-hidden" />
            <img src="{{ asset('frontAssets/images/user-progress.svg') }}" alt="" class="absolute top-0 left-0 right-0" />
            <img src="{{ asset('frontAssets/images/badge1.png') }}" alt="" class="absolute -bottom-2 left-[60px]" />
        </div>
    </div>
    <!-- User Profile Image End -->
    <div class="flex justify-center items-center pt-5 flex-col pb-5">
        <div class="flex justify-start items-center gap-1 text-2xl">
            <p class="font-semibold">{{ Auth::user()->name }}</p>
            <i class="ph-fill ph-seal-check text-p1"></i>
        </div>
        {{-- <p class="text-color5 pt-1 dark:text-bgColor20 font-semibold">
            Frend come on, play with me
        </p> --}}
    </div>

    <div
        class="flex justify-between items-center gap-6 bg-white py-3 px-5 border border-color21 dark:border-color24 rounded-2xl dark:bg-color9">
        <div class="">
            <p class="text-p2 font-semibold dark:text-p1">{{ \App\Helpers\Helper::formatCurrency($wallet->balance ?? 0) }}</p>
            <p class="text-xs text-nowrap">Total Earning</p>
        </div>
        <div class="border-t border-color21 border-dashed dark:border-color24 w-full"></div>
        <a href="{{ route('frontend.wallet') }}" class="flex justify-start items-center gap-2">
            <p class="text-p2 font-semibold text-sm text-nowrap dark:text-p1">
                View Wallet
            </p>
            <div
                class="text-p2 dark:text-p1 dark:border-bgColor16 dark:bg-bgColor14 border border-color14 p-2 rounded-full flex justify-center items-center bg-color16">
                <i class="ph ph-caret-right"></i>
            </div>
        </a>
    </div>
    <div class="p-5 mt-8 bg-p2 dark:bg-p1 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p2 after:dark:bg-p1 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p2 before:dark:bg-p1 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
        <div class="flex flex-col justify-center items-center">
            <div class="flex justify-center items-center text-p2 dark:text-p1 bg-white p-2 rounded-full text-xl">
                <i class="ph ph-users-three"></i>
            </div>
            <p class="text-sm font-semibold text-white pt-2">Referred users</p>
            <p class="font-semibold text-white">{{ $totalReferrals }}</p>
        </div>
        <img src="{{ asset('frontAssets/images/bg-vector.png') }}" alt="" />
        <div class="flex flex-col justify-center items-center">
            <div class="flex justify-center items-center text-p2 dark:text-p1 bg-white p-2 rounded-full text-xl">
                <i class="ph ph-star"></i>
            </div>
            <p class="text-sm font-semibold text-white pt-2">Deposit</p>
            <p class="font-semibold text-white">{{ \App\Helpers\Helper::formatCurrency($depositAmount ?? 0) }}</p>
        </div>
        <img src="{{ asset('frontAssets/images/bg-vector.png') }}" alt="" />
        <div class="flex flex-col justify-center items-center">
            <div class="flex justify-center items-center text-p2 dark:text-p1 bg-white p-2 rounded-full text-xl">
                <i class="ph ph-bank"></i>
            </div>
            <p class="text-sm font-semibold text-white pt-2">Withdrawals</p>
            <p class="font-semibold text-white">{{ \App\Helpers\Helper::formatCurrency($withdrawalAmount ?? 0) }}</p>
        </div>
    </div>
@endsection

@section('script')
@endsection
