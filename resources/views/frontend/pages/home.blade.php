@extends('frontend.layouts.master')

@section('title', 'Home')

@section('css')
    <style>
        .absolute img {
            height: 50px !important;
        }

        .absolute .text-xs {
            color: #fff !important;
        }
    </style>
    <style>
        .coin-selector {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .coin-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.6;
            border: 2px solid transparent;
        }

        .coin-icon:hover {
            transform: scale(1.1);
            opacity: 1;
        }

        .coin-icon.active {
            opacity: 1;
            border-color: #3b82f6;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
        }

        .price-info {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        /* .price-info h3 {
                font-size: 2rem;
                font-weight: 700;
            } */

        .price-info span {
            font-size: 1rem;
            margin-left: 10px;
        }

        canvas {
            max-height: 360px;
        }

        .price-info span#coinPrice {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
        }

        .price-info span#coinChange {
            font-size: 1rem; /* Prominent change percentage */
            padding: 5px 12px;
            border-radius: 8px;
            font-weight: 600;
            /* Default background for neutral/unloaded state */
            background-color: rgba(255, 255, 255, 0.1);
        }

        .price-info span#coinChange.text-green-600 {
            background-color: rgba(16, 185, 129, 0.2); /* Tailwind green-500 with opacity */
            color: #10b981;
        }

        .price-info span#coinChange.text-red-600 {
            background-color: rgba(239, 68, 68, 0.2);
            /* Tailwind red-500 with opacity */
            color: #ef4444;
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="relative">
        <h4 class="text-white text-center pt-5 text-sm font-semibold" style="font-size: 2rem;">
            {{ \App\Helpers\Helper::getCompanyName() }}
        </h4>
        <div
            class="absolute -left-[53%] -top-[620px] min-[370px]:-top-[650px] min-[380px]:-top-[680px] min-[400px]:-top-[720px] min-[420px]:-top-[750px]">
            <div
                class="flex justify-around items-center rounded-full relative rotate-0 circleSliders duration-700 max-[430px]:size-[209vw] size-[900px]">
                <a href=""
                    class="flex flex-col justify-center items-center text-center gap-3 absolute -left-[1%] bottom-[35%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </a>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[2%] bottom-[24%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[7%] bottom-[14.5%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute left-[15.5%] bottom-[7.5%] rotate-[58deg]">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        BNB
                    </p>
                </div>

                <div class="flex flex-col justify-center items-center text-center gap-3 absolute left-[29%] bottom-0">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </div>
                <div class="flex flex-col justify-center items-center text-center gap-3 absolute left-[39.5%] -bottom-[3%]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[40.5%] -bottom-[3%]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center text-center gap-3 absolute right-[31%] bottom-0">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="BNB" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        BNB
                    </p>
                </div>

                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[16.5%] bottom-[6.5%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/bitcoin.png') }}" alt="BTC" class="" />
                    <p class="text-xs font-semibold dark:text-white">BTC</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[8%] bottom-[13%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/etherium.png') }}" alt="ETH" class="" />
                    <p class="text-xs font-semibold dark:text-white">ETH</p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-[2%] bottom-[23.5%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/solana.png') }}" alt="SOL" class="" />
                    <p class="text-xs font-semibold dark:text-white">
                        SOL
                    </p>
                </div>
                <div
                    class="flex flex-col justify-center items-center text-center gap-3 absolute right-0 bottom-[34%] rotate-[-58deg]">
                    <img src="{{ asset('frontAssets/images/coins/binance-coin.png') }}" alt="" class="" />
                    <p class="text-xs font-semibold dark:text-white">BNB</p>
                </div>
            </div>
        </div>
        <div class="flex justify-start items-center gap-1 flex-col pt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="202" height="202">
                <path
                    d="M76.388 165.94C75.9671 167.043 74.7305 167.599 73.6407 167.145C70.8225 165.972 68.0826 164.618 65.4379 163.094C64.4153 162.504 64.1052 161.184 64.7252 160.18V160.18C65.3453 159.175 66.6606 158.867 67.6844 159.454C70.0989 160.84 72.5974 162.074 75.1655 163.149C76.2544 163.605 76.8088 164.837 76.388 165.94V165.94Z"
                    fill="#141414" fill-opacity="0.16" id="itemLeft" />
                <path
                    d="M124.225 166.48C124.629 167.59 124.057 168.82 122.936 169.19C110.033 173.452 96.1783 173.936 83.0093 170.584C81.8653 170.293 81.2096 169.106 81.535 167.971V167.971C81.8604 166.836 83.0434 166.184 84.1878 166.473C96.4884 169.579 109.42 169.127 121.474 165.171C122.595 164.803 123.821 165.371 124.225 166.48V166.48Z"
                    fill="#FF710F" id="itemCenter" />

                <path
                    d="M141.502 157.326C142.203 158.276 142.002 159.617 141.031 160.288C138.52 162.024 135.9 163.597 133.187 164.996C132.138 165.537 130.86 165.084 130.35 164.02V164.02C129.84 162.955 130.291 161.682 131.339 161.139C133.811 159.858 136.2 158.424 138.493 156.845C139.465 156.176 140.802 156.376 141.502 157.326V157.326Z"
                    fill="#141414" fill-opacity="0.16" id="itemRight" />
            </svg>
        </div>
    </div>

    <div class="px-6">
        <div
            class="px-4 bg-p2 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p2 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p2 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
            <div class="text-white font-semibold !leading-none pl-2">
                <p class="">Invite Friends</p>
                <p class="text-[36px] py-2 pl-2">$80</p>
                <p class="pl-7">Earn Up To</p>
            </div>
            <div class="">
                <img src="{{ asset('frontAssets/images/invite_illus.png') }}" alt="" />
            </div>
        </div>
    </div>

    {{-- <div class="container mx-auto py-10">

        <div class="coin-selector">
            @foreach ($priceData as $coinId => $coinInfo)
                <img src="{{ $coinInfo['image'] }}" alt="{{ strtoupper($coinId) }}"
                    class="coin-icon {{ $loop->first ? 'active' : '' }}" data-coin="{{ $coinId }}"
                    data-usd="{{ $coinInfo['usd'] }}" data-change="{{ $coinInfo['usd_24h_change'] }}"
                    data-sparkline="{{ json_encode($coinInfo['sparkline']) }}">
            @endforeach
        </div>

        <div class="price-info">
            @php $first = array_key_first($priceData); @endphp
            <h3 id="coinName">{{ strtoupper($first) }}</h3>
            <p>
                <span id="coinPrice" class="font-bold text-2xl">${{ number_format($priceData[$first]['usd'], 2) }}</span>
                <span id="coinChange"
                    class="{{ $priceData[$first]['usd_24h_change'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($priceData[$first]['usd_24h_change'], 2) }}%
                </span>
            </p>
        </div>

        <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-lg">
            <canvas id="cryptoChart"></canvas>
        </div>
    </div> --}}
@endsection

@section('script')
    <script src="{{ asset('frontAssets/js/plugins/circle-slider.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('cryptoChart').getContext('2d');
            const defaultCoin = document.querySelector('.coin-icon.active');
            const sparkline = JSON.parse(defaultCoin.dataset.sparkline);
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array.from({
                        length: sparkline.length
                    }, (_, i) => `Day ${i+1}`),
                    datasets: [{
                        label: `${defaultCoin.dataset.coin.toUpperCase()} Price (USD)`,
                        data: sparkline,
                        borderColor: '#3b82f6',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointRadius: 0,
                        fill: true,
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: {
                                color: 'rgba(200,200,200,0.1)'
                            },
                            ticks: {
                                color: '#888'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#888'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#111',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 10,
                            displayColors: false,
                        }
                    }
                }
            });

            document.querySelectorAll('.coin-icon').forEach(icon => {
                icon.addEventListener('click', () => {
                    document.querySelectorAll('.coin-icon').forEach(i => i.classList.remove(
                        'active'));
                    icon.classList.add('active');

                    const coin = icon.dataset.coin;
                    const spark = JSON.parse(icon.dataset.sparkline);
                    // Format price with commas
                    const usd = new Intl.NumberFormat('en-US', {
                        style: 'decimal',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(parseFloat(icon.dataset.usd));
                    const change = parseFloat(icon.dataset.change).toFixed(2);

                    document.getElementById('coinName').innerText = coin.toUpperCase();
                    document.getElementById('coinPrice').innerText = `$${usd}`;
                    const changeEl = document.getElementById('coinChange');
                    changeEl.innerText = `${change}%`;
                    changeEl.className = change >= 0 ? 'text-green-600' : 'text-red-600';

                    chart.data.datasets[0].data = spark;
                    chart.data.datasets[0].label = `${coin.toUpperCase()} Price (USD)`;
                    chart.update();
                });
            });
        });
    </script> --}}
@endsection
