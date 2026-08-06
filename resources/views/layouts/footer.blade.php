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
                <small class="text-muted d-block"><i class="bi bi-geo-alt-fill me-1"></i>London, United Kingdom • support@wmpcreative.com</small>
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
