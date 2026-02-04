<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home()
    {
        try {
            return view('frontend.pages.home');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading home page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function cryptoData()
    {
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

        return Cache::remember('crypto_data_main', 3600, function () use ($coins) {

            $data = [];

            foreach ($coins as $coinId => $info) {

                try {
                    /* ================= BINANCE PRICE ================= */
                    $priceRes = Http::get('https://api.binance.com/api/v3/ticker/price', [
                        'symbol' => $info['symbol']
                    ]);

                    if (!$priceRes->ok()) {
                        $fallback = $this->coincapFallback($coinId, $info['image']);
                        if ($fallback) {
                            $data[$coinId] = $fallback;
                        }
                        continue;
                    }

                    $price = (float) ($priceRes['price'] ?? 0);

                    /* ================= BINANCE 24H CHANGE ================= */
                    $tickerRes = Http::get('https://api.binance.com/api/v3/ticker/24hr', [
                        'symbol' => $info['symbol']
                    ]);

                    $change24 = $tickerRes->ok()
                        ? (float) ($tickerRes['priceChangePercent'] ?? 0)
                        : 0;

                    /* ================= 7 DAY SPARKLINE ================= */
                    $klinesRes = Http::get('https://api.binance.com/api/v3/klines', [
                        'symbol' => $info['symbol'],
                        'interval' => '1d',
                        'limit' => 7,
                    ]);

                    $sparkline = [];
                    if ($klinesRes->ok()) {
                        foreach ($klinesRes->json() as $k) {
                            if (isset($k[4])) {
                                $sparkline[] = (float) $k[4];
                            }
                        }
                    }

                    $data[$coinId] = [
                        'usd' => $price,
                        'usd_24h_change' => $change24,
                        'sparkline' => $sparkline ?: [0],
                        'image' => $info['image'],
                    ];
                } catch (\Throwable $e) {
                    Log::warning("Crypto error ({$coinId}): " . $e->getMessage());
                }
            }

            return $data;
        });
    }

    private function coincapFallback(string $coinId, string $image)
    {
        try {
            $assetRes = Http::get("https://api.coincap.io/v2/assets/{$coinId}");
            if (!$assetRes->ok()) return null;

            $asset = $assetRes->json('data');

            $historyRes = Http::get("https://api.coincap.io/v2/assets/{$coinId}/history", [
                'interval' => 'd1',
                'start' => now()->subDays(7)->startOfDay()->valueOf(),
                'end' => now()->valueOf(),
            ]);

            $spark = [];
            foreach ($historyRes->json('data') ?? [] as $h) {
                if (isset($h['priceUsd'])) {
                    $spark[] = (float) $h['priceUsd'];
                }
            }

            return [
                'usd' => (float) ($asset['priceUsd'] ?? 0),
                'usd_24h_change' => (float) ($asset['changePercent24Hr'] ?? 0),
                'sparkline' => $spark ?: [0],
                'image' => $image,
            ];
        } catch (\Throwable $e) {
            Log::warning("CoinCap fallback failed ({$coinId}): " . $e->getMessage());
            return null;
        }
    }

    public function shareEarn()
    {
        try {
            $user = Auth::user();
            $reffralBonus = Helper::getReferralBonus();
            $refrrals = User::with('profile:id,user_id,profile_image')->where('inviter_id', $user->id)->get();
            return view('frontend.pages.share-and-earn', compact('reffralBonus', 'refrrals'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading share-and-earn page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }

    public function faqs()
    {
        try {
            $faqs = Faq::where('status', 'active')->get();
            return view('frontend.pages.faqs', compact('faqs'));
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

    public function transactions()
    {
        try {
            $transactions = Transaction::where('user_id', auth()->id())
                ->latest()
                ->paginate(6);
            return view('frontend.pages.transactions', compact('transactions'));
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error loading transactions page: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the home page.');
        }
    }
}
