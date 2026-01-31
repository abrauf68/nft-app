@extends('frontend.layouts.share.master')

@section('title', 'Withdraw Amount')

@section('css')
<style>
    .withdraw-container {
        margin-top: 20px;
        background: #fff;
        border-radius: 20px;
    }

    .recommended {
        transition: all 0.2s;
    }

    .recommended:hover {
        border-color: #f59e0b;
        cursor: pointer;
    }

    input::placeholder, textarea::placeholder {
        font-weight: normal;
        color: #9ca3af;
    }
</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    {{-- Current Wallet Balance --}}
    <div class="p-5 mt-8 bg-p1 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p1 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p1 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
        <div class="flex justify-start items-start gap-3">
            <div class="size-12 bg-white rounded-full flex justify-center items-center text-color9 text-xl">
                <i class="ph ph-bank"></i>
            </div>
            <div>
                <p class="text-2xl font-semibold text-white">{{ \App\Helpers\Helper::formatCurrency($wallet->balance ?? 0) }}</p>
                <p class="text-xs text-bgColor5">Current Balance</p>
            </div>
        </div>
    </div>

    {{-- Withdraw Form --}}
    <div class="withdraw-container">
        <form method="POST" action="{{ route('frontend.withdraw.request.submit') }}">
            @csrf
            <div class="z-40 overflow-auto pb-8">

                {{-- Amount --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">
                        Enter Amount
                        <small style="color: red;">
                            (minimum: {{ \App\Helpers\Helper::formatCurrency($minimumWithdraw) }}, max: {{ \App\Helpers\Helper::formatCurrency($wallet->balance ?? 0) }})
                        </small>
                    </p>
                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <input type="number" id="withdrawAmount" name="amount"
                               min="{{ $minimumWithdraw }}"
                               max="{{ $wallet->balance ?? 0 }}"
                               placeholder="i.e. 50"
                               class="outline-none bg-transparent w-full placeholder:text-color9"
                               required />
                    </div>
                </div>

                {{-- Recommended Amounts --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Recommended</p>
                    <div class="flex justify-start items-center gap-2">
                        @foreach ([50, 100, 200, 500] as $amt)
                            <div class="recommended py-2 px-4 rounded-xl text-sm bg-white border border-color21 text-color1"
                                 data-amount="{{ $amt }}">
                                {{ $amt }}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Crypto / Wallet Type --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Select Crypto / Wallet</p>
                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <select name="crypto"
                                class="form-control mt-2 outline-none bg-transparent w-full placeholder:text-color9 font-normal">
                            <option value="USDTTRC20" {{ optional($latestWithdraw)->crypto == 'USDTTRC20' ? 'selected' : '' }}>USDT (TRC20)</option>
                            <option value="BTC" {{ optional($latestWithdraw)->crypto == 'BTC' ? 'selected' : '' }}>Bitcoin</option>
                            <option value="ETH" {{ optional($latestWithdraw)->crypto == 'ETH' ? 'selected' : '' }}>Ethereum</option>
                        </select>
                    </div>
                </div>

                {{-- Wallet Address --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Wallet Address</p>
                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <input type="text" name="wallet_address" placeholder="Enter your wallet address"
                               class="outline-none bg-transparent w-full placeholder:text-color9 font-normal"
                               value="{{ optional($latestWithdraw)->wallet_address ?? '' }}" required />
                    </div>
                </div>

                {{-- Optional Notes --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Notes (Optional)</p>
                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <textarea name="notes" placeholder="Add a note or description"
                                  class="outline-none bg-transparent w-full placeholder:text-color9 font-normal">{{ optional($latestWithdraw)->notes ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="pt-5 px-6">
                    <button type="submit" style="width: 100%;"
                            class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block dark:bg-p1">
                        Withdraw
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    const recommendedButtons = document.querySelectorAll('.recommended');
    const withdrawAmount = document.getElementById('withdrawAmount');
    const MIN_WITHDRAW = {{ $minimumWithdraw }};
    const MAX_WITHDRAW = {{ $wallet->balance ?? 0 }};

    // Recommended buttons click
    recommendedButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            let value = parseFloat(this.dataset.amount);
            if (value < MIN_WITHDRAW) {
                alert(`Minimum withdrawal is ${MIN_WITHDRAW}`);
                return;
            }
            if (value > MAX_WITHDRAW) {
                alert(`Maximum withdrawal is ${MAX_WITHDRAW}`);
                return;
            }

            recommendedButtons.forEach(b => {
                b.classList.remove('bg-p2', 'text-white');
                b.classList.add('bg-white', 'text-color1');
            });

            this.classList.remove('bg-white', 'text-color1');
            this.classList.add('bg-p2', 'text-white');
            withdrawAmount.value = value;
        });
    });

    // Manual input validation
    withdrawAmount.addEventListener('input', function() {
        let value = parseFloat(this.value);
        if (value && value < MIN_WITHDRAW) {
            this.setCustomValidity(`Minimum withdrawal amount is ${MIN_WITHDRAW}`);
        } else if (value && value > MAX_WITHDRAW) {
            this.setCustomValidity(`Maximum withdrawal amount is ${MAX_WITHDRAW}`);
        } else {
            this.setCustomValidity('');
        }
    });

    // Pre-fill recommended button if it matches latest withdrawal
    const latestAmount = {{ optional($latestWithdraw)->amount ?? 'null' }};
    if (latestAmount) {
        recommendedButtons.forEach(btn => {
            if (parseFloat(btn.dataset.amount) === latestAmount) {
                btn.classList.remove('bg-white', 'text-color1');
                btn.classList.add('bg-p2', 'text-white');
            }
        });
        withdrawAmount.value = latestAmount;
    }
</script>
@endsection
