<div class="top-bar d-none d-lg-block">
    <div class="container-fluid ps-2 pe-4 ps-md-3 pe-md-5">
        <div class="d-flex justify-content-between align-items-center py-2">
            <!-- Left Side -->
            <div class="d-flex align-items-center gap-3">
                <div class="social-icons d-flex align-items-center gap-3 text-white-50">
                    <a href="https://www.linkedin.com/company/startup-by-123krishnagiri/" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.youtube.com/@startupby123krishnagiri" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.instagram.com/startup.123krishnagiri" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/startupby123krishnagiri/" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.threads.com/@startup.123krishnagiri" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-threads"></i></a>
                    <a href="https://whatsapp.com/channel/0029Vawangz5fM5chbmiPB3a" target="_blank" class="text-white-50 hover-text-white"><i class="bi bi-whatsapp"></i></a>
                </div>
                <div class="topbar-divider"></div>
                <a href="#" class="btn btn-creative btn-sm py-1 px-3 d-flex align-items-center gap-2" style="font-size: 0.75rem; border-radius: 4px; box-shadow: none;">
                    <i class="bi bi-graph-up-arrow"></i> Career With Us
                </a>
            </div>

            <!-- Right Side -->
            <div class="d-flex align-items-center gap-3 text-white-50" style="font-size: 0.85rem; font-family: var(--font-brand); font-weight: 600;">
                <div class="d-flex align-items-center gap-2 text-white">
                    <i class="bi bi-telephone-fill text-warning"></i> +91 8940684434
                </div>
                
                <div class="topbar-divider"></div>
                
                <a href="{{ route('services.show', 'sales-funnel') }}" class="btn btn-creative btn-sm py-1 px-3 d-flex align-items-center gap-2" style="font-size: 0.75rem; border-radius: 4px; box-shadow: none;">
                    Get a Proposal <i class="bi bi-rocket-takeoff-fill"></i>
                </a>

                <div class="topbar-divider"></div>
                
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none hover-color-primary d-flex align-items-center gap-1 text-uppercase">
                            <i class="bi bi-box-arrow-in-right"></i> ADMIN
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none hover-color-primary d-flex align-items-center gap-1 text-uppercase">
                            <i class="bi bi-box-arrow-in-right"></i> VAULT
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="mb-0 ms-1">
                        @csrf
                        <button type="submit" class="text-white-50 text-decoration-none hover-color-primary btn btn-link p-0 m-0 text-decoration-none d-flex align-items-center" style="font-size: 0.85rem; font-family: var(--font-brand); font-weight: 600; box-shadow:none;">
                            Logout
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-link p-0 text-white text-decoration-none hover-color-primary d-flex align-items-center gap-1 text-uppercase" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')" style="font-size: 0.85rem; font-family: var(--font-brand); font-weight: 600; box-shadow:none;">
                        <i class="bi bi-box-arrow-in-right"></i> LOGIN
                    </button>
                @endauth
                

            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-storefront sticky-top py-2">
    <div class="container-fluid ps-2 pe-4 ps-md-3 pe-md-5">
        <a class="navbar-brand d-flex align-items-center gap-2 ps-0" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP Creative" class="logo-img">
        </a>
        
        <!-- Mobile-only Auth Action Button -->
        <div class="d-lg-none ms-2 ms-sm-3 d-flex align-items-center gap-2">
            @auth
                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-creative btn-sm py-2 px-3" style="font-size: 0.8rem; box-shadow: none;">
                        Admin
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-creative btn-sm py-2 px-3" style="font-size: 0.8rem; box-shadow: none;">
                        Vault
                    </a>
                @endif
            @else
                <button type="button" class="btn btn-creative btn-sm py-2 px-3" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')" style="font-size: 0.8rem; box-shadow: none;">
                    Login
                </button>
            @endauth
            
            <button class="navbar-toggler border-0 shadow-none custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storefrontNavbar" aria-controls="storefrontNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>
        
        <div class="collapse navbar-collapse justify-content-center" id="storefrontNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center mx-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="{{ url('/') }}#browse">Solutions</a>
                </li>
                
                <!-- Services Mega Dropdown -->
                <li class="nav-item dropdown position-static">
                    <a class="nav-link nav-link-store dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Who We Serve
                    </a>
                    <div class="dropdown-menu w-100 border-0 shadow-lg p-4 mega-menu" aria-labelledby="servicesDropdown" style="border-radius: 16px; margin-top: 10px;">
                        <div class="container-fluid">
                            <div class="row g-4 mega-menu-grid">
                                <!-- Col 1: Website Designing -->
                                <div class="col-lg-3">
                                    <h6 class="dropdown-header text-danger fw-bold font-brand mb-2 px-0 d-flex align-items-center gap-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">
                                        <i class="bi bi-laptop fs-6"></i> Website Designing
                                    </h6>
                                    <ul class="list-unstyled d-flex flex-column gap-1">
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'static-website') }}">
                                                <i class="bi bi-window-sidebar text-danger"></i> Static Website
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'dynamic-website') }}">
                                                <i class="bi bi-cpu text-danger"></i> Dynamic Website
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'ecommerce-website') }}">
                                                <i class="bi bi-cart-check-fill text-danger"></i> eCommerce Website
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Col 2: Digital Marketing -->
                                <div class="col-lg-3">
                                    <h6 class="dropdown-header text-danger fw-bold font-brand mb-2 px-0 d-flex align-items-center gap-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">
                                        <i class="bi bi-megaphone fs-6"></i> Digital Marketing
                                    </h6>
                                    <ul class="list-unstyled d-flex flex-column gap-1">
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'seo') }}">
                                                <i class="bi bi-search text-danger"></i> SEO Optimization
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'facebook-instagram-ads') }}">
                                                <i class="bi bi-instagram text-danger"></i> Facebook & Instagram Ads
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'google-ads') }}">
                                                <i class="bi bi-google text-danger"></i> Google Ads Campaign
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Col 3: Branding -->
                                <div class="col-lg-3">
                                    <h6 class="dropdown-header text-danger fw-bold font-brand mb-2 px-0 d-flex align-items-center gap-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">
                                        <i class="bi bi-brush fs-6"></i> Branding
                                    </h6>
                                    <ul class="list-unstyled d-flex flex-column gap-1">
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'logo-design') }}">
                                                <i class="bi bi-vector-pen text-danger"></i> Logo Design
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'poster-design') }}">
                                                <i class="bi bi-postcard-fill text-danger"></i> Poster Design
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'brochure-design') }}">
                                                <i class="bi bi-book-half text-danger"></i> Brochure Design
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Col 4: Performance Marketing -->
                                <div class="col-lg-3">
                                    <h6 class="dropdown-header text-danger fw-bold font-brand mb-2 px-0 d-flex align-items-center gap-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">
                                        <i class="bi bi-graph-up-arrow fs-6"></i> Performance
                                    </h6>
                                    <ul class="list-unstyled d-flex flex-column gap-1">
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'sales-funnel') }}">
                                                <i class="bi bi-funnel-fill text-danger"></i> Sales Funnel Building
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 small" href="{{ route('services.show', 'lead-generation') }}">
                                                <i class="bi bi-person-vcard-fill text-danger"></i> Lead Generation
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="{{ route('about') }}">Who We Are</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="{{ route('blogs.index') }}">Self Help</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="#">Partner Program</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="{{ url('/') }}#browse">Industries We Serve</a>
                </li>
            </ul>

            <div class="d-none d-lg-flex align-items-center gap-4 ms-lg-auto right-nav-actions">
                <button class="btn btn-link p-0 text-dark hover-color-primary search-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse">
                    <i class="bi bi-search fs-5"></i>
                </button>
                
                <a href="#" class="btn py-2 px-4 rounded-pill fw-bold" style="background: var(--color-accent); color: var(--color-dark); font-family: var(--font-brand); font-size: 0.9rem; border: none; box-shadow: 0 4px 14px rgba(255, 193, 7, 0.4); transition: transform 0.2s, box-shadow 0.2s;">
                    <i class="bi bi-headset me-1"></i> Schedule Free Consultation
                </a>
            </div>
            
            <!-- Mobile Search Bar (Since we hid it in topbar for desktop) -->
            <div class="d-lg-none mt-3">
                <form action="{{ url('/') }}#browse">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search templates..." aria-label="Search" style="border-radius: 8px 0 0 8px; border: 1.5px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff;">
                        <button class="btn btn-creative" type="submit" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Expandable Desktop Search -->
<div class="collapse position-absolute w-100 shadow-sm" id="searchCollapse" style="z-index: 1020; top: 100%; background: var(--color-white); border-bottom: 1px solid var(--border-color);">
    <div class="container-fluid py-4 ps-2 pe-4 ps-md-3 pe-md-5">
        <form class="mx-auto col-md-6" action="{{ url('/') }}#browse">
            <div class="input-group input-group-lg">
                <input class="form-control" type="search" placeholder="Search solutions, templates, icons..." aria-label="Search" style="border-radius: 12px 0 0 12px; border: 2px solid var(--border-color);">
                <button class="btn btn-creative" type="submit" style="border-radius: 0 12px 12px 0; padding: 0.5rem 2rem;">
                    <i class="bi bi-search fs-5"></i>
                </button>
            </div>
        </form>
    </div>
</div>
