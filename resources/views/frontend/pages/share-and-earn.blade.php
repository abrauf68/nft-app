@extends('frontend.layouts.share.master')

@section('title', 'Invite & Earn rewards')

@section('css')
    <style>
        /* Base badge styling */
        .inline-block { display: inline-block; }
        .px-2 { padding-left: 8px; padding-right: 8px; }
        .py-1 { padding-top: 4px; padding-bottom: 4px; }
        .text-xs { font-size: 12px; line-height: 1; }
        .rounded-full { border-radius: 9999px; }

        /* VERIFIED badge */
        .bg-green-100 { background-color: #dcfce7; }
        .text-green-700 { color: #15803d; }

        /* PENDING badge */
        .bg-yellow-100 { background-color: #fef3c7; }
        .text-yellow-700 { color: #b45309; }

        /* SUSPICIOUS badge */
        .bg-red-100 { background-color: #fee2e2; }
        .text-red-700 { color: #b91c1c; }

        /* Dark mode overrides */
        .dark .bg-green-900 { background-color: #064e3b; }
        .dark .text-green-300 { color: #6ee7b7; }
        .dark .bg-yellow-900 { background-color: #78350f; }
        .dark .text-yellow-300 { color: #fde68a; }
        .dark .bg-red-900 { background-color: #7f1d1d; }
        .dark .text-red-300 { color: #fca5a5; }

        /* Suspicious profile indicator */
        .suspicious-indicator {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #fee2e2;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #b91c1c;
            font-size: 20px;
            border: 2px solid #f87171;
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    @php
        $referralLink = route('register', ['code' => Auth::user()->username]);
    @endphp

    {{-- Referral Code Section --}}
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
            <i class="ph ph-asterisk text-p1"></i> Will earn {{ \App\Helpers\Helper::formatCurrency($reffralBonus ?? 0) }}
            for each friend
            you invite
        </p>
    </div>

    {{-- Referrals Section --}}
    <div class="bg-white dark:bg-color10 py-6 px-5 rounded-xl border border-color21 mt-6">

        {{-- Heading --}}
        <div class="flex items-center gap-2 mb-3">
            <i class="ph ph-users-three text-p1 text-xl"></i>
            <h2 class="text-xl font-semibold dark:text-white">Your Referrals</h2>
        </div>

        @if ($refrrals->count() > 0)

            {{-- Referral List --}}
            <div class="flex flex-col gap-3">
                @foreach ($refrrals as $referral)
                    <div
                        class="flex justify-between items-center p-4 rounded-lg border border-color21 bg-color14 dark:bg-bgColor16">

                        {{-- Left Side: Avatar + Info --}}
                        <div class="flex items-center gap-3">

                            {{-- Profile Image or Suspicious Indicator --}}
                            <div class="relative size-12 rounded-full overflow-hidden border border-color21 shrink-0">
                                @if ($referral->is_suspicious)
                                    <div class="suspicious-indicator" title="Suspicious user">
                                        <i class="ph ph-warning"></i>
                                    </div>
                                @elseif ($referral->profile->profile_image ?? false)
                                    <img src="{{ asset($referral->profile->profile_image) }}" alt="Profile Image"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-color21 text-sm font-semibold text-white">
                                        {{ strtoupper(substr($referral->username, 0, 1)) }}
                                    </div>
                                @endif

                                {{-- Pending Indicator --}}
                                @if (!$referral->email_verified_at)
                                    <span
                                        class="absolute -bottom-1 -right-1 size-4 bg-yellow-400 border-2 border-white rounded-full"
                                        title="Email not verified"></span>
                                @endif
                            </div>

                            {{-- User Info --}}
                            <div>
                                <p class="font-semibold">{{ $referral->username ?? 'User' }}</p>
                                <p class="text-xs text-color5 dark:text-bgColor5">
                                    Joined on {{ $referral->created_at->format('d M Y') }}
                                </p>
                            </div>

                        </div>

                        {{-- Right Side: Status / Earnings --}}
                        <div class="text-right">

                            {{-- 1️⃣ Email not verified --}}
                            @if (!$referral->email_verified_at)
                                <span
                                    class="inline-block px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                                    Pending
                                </span>

                                <p class="text-xs text-color5 mt-1 dark:text-bgColor5">
                                    Reward locked
                                </p>

                            {{-- 2️⃣ Verified but suspicious --}}
                            @elseif ($referral->is_suspicious)
                                <span
                                    class="inline-block px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">
                                    Under Review
                                </span>

                                <p class="text-xs text-color5 mt-1 dark:text-bgColor5">
                                    Suspicious activity detected
                                </p>

                            {{-- 3️⃣ Verified & clean --}}
                            @else
                                <span
                                    class="inline-block mb-1 px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                    Verified
                                </span>

                                <p class="text-xs text-color5 dark:text-bgColor5">
                                    You earned
                                </p>

                                <p class="font-semibold text-p1">
                                    {{ \App\Helpers\Helper::formatCurrency($reffralBonus ?? 0) }}
                                </p>
                            @endif

                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Important Note --}}
            <div class="mt-6 p-4 rounded-lg border border-dashed border-p1 bg-color14 dark:bg-bgColor16">
                <div class="flex items-start gap-2">
                    <i class="ph ph-info text-p1 mt-0.5"></i>
                    <p class="text-sm text-color5 dark:text-bgColor5">
                        <span class="font-semibold text-color9 dark:text-white">Important:</span>
                        You will receive referral rewards only after your friend
                        <span class="font-semibold">verifies their email address</span>.
                        Rewards remain locked for unverified referrals.
                    </p>
                </div>
            </div>

        @else
            {{-- No Referrals State --}}
            <div class="text-center py-10">

                <i class="ph ph-users text-5xl text-p1 mb-4"></i>

                <p class="text-lg font-semibold">
                    No referrals yet
                </p>

                <p class="text-sm text-color5 mt-2 max-w-md mx-auto dark:text-bgColor5">
                    Invite your friends and start earning rewards when they join and verify their account.
                </p>

                {{-- How You Earn --}}
                <div class="mt-6 p-5 rounded-xl border border-dashed border-p1 bg-color14 dark:bg-bgColor16 text-left">
                    <p class="font-semibold mb-3">How you earn 💰</p>
                    <ul class="text-sm text-color5 flex flex-col gap-2 dark:text-bgColor5">
                        <li>• Share your referral link or code</li>
                        <li>• Friend registers using your code</li>
                        <li>• Friend verifies their email address</li>
                        <li>• You earn <span class="font-semibold text-p1">{{ \App\Helpers\Helper::formatCurrency($reffralBonus ?? 0) }}</span> after email verification</li>
                    </ul>
                </div>

                {{-- Invite Button --}}
                <div class="mt-6">
                    <button
                        onclick="navigator.clipboard.writeText('{{ $referralLink }}'); toastr.success('Referral link copied!')"
                        class="bg-p2 text-white px-6 py-3 rounded-full font-semibold text-sm">
                        Invite Friends Now
                    </button>
                </div>

            </div>
        @endif

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
