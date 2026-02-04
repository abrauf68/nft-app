@extends('frontend.layouts.share.master')

@section('title', $miningMachine->name)

@section('css')
    <style>
        /* ================= MINING DETAILS PAGE ================= */
        .mining-detail-page {
            background: var(--bg-light);
            min-height: 100vh;
        }

        /* Header */
        .detail-header {
            background: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            padding: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            flex-shrink: 0;
        }

        .back-btn:hover {
            background: var(--border-color);
        }

        .header-info {
            flex: 1;
            min-width: 0;
        }

        .machine-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .machine-id {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Price Banner */
        .price-banner {
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
            color: white;
            padding: 20px 16px;
            margin-bottom: 16px;
        }

        .price-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .price-amount {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .buy-button {
            width: 100%;
            background: white;
            color: #111827;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .buy-button:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* Main Content */
        .content-section {
            background: var(--bg-white);
            border-radius: 12px;
            margin: 0 16px 16px;
            overflow: hidden;
        }

        .section-header {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #111827;
            font-size: 16px;
        }

        .section-content {
            padding: 16px;
        }

        /* Image Section */
        .machine-image {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .machine-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .machine-image i {
            font-size: 64px;
            color: var(--text-muted);
        }

        /* Key Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stat-card {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
        }

        .stat-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .stat-value.positive {
            color: var(--success-color);
        }

        /* Description */
        .description-content {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Earnings Calculator */
        .earnings-calc {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 16px;
        }

        .calc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .calc-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--info-color);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .calc-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .calc-item {
            background: white;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
        }

        .calc-period {
            font-size: 11px;
            color: var(--text-secondary);
            margin-bottom: 2px;
        }

        .calc-amount {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* ROI Section */
        .roi-section {
            background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%);
            border: 1px solid #fde047;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }

        .roi-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .roi-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .roi-note {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Machine Specifications */
        .specs-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--bg-light);
        }

        .spec-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .spec-label {
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .spec-label i {
            font-size: 14px;
            color: var(--primary-color);
        }

        .spec-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 10px;
            background: var(--success-color);
            color: white;
        }

        .status-badge.inactive {
            background: var(--danger-color);
        }

        /* Responsive */
        @media (min-width: 768px) {
            .mining-detail-page {
                max-width: 480px;
                margin: 0 auto;
            }

            .machine-image {
                height: 240px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .calc-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Overlay */
        .error-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        /* Modal box */
        .error-modal {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 24px;
            border-radius: 18px;
            margin: 40px;
            position: relative;
            animation: popupScale 0.25s ease-out;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        /* Close (X) */
        .error-close {
            position: absolute;
            top: 14px;
            right: 16px;
            border: none;
            background: transparent;
            font-size: 26px;
            cursor: pointer;
            color: #999;
        }

        .error-close:hover {
            color: #e11d48;
        }

        /* Header */
        .error-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .error-icon {
            width: 42px;
            height: 42px;
            background: #fee2e2;
            color: #dc2626;
            border-radius: 50%;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .error-header h3 {
            margin: 0;
            font-size: 20px;
            color: #dc2626;
        }

        /* Message */
        .error-message {
            font-size: 14px;
            color: #444;
            line-height: 1.6;
            margin: 12px 0 20px;
            text-align: center;
        }

        /* Footer */
        .error-footer {
            text-align: center;
        }

        .error-btn {
            background: #ff710f;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .error-btn:hover {
            background: #fdfdfd;
            border: 1px solid #ff710f;
            color: #ff710f;
        }

        /* Animation */
        @keyframes popupScale {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mining-detail-page">
        <div
            class="p-5 mt-8 bg-p1 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p1 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p1 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
            <div class="flex justify-start items-start gap-3">
                <div class="size-12 bg-white rounded-full flex justify-center items-center text-color9 text-xl">
                    <i class="ph ph-cpu"></i>
                </div>
                <div class="">
                    <p class="text-2xl font-semibold text-white">
                        {{ \App\Helpers\Helper::formatCurrency($miningMachine->price ?? 0) }}</p>
                    <p class="text-xs text-bgColor5">>Purchase Price</p>
                </div>
            </div>
            <a href="{{ route('frontend.mining.purchase', $miningMachine->slug) }}"
                class="bg-white text-color9 py-2 px-5 rounded-xl font-semibold text-xs">
                Purchase Machine
            </a>
        </div>

        <!-- Machine Image -->
        <div class="content-section" style="margin-top: 15px">
            <div class="section-content">
                <div class="machine-image">
                    @if ($miningMachine->image)
                        <img src="{{ asset('storage/' . $miningMachine->image) }}" alt="{{ $miningMachine->name }}">
                    @else
                        <i class="ph ph-cpu"></i>
                    @endif
                </div>
            </div>
        </div>

        <!-- Key Stats -->
        <div class="content-section">
            <div class="section-header">
                <div class="section-title">
                    <i class="ph ph-gauge"></i>
                    Machine Stats
                </div>
            </div>
            <div class="section-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Daily Reward</div>
                        <div class="stat-value positive">{{ number_format($miningMachine->daily_reward, 8) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Duration</div>
                        <div class="stat-value">{{ $miningMachine->duration_days }} days</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Total Reward</div>
                        <div class="stat-value positive">{{ number_format($miningMachine->total_reward, 8) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Power</div>
                        <div class="stat-value">{{ $miningMachine->power ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings Calculator -->
        <div class="content-section">
            <div class="section-header">
                <div class="section-title">
                    <i class="ph ph-calculator"></i>
                    Estimated Earnings
                </div>
            </div>
            <div class="section-content">
                <div class="earnings-calc">
                    <div class="calc-header">
                        <div class="calc-title">
                            <i class="ph ph-currency-circle-dollar"></i>
                            Projected Returns
                        </div>
                        <span class="text-xs" style="color: var(--text-muted);">Based on current rate</span>
                    </div>
                    <div class="calc-grid">
                        <div class="calc-item">
                            <div class="calc-period">Daily</div>
                            <div class="calc-amount">{{ number_format($miningMachine->daily_reward, 6) }}</div>
                        </div>
                        <div class="calc-item">
                            <div class="calc-period">Weekly</div>
                            <div class="calc-amount">{{ number_format($miningMachine->daily_reward * 7, 6) }}</div>
                        </div>
                        <div class="calc-item">
                            <div class="calc-period">Monthly</div>
                            <div class="calc-amount">{{ number_format($miningMachine->daily_reward * 30, 6) }}</div>
                        </div>
                        <div class="calc-item">
                            <div class="calc-period">Total</div>
                            <div class="calc-amount">{{ number_format($miningMachine->total_reward, 6) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROI Analysis -->
        <div class="content-section">
            <div class="section-header">
                <div class="section-title">
                    <i class="ph ph-trend-up"></i>
                    ROI Analysis
                </div>
            </div>
            <div class="section-content">
                <div class="roi-section">
                    <div class="roi-label">Return on Investment</div>
                    @php
                        $roiPercentage =
                            $miningMachine->price > 0
                                ? (($miningMachine->total_reward - $miningMachine->price) / $miningMachine->price) * 100
                                : 0;
                    @endphp
                    <div class="roi-value"
                        style="color: {{ $roiPercentage > 0 ? 'var(--success-color)' : 'var(--danger-color)' }};">
                        {{ number_format($roiPercentage, 2) }}%
                    </div>
                    <div class="roi-note">
                        Projected over {{ $miningMachine->duration_days }} days •
                        {{ $roiPercentage > 0 ? 'Positive' : 'Negative' }} ROI
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if ($miningMachine->description)
            <div class="content-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="ph ph-info"></i>
                        Description
                    </div>
                </div>
                <div class="section-content">
                    <div class="description-content">
                        {{ $miningMachine->description }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Specifications -->
        <div class="content-section">
            <div class="section-header">
                <div class="section-title">
                    <i class="ph ph-list-checks"></i>
                    Specifications
                </div>
            </div>
            <div class="section-content">
                <div class="specs-list">
                    <div class="spec-item">
                        <div class="spec-label">
                            <i class="ph ph-cpu"></i>
                            Machine Type
                        </div>
                        <div class="spec-value">ASIC Miner</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">
                            <i class="ph ph-lightning"></i>
                            Algorithm
                        </div>
                        <div class="spec-value">SHA-256</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">
                            <i class="ph ph-flashlight"></i>
                            Power Consumption
                        </div>
                        <div class="spec-value">3250W</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">
                            <i class="ph ph-shield-check"></i>
                            Warranty
                        </div>
                        <div class="spec-value">180 days</div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-label">
                            <i class="ph ph-clock"></i>
                            Maintenance
                        </div>
                        <div class="spec-value">Included</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Spacing -->
        <div style="height: 40px;"></div>

        @if (session('low_balance_error'))
            <div id="sessionErrorModal" class="error-overlay">
                <div class="error-modal">
                    <button class="error-close" onclick="closeErrorModal()">×</button>

                    <div class="error-header">
                        <div class="error-icon">!</div>
                        <h3>Error</h3>
                    </div>

                    <p class="error-message">
                        {{ session('low_balance_error') }}
                    </p>

                    <div class="error-footer">
                        <a href="{{ route('frontend.wallet.add') }}" class="error-btn">Add Money</a>
                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection

@section('script')
    <script>
        function closeErrorModal() {
            const modal = document.getElementById('sessionErrorModal');
            if (modal) {
                modal.style.opacity = '0';
                setTimeout(() => modal.remove(), 200);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {

            // Add subtle animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe sections for animation
            document.querySelectorAll('.content-section').forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                section.style.transitionDelay = (index * 0.1) + 's';
                observer.observe(section);
            });
        });
    </script>
@endsection
