<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'WMP Creative Agency') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">
    
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>

    @yield('content')

    @guest
    <!-- Premium Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; background: #fff;">
                
                <!-- Modal Header -->
                <div class="modal-header border-0 pb-0 pt-4 px-4 position-relative d-flex justify-content-center">
                    <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP" style="height: 80px; width: auto; object-fit: contain;">
                    <button type="button" class="btn-close shadow-none position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 1.5rem; right: 1.5rem;"></button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body p-4 pt-3">
                    
                    <!-- LOGIN VIEW -->
                    <div id="auth-view-login" class="auth-view">
                        <div class="mb-4 text-center">
                            <h4 class="mb-1" style="font-weight: 800; font-family: var(--font-brand);">Welcome Back</h4>
                            <p class="text-muted small mb-0">Sign in to access your digital downloads vault.</p>
                        </div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="form_type" value="login">
                            
                            <div class="form-group-creative">
                                <label for="login-email" class="form-label-creative">EMAIL ADDRESS</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="login-email" class="form-control form-control-creative border-start-0 ps-0" type="email" name="email" value="{{ old('form_type') === 'login' ? old('email') : '' }}" required placeholder="name@domain.com" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                                @if ($errors->has('email') && old('form_type') === 'login')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group-creative">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="login-password" class="form-label-creative mb-0">PASSWORD</label>
                                    <a href="#" class="small text-decoration-none text-danger fw-bold" onclick="switchAuthView('forgot'); event.preventDefault();">Forgot?</a>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="login-password" class="form-control form-control-creative border-start-0 ps-0" type="password" name="password" required placeholder="••••••••" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                                @if ($errors->has('password') && old('form_type') === 'login')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-creative w-100 py-3 mt-2 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Log In
                            </button>
                        </form>
                        
                        <div class="text-center mt-3 pt-2 border-top border-light">
                            <span class="text-muted small">New to WMP Store?</span>
                            <a href="#" class="text-decoration-none small ms-1 text-danger fw-bold" onclick="switchAuthView('register'); event.preventDefault();">Create Account</a>
                        </div>
                    </div>
                    
                    <!-- REGISTER VIEW -->
                    <div id="auth-view-register" class="auth-view" style="display: none;">
                        <div class="mb-4 text-center">
                            <h4 class="mb-1" style="font-weight: 800; font-family: var(--font-brand);">Create Account</h4>
                            <p class="text-muted small mb-0">Register your custom client workspace today.</p>
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="form_type" value="register">
                            
                            <div class="form-group-creative">
                                <label for="register-name" class="form-label-creative">FULL NAME</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input id="register-name" class="form-control form-control-creative border-start-0 ps-0" type="text" name="name" value="{{ old('form_type') === 'register' ? old('name') : '' }}" required placeholder="John Doe" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                                @if ($errors->has('name') && old('form_type') === 'register')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group-creative">
                                <label for="register-email" class="form-label-creative">EMAIL ADDRESS</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="register-email" class="form-control form-control-creative border-start-0 ps-0" type="email" name="email" value="{{ old('form_type') === 'register' ? old('email') : '' }}" required placeholder="john@example.com" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                                @if ($errors->has('email') && old('form_type') === 'register')
                                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group-creative">
                                        <label for="register-password" class="form-label-creative">PASSWORD</label>
                                        <input id="register-password" class="form-control form-control-creative" type="password" name="password" required placeholder="••••••••">
                                        @if ($errors->has('password') && old('form_type') === 'register')
                                            <div class="text-danger small mt-1" style="font-size: 0.75rem;"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group-creative">
                                        <label for="register-password-confirm" class="form-label-creative">CONFIRM</label>
                                        <input id="register-password-confirm" class="form-control form-control-creative" type="password" name="password_confirmation" required placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-creative w-100 py-3 mt-2 mb-3">
                                <i class="bi bi-person-plus me-2"></i> Register Account
                            </button>
                        </form>
                        
                        <div class="text-center mt-3 pt-2 border-top border-light">
                            <span class="text-muted small">Already registered?</span>
                            <a href="#" class="text-decoration-none small ms-1 text-danger fw-bold" onclick="switchAuthView('login'); event.preventDefault();">Log In Here</a>
                        </div>
                    </div>

                    <!-- FORGOT PASSWORD VIEW -->
                    <div id="auth-view-forgot" class="auth-view" style="display: none;">
                        <div class="mb-4 text-center">
                            <h4 class="mb-1" style="font-weight: 800; font-family: var(--font-brand);">Reset Password</h4>
                            <p class="text-muted small mb-0">Enter your email and we'll send a password recovery token.</p>
                        </div>
                        
                        <form onsubmit="event.preventDefault(); alert('A simulated password reset token has been dispatched to your email address!'); switchAuthView('login');">
                            <div class="form-group-creative">
                                <label for="forgot-email" class="form-label-creative">EMAIL ADDRESS</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: var(--text-muted);">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="forgot-email" class="form-control form-control-creative border-start-0 ps-0" type="email" required placeholder="name@domain.com" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-creative w-100 py-3 mt-2 mb-3">
                                <i class="bi bi-send-fill me-2"></i> Request Reset Link
                            </button>
                        </form>
                        
                        <div class="text-center mt-3 pt-2 border-top border-light">
                            <span class="text-muted small">Remembered your password?</span>
                            <a href="#" class="text-decoration-none small ms-1 text-danger fw-bold" onclick="switchAuthView('login'); event.preventDefault();">Back to Log In</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchAuthView(view) {
            document.querySelectorAll('.auth-view').forEach(el => el.style.display = 'none');
            const activeView = document.getElementById('auth-view-' + view);
            if (activeView) {
                activeView.style.display = 'block';
            }
        }
        
        // Auto-open modal if validation errors exist, or if query param matches
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const authAction = urlParams.get('auth');
            
            @if ($errors->any())
                const modal = new bootstrap.Modal(document.getElementById('authModal'));
                const formType = "{{ old('form_type', 'login') }}";
                switchAuthView(formType);
                modal.show();
            @elseif (request('auth'))
                const modal = new bootstrap.Modal(document.getElementById('authModal'));
                switchAuthView("{{ request('auth') }}");
                modal.show();
            @endif
        });
    </script>
    @endguest

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
