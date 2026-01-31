@extends('frontend.layouts.share.master')

@section('title', 'Help Center - FAQs')

@section('css')
@endsection

@section('content')
    <div class="flex justify-between items-center pt-8 gap-4">
        <a href="{{ route('frontend.faqs') }}" class="py-2 block text-center w-full bg-p1 text-white text-sm font-semibold rounded-lg">
            FAQ
        </a>
        <a href="{{ route('frontend.contact') }}"
            class="py-2 w-full block text-center bg-white text-sm font-semibold rounded-lg dark:text-color5">
            Contact
        </a>
    </div>

    <!-- Search Box End -->
    <div class="pt-6">
        <div class="flex flex-col gap-2">
            @if (isset($faqs) && count($faqs) > 0)
                @foreach ($faqs as $faq)
                    <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                        <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                            <h6 class="text-sm font-semibold">{{ $faq->question }}</h6>
                            <div class="">
                                <i class="ph-fill ph-caret-down ti-plus"> </i>
                            </div>
                        </div>
                        <div class="duration-500 h-0 overflow-hidden">
                            <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                    <h6 class="text-sm font-semibold">
                        Available quiz categories?
                    </h6>
                    <div class="">
                        <i class="ph-fill ph-caret-down ti-plus"> </i>
                    </div>
                </div>
                <div class="duration-500 h-0 overflow-hidden">
                    <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                        Begin by selecting a quiz category, then tap 'Start' to delve
                        into an engaging learning experience.
                    </p>
                </div>
            </div>
            <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                    <h6 class="text-sm font-semibold">
                        Rewards or prizes offered?
                    </h6>
                    <div class="">
                        <i class="ph-fill ph-caret-down ti-plus"> </i>
                    </div>
                </div>
                <div class="duration-500 h-0 overflow-hidden">
                    <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                        Begin by selecting a quiz category, then tap 'Start' to delve
                        into an engaging learning experience.
                    </p>
                </div>
            </div>
            <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                    <h6 class="text-sm font-semibold">Inviting friends to play?</h6>
                    <div class="">
                        <i class="ph-fill ph-caret-down ti-plus"> </i>
                    </div>
                </div>
                <div class="duration-500 h-0 overflow-hidden">
                    <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                        Begin by selecting a quiz category, then tap 'Start' to delve
                        into an engaging learning experience.
                    </p>
                </div>
            </div>
            <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                    <h6 class="text-sm font-semibold">Quiz time limits?</h6>
                    <div class="">
                        <i class="ph-fill ph-caret-down ti-plus"> </i>
                    </div>
                </div>
                <div class="duration-500 h-0 overflow-hidden">
                    <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                        Begin by selecting a quiz category, then tap 'Start' to delve
                        into an engaging learning experience.
                    </p>
                </div>
            </div>
            <div class="faq-accordion-area border border-color21 rounded-xl bg-white dark:bg-color9 cursor-pointer">
                <div class="faq-accordion duration-500 flex justify-between items-center p-4">
                    <h6 class="text-sm font-semibold">Contacting support team?</h6>
                    <div class="">
                        <i class="ph-fill ph-caret-down ti-plus"> </i>
                    </div>
                </div>
                <div class="duration-500 h-0 overflow-hidden">
                    <p class="text-xs text-n500 border-t border-dashed border-n50 pt-3 mx-4 pb-4">
                        Begin by selecting a quiz category, then tap 'Start' to delve
                        into an engaging learning experience.
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
