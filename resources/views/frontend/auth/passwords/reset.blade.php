@extends('frontend.layouts.auth.master')

@section('title', 'Reset Password')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-start items-center gap-4 relative z-10">
        <h2 class="text-2xl font-semibold text-white">Reset Password</h2>
    </div>
    <!-- Page Title End -->

    <!-- Sign In Form Start -->
    <form action="{{ route('reset-password.attempt') }}" method="POST" class="relative z-10">
        @csrf
        <input type="text" name="email" value="{{ request('email') }}" hidden />
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
            <div class="flex flex-col gap-3 text-center">
                <h3 class="text-xl font-semibold">Reset Password</h3>
                <p class="text-bgColor18 text-sm dark:text-color18">
                    Create new password for your account now
                </p>
            </div>

            <div class="pt-4">
                <p class="text-sm font-semibold pb-2">{{ __('Password') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('password') is-invalid @enderror">
                    <input type="password" placeholder="*****" name="password"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 passwordField"
                        required />
                    <i
                        class="ph ph-eye-slash text-xl text-bgColor18 !leading-none passowordShow cursor-pointer dark:text-color18"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="pt-4">
                <p class="text-sm font-semibold pb-2">{{ __('Confirm Password') }}</p>
                <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
                    <input type="password" placeholder="*****" name="confirm-password"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 confirmPasswordField"
                        required />
                    <i class="ph ph-eye-slash text-xl text-bgColor18 !leading-none confirmPasswordShow cursor-pointer dark:text-color18"></i>
                    @error('confirm-password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <button style="width: 100%;" type="submit"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Confirm</button>
    </form>

    <!-- Sign In Form End -->
@endsection

@section('script')
@endsection
