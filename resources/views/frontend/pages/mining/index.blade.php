@extends('frontend.layouts.share.master')

@section('title', 'Mining Dashboard')

@section('css')
<style>
/* ================= MOBILE-FIRST GLOBAL STYLES ================= */
:root {
    --primary-color: #111827;
    --success-color: #10b981;
    --info-color: #3b82f6;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --border-color: #e5e7eb;
    --bg-light: #f9fafb;
    --bg-white: #ffffff;
    --text-primary: #111827;
    --text-secondary: #6b7280;
    --text-muted: #9ca3af;
    --radius-sm: 8px;
    --radius-md: 12px;
}

body {
    font-size: 14px;
    line-height: 1.5;
}

.section-box {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    padding: 16px;
    margin-bottom: 20px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--bg-light);
}

.section-title i {
    color: var(--primary-color);
    font-size: 16px;
}

/* ================= STATS OVERVIEW ================= */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

.stat-card {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    padding: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.stat-icon.earning { background: #d1fae5; color: var(--success-color); }
.stat-icon.active { background: #dbeafe; color: var(--info-color); }
.stat-icon.total { background: #fef3c7; color: var(--warning-color); }
.stat-icon.power { background: #ede9fe; color: #8b5cf6; }

.stat-content {
    flex: 1;
    min-width: 0;
}

.stat-value {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.stat-label {
    font-size: 11px;
    color: var(--text-secondary);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

/* ================= USER MININGS ================= */
.user-mining-row {
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-sm);
    padding: 14px;
    margin-bottom: 10px;
}

.user-mining-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.user-mining-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color) 0%, #374151 100%);
    color: var(--bg-white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.user-mining-info {
    flex: 1;
    min-width: 0;
}

.user-mining-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 2px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-mining-status {
    font-size: 10px;
    padding: 3px 8px;
    border-radius: 10px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-running { background: #d1fae5; color: var(--success-color); }
.status-completed { background: #dbeafe; color: var(--info-color); }
.status-pending { background: #fef3c7; color: var(--warning-color); }
.status-cancelled { background: #fee2e2; color: var(--danger-color); }

.user-mining-meta {
    font-size: 11px;
    color: var(--text-secondary);
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.user-mining-dates {
    font-size: 11px;
    color: var(--text-muted);
    margin-bottom: 10px;
}

/* Progress Bar */
.progress-container {
    background: #e5e7eb;
    height: 4px;
    border-radius: 2px;
    overflow: hidden;
    margin: 10px 0;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--success-color) 0%, #34d399 100%);
    border-radius: 2px;
}

.user-mining-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
}

.user-mining-amount {
    font-size: 14px;
    font-weight: 600;
    color: var(--success-color);
}

.user-mining-percentage {
    font-size: 11px;
    color: var(--text-secondary);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px 16px;
}

.empty-state i {
    font-size: 48px;
    color: #e5e7eb;
    margin-bottom: 16px;
}

.empty-state h4 {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 6px;
}

.empty-state p {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 16px;
}

/* ================= MACHINE CARDS ================= */
.machine-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.machine-card {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    padding: 16px;
    position: relative;
}

.popular-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    color: white;
    font-size: 10px;
    padding: 3px 10px;
    border-radius: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    z-index: 1;
}

/* Machine Header */
.machine-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.machine-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
    flex: 1;
    margin-right: 8px;
}

.machine-duration {
    font-size: 11px;
    color: var(--text-secondary);
    background: var(--bg-light);
    padding: 3px 8px;
    border-radius: var(--radius-sm);
    font-weight: 500;
    white-space: nowrap;
}

/* Machine Image */
.machine-image {
    width: 100%;
    height: 140px;
    border-radius: var(--radius-sm);
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    overflow: hidden;
}

.machine-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.machine-image i {
    font-size: 40px;
    color: var(--text-muted);
}

/* Machine Description */
.machine-description {
    font-size: 12px;
    color: var(--text-secondary);
    line-height: 1.4;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Machine Stats */
.machine-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 16px;
    padding: 14px;
    background: var(--bg-light);
    border-radius: var(--radius-sm);
}

.machine-stat {
    font-size: 11px;
    color: var(--text-secondary);
}

.machine-stat strong {
    display: block;
    font-size: 13px;
    color: var(--text-primary);
    font-weight: 600;
    margin-top: 2px;
}

.machine-stat i {
    margin-right: 4px;
    font-size: 12px;
}

/* Machine Footer */
.machine-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 1px solid var(--border-color);
}

.machine-price {
    font-size: 16px;
    font-weight: 600;
    color: var(--primary-color);
}

.buy-btn {
    background: var(--primary-color);
    color: var(--bg-white);
    padding: 10px 16px;
    border-radius: var(--radius-sm);
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    text-decoration: none;
}

.buy-btn:hover {
    background: #000000;
}

/* ================= INSTRUCTIONS ================= */
.instructions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.instruction-step {
    text-align: center;
    padding: 14px;
}

.instruction-icon {
    width: 44px;
    height: 44px;
    background: var(--bg-light);
    color: var(--primary-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 20px;
}

.step-title {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.step-description {
    font-size: 11px;
    color: var(--text-secondary);
    line-height: 1.3;
}

/* ================= UTILITY CLASSES ================= */
.text-xs {
    font-size: 10px;
}

.text-sm {
    font-size: 12px;
}

.text-md {
    font-size: 13px;
}

.text-lg {
    font-size: 14px;
}

.font-semibold {
    font-weight: 600;
}

.font-bold {
    font-weight: 700;
}

.text-center {
    text-align: center;
}

.mb-1 {
    margin-bottom: 4px;
}

.mb-2 {
    margin-bottom: 8px;
}

.mb-3 {
    margin-bottom: 12px;
}

.mt-1 {
    margin-top: 4px;
}

.mt-2 {
    margin-top: 8px;
}

.p-2 {
    padding: 8px;
}

.p-3 {
    padding: 12px;
}

/* ================= LOADING STATES ================= */
.loading-skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
    border-radius: var(--radius-sm);
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* ================= SCROLLBAR ================= */
::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}

::-webkit-scrollbar-track {
    background: var(--bg-light);
}

::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 2px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-muted);
}
</style>
@endsection

@section('content')

{{-- ================= STATS OVERVIEW ================= --}}
<div class="section-box" style="margin-top: 30px;">
    <div class="section-title">
        <i class="ph ph-gauge"></i>
        Mining Overview
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon earning">
                <i class="ph ph-currency-circle-dollar"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ number_format($totalEarnings ?? 0, 4) }}</div>
                <div class="stat-label">Earnings</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon active">
                <i class="ph ph-cpu"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $activeMinings ?? 0 }}</div>
                <div class="stat-label">Active</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon total">
                <i class="ph ph-hard-drives"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalMachines ?? 0 }}</div>
                <div class="stat-label">Machines</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon power">
                <i class="ph ph-lightning"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalPower ?? '0' }}</div>
                <div class="stat-label">Power</div>
            </div>
        </div>
    </div>
