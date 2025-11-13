<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // public function home()
    // {
    //     try {
    //         return view('frontend.pages.home');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         Log::error('Error loading home page: ' . $th->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred while loading the home page.');
    //     }
    // }

    public function home()
    {
        try {
            // map coins to exchange symbols (Binance)
            $coins = [
                'bitcoin' => [
                    'symbol' => 'BTCUSDT',
                    'image' => 'https://assets.coincap.io/assets/icons/btc@2x.png',
                ],
                'ethereum' => [
                    'symbol' => 'ETHUSDT',
                    'image' => 'https://assets.coincap.io/assets/icons/eth@2x.png',
                ],
                'solana' => [
                    'symbol' => 'SOLUSDT',
                    'image' => 'https://assets.coincap.io/assets/icons/sol@2x.png',
                ],
                'binancecoin' => [
                    'symbol' => 'BNBUSDT',
                    'image' => 'https://assets.coincap.io/assets/icons/bnb@2x.png',
                ],
            ];

            $priceData = Cache::remember('crypto_data_binance', 60, function () use ($coins) {
                $data = [];
                foreach ($coins as $id => $info) {
                    $symbol = $info['symbol'];

                    // Binance price call...
                    $priceRes = Http::get("https://api.binance.com/api/v3/ticker/price", [
                        'symbol' => $symbol,
                    ]);

                    if (!$priceRes->ok()) {
                        Log::warning("Binance price failed for {$symbol} ({$id})");
                        $fallback = $this->coincapPriceFallback($id);
                        if ($fallback === null) continue;
                        $data[$id] = array_merge($fallback, ['image' => $info['image']]);
                        continue;
                    }

                    $priceJson = $priceRes->json();
                    $price = isset($priceJson['price']) ? (float)$priceJson['price'] : null;

                    // 24h ticker
                    $tickerRes = Http::get("https://api.binance.com/api/v3/ticker/24hr", [
                        'symbol' => $symbol,
                    ]);
                    $change24 = $tickerRes->ok() ? (float)($tickerRes['priceChangePercent'] ?? 0) : 0;

                    // 7-day sparkline
                    $klinesRes = Http::get("https://api.binance.com/api/v3/klines", [
                        'symbol' => $symbol,
                        'interval' => '1d',
                        'limit' => 7,
                    ]);

                    $sparkline = [];
                    if ($klinesRes->ok()) {
                        foreach ($klinesRes->json() as $k) {
                            if (isset($k[4])) $sparkline[] = (float)$k[4];
                        }
                    }

                    $data[$id] = [
                        'usd' => $price,
                        'usd_24h_change' => $change24,
                        'sparkline' => $sparkline,
                        'image' => $info['image'],
                    ];
                }
                return $data;
            }); // end cache

            if (empty($priceData)) {
                return redirect()->back()->with('error', 'Could not fetch crypto data right now. Try again soon.');
            }

            return view('frontend.pages.home', compact('priceData'));
        } catch (\Throwable $th) {
            Log::error('Error loading home page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    /**
     * Simple CoinCap fallback for price + 24h change + 7-day history.
     * Returns array or null on failure.
     */
    private function coincapPriceFallback(string $coinId)
    {
        try {
            // CoinCap asset id names: bitcoin, ethereum, solana, binancecoin
            $assetRes = Http::get("https://api.coincap.io/v2/assets/{$coinId}");
            if (!$assetRes->ok()) return null;
            $asset = $assetRes->json('data');

            $price = isset($asset['priceUsd']) ? (float)$asset['priceUsd'] : null;
            $change24 = isset($asset['changePercent24Hr']) ? (float)$asset['changePercent24Hr'] : 0;

            // history for 7 days (interval = d1)
            $historyRes = Http::get("https://api.coincap.io/v2/assets/{$coinId}/history", [
                'interval' => 'd1',
                'start' => now()->subDays(7)->startOfDay()->valueOf(), // JS ms
                'end' => now()->valueOf(),
            ]);

            $sparkline = [];
            if ($historyRes->ok()) {
                $hist = $historyRes->json('data');
                if (is_array($hist)) {
                    foreach ($hist as $h) {
                        if (isset($h['priceUsd'])) $sparkline[] = (float)$h['priceUsd'];
                    }
                }
            }

            return [
                'usd' => $price,
                'usd_24h_change' => $change24,
                'sparkline' => $sparkline,
            ];
        } catch (\Throwable $e) {
            Log::warning("CoinCap fallback failed for {$coinId}: " . $e->getMessage());
            return null;
        }
    }

    public function shareEarn()
    {
        try {
            return view('frontend.pages.share-and-earn');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading share-and-earn page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function faqs()
    {
        try {
            return view('frontend.pages.faqs');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading faqs page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function contact()
    {
        try {
            return view('frontend.pages.contact');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading contact page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
}
