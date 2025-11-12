@extends('frontend.layouts.share.master')

@section('title', 'My Wallet')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="p-5 mt-8 bg-p1 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p1 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p1 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
        <div class="flex justify-start items-start gap-3">
            <div class="size-12 bg-white rounded-full flex justify-center items-center text-color9 text-xl">
                <i class="ph ph-bank"></i>
            </div>
            <div class="">
                <p class="text-2xl font-semibold text-white">$60.00</p>
                <p class="text-xs text-bgColor5">Current Balance</p>
            </div>
        </div>
        <button class="bg-white text-color9 py-2 px-5 rounded-xl font-semibold text-xs withdrawModalOpenButton">
            Add Money
        </button>
    </div>

    <div class="p-6 bg-white border-color21 dark:border-color24 dark:bg-color10 rounded-2xl flex flex-col gap-5 mt-14">
        <div class="flex justify-start items-center gap-3 pb-5 border-b border-color21 dark:border-color24 border-dashed">
            <div
                class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                <i class="ph ph-currency-circle-dollar"></i>
            </div>
            <div class="">
                <p class="text-sm font-semibold">Amount Added (Un-utilised)</p>
                <p class="text-2xl font-semibold text-p2">$64</p>
            </div>
        </div>
        <div class="flex justify-between items-center pb-5 border-b border-color21 dark:border-color24 border-dashed">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                    <i class="ph ph-currency-circle-dollar"></i>
                </div>
                <div class="">
                    <p class="text-sm font-semibold">Winning</p>
                    <p class="text-2xl font-semibold text-p2">$6</p>
                </div>
            </div>
            <a href="./request-withdrew.html"
                class="py-2 px-5 rounded-md text-white bg-p2 dark:bg-p1 text-xs font-semibold">Withdraw</a>
        </div>
        <div class="flex justify-start items-center gap-3 pb-5 border-b border-color21 dark:border-color24 border-dashed">
            <div
                class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                <i class="ph ph-currency-circle-dollar"></i>
            </div>
            <div class="">
                <p class="text-sm font-semibold">Bonus</p>
                <p class="text-2xl font-semibold text-p2">$4</p>
            </div>
        </div>
        <div class="flex justify-start items-center gap-3 pb-5 border-b border-color21 dark:border-color24 border-dashed">
            <div
                class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                <i class="ph ph-coins"></i>
            </div>
            <div class="">
                <p class="text-sm font-semibold">Coin</p>
                <p class="text-2xl font-semibold text-p2">$32</p>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-color21 dark:border-color24 dark:bg-color10 rounded-2xl flex flex-col gap-5 mt-8">
        <div class="flex justify-between items-center border-b border-color21 dark:border-color24 border-dashed pb-5">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                    <i class="ph ph-currency-circle-dollar"></i>
                </div>
                <p class="text-sm font-semibold">My Transection</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div class="flex justify-between items-center gap-4">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-3.5 rounded-full bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border text-p2 dark:text-p1 text-2xl !leading-none">
                    <i class="ph ph-currency-circle-dollar"></i>
                </div>
                <div class="">
                    <p class="text-sm font-semibold">Refer & Earn</p>
                    <p class="text-xs pt-1">
                        Invite 40 friends and collect bonous upto $50
                    </p>
                </div>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
    </div>
@endsection

@section('script')
@endsection
