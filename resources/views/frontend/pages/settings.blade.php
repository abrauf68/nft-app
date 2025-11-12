@extends('frontend.layouts.profile.master')

@section('title', 'Settings')

@section('css')

@endsection

@section('content')
    <div class="userProfileTab pt-8">
        <ul class="flex justify-between items-center gap-3 tab-button text-center">
            <li id="tabOne" class="tabButton activeTabButton w-full cursor-pointer">
                Security
            </li>
            <li id="tabThree" class="tabButton w-full cursor-pointer">
                Others
            </li>
        </ul>

        <div class="pt-8">
            <div class="tab-content activeTab" id="tabOne_data">
                <div class="bg-white dark:bg-color10 p-5 rounded-2xl">
                    <div class="flex flex-col gap-5 pt-8">
                        <form action="{{ route('frontend.settings.change-password') }}" method="POST" class="relative z-10">
                            @csrf
                            <div class="bg-white px-6 rounded-xl dark:bg-color10">
                                <div class="flex flex-col gap-3 text-center">
                                    <h3 class="text-xl font-semibold">Change Password</h3>
                                    <p class="text-bgColor18 text-sm dark:text-color18">
                                        Create new password for your account now
                                    </p>
                                </div>

                                <div class="pt-4">
                                    <p class="text-sm font-semibold pb-2">{{ __('Current Password') }}</p>
                                    <div
                                        class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('current_password') is-invalid @enderror">
                                        <input type="password" placeholder="*****" name="current_password"
                                            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 currentPasswordField"
                                            required />
                                        <i
                                            class="ph ph-eye-slash text-xl text-bgColor18 !leading-none currentPassowordShow cursor-pointer dark:text-color18"></i>
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="pt-4">
                                    <p class="text-sm font-semibold pb-2">{{ __('New Password') }}</p>
                                    <div
                                        class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3 @error('new_password') is-invalid @enderror">
                                        <input type="password" placeholder="*****" name="new_password"
                                            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 passwordField"
                                            required />
                                        <i
                                            class="ph ph-eye-slash text-xl text-bgColor18 !leading-none passowordShow cursor-pointer dark:text-color18"></i>
                                    </div>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="pt-4">
                                    <p class="text-sm font-semibold pb-2">{{ __('Confirm Password') }}</p>
                                    <div
                                        class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
                                        <input type="password" placeholder="*****" name="confirm_new_password"
                                            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 confirmPasswordField"
                                            required />
                                        <i
                                            class="ph ph-eye-slash text-xl text-bgColor18 !leading-none confirmPasswordShow cursor-pointer dark:text-color18"></i>
                                        @error('confirm_new_password')
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
                    </div>
                </div>
            </div>
            <div class="tab-content hiddenTab" id="tabThree_data">
                <div class="bg-white dark:bg-color10 p-5 rounded-2xl">
                    <p class="text-xl font-semibold">Account</p>
                    <div class="flex flex-col gap-5 pt-8">
                        <div
                            class="flex justify-between items-center py-4 px-5 rounded-xl bg-white border border-color21 dark:bg-color11 dark:border-color24">
                            <div class="flex justify-start items-center gap-3">
                                <div
                                    class="flex justify-center items-center p-2 rounded-full border bg-color14 border-color16 text-lg !leading-none text-p2 dark:bg-bgColor14 dark:border-bgColor16 dark:text-p1">
                                    <i class="ph-fill ph-sun-dim"></i>
                                </div>
                                <p class="font-semibold text-sm">Dark Mode</p>
                            </div>
                            <div class="toggle choose-mode">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
