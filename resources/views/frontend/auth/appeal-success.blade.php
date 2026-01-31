@extends('frontend.layouts.auth.master')

@section('title', 'Appeal Submitted')

@section('css')
<style>
    .success-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 36px;
        border: 1px solid #e5e7eb;
        max-width: 520px;
        margin: 0 auto;
        text-align: center;
    }

    .success-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #dcfce7;
        color: #15803d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        margin: 0 auto 18px;
    }

    .success-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #111827;
    }

    .success-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .info-box {
        background: #f9fafb;
        border: 1px dashed #e5e7eb;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 24px;
        text-align: left;
    }

    .info-item {
        display: flex;
        gap: 10px;
        font-size: 13px;
        color: #374151;
        margin-bottom: 10px;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-item i {
        color: #f59e0b;
        margin-top: 2px;
    }

    .success-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .btn-secondary {
        flex: 1;
        background: #f3f4f6;
        color: #374151;
        border-radius: 14px;
        padding: 12px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
    }

    .btn-primary {
        flex: 1;
        background: #f59e0b;
        color: #ffffff;
        border-radius: 14px;
        padding: 12px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
    }

    .btn-primary:hover {
        background: #d97706;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }
</style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 relative">
    <div class="success-card">

        {{-- Success Icon --}}
        <div class="success-icon">
            <i class="ph ph-check-circle"></i>
        </div>

        {{-- Title --}}
        <h2 class="success-title">Appeal Submitted Successfully</h2>

        {{-- Subtitle --}}
        <p class="success-subtitle">
            Thank you for submitting your appeal. Our compliance team will carefully review your request.
        </p>

        {{-- Info Box --}}
        <div class="info-box">

            <div class="info-item">
                <i class="ph ph-clock"></i>
                <span>
                    Review usually takes <strong>3–5 business days</strong>.
                </span>
            </div>

            <div class="info-item">
                <i class="ph ph-envelope-simple"></i>
                <span>
                    You will be notified via email once a decision is made.
                </span>
            </div>

            <div class="info-item">
                <i class="ph ph-shield-warning"></i>
                <span>
                    Your account remains restricted during the review period.
                </span>
            </div>

        </div>

        {{-- Footer Note --}}
        <p class="text-xs text-color5 mb-4">
            Please do not submit multiple appeals for the same issue, as this may delay the review process.
        </p>

        {{-- Actions --}}
        <div class="success-actions">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="btn-secondary">
                Logout
            </a>

            <a href="{{ url('/') }}" class="btn-primary">
                Go Back
            </a>
        </div>

        {{-- Logout form --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

    </div>
</div>

@endsection

@section('script')
@endsection
