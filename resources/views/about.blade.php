@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Header / Navbar -->
@include('layouts.header')

<!-- About Hero Section -->
<div class="bg-white border-bottom border-light py-5">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 text-start">
                <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Our Agency DNA</span>
                <h1 class="display-4 mb-4" style="font-weight: 800; line-height: 1.15;">
                    Crafting <span class="text-gradient-red">premium assets</span> and customized strategies.
                </h1>
                <p class="text-muted fs-6 mb-4" style="line-height: 1.7;">
                    WMP Creative is a luxury design agency operating at the intersection of branding, visual assets, performance marketing, and elite web engineering. We provide developers and enterprises with source files, structural UI templates, and paid ads frameworks that immediately drive growth and look stunning.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/') }}#browse" class="btn btn-creative py-3 px-4">
                        Explore Digital Store <i class="bi bi-cart-fill ms-1"></i>
                    </a>
                    <a href="{{ url('/') }}#footer-subscribe" class="btn btn-outline-secondary py-3 px-4" style="border-radius: 10px;">
                        Subscribe for Newsletters
                    </a>
                </div>
            </div>
            
            <div class="col-lg-5 text-center">
                <div class="p-5 rounded-4" style="background: var(--color-light); border: 2.5px dashed var(--border-color); position: relative;">
                    <div style="font-size: 5rem;" class="text-gradient-red"><i class="bi bi-ui-checks"></i></div>
                    <h3 class="mt-4 mb-2" style="font-weight: 700;">WMP Creative Team</h3>
                    <p class="text-muted small px-3">Based in London, United Kingdom. Delivering aesthetic superiority worldwide.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agency Core Values -->
<div class="container py-5 my-4">
    <div class="text-center mb-5" style="max-width: 600px; margin: 0 auto;">
        <h2 class="display-6 mb-2" style="font-weight: 800;">Our Core Pillars</h2>
        <p class="text-muted">How we maintain visual excellence and code performance on every deliverable.</p>
    </div>
    
    <div class="row g-4">
        <!-- Pillar 1 -->
        <div class="col-md-4">
            <div class="white-panel p-4 h-100 text-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; background: rgba(229, 57, 53, 0.08); border: 1.5px solid rgba(229, 57, 53, 0.15); color: var(--color-primary);">
                    <i class="bi bi-palette-fill fs-4"></i>
                </div>
                <h4 style="font-weight: 700;">Aesthetic Superiority</h4>
                <p class="text-muted small px-lg-2">We build custom assets featuring rich colors, balanced margins, premium typography, and seamless micro-animations designed to wow customers.</p>
            </div>
        </div>
        
        <!-- Pillar 2 -->
        <div class="col-md-4">
            <div class="white-panel p-4 h-100 text-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; background: rgba(255, 193, 7, 0.12); border: 1.5px solid rgba(255, 193, 7, 0.25); color: #d49a00;">
                    <i class="bi bi-cpu-fill fs-4"></i>
                </div>
                <h4 style="font-weight: 700;">Elite Code Optimization</h4>
                <p class="text-muted small px-lg-2">All backend and storefront templates are fully responsive, SEO-ready, built on semantic HTML structure, and speed-optimized for instant index performance.</p>
            </div>
        </div>
        
        <!-- Pillar 3 -->
        <div class="col-md-4">
            <div class="white-panel p-4 h-100 text-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; background: rgba(46, 204, 113, 0.1); border: 1.5px solid rgba(46, 204, 113, 0.2); color: #27ae60;">
                    <i class="bi bi-graph-up-arrow fs-4"></i>
                </div>
                <h4 style="font-weight: 700;">Performance Marketing</h4>
                <p class="text-muted small px-lg-2">We construct ads campaign frameworks, funnel building blocks, and optimized lead flows that capture hot leads and maximize customer conversion ROAS.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-white border-top border-light-subtle py-5 mt-5">
    <div class="container py-4">
        <div class="row g-5">
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

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-dark fw-bold mb-3 font-brand" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem;">Explore Store</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ url('/') }}#browse" class="text-muted text-decoration-none hover-link">UI Templates</a></li>
                    <li><a href="{{ url('/') }}#browse" class="text-muted text-decoration-none hover-link">UI Components</a></li>
                    <li><a href="{{ url('/') }}#browse" class="text-muted text-decoration-none hover-link">Graphics & Vectors</a></li>
                    <li><a href="{{ url('/') }}#browse" class="text-muted text-decoration-none hover-link">Code Boilerplates</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-dark fw-bold mb-3 font-brand" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.8rem;">Resources</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="#" class="text-muted text-decoration-none hover-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')">My Account Vault</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')">Help & Support</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link">Licensing Policy</a></li>
                    <li><a href="#" class="text-muted text-decoration-none hover-link">Privacy Statement</a></li>
                </ul>
            </div>

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
