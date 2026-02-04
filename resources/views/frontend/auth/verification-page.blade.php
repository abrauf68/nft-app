@extends('frontend.layouts.auth.master')

@section('title', 'OTP Verification')

@section('css')

<style>
    /* Error Box Container */
    .otp-error-box {
        display: flex;
        align-items: center;
        background-color: #ffe6e6; /* Light red background */
        border: 1px solid #ff4d4d; /* Red border */
        color: #b30000; /* Dark red text */
        padding: 12px 16px;
        border-radius: 8px;
        margin-top: 12px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        font-family: Arial, sans-serif;
        font-size: 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease-in-out;
    }

    /* Icon in the error box */
    .otp-error-icon {
        margin-right: 10px;
        font-size: 18px;
    }

    /* Text styling */
    .otp-error-text {
        line-height: 1.4;
    }

    /* Slide down animation */
    @keyframes slideDown {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-start items-center gap-4 relative z-10">
        <a href="{{ route('login') }}"
            class="bg-white p-2 rounded-full flex justify-center items-center text-xl dark:bg-color10">
            <i class="ph ph-caret-left"></i>
        </a>
        <h2 class="text-2xl font-semibold text-white">OTP Verification</h2>
    </div>
    <!-- Page Title End -->

    <!-- Sign In Form Start -->
    <form action="{{ route('verify.otp') }}" method="POST" class="relative z-10 otp-form">
        @csrf
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
            <div class="flex flex-col gap-3 text-center">
                <h3 class="text-xl font-semibold">Enter OTP</h3>
                {{-- Display validation error here --}}
                @if($errors->has('otp') || session('error'))
                    <div class="otp-error-box">
                        {{-- <span class="otp-error-icon">⚠️</span> --}}
                        <i class="ph ph-warning otp-error-icon"></i>
                        <span class="otp-error-text">
                            {{ $errors->has('otp') ? $errors->first('otp') : session('error') }}
                        </span>
                    </div>
                @endif
                <p class="text-bgColor18 text-sm dark:text-color18">
                    Input the verification code that already sent to
                    <span class="text-p1">{{ Auth::user()->email }}</span>
                </p>
            </div>

            <div class="flex justify-between items-center gap-3 max-w-[380px] mx-auto py-6">
                <input type="text" name="otp[]" class="item otp-form-item" maxlength="1" />
                <input type="text" name="otp[]" class="item otp-form-item" maxlength="1" />
                <input type="text" name="otp[]" class="item otp-form-item" maxlength="1" />
                <input type="text" name="otp[]" class="item otp-form-item" maxlength="1" />
            </div>

            <p class="text-bgColor18 text-sm dark:text-white pt-2 text-center">
                Didn't receive email?
                <a href="{{ route('resend.otp') }}" class="text-p1">Resend</a>
            </p>
        </div>

        <button type="submit" style="width: 100%;"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Confirm</button>
    </form>

    <!-- Sign In Form End -->
@endsection

@section('script')
    <script>
        document.querySelectorAll('.otp-form-item').forEach((input, index, arr) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < arr.length - 1) {
                    arr[index + 1].focus();
                }
            });
        });
    </script>
@endsection
