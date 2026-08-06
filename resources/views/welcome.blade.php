@extends('layouts.app')

@section('title', 'Digital Products Storefront')

@section('content')
<!-- Storefront Header / Navbar -->
@include('layouts.header')

<!-- Hero Section -->
<div class="bg-white border-bottom border-light py-5">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">WMP Creative Store</span>
                <h1 class="display-4 mb-4" style="font-weight: 800; line-height: 1.15;">
                    Premium <span class="text-gradient-red">digital design assets</span> & developer code kits.
                </h1>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.6;">
                    Boost your development speed and brand aesthetics. Download premium corporate web templates, UX frameworks, detailed Vector guidelines, and robust boilerplates designed in our agency colors.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#browse" class="btn btn-creative py-3 px-4">
                        Browse Assets <i class="bi bi-arrow-down-short ms-1"></i>
                    </a>
                    <a href="#features" class="btn btn-outline-secondary py-3 px-4" style="border-radius: 10px;">
                        Why Choose WMP?
                    </a>
                </div>
            </div>
            
            <!-- Graphic Block -->
            <div class="col-lg-5 text-center">
                <div class="p-5 rounded-4" style="background: var(--color-light); border: 2.5px dashed var(--border-color); position: relative;">
                    <div style="font-size: 5rem;" class="text-gradient-red"><i class="bi bi-box-seam-fill"></i></div>
                    <h3 class="mt-3 mb-1" style="font-weight: 700;">WMP Asset Box</h3>
                    <p class="text-muted small px-3">Instant download vault for production-ready design elements and source codes.</p>
                    <span class="position-absolute translate-middle badge rounded-pill bg-warning text-dark px-3 py-2 border border-white" style="top: 10%; right: 5%; font-family: var(--font-brand); font-weight: 700;">
                        ★ Gold Level
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Filters & Store Grid -->
<div id="browse" class="container py-5 my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-4">
        <div>
            <h2 class="display-6 mb-1" style="font-weight: 800;">Featured Assets</h2>
            <p class="text-muted mb-0">High-fidelity digital items created for designers and developers.</p>
        </div>
        
        <!-- Filter Tabs -->
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-creative btn-sm py-2 px-3">All Items</button>
            <button class="btn btn-creative-outline btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);">UI Templates</button>
            <button class="btn btn-creative-outline btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);">Graphics & Vectors</button>
            <button class="btn btn-creative-outline btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);">Code Scripts</button>
        </div>
    </div>
    
    <div class="row g-4">
        @forelse ($products as $product)
            <!-- Dynamic Product Card -->
            <div class="col-md-6 col-lg-4">
                <div class="store-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="store-card-img-wrapper" style="background: radial-gradient(circle, rgba(229, 57, 53, 0.02) 0%, rgba(255, 193, 7, 0.05) 100%);">
                            @if ($product->preview_image && file_exists(public_path($product->preview_image)))
                                <img src="{{ asset($product->preview_image) }}" alt="{{ $product->name }}" class="store-card-img">
                            @else
                                <div class="text-center">
                                    <i class="bi bi-box-seam-fill display-3 text-danger mb-2 d-block"></i>
                                    <small class="text-muted fw-bold">{{ strtoupper($product->category) }}</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <div class="store-card-category mb-2">{{ $product->category }}</div>
                            <h4 class="mb-2" style="font-size: 1.2rem; font-weight: 700;">{{ $product->name }}</h4>
                            <p class="text-muted small mb-3">{{ $product->description }}</p>
                            
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="star-rating small">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <small class="text-muted fw-bold">(5.0 / 8 reviews)</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-4 pb-4 pt-0 d-flex align-items-center justify-content-between border-top border-light-subtle pt-3">
                        <span class="fs-4 fw-800 text-danger" style="font-family: var(--font-brand); font-weight: 800;">₹{{ number_format($product->price, 2) }}</span>
                        
                        <!-- Simulated checkout trigger -->
                        <form method="POST" action="{{ route('purchase.store', $product->id) }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-creative btn-sm py-2 px-3">
                                <i class="bi bi-cart-plus me-1"></i> Buy Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-12 text-center py-5">
                <div class="rounded-4 p-5" style="background: var(--color-white); border: 1.5px solid var(--border-color);">
                    <i class="bi bi-emoji-frown display-3 text-muted"></i>
                    <h4 class="text-muted mt-3">No creative products found in the database.</h4>
                    <p class="text-muted small">Log in as admin to populate the storefront.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Features Section -->