</div>

{{-- ================= USER MININGS ================= --}}
<div class="section-box">
    <div class="section-title">
        <i class="ph ph-mining"></i>
        My Mining
    </div>

    @if($userMinings->count())
        <div>
            @foreach($userMinings as $mining)
                @php
                    $progress = $mining->progress ?? 0;
                    $remainingDays = $mining->remaining_days ?? 0;
                    $startDate = \Carbon\Carbon::parse($mining->start_date);
                    $endDate = \Carbon\Carbon::parse($mining->end_date);
                @endphp

                <div class="user-mining-row">
                    <div class="user-mining-header">
                        <div class="user-mining-icon">
                            <i class="ph ph-pickaxe"></i>
                        </div>
                        <div class="user-mining-info">
                            <div class="user-mining-name">
                                {{ Str::limit($mining->miningMachine->name ?? 'Mining Machine', 20) }}
                                <span class="user-mining-status status-{{ $mining->status }}">
                                    {{ ucfirst($mining->status) }}
                                </span>
                            </div>
                            <div class="user-mining-meta">
                                <span>ID: {{ $mining->id }}</span>
                                <span>•</span>
                                <span>{{ $mining->power ?? '0' }} TH/s</span>
                            </div>
                        </div>
                    </div>

                    <div class="user-mining-dates">
                        <i class="ph ph-calendar text-xs"></i>
                        {{ $startDate->format('M d') }} - {{ $endDate->format('M d, Y') }}
                    </div>

                    @if($mining->status == 'running')
                        <div class="progress-container">
                            <div class="progress-bar" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="user-mining-meta">
                            <span class="text-xs">{{ round($progress) }}% complete</span>
                            <span class="text-xs">•</span>
                            <span class="text-xs">{{ $remainingDays }}d left</span>
                        </div>
                    @endif

                    <div class="user-mining-footer">
                        <div class="user-mining-amount">
                            {{ number_format($mining->total_earned, 6) }}
                            <span class="text-xs text-muted">BTC</span>
                        </div>
                        @if($progress > 0)
                            <div class="user-mining-percentage">
                                {{ round($progress) }}%
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="ph ph-hard-drives"></i>
            <h4>No Active Mining</h4>
            <p>Purchase a machine to start mining</p>
        </div>
    @endif
