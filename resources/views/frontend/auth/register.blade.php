@extends('frontend.layouts.auth.master')

@section('title', 'Sign Up')

@section('css')
    <style>
        .input-success {
            border-color: #16a34a !important;
            /* green */
        }

        .input-danger {
            border-color: #dc2626 !important;
            /* red */
        }

        .icon-success {
            color: #16a34a !important;
        }

        .icon-danger {
            color: #dc2626 !important;
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-start items-center gap-4 relative z-10">
        <h2 class="text-2xl font-semibold text-white">Sign Up</h2>
    </div>
    <!-- Page Title End -->

    <!-- Sign In Form Start -->
    <form action="{{ route('register.attempt') }}" method="POST" class="relative z-20">
        @csrf
        <input type="hidden" name="device_fingerprint" id="device_fingerprint">
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
            <div class="flex justify-between items-center">
                <a href="{{ route('login') }}"
                    class="text-center text-xl font-semibold text-bgColor18 border-b-2 pb-2 border-bgColor18 w-full dark:text-color18 dark:border-color18">Sign
                    In</a>
                <a href="{{ route('register') }}"
                    class="text-center text-xl font-semibold text-p2 border-b-2 pb-2 border-p2 w-full dark:text-p1 dark:border-p1">Sign
                    Up</a>
            </div>
            <div class="pt-8">
                <p class="text-sm font-semibold pb-2">{{ __('Name') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('name') is-invalid @enderror">
                    <input type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18"
                        required />
                    <i class="ph ph-user text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="pt-4">
                <p class="text-sm font-semibold pb-2">{{ __('Email') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('email') is-invalid @enderror">
                    <input type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18"
                        required />
                    <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
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
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('confirm-password') is-invalid @enderror">
                    <input type="password" placeholder="*****" name="confirm-password"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 confirmPasswordField"
                        required />
                    <i
                        class="ph ph-eye-slash text-xl text-bgColor18 !leading-none confirmPasswordShow cursor-pointer dark:text-color18"></i>
                </div>
                @error('confirm-password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="pt-8">
                <p class="text-sm font-semibold pb-2">{{ __('Invitation Code') }}</p>
                <div
                    class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('invitation_code') is-invalid @enderror">
                    <input type="text" placeholder="Enter invitation code" id="invitation_code" name="invitation_code"
                        value="{{ old('invitation_code', request('code')) }}"
                        class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18" />
                    <i id="invitation_icon" class="ph ph-user text-xl text-bgColor18 !leading-none"></i>
                </div>
                <div id="invitation_code_feedback" class="mt-2"></div>
                @error('invitation_code')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="pt-4">
                <label for="checkbox" class="flex justify-start items-center gap-3 text-sm cursor-pointer">
                    <input type="checkbox" name="terms" id="checkbox" class="peer hidden"
                        {{ old('terms') ? 'checked' : '' }} />
                    <span
                        class="border border-color21 size-7 rounded-full flex justify-center items-center !leading-none text-white peer-checked:bg-p2 dark:border-color24">
                        <i class="ph ph-check"></i>
                    </span>
                    I accept to all Term, Privacy and Fees
                </label>
            </div>
        </div>

        <button style="width: 100%;" type="submit"
            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Sign
            Up</button>
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
            Already have an account?
            <a href="{{ route('login') }}" class="text-p2 dark:text-p1">Sign In</a> here
        </p>
    </div>
    <!-- Sign In Form End -->
@endsection

@section('script')
    <script type="text/javascript">
        document.getElementById('device_fingerprint').value = btoa(
            navigator.userAgent +
            screen.width +
            screen.height +
            Intl.DateTimeFormat().resolvedOptions().timeZone
        );

        $(document).ready(function() {

            let typingTimer = null;
            let ajaxRequest = null;
            const delay = 500;

            const $input = $('#invitation_code');
            const $icon = $('#invitation_icon');
            const $wrapper = $input.closest('div'); // parent border div

            $('#invitation_code').on('input', function() {
                let invitationCode = $(this).val();

                clearTimeout(typingTimer);

                // Reset state if empty
                if (!invitationCode || invitationCode.length < 1) {
                    $wrapper.removeClass('input-success input-danger');
                    $icon.removeClass('icon-success icon-danger ph-check-circle ph-x-circle')
                        .addClass('ph-user');
                    return;
                }

                typingTimer = setTimeout(function() {

                    if (ajaxRequest !== null) {
                        ajaxRequest.abort();
                    }

                    ajaxRequest = $.ajax({
                        url: "api/check-invitation-code",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            invitation_code: invitationCode
                        },
                        success: function(response) {

                            // Remove old classes
                            $wrapper.removeClass('input-success input-danger');
                            $icon.removeClass(
                                'icon-success icon-danger ph-user ph-check-circle ph-x-circle'
                            );

                            if (response.status === 'matched') {
                                // ✅ Success UI
                                $wrapper.addClass('input-success');
                                $icon.addClass('ph-check-circle icon-success');

                            } else {
                                // ❌ Error UI
                                $wrapper.addClass('input-danger');
                                $icon.addClass('ph-x-circle icon-danger');
                            }
                        },
                        error: function() {
                            $wrapper.removeClass('input-success').addClass(
                                'input-danger');
                            $icon.removeClass('ph-user ph-check-circle')
                                .addClass('ph-x-circle icon-danger');
                        }
                    });

                }, delay);

            });

        });
    </script>

@endsection
