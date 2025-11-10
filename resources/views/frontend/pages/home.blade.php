@extends('frontend.layouts.master')

@section('title', 'Home')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="relative">
        <img src="./assets/images/icon-3.png" class="absolute -top-8 left-4" alt="" />
        <div class="swiper onboarding-steps-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide flex flex-col justify-center items-center text-center px-4">
                    <h1 class="text-4xl font-semibold">
                        Quiz On the <span class="text-p1">Go</span>
                    </h1>
                    <p class="m-body pt-5 opacity-80">
                        Answer a quiz for a shot at winning thrilling prizes! Test
                        your knowledge and win big!
                    </p>
                </div>
                <div class="swiper-slide flex flex-col justify-center items-center text-center px-4">
                    <h1 class="text-4xl font-semibold">Knowledge Boosting</h1>
                    <p class="m-body pt-5 opacity-80">
                        Find fun and interesting quizzes to boost up your knowledge
                    </p>
                </div>
                <div class="swiper-slide flex flex-col justify-center items-center text-center px-4">
                    <h1 class="text-4xl font-semibold">Win Rewards Galore</h1>
                    <p class="m-body pt-5 opacity-80">
                        Answer a quiz for a shot at winning thrilling prizes! Test
                        your knowledge and win big!
                    </p>
                </div>
            </div>

            <div class="flex justify-center items-center py-8">
                <div class="onBoardingsliderPagingation swiper-pagination"></div>
            </div>

            <div class="flex justify-between items-center px-6">
                <a href="./sign-in.html" class="text-p2 font-semibold dark:text-p1">Skip</a>
                <div class="nextButton">
                    <div class="ara-next">
                        <button class="text-white flex justify-center items-center bg-p2 rounded-full text-2xl p-3.5">
                            <i class="ph ph-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
