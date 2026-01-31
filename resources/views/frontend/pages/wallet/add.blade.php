@extends('frontend.layouts.share.master')

@section('title', 'Add Amount')

@section('css')
    <style>
        .add-container {
            margin-top: 20px;
            background: #fff;
            border-radius: 20px;
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="add-container">
        <form method="POST" action="{{ route('frontend.wallet.add-crypto') }}">
            @csrf
            <div class="z-40 overflow-auto pb-8">
                {{-- <div class="flex justify-between items-center px-6 pt-10">
                    <p class="text-2xl text-color9 font-semibold dark:text-white">
                        Add Money
                    </p>
                </div> --}}
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">
                        Select Amount
                        <small style="color: red;">
                            (minimum is {{ \App\Helpers\Helper::formatCurrency($minimumDeposit) }})
                        </small>
                    </p>

                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <input type="number" id="amountInput" name="amount" min="{{ $minimumDeposit }}" placeholder="i.e. 50"
                            class="outline-none bg-transparent w-full placeholder:text-color9 font-bold" />
                    </div>
                </div>
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Recommended</p>
                    <div class="flex justify-start items-center gap-2">
                        <div class="recommended py-2 px-4 rounded-xl text-sm bg-white border border-color21 text-color1 cursor-pointer"
                            data-amount="20">
                            20
                        </div>
                        <div class="recommended py-2 px-4 rounded-xl text-sm bg-white border border-color21 text-color1 cursor-pointer"
                            data-amount="50">
                            50
                        </div>
                        <div class="recommended py-2 px-4 rounded-xl bg-white text-sm border border-color21 text-color1 cursor-pointer"
                            data-amount="100">
                            100
                        </div>
                        <div class="recommended py-2 px-4 rounded-xl bg-white text-sm border border-color21 text-color1 cursor-pointer"
                            data-amount="200">
                            200
                        </div>
                    </div>

                </div>
                <div class="px-6 pt-5">
                    <p class="pb-2 dark:text-white">Select Crypto Type</p>
                    <div class="py-3 px-4 bg-white rounded-xl border border-color21">
                        <select name="crypto"
                            class="form-control mt-2 outline-none bg-transparent w-full placeholder:text-color9 font-bold">
                            <option value="USDTTRC20">USDT (TRC20)</option>
                            <option value="BTC">Bitcoin</option>
                            <option value="ETH">Ethereum</option>
                        </select>
                    </div>
                </div>
                <div class="pt-5 px-6">
                    <button style="width: 100%;"
                        class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block dark:bg-p1">Continue</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const recommendedButtons = document.querySelectorAll('.recommended');
        const amountInput = document.getElementById('amountInput');

        const MIN_AMOUNT = {{ $minimumDeposit }};

        // Recommended buttons click
        recommendedButtons.forEach(btn => {
            btn.addEventListener('click', function() {

                let value = parseFloat(this.dataset.amount);

                if (value < MIN_AMOUNT) {
                    alert(`Minimum deposit is ${MIN_AMOUNT}`);
                    return;
                }

                recommendedButtons.forEach(b => {
                    b.classList.remove('bg-p2', 'text-white');
                    b.classList.add('bg-white', 'text-color1');
                });

                this.classList.remove('bg-white', 'text-color1');
                this.classList.add('bg-p2', 'text-white');

                amountInput.value = value;
            });
        });

        // Manual input validation
        amountInput.addEventListener('input', function() {
            let value = parseFloat(this.value);

            if (value && value < MIN_AMOUNT) {
                this.setCustomValidity(`Minimum amount is ${MIN_AMOUNT}`);
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
@endsection
