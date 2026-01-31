@extends('frontend.layouts.share.master')

@section('title', 'Withdraws')

@section('css')
    <style>
        /* ---------------------------------------------
               Status badges
            --------------------------------------------- */
        .bg-green-100 {
            background-color: #dcfce7;
        }

        .text-green-700 {
            color: #15803d;
        }

        .bg-yellow-100 {
            background-color: #fef3c7;
        }

        .text-yellow-700 {
            color: #b45309;
        }

        .bg-red-100 {
            background-color: #fee2e2;
        }

        .text-red-700 {
            color: #b91c1c;
        }

        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        .text-gray-700 {
            color: #374151;
        }

        /* ---------------------------------------------
               Withdraw card
            --------------------------------------------- */
        .withdraw-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background-color: #ffffff;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        .withdraw-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #f59e0b;
        }

        .withdraw-left {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .withdraw-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f59e0b;
            font-size: 18px;
            flex-shrink: 0;
        }

        .withdraw-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .withdraw-info p {
            margin: 0;
            font-size: 0.85rem;
        }

        /* Amount */
        .amount-out {
            color: #dc2626;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 24px;
            gap: 4px;
            flex-wrap: wrap;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-wrapper a {
            background-color: #f3f4f6;
            color: #374151;
        }

        .pagination-wrapper a:hover {
            background-color: #f59e0b;
            color: #ffffff;
        }

        .pagination-wrapper .active {
            background-color: #f59e0b;
            color: #ffffff;
            font-weight: 600;
        }

        .pagination-wrapper .disabled {
            background-color: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 48px;
            color: #f59e0b;
            margin-bottom: 12px;
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div
        class="p-5 mt-8 bg-p1 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p1 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p1 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
        <div class="flex justify-start items-start gap-3">
            <div class="size-12 bg-white rounded-full flex justify-center items-center text-color9 text-xl">
                <i class="ph ph-bank"></i>
            </div>
            <div class="text-white">
                <p class="text-2xl font-semibold">{{ \App\Helpers\Helper::formatCurrency($wallet->balance ?? 0) }}</p>
                <p class="text-xs">Current Balance</p>
            </div>
        </div>
        <a href="{{ route('frontend.withdraw.request') }}"
            class="bg-white text-color9 py-2 px-5 rounded-xl font-semibold text-xs">
            Withdraw
        </a>
    </div>

    <div class="px-5 py-7 mt-14 bg-p2 flex justify-between items-center rounded-2xl gap-3">
        <div class="flex justify-start items-center gap-3">
            <div class="bg-white rounded-full flex justify-center items-center text-color9 text-xl !leading-none p-3">
                <i class="ph ph-chats-circle text-p1"></i>
            </div>
            <div class="text-white">
                <p class="text-xs">Do you have a question about the balance?</p>
            </div>
        </div>
        <a href="{{ route('frontend.faqs') }}"
            class="bg-white text-p1 py-2 px-5 rounded-xl font-semibold text-xs text-nowrap">
            Get Help</a>
    </div>
    <div class="bg-white dark:bg-color10 py-6 px-5 rounded-xl border border-color21 mt-6">

        {{-- Heading --}}
        <div class="flex items-center gap-2 mb-5">
            <i class="ph ph-bank text-p1 text-lg"></i>
            <h2 class="text-lg font-semibold dark:text-white">My Withdrawals</h2>
        </div>

        @if ($withdraws->count() > 0)
            <div class="flex flex-col gap-3">
                @foreach ($withdraws as $wd)
                    <div class="withdraw-card"
                        onclick="window.location='{{ route('frontend.withdraw.preview', ['id' => $wd->id]) }}'">
                        {{-- Left --}}
                        <div class="withdraw-left">
                            <div class="withdraw-icon">
                                <i class="ph ph-arrow-up"></i>
                            </div>
                            <div class="withdraw-info">
                                <p class="font-semibold">{{ \App\Helpers\Helper::formatCurrency($wd->amount) }}</p>
                                <p class="text-color5">{{ $wd->crypto }} - {{ $wd->wallet_address }}</p>
                                <p class="text-color5 text-xs">{{ $wd->created_at->format('d M Y • h:i A') }}</p>
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="text-right">
                            <span
                                class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                            {{ $wd->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $wd->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $wd->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($wd->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrapper mt-6">
                {{ $withdraws->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="ph ph-wallet"></i>
                <p class="text-sm font-semibold">No withdrawals found</p>
                <p class="text-xs mt-1 max-w-md mx-auto text-color5">
                    All your withdrawal requests will appear here.
                </p>
            </div>
        @endif

    </div>
@endsection

@section('script')
@endsection
