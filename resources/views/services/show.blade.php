@extends('layouts.app')

@section('title', $service['title'])

@section('content')
<!-- Header / Navbar -->
@include('layouts.header')

<!-- Service Hero Section -->
<div class="bg-white border-bottom border-light py-5">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 text-start">
                <span class="badge rounded-pill mb-3 px-3 py-2 text-uppercase" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em;">
                    {{ $service['category'] }}
                </span>
                <h1 class="display-4 mb-3" style="font-weight: 800; line-height: 1.15;">
                    {{ $service['title'] }}
                </h1>
                <p class="fs-5 text-gradient-red fw-bold mb-4" style="font-family: var(--font-brand);">
                    {{ $service['tagline'] }}
                </p>
                <p class="text-muted fs-6 mb-4" style="line-height: 1.7;">
                    {{ $service['description'] }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    @auth
                        <button class="btn btn-creative py-3 px-4" onclick="triggerInquiryModal()">
                            <i class="bi bi-chat-right-quote-fill me-1"></i> Request Quote
                        </button>
                    @else
                        <button class="btn btn-creative py-3 px-4" data-bs-toggle="modal" data-bs-target="#authModal" onclick="switchAuthView('login')">
                            Login to Order <i class="bi bi-arrow-right-short ms-1"></i>
                        </button>
                    @endauth
                    <a href="{{ url('/') }}#browse" class="btn btn-outline-secondary py-3 px-4" style="border-radius: 10px;">
                        Explore Products
                    </a>
                </div>
            </div>
            
            <!-- Visual Graphic Block -->
            <div class="col-lg-5 text-center">
                <div class="p-5 rounded-4" style="background: var(--color-light); border: 2.5px dashed var(--border-color); position: relative;">
                    <div style="font-size: 6rem;" class="text-gradient-red"><i class="bi {{ $service['icon'] }}"></i></div>
                    <h4 class="mt-4 mb-2" style="font-weight: 700;">WMP Quality Assured</h4>
                    <span class="badge bg-warning text-dark px-3 py-2 border border-white" style="font-family: var(--font-brand); font-weight: 700;">
                        {{ $service['timeline'] }}
                    </span>
                    <p class="text-muted small mt-3 mb-0">{{ $service['price'] }} basis</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features & Deliverables -->
<div class="container py-5 my-4">
    <div class="text-center mb-5" style="max-width: 600px; margin: 0 auto;">
        <h2 class="display-6 mb-2" style="font-weight: 800;">What's Included</h2>
        <p class="text-muted">High-end deliverables backing up our bespoke agency service packages.</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        @foreach ($service['features'] as $feature)
            <div class="col-md-6 col-lg-4">
                <div class="white-panel p-4 h-100 d-flex gap-3 align-items-start">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: rgba(229, 57, 53, 0.08); border: 1.5px solid rgba(229, 57, 53, 0.15); color: var(--color-primary);">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $feature }}</h6>
                        <small class="text-muted">Agency-standard optimization and priority compliance.</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bottom Quote Simulation Modal for Logged-In Clients -->
@auth
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; background: #fff;">
            <div class="modal-header border-0 pb-0 pt-4 px-4 position-relative d-flex justify-content-center">
                <h5 class="fw-bold text-dark font-brand mb-0" style="letter-spacing: -0.02em;">Request Services Quote</h5>
                <button type="button" class="btn-close shadow-none position-absolute" data-bs-dismiss="modal" aria-label="Close" style="top: 1.5rem; right: 1.5rem;"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('tickets.store') }}">
                    @csrf
                    <!-- Auto-fill subject with current service -->
                    <input type="hidden" name="topic" value="Service Quote: {{ $service['title'] }}">
                    <input type="hidden" name="priority" value="medium">
                    
                    <div class="mb-3">
                        <label class="form-label-creative">SELECTED SERVICE</label>
                        <input class="form-control form-control-creative" type="text" value="{{ $service['title'] }}" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label-creative">PROJECT BRIEF / REQUIREMENTS</label>
                        <textarea id="message" name="message" class="form-control" rows="4" placeholder="Describe your web design scope, feature count, or campaign goals..." style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.9rem;" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-creative w-100 py-3">
                        <i class="bi bi-send-fill me-1"></i> Submit Brief to Lead Agent
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function triggerInquiryModal() {
        const modal = new bootstrap.Modal(document.getElementById('inquiryModal'));
        modal.show();
    }
</script>
@endauth

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