</div>

{{-- ================= AVAILABLE MACHINES ================= --}}
<div class="section-box" id="machines">
    <div class="section-title">
        <i class="ph ph-storefront"></i>
        Mining Machines
    </div>

    @if($miningMachines->count())
        <div class="machine-list">
            @foreach($miningMachines as $machine)
                @php
                    $isPopular = $machine->is_popular ?? false;
                    $dailyReward = number_format($machine->daily_reward, 6);
                    $totalReward = number_format($machine->total_reward, 6);
                @endphp

                <div class="machine-card">
                    @if($isPopular)
                        <span class="popular-badge">Popular</span>
                    @endif

                    <div class="machine-header">
                        <div class="machine-name">{{ Str::limit($machine->name, 30) }}</div>
                        <span class="machine-duration">{{ $machine->duration_days }}d</span>
                    </div>

                    @if($machine->image)
                        <div class="machine-image">
                            <img src="{{ asset('storage/' . $machine->image) }}" alt="{{ $machine->name }}">
                        </div>
                    @endif

                    <p class="machine-description">
                        {{ Str::limit($machine->description ?? 'High performance mining machine', 80) }}
                    </p>

                    <div class="machine-stats">
                        <div class="machine-stat">
                            <i class="ph ph-currency-circle-dollar"></i>
                            Daily
                            <strong>{{ $dailyReward }}</strong>
                        </div>
                        <div class="machine-stat">
                            <i class="ph ph-trophy"></i>
                            Total
                            <strong>{{ $totalReward }}</strong>
                        </div>
                        <div class="machine-stat">
                            <i class="ph ph-lightning"></i>
                            Power
                            <strong>{{ $machine->power ?? '—' }}</strong>
                        </div>
                        <div class="machine-stat">
                            <i class="ph ph-gauge"></i>
                            Eff.
                            <strong>{{ $machine->efficiency ?? 'High' }}</strong>
                        </div>
                    </div>

                    <div class="machine-footer">
                        <div class="machine-price">
                            {{ \App\Helpers\Helper::formatCurrency($machine->price) }}
                        </div>
                        <a href="{{ route('frontend.mining.show', $machine->slug) }}" class="buy-btn">
                            <i class="ph ph-shopping-cart"></i>
                            Buy
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="ph ph-cpu"></i>
            <h4>No Machines</h4>
            <p>Machines will be available soon</p>
        </div>
    @endif
</div>

{{-- ================= INSTRUCTIONS ================= --}}
<div class="section-box">
    <div class="section-title">
        <i class="ph ph-info"></i>
        How It Works
    </div>

    <div class="instructions-grid">
        <div class="instruction-step">
            <div class="instruction-icon">
                <i class="ph ph-shopping-cart"></i>
            </div>
            <div class="step-title">Buy Machine</div>
            <p class="step-description">Select & purchase mining machine</p>
        </div>

        <div class="instruction-step">
            <div class="instruction-icon">
                <i class="ph ph-play-circle"></i>
            </div>
            <div class="step-title">Start Mining</div>
            <p class="step-description">Mining begins immediately</p>
        </div>

        <div class="instruction-step">
            <div class="instruction-icon">
                <i class="ph ph-currency-circle-dollar"></i>
            </div>
            <div class="step-title">Earn Rewards</div>
            <p class="step-description">Get daily mining rewards</p>
        </div>

        <div class="instruction-step">
            <div class="instruction-icon">
                <i class="ph ph-repeat"></i>
            </div>
            <div class="step-title">Repeat</div>
            <p class="step-description">Expand your mining farm</p>
        </div>
    </div>
</div>

@endsection
