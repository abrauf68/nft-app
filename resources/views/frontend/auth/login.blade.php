@extends('frontend.layouts.master')

@section('title', 'Home')

@section('css')
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
    <main class="main login-page">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->
        <div class="page-content">
            <div class="container">
                <div class="login-popup">
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        <ul class="nav nav-tabs text-uppercase" role="tablist">
                            <li class="nav-item">
                                <a href="#sign-in" class="nav-link active">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a href="#sign-up" class="nav-link">Sign Up</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="sign-in">
                                <form action="{{ route('login.attempt') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Username or email address *</label>
                                        <input type="text" class="form-control" name="email_username" id="email_username"
                                            required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1">
                                        <label for="remember1">Remember me</label>
                                        <a href="#">Forget your password?</a>
                                    </div>
                                    <button class="btn btn-primary w-100">Sign In</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="sign-up">
                                <form action="{{ route('register.attempt') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"  placeholder="{{ __('Enter your name') }}" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email <span style="color: red;">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Your Password <span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Repeat Password <span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="confirm_password"
                                            id="confirm_password" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Transaction Password <span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="transaction_password"
                                            id="transaction_password" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Repeat Transaction Password <span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="confirm_transaction_password"
                                            id="confirm_transaction_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Shop Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="shop_name" id="shop_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Certificate Type <span style="color: red;">*</span></label>
                                        <select class="form-control" name="certificate_type" id="certificate_type" required>
                                            <option value="" selected disabled>Select Certificate Type</option>
                                            <option value="id">ID</option>
                                            <option value="aadhar_card">Aadhar Card</option>
                                            <option value="passport">Passport</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Certificate Front <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="certificate_front"
                                            id="certificate_front" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Certificate Back <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="certificate_back"
                                            id="certificate_back" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Invitation Code <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="invitation_code"
                                            id="invitation_code" required>
                                    </div>
                                    <p>Your personal data will be used to support your experience
                                        throughout this website, to manage access to your account,
                                        and for other purposes described in our <a href="#"
                                            class="text-primary">privacy
                                            policy</a>.</p>
                                    {{-- <a href="#" class="d-block mb-5 text-primary">Signup as a vendor?</a> --}}
                                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                        <input type="checkbox" class="custom-checkbox" id="terms" name="terms"
                                            required="">
                                        <label for="terms" class="font-size-md">I agree to the <a href="#"
                                                class="text-primary font-size-md">privacy policy</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                </form>
                            </div>
                        </div>
                        {{-- <p class="text-center">Sign in with social account</p>
                        <div class="social-icons social-icon-border-color d-flex justify-content-center">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-google fab fa-google"></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@endsection
