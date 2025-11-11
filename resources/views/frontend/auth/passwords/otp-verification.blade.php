@extends('frontend.layouts.auth.master')

@section('title', 'OTP Verification')

@section('css')
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
    <form action="{{ route('verify-otp') }}" method="POST" class="relative z-10 otp-form">
        @csrf
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
            <div class="flex flex-col gap-3 text-center">
                <h3 class="text-xl font-semibold">Enter OTP</h3>
                <p class="text-bgColor18 text-sm dark:text-color18">
                    Input the verification code that already sent to
                    <span class="text-p1">{{ request('email') }}</span>
                </p>
            </div>

            <div class="flex justify-between items-center gap-3 px-10 max-w-[380px] mx-auto py-6">
                <input type="text" id="otp" class="item otp-form-item" maxlength="1" />
                <input type="text" id="otp" class="item otp-form-item" maxlength="1" />
                <input type="text" id="otp" class="item otp-form-item" maxlength="1" />
                <input type="text" id="otp" class="item otp-form-item" maxlength="1" />
            </div>
            <p class="text-bgColor18 text-sm dark:text-white pt-2 text-center">
                Didn't receive email?
                <a href="{{ route('resend-otp', request('email')) }}" class="text-p1">Resend</a>
            </p>
        </div>

        <button style="width: 100%;" type="submit"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Confirm</button>
    </form>

    <!-- Sign In Form End -->
@endsection

@section('script')
<script>
document.querySelector('.otp-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // collect all OTP inputs
    let inputs = document.querySelectorAll('.otp-form-item');
    let otp = '';

    inputs.forEach(input => otp += input.value);

    // create a hidden input to hold the full OTP
    let hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'otp';
    hiddenInput.value = otp;

    this.appendChild(hiddenInput);

    // submit the form now
    this.submit();
});
</script>

@endsection
