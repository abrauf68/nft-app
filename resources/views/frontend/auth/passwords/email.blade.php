@extends('frontend.layouts.auth.master')

@section('title', 'Forgot Password')

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
      <h2 class="text-2xl font-semibold text-white">{{__('Forgot Password?')}}</h2>
    </div>
    <!-- Page Title End -->

    <!-- Sign In Form Start -->
    <form action="{{ route('otp-email') }}" method="POST" class="relative z-10">
        @csrf
      <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
        <div class="flex flex-col gap-3 text-center">
          <h3 class="text-xl font-semibold">{{__('Forgot Password')}}</h3>
          <p class="text-bgColor18 text-sm dark:text-color18">
            {{ __('Reset your access evffortlessly and regain control with our
            password recovery service.') }}
          </p>
        </div>

        <div class="pt-8">
          <p class="text-sm font-semibold pb-2">{{ __('Email') }}</p>
          <div
            class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('email') is-invalid @enderror">
            <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}"
              class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18" required />
            <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
          </div>
        </div>
      </div>

      <button style="width: 100%;" type="submit"
        class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1">Continue</button>
    </form>

    <!-- Sign In Form End -->
@endsection

@section('script')
@endsection
