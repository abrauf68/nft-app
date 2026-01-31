@extends('frontend.layouts.share.master')

@section('title', 'Withdraw Preview')

@section('css')
<style>
    .invoice-container {
        margin: 30px auto;
        max-width: 700px;
        background: #fff;
        border-radius: 12px;
        padding: 25px 30px;
        border: 1px solid #e5e7eb;
        font-size: 0.875rem; /* smaller font for professional look */
        color: #374151;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 10px;
    }

    .invoice-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        color: #111827;
    }

    .invoice-section {
        margin-top: 15px;
    }

    .invoice-section h3 {
        font-weight: 600;
        margin-bottom: 8px;
        color: #f59e0b;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .invoice-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dashed #e5e7eb;
    }

    .invoice-item:last-child {
        border-bottom: none;
    }

    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-pending { background-color: #fef3c7; color: #b45309; }
    .status-approved { background-color: #dcfce7; color: #15803d; }
    .status-rejected { background-color: #fee2e2; color: #b91c1c; }

    .text-label {
        font-weight: 500;
        color: #374151;
    }

    /* PH icons color */
    .ph-icon {
        color: #f59e0b;
        font-size: 1rem;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .invoice-container {
            padding: 20px 15px;
        }
        .invoice-header h2 {
            font-size: 1.1rem;
        }
        .invoice-section h3 {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<div class="invoice-container">
    {{-- Header --}}
    <div class="invoice-header">
        <h2><i class="ph ph-receipt ph-icon"></i> Preview</h2>
        <span class="text-color5">{{ $withdraw->created_at->format('d M Y, h:i A') }}</span>
    </div>

    {{-- User Info --}}
    <div class="invoice-section">
        <h3><i class="ph ph-user ph-icon"></i> User Information</h3>
        <div class="invoice-item">
            <span class="text-label">Username</span>
            <span>{{ '@'.$withdraw->user->username }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Email</span>
            <span>{{ $withdraw->user->email }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Wallet Balance</span>
            <span>{{ \App\Helpers\Helper::formatCurrency($withdraw->user->wallet->balance ?? 0) }}</span>
        </div>
    </div>

    {{-- Transaction Details --}}
    <div class="invoice-section">
        <h3><i class="ph ph-currency-dollar ph-icon"></i> Transaction Details</h3>
        <div class="invoice-item">
            <span class="text-label">Transaction ID</span>
            <span>{{ $withdraw->transaction->transaction_id }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Amount</span>
            <span>{{ \App\Helpers\Helper::formatCurrency($withdraw->amount) }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Crypto / Wallet</span>
            <span>{{ $withdraw->crypto }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Wallet Address</span>
            <span>{{ $withdraw->wallet_address }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">User Note</span>
            <span>{{ $withdraw->user_note ?? 'N/A' }}</span>
        </div>
        <div class="invoice-item">
            <span class="text-label">Status</span>
            <span class="status-badge
                {{ $withdraw->status == 'pending' ? 'status-pending' : '' }}
                {{ $withdraw->status == 'approved' ? 'status-approved' : '' }}
                {{ $withdraw->status == 'rejected' ? 'status-rejected' : '' }}">
                {{ ucfirst($withdraw->status) }}
            </span>
        </div>
    </div>

    {{-- Admin Notes --}}
    @if($withdraw->admin_note)
    <div class="invoice-section">
        <h3><i class="ph ph-note ph-icon"></i> Admin Notes</h3>
        <div class="invoice-item">
            <span>{{ $withdraw->admin_note }}</span>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
@endsection
