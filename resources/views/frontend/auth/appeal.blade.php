@extends('frontend.layouts.auth.master')

@section('title', 'Submit Appeal')

@section('css')
<style>
    .appeal-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        border: 1px solid #e5e7eb;
        max-width: 520px;
        margin: 0 auto;
    }

    .appeal-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 16px;
    }

    .appeal-title {
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .appeal-subtitle {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #374151;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 10px 12px;
        font-size: 13px;
        outline: none;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.15);
    }

    .form-textarea {
        resize: none;
        min-height: 120px;
    }

    .appeal-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .btn-secondary {
        flex: 1;
        background: #f3f4f6;
        color: #374151;
        border-radius: 12px;
        padding: 12px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
    }

    .btn-primary {
        flex: 1;
        background: #f59e0b;
        color: #ffffff;
        border-radius: 12px;
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

<div class="min-h-screen flex items-center justify-center px-4 gap-4 relative z-10">
    <div class="appeal-card">

        {{-- Icon --}}
        <div class="appeal-icon">
            <i class="ph ph-warning-octagon"></i>
        </div>

        {{-- Title --}}
        <h2 class="appeal-title">Submit an Appeal</h2>
        <p class="appeal-subtitle">
            If you believe your account was incorrectly flagged, you may submit an appeal for review.
        </p>

        {{-- Appeal Form --}}
        <form method="POST" action="{{ route('appeal.submit') }}">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text"
                       name="name"
                       class="form-input"
                       placeholder="Enter your full name"
                       value="{{ auth()->user()->name ?? '' }}"
                       required>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email"
                       name="email"
                       class="form-input"
                       placeholder="Enter your email"
                       value="{{ auth()->user()->email ?? '' }}"
                       required>
            </div>

            {{-- Appeal Type --}}
            <div class="form-group">
                <label class="form-label">Appeal Type</label>
                <select name="appeal_type" class="form-select" required>
                    <option value="">Select appeal reason</option>
                    <option value="false_positive">Account wrongly flagged</option>
                    <option value="activity_review">Explain my activity</option>
                    <option value="verification_issue">Verification issue</option>
                    <option value="other">Other</option>
                </select>
            </div>

            {{-- Message --}}
            <div class="form-group">
                <label class="form-label">Your Message</label>
                <textarea name="message"
                          class="form-textarea"
                          placeholder="Explain your situation clearly and honestly..."
                          required></textarea>
            </div>

            {{-- Actions --}}
            <div class="appeal-actions">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn-secondary">
                    Logout
                </a>

                <button type="submit" class="btn-primary">
                    Submit Appeal
                </button>
            </div>

        </form>

        {{-- Logout form --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

    </div>
</div>

@endsection

@section('script')
@endsection
