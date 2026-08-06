@extends('layouts.app')

@section('title', 'Create Account')

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
            <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Workspace Registration</span>
            <h1 class="display-5 mb-3" style="line-height: 1.15; font-weight: 800;">Get a vault of <span class="text-gradient-red">premium resources</span>.</h1>
            <p class="text-muted" style="line-height: 1.6; font-size: 0.95rem;">Join our platform to purchase, download, and license high-end graphic assets, templates, UI components, and code extensions crafted by WMP Creative leads.</p>
            
            <div class="mt-4 pt-2">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; background: rgba(229, 57, 53, 0.08); border: 1px solid rgba(229, 57, 53, 0.15);">
                        <i class="bi bi-shield-check text-danger"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Secure Purchases</h6>
                        <small class="text-muted">Encrypted billing and instantly available download tokens</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; background: rgba(255, 193, 7, 0.12); border: 1px solid rgba(255, 193, 7, 0.25);">
                        <i class="bi bi-headphones text-warning"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">24/7 Developer Support</h6>
                        <small class="text-muted">Direct communication desk with our engineering team</small>
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
            <div class="white-panel p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="mb-1" style="font-weight: 800;">Register</h2>
                    <p class="text-muted small">Create an account to start downloading assets.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group-creative">
                        <label for="name" class="form-label-creative">FULL NAME</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                <i class="bi bi-person"></i>
                            </span>
                            <input id="name" class="form-control form-control-creative border-start-0 ps-0" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group-creative">
                        <label for="email" class="form-label-creative">EMAIL ADDRESS</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" class="form-control form-control-creative border-start-0 ps-0" type="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
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
                            <input id="password" class="form-control form-control-creative border-start-0 ps-0" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group-creative">
                        <label for="password_confirmation" class="form-label-creative">CONFIRM PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input id="password_confirmation" class="form-control form-control-creative border-start-0 ps-0" type="password" name="password_confirmation" required placeholder="••••••••" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        </div>
                        @error('password_confirmation')
                            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-creative w-100 mb-3 py-3 mt-2">
                        <i class="bi bi-person-plus me-2"></i> Register
                    </button>
                    
                    <!-- Link to Login -->
                    <div class="text-center mt-3">
                        <span class="text-muted small">Already registered?</span>
                        <a href="{{ route('login') }}" class="text-decoration-none small ms-1" style="color: var(--color-primary); font-weight: 700; transition: var(--transition-smooth);">Log In Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