<div id="features" class="bg-white border-top border-bottom border-light py-5 mt-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold" style="font-weight: 800;">The WMP Creative Guarantee</h2>
            <p class="text-muted">High-fidelity digital items backed by our agency expertise.</p>
        </div>
        
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="bi bi-shield-lock-fill display-4 text-danger mb-3"></i>
                <h4 style="font-weight: 700;">Secure Transactions</h4>
                <p class="text-muted small px-lg-4">Your purchases are fully protected and downloads are generated immediately inside your client dashboard library.</p>
            </div>
            
            <div class="col-md-4">
                <i class="bi bi-arrow-repeat display-4 text-warning mb-3"></i>
                <h4 style="font-weight: 700;">Lifetime Updates</h4>
                <p class="text-muted small px-lg-4">Any future design updates, security improvements, or code modifications are free to redownload forever.</p>
            </div>
            
            <div class="col-md-4">
                <i class="bi bi-patch-check-fill display-4 text-success mb-3"></i>
                <h4 style="font-weight: 700;">Agency Approved</h4>
                <p class="text-muted small px-lg-4">All assets are identical to the source materials utilized in our luxury commercial client deliverables.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-white border-top border-light-subtle py-5 mt-5">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP Creative Logo" style="height: 44px; width: auto;">
                    <span class="fs-5 fw-bold text-dark font-brand" style="letter-spacing: -0.02em;">WMP Creative</span>
                </div>
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    WMP Creative is a luxury design agency dedicated to crafting premium digital storefronts, high-end visual kits, vector guidelines, and developer-centric templates.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary fs-5 hover-color-primary"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-color-primary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-color-primary"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-color-primary"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Shop Catalog links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-dark fw-bold mb-3 font-brand" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem;">Explore Store</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="#browse" class="text-muted text-decoration-none hover-link">UI Templates</a></li>
                    <li><a href="#browse" class="text-muted text-decoration-none hover-link">UI Components</a></li>
                    <li><a href="#browse" class="text-muted text-decoration-none hover-link">Graphics & Vectors</a></li>
                    <li><a href="#browse" class="text-muted text-decoration-none hover-link">Code Boilerplates</a></li>
                </ul>
            </div>

            <!-- Support/Help Desk links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-dark fw-bold mb-3 font-brand" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem;">Resources</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="#" class="text-muted text-decoration-none hover-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')">My Account Vault</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')">Help & Support</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link">Licensing Policy</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link">Privacy Statement</a></li>
                </ul>
            </div>

            <!-- Contacts / Location column -->
            <div class="col-lg-4 col-md-6" id="footer-subscribe">
                <h6 class="text-dark fw-bold mb-3 font-brand" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem;">Get in Touch</h6>
                <p class="text-muted small mb-3">Subscribe to receive notifications for luxury template releases and exclusive updates.</p>
                
                <form class="mb-3" onsubmit="event.preventDefault(); alert('Subscribed to newsletter list!');">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter email..." required style="border-radius: 8px 0 0 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem;">
                        <button type="submit" class="btn btn-creative py-2 px-3" style="border-radius: 0 8px 8px 0; font-size: 0.85rem;">
                            Join
                        </button>
                    </div>
                </form>
                <small class="text-muted d-block"><i class="bi bi-geo-alt-fill me-1"></i><a href="https://maps.app.goo.gl/eSCkg1xyFC5CRKYC7" target="_blank" class="text-muted text-decoration-none hover-link">3/341 Subedharmedu, Kattinayanapalli Po, Krishnagiri -635001</a></small>
                <small class="text-muted d-block mt-1"><i class="bi bi-envelope-fill me-1"></i><a href="mailto:support@wmpcreativeagency.com" class="text-muted text-decoration-none hover-link">support@wmpcreativeagency.com</a></small>
                <small class="text-muted d-block mt-1"><i class="bi bi-telephone-fill me-1"></i><a href="tel:+918940684434" class="text-muted text-decoration-none hover-link">+91 8940684434</a></small>
            </div>
        </div>

        <hr class="my-5 border-light-subtle">

        <!-- Bottom Copyright -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <span class="text-muted small">&copy; {{ date('Y') }} WMP Creative Agency. Built with Laravel, HTML, CSS, and Bootstrap.</span>
            <div class="d-flex gap-3 small">
                <a href="#" class="text-muted text-decoration-none hover-link">Terms of Use</a>
                <span class="text-muted">•</span>
                <a href="#" class="text-muted text-decoration-none hover-link">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
@endsection
