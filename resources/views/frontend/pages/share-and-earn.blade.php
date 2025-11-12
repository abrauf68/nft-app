@extends('frontend.layouts.share.master')

@section('title', 'Invite & Earn rewards')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    @php
        $referralLink = route('register', ['code' => Auth::user()->username]);
    @endphp
    <div class="pt-8">
        <div class="py-6 px-5 bg-white dark:bg-color9 border border-dashed border-p1 rounded-xl">
            <div class="flex justify-between items-center pb-4 border-b border-dashed border-p1">
                <div class="flex justify-start items-center gap-2">
                    <i class="ph ph-megaphone text-p1"></i>
                    <p class="text-xs">Referral Code :</p>
                </div>
                <div class="flex justify-start items-start">
                    <p class="text-xl font-semibold">{{ Auth::user()->username }}</p>
                    <i class="ph ph-copy text-p1 cursor-pointer copy-icon" data-link="{{ Auth::user()->username }}"></i>
                </div>
            </div>
            <div class="flex justify-between items-center pt-4">
                <p class="text-xs font-semibold">Or share link via</p>
                <div class="flex justify-start items-center gap-2">
                    <a href="https://www.facebook.com/dialog/send?link={{ urlencode($referralLink) }}" target="_blank"
                        rel="noopener noreferrer">
                        <img src="{{ asset('frontAssets/images/messanger.svg') }}" alt="" />
                    </a>
                    <a href="https://wa.me/?text={{ urlencode('Join using my referral link: ' . $referralLink) }}"
                        target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('frontAssets/images/whatsapp.svg') }}" alt="" />
                    </a>
                    <a href="mailto:?subject=Join%20Now&body={{ urlencode('Use my referral link to register: ' . $referralLink) }}"
                        title="Share via Email"
                        class="p-2 rounded-full border border-color16 bg-color14 flex justify-center items-center text-bgColor18 dark:border-bgColor16 dark:bg-bgColor16 dark:text-white">
                        <i class="ph ph-envelope-open"></i>
                    </a>

                    <!-- Copy Link -->
                    <button type="button"
                        class="p-2 rounded-full border border-color16 bg-color14 flex justify-center items-center text-bgColor18 dark:border-bgColor16 dark:bg-bgColor16 dark:text-white copy-link"
                        data-link="{{ $referralLink }}" title="Copy Link">
                        <i class="ph ph-link-simple"></i>
                    </button>
                </div>
            </div>
        </div>
        <p class="text-xs text-color5 text-center pt-5 dark:text-white">
            <i class="ph ph-asterisk text-p1"></i> Will earn when 11 friends
            join Quize platform
        </p>
    </div>
    <div class="bg-white dark:bg-color10 py-8 px-5 rounded-xl border border-color21 mt-6">
        <p class="text-xl font-semibold">How it works</p>
        <div class="flex flex-col gap-4 pt-5">
            <div class="flex justify-start items-start gap-3">
                <div
                    class="size-8 flex justify-center items-center border border-color16 bg-color14 rounded-full text-xs font-semibold shrink-0 dark:text-p1 dark:border-bgColor16 dark:bg-bgColor14">
                    1
                </div>
                <div class="">
                    <p class="font-semibold">Invite Friends :</p>
                    <p class="text-xs text-color5 pt-1 dark:text-bgColor5">
                        Invite friends who share your passion for competitive contests
                        to join MindPe. Share your referral code with them to sign up
                        and receive a joining bonus.
                    </p>
                </div>
            </div>
            <div class="flex justify-start items-start gap-3">
                <div
                    class="size-8 flex justify-center items-center border border-color16 bg-color14 rounded-full text-xs font-semibold shrink-0 dark:text-p1 dark:border-bgColor16 dark:bg-bgColor14">
                    2
                </div>
                <div class="">
                    <p class="font-semibold">Earn Rewards :</p>
                    <p class="text-xs text-color5 pt-1 dark:text-bgColor5">
                        When your friends use your referral code during registration,
                        they receive a cash reward as a joining bonus.
                    </p>
                </div>
            </div>
            <div class="flex justify-start items-start gap-3">
                <div
                    class="size-8 flex justify-center items-center border border-color16 bg-color14 rounded-full text-xs font-semibold shrink-0 dark:text-p1 dark:border-bgColor16 dark:bg-bgColor14">
                    3
                </div>
                <div class="">
                    <p class="font-semibold">Join Contests :</p>
                    <p class="text-xs text-color5 pt-1 dark:text-bgColor5">
                        Encourage your friends to explore MindPe and join contests
                        based on their skill sets. To activate the joining bonus, they
                        need to participate in at least one paid contest.
                    </p>
                </div>
            </div>
            <div class="flex justify-start items-start gap-3">
                <div
                    class="size-8 flex justify-center items-center border border-color16 bg-color14 rounded-full text-xs font-semibold shrink-0 dark:text-p1 dark:border-bgColor16 dark:bg-bgColor14">
                    1
                </div>
                <div class="">
                    <p class="font-semibold">Compete and Win :</p>
                    <p class="text-xs text-color5 pt-1 dark:text-bgColor5">
                        Engage in various contests, showcase your skills, and compete
                        against others for exciting prizes and rewards offered on
                        MindPe's platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Copy icon click
            document.querySelectorAll('.copy-icon, .copy-link').forEach(el => {
                el.addEventListener('click', () => {
                    const link = el.getAttribute('data-link');
                    navigator.clipboard.writeText(link);
                    toastr.success("Copied successfully!");
                });
            });
        });
    </script>
@endsection
