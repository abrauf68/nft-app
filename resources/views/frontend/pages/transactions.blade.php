@extends('frontend.layouts.share.master')

@section('title', 'Transactions')

@section('css')
<style>
    /* ---------------------------------------------
       Status badges
    --------------------------------------------- */
    .bg-green-100 { background-color: #dcfce7; }
    .text-green-700 { color: #15803d; }

    .bg-yellow-100 { background-color: #fef3c7; }
    .text-yellow-700 { color: #b45309; }

    .bg-red-100 { background-color: #fee2e2; }
    .text-red-700 { color: #b91c1c; }

    .bg-gray-100 { background-color: #f3f4f6; }
    .text-gray-700 { color: #374151; }

    /* ---------------------------------------------
       Transaction card
    --------------------------------------------- */
    .transaction-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        background-color: #ffffff;
        transition: all 0.2s ease-in-out;
    }
    .transaction-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-color: #facc15;
    }
    .transaction-left {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    .transaction-icon {
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
    .transaction-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .transaction-info p {
        margin: 0;
    }

    /* ---------------------------------------------
       Amount
    --------------------------------------------- */
    .amount-in { color: #15803d; font-weight: 600; font-size: 1rem; }
    .amount-out { color: #dc2626; font-weight: 600; font-size: 1rem; }

    /* ---------------------------------------------
       Pagination
    --------------------------------------------- */
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
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
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

    /* ---------------------------------------------
       Empty state
    --------------------------------------------- */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }
    .empty-state i {
        font-size: 64px;
        color: #f59e0b;
        margin-bottom: 16px;
    }

</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<div class="bg-white dark:bg-color10 py-6 px-5 rounded-xl border border-color21" style="margin-top: 30px;">

    {{-- Heading --}}
    {{-- <div class="flex items-center gap-2 mb-4">
        <i class="ph ph-receipt text-p1 text-xl"></i>
        <h2 class="text-xl font-semibold dark:text-white">
            Transactions
        </h2>
    </div> --}}

    @if ($transactions->count() > 0)
        <div class="flex flex-col gap-3">
            @foreach ($transactions as $txn)
                <div class="transaction-card">

                    {{-- Left Side --}}
                    <div class="transaction-left">
                        {{-- Icon --}}
                        <div class="transaction-icon">
                            <i class="ph
                                {{ $txn->transaction_type === 'deposit' ? 'ph-arrow-down' : '' }}
                                {{ $txn->transaction_type === 'withdrawal' ? 'ph-arrow-up' : '' }}
                                {{ $txn->transaction_type === 'referral_bonus' ? 'ph-gift' : '' }}
                                {{ $txn->transaction_type === 'reward' ? 'ph-trophy' : '' }}
                                {{ $txn->transaction_type === 'transfer' ? 'ph-arrows-left-right' : '' }}
                                {{ $txn->transaction_type === 'mined' ? 'ph-pickaxe' : '' }}"></i>
                        </div>

                        {{-- Info --}}
                        <div class="transaction-info">
                            <p class="font-semibold">
                                {{ ucfirst(str_replace('_', ' ', $txn->transaction_type)) }}
                            </p>
                            <p class="text-xs text-color5 dark:text-bgColor5">
                                {{ $txn->description ?? 'Transaction' }}
                            </p>
                            @if ($txn->tx_hash)
                                <p class="text-xs text-color5 break-all">
                                    Tx: {{ Str::limit($txn->tx_hash, 28) }}
                                </p>
                            @endif
                            <p class="text-xs text-color5">
                                {{ $txn->created_at->format('d M Y • h:i A') }}
                            </p>
                        </div>
                    </div>

                    {{-- Right Side --}}
                    <div class="text-right">
                        <p class="{{ $txn->money_flow === 'in' ? 'amount-in' : 'amount-out' }}">
                            {{ $txn->money_flow === 'in' ? '+' : '-' }}
                            {{ \App\Helpers\Helper::formatCurrency($txn->amount) }}
                        </p>

                        <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                            {{ $txn->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $txn->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $txn->status === 'failed' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $txn->status === 'cancelled' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ ucfirst($txn->status) }}
                        </span>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Inline Pagination --}}
        @if ($transactions->lastPage() > 1)
            <div class="pagination-wrapper mt-6">
                {{-- Previous Page Link --}}
                @if ($transactions->onFirstPage())
                    <span class="disabled">Prev</span>
                @else
                    <a href="{{ $transactions->previousPageUrl() }}">Prev</a>
                @endif

                {{-- Page Links --}}
                @for ($i = 1; $i <= $transactions->lastPage(); $i++)
                    @if ($i == $transactions->currentPage())
                        <span class="active">{{ $i }}</span>
                    @else
                        <a href="{{ $transactions->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif

    @else
        {{-- Empty State --}}
        <div class="empty-state">
            <i class="ph ph-wallet"></i>
            <p class="text-lg font-semibold">No transactions found</p>
            <p class="text-sm mt-2 max-w-md mx-auto dark:text-bgColor5">
                Your deposits, withdrawals, rewards, and referral earnings will appear here.
            </p>
        </div>
    @endif

</div>
@endsection

@section('script')
@endsection
