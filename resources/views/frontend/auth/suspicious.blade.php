@extends('frontend.layouts.auth.master')

@section('title', 'Suspicious Account')

@section('css')
    <style>
        body {
            background-color: #fef2f2; /* light red background for alert */
        }

        .suspicious-container {
            z-index: 1000;
            max-width: 480px;
            margin: 80px auto;
            background-color: #fff;
            border-radius: 16px;
            padding: 40px 30px;
            border: 2px solid #f87171;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .suspicious-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background-color: #fee2e2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            color: #b91c1c;
            font-size: 36px;
            border: 2px solid #f87171;
        }

        .suspicious-container h2 {
            font-size: 1.75rem;
            color: #b91c1c;
            margin-bottom: 12px;
        }

        .suspicious-container p {
            color: #7f1d1d;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .suspicious-container .alert-info {
            font-size: 0.875rem;
            color: #b91c1c;
            margin-bottom: 30px;
        }

        .suspicious-container .btn {
            padding: 10px 22px;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 5px;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-logout {
            background-color: #f87171;
            color: white;
            border: 1px solid #f87171;
        }

        .btn-logout:hover {
            background-color: #b91c1c;
            border-color: #b91c1c;
        }

        .btn-appeal {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #f87171;
        }

        .btn-appeal:hover {
            background-color: #f87171;
            color: white;
        }

        @media (max-width: 500px) {
            .suspicious-container {
                padding: 30px 20px;
            }

            .suspicious-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .suspicious-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <div class="suspicious-container gap-4 relative z-10">
        <div class="suspicious-icon">
            <i class="ph ph-warning"></i>
        </div>
        <h2>Suspicious Activity Detected</h2>
        <p>We've detected unusual or potentially illegal activity in your account. To protect your account, access has been restricted.</p>
        <p class="alert-info">Your account will be permanently removed within <strong>10 days</strong> if no action is taken.</p>

        <div>
            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-logout">
                Logout
            </a>
            <a href="{{ route('appeal') }}" class="btn btn-appeal">Submit Appeal</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
