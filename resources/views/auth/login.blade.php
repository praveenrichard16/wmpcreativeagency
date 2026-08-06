@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="auth-split-wrapper">
    <!-- Left Info Side -->
    <div class="auth-split-info">
        <div class="auth-glow-accent"></div>
        
        <!-- Logo Header -->
        <div style="z-index: 1;">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP Creative" class="logo-img">
            </a>
        </div>
        
        <!-- Marketing Copy -->
        <div class="my-auto py-4" style="max-width: 480px; z-index: 1;">
            <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Creative Assets Hub</span>
            <h1 class="display-5 mb-3" style="line-height: 1.15; font-weight: 800;">Get instant access to <span class="text-gradient-red">premium assets</span>.</h1>
            <p class="text-muted" style="line-height: 1.6; font-size: 0.95rem;">Log in to your client workspace to retrieve your purchased templates, access visual mockups, and download source code repositories from our creative team.</p>
            
            <div class="mt-4 pt-2">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; background: rgba(229, 57, 53, 0.08); border: 1px solid rgba(229, 57, 53, 0.15);">
                        <i class="bi bi-download text-danger"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Unlimited Downloads</h6>
                        <small class="text-muted">Grab your templates, vector illustrations, and themes anytime</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; background: rgba(255, 193, 7, 0.12); border: 1px solid rgba(255, 193, 7, 0.25);">
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Exclusive Lifetime Updates</h6>
                        <small class="text-muted">Receive regular product improvements at no extra cost</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer info -->
        <div class="text-muted small" style="z-index: 1;">
            &copy; {{ date('Y') }} WMP Creative Agency. All rights reserved.
        </div>
    </div>

    <!-- Right Form Side -->
    <div class="auth-split-form">
        <div class="w-100" style="max-width: 400px; z-index: 1;">
            
            <!-- Alert Notifications -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 mb-4" role="alert" style="background: rgba(40, 167, 69, 0.1); color: #2e7d32; border: 1px solid rgba(40, 167, 69, 0.2) !important;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="white-panel p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="mb-1" style="font-weight: 800;">Sign In</h2>
                    <p class="text-muted small">Access your purchased creative files.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group-creative">
                        <label for="email" class="form-label-creative">EMAIL ADDRESS</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" class="form-control form-control-creative border-start-0 ps-0" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@domain.com" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group-creative">
                        <label for="password" class="form-label-creative">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input id="password" class="form-control form-control-creative border-start-0 ps-0" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input form-check-input-creative" name="remember">
                            <label for="remember_me" class="form-check-label text-muted small" style="user-select: none;">Keep me logged in</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-creative w-100 mb-3 py-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Log In
                    </button>
                    
                    <!-- Link to Register -->
                    <div class="text-center mt-3">
                        <span class="text-muted small">New to WMP Store?</span>
                        <a href="{{ route('register') }}" class="text-decoration-none small ms-1" style="color: var(--color-primary); font-weight: 700; transition: var(--transition-smooth);">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
