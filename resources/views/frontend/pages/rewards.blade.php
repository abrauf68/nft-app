@extends('frontend.layouts.share.master')

@section('title', 'Rewards')

@section('css')
    <style>
        /* ===== Rewards Layout ===== */
        .rewards-wrapper {
            background: #ffffff;
            padding: 28px 22px;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
        }

        .rewards-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        /* ===== Reward Card ===== */
        .reward-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #eef0f4;
            transition: all 0.25s ease;
            position: relative;
        }

        .reward-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
        }

        /* ===== Icon ===== */
        .reward-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            padding: 3px;
            background: linear-gradient(135deg, #4f46e5, #22c55e);
            flex-shrink: 0;
        }

        .reward-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
        }

        /* ===== Content ===== */
        .reward-content {
            flex: 1;
        }

        .reward-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .reward-desc {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        .reward-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #16a34a;
        }

        /* ===== Button ===== */
        .reward-btn {
            padding: 8px 18px;
            font-size: 12px;
            border-radius: 999px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .reward-btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        /* ===== Claimed Badge ===== */
        .reward-claimed {
            padding: 7px 16px;
            font-size: 11px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ===== Claimed Card Look ===== */
        .reward-card.claimed {
            opacity: 0.7;
            background: #f9fafb;
        }

        /* ===== Mobile Fix ===== */
        @media (max-width: 640px) {
            .reward-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .reward-btn,
            .reward-claimed {
                align-self: flex-end;
                margin-top: 10px;
            }
        }
    </style>
@endsection

@section('content')

    <div class="rewards-wrapper mt-6">
        <p class="rewards-title">Rewards Hub</p>

        <div class="grid md:grid-cols-2 gap-4">

            @forelse($rewards as $reward)
                <div class="reward-card {{ in_array($reward->id, $userClaimedRewards) ? 'claimed' : '' }}">

                    <!-- Icon -->
                    <div class="reward-icon">
                        <img src="{{ asset($reward->image ?? 'frontAssets/images/icon4.png') }}" alt="{{ $reward->title }}">
                    </div>

                    <!-- Content -->
                    <div class="reward-content">
                        <div class="reward-title">{{ $reward->title }}</div>
                        <div class="reward-desc">{{ $reward->short_description }}</div>
                        <div class="reward-amount">
                            <span>
                                Earn ${{ $reward->reward_amount }}
                            </span>
                            <!-- Action -->
                            @if (in_array($reward->id, $userClaimedRewards))
                                <div class="reward-claimed">✔ Claimed</div>
                            @else
                                <a href="{{ route('frontend.reward.claim', $reward->id) }}" class="reward-btn">
                                    Claim
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

            @empty
                <p class="text-sm text-gray-500">No rewards available right now.</p>
            @endforelse

        </div>
    </div>


@endsection
