@extends('frontend.layouts.share.master')

@section('title', 'Help Center - Contact Us')

@section('css')
@endsection

@section('content')
    <div class="flex justify-between items-center pt-8 gap-4">
        <a href="{{ route('frontend.faqs') }}"
            class="py-2 w-full block text-center bg-white text-sm font-semibold rounded-lg dark:text-color5">
            FAQ
        </a>
        <a href="{{ route('frontend.contact') }}"
            class="py-2 block text-center w-full bg-p1 text-white text-sm font-semibold rounded-lg">
            Contact
        </a>
    </div>

    <div class="flex flex-col gap-2 pt-8">
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-headphones"></i>
                </div>
                <p class="font-semibold text-sm">Customer Service</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-whatsapp-logo"></i>
                </div>
                <p class="font-semibold text-sm">WhatsApp</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-globe"></i>
                </div>
                <p class="font-semibold text-sm">Website</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-facebook-logo"></i>
                </div>
                <p class="font-semibold text-sm">Facebook</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-twitter-logo"></i>
                </div>
                <p class="font-semibold text-sm">Twitter</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
        <div
            class="flex justify-between items-center py-3 px-5 rounded-2xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
            <div class="flex justify-start items-center gap-3">
                <div
                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                    <i class="ph ph-instagram-logo"></i>
                </div>
                <p class="font-semibold text-sm">Instagram</p>
            </div>
            <a href=""
                class="p-2 bg-color16 border-color14 dark:bg-bgColor14 dark:border-bgColor16 border flex justify-center items-center rounded-full">
                <i class="ph ph-caret-right"></i>
            </a>
        </div>
    </div>
@endsection
