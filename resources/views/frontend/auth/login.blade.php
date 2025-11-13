@extends('frontend.layouts.auth.master')

@section('title', 'Sign In')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-start items-center gap-4 relative z-10">
        {{-- <a href="./index.html"
                class="bg-white p-2 rounded-full flex justify-center items-center text-xl dark:bg-color10">
                <i class="ph ph-caret-left"></i>
            </a> --}}
        <h2 class="text-2xl font-semibold text-white">Sign In</h2>
    </div>
    <!-- Page Title End -->

    <!-- Sign In Form Start -->
    <form action="{{route('login.attempt')}}" method="POST" class="relative z-10">
        @csrf
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
            <div class="flex justify-between items-center">
                <a href="{{ route('login') }}"
                    class="text-center text-xl font-semibold text-p2 border-b-2 pb-2 border-p2 w-full dark:text-p1 dark:border-p1">Sign
                    In</a>
                <a href="{{ route('register') }}"
                    class="text-center text-xl font-semibold text-bgColor18 border-b-2 pb-2 border-bgColor18 w-full dark:text-color18 dark:border-color18">Sign
                    Up</a>
            </div>

            <div class="pt-8">
                <p class="text-sm font-semibold pb-2">{{__('Email/Username')}}</p>
                <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('email_username') is-invalid @enderror">
                    <input type="text" placeholder="Enter Email" name="email_username"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18"
                        autofocus required />
                    <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('email_username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="pt-4">
                <p class="text-sm font-semibold pb-2">{{__('Password')}}</p>
                <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('password') is-invalid @enderror">
                    <input type="password" placeholder="*****" name="password"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 passwordField" required />
                    <i class="ph ph-eye-slash text-xl text-bgColor18 !leading-none passowordShow cursor-pointer dark:text-color18"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-end text-p2 text-sm font-semibold block pt-2 dark:text-p1">Forgot
                    password?</a>
            @endif
        </div>

        <button style="width: 100%;" type="submit"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Sign
            In</button>
    </form>
    <div class="relative z-10">
        {{-- <div class="flex justify-center items-center my-8 gap-2">
            <div class="border-b border-color21 w-full dark:border-color18"></div>
            <p class="text-sm text-color1 text-nowrap dark:text-white">
                Or Continue With
            </p>
            <div class="border-b border-color21 w-full dark:border-color18"></div>
        </div>
        <div class="flex flex-col gap-4">
            <button class="flex justify-center items-center gap-3 py-3 border border-color21 text-sm font-semibold rounded-full bg-white dark:bg-color11 dark:border-color21">
                <img src="{{ asset('frontAssets/images/google.png') }}" alt="" />
                <p>Continue With</p>
            </button>
            <button class="flex justify-center items-center gap-3 py-3 border border-color21 text-sm font-semibold rounded-full bg-white dark:bg-color11 dark:border-color21">
                <img src="{{ asset('frontAssets/images/AppleLogo.png') }}" alt="" />
                <p>Continue With</p>
            </button>
        </div> --}}

        <p class="text-sm font-semibold text-center pt-5">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-p2 dark:text-p1">Sign Up</a> here
        </p>
    </div>
    <!-- Sign In Form End -->
@endsection

@section('script')
@endsection
