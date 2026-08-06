@extends('layouts.app')

@section('title', 'My Vault')

@section('content')
<!-- Storefront Header / Navbar -->
<nav class="navbar navbar-expand-lg navbar-storefront sticky-top py-2">
    <div class="container-fluid ps-2 pe-4 ps-md-3 pe-md-5">
        <a class="navbar-brand d-flex align-items-center gap-2 ps-0" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP Creative" class="logo-img">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="dashboardNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link nav-link-store" href="{{ url('/') }}"><i class="bi bi-shop me-1"></i>Storefront</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-store active" href="#"><i class="bi bi-folder2-open me-1"></i>My Library</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center gap-3">
                <span class="text-dark small d-none d-md-inline" style="font-family: var(--font-brand); font-weight: 700;">
                    <i class="bi bi-person-badge text-danger me-1"></i>{{ Auth::user()->name }}
                </span>
                
                <!-- Logout POST form -->
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary py-2 px-3 fs-7" style="border-radius: 10px; font-size: 0.9rem;">
                        <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container py-5">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 mb-4" role="alert" style="background: rgba(40, 167, 69, 0.1); color: #2e7d32; border: 1px solid rgba(40, 167, 69, 0.2) !important;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hero / Welcome Header -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-8">
            <h1 class="display-5 mb-2" style="font-weight: 800;">My Product <span class="text-gradient-red">Vault</span></h1>
            <p class="text-muted fs-6 mb-0">Manage your product license tokens, view purchase invoices, and download design updates immediately.</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
            <a href="{{ url('/') }}" class="btn btn-creative">
                <i class="bi bi-plus-lg me-1"></i> Explore More Assets
            </a>
        </div>
    </div>

    <!-- Main Grid Workspace -->
    <div class="row g-5">
        <!-- Products Library (Left Col) -->
        <div class="col-lg-8">
            <div class="white-panel p-4 p-md-5 mb-5">
                <h3 class="mb-4 d-flex align-items-center" style="font-weight: 800;">
                    <i class="bi bi-download text-danger me-2"></i> Purchased Items Library
                </h3>
                
                <div class="row g-4 mt-2">
                    @forelse ($purchases as $purchase)
                        <!-- Dynamic Purchase Card -->
                        <div class="col-md-12">
                            <div class="library-card p-4">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 54px; height: 54px; background: rgba(229, 57, 53, 0.08); border: 1.5px solid rgba(229, 57, 53, 0.15);">
                                            <i class="bi bi-box-seam text-danger fs-4"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill mb-1" style="font-size: 0.7rem; font-family: var(--font-brand); font-weight: 700; text-transform: uppercase;">{{ $purchase->product->category }}</span>
                                            <h5 class="mb-0 fw-bold">{{ $purchase->product->name }}</h5>
                                            <small class="text-muted">Purchased on {{ $purchase->created_at->format('d M, Y') }} • Version 1.0.0 (Latest)</small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-creative btn-sm py-2 px-3" onclick="alert('Downloading {{ str_replace(' ', '_', $purchase->product->name) }}_source.zip...')">
                                            <i class="bi bi-cloud-arrow-down-fill me-1"></i> Download
                                        </button>
                                        <button class="btn btn-creative-outline btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);" onclick="alert('License Key: WMP-KEY-{{ $purchase->id }}-{{ mt_rand(1000, 9999) }}')">
                                            <i class="bi bi-key-fill me-1"></i> License
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <i class="bi bi-folder-x display-4 text-muted"></i>
                            <p class="text-muted mt-2">You haven't purchased any templates or scripts yet.</p>
                            <a href="{{ url('/') }}" class="text-danger fw-bold text-decoration-none">Go to storefront &rarr;</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Invoices Section -->
            @if ($purchases->isNotEmpty())
                <div class="white-panel p-4 p-md-5 mb-5">
                    <h3 class="mb-4 d-flex align-items-center" style="font-weight: 800;">
                        <i class="bi bi-receipt text-danger me-2"></i> Transaction Log & Invoices
                    </h3>
                    
                    <div class="table-responsive">
                        <table class="table align-middle border-0" style="background: transparent;">
                            <thead>
                                <tr class="text-muted" style="border-bottom: 1.5px solid var(--border-color);">
                                    <th scope="col" class="pb-3 border-0">ORDER ID</th>
                                    <th scope="col" class="pb-3 border-0">PRODUCT</th>
                                    <th scope="col" class="pb-3 border-0">DATE</th>
                                    <th scope="col" class="pb-3 border-0">AMOUNT</th>
                                    <th scope="col" class="pb-3 border-0 text-end">INVOICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr style="border-bottom: 1px solid var(--border-color);">
                                        <td class="py-3 fw-bold border-0">#WMP-{{ $purchase->id + 4890 }}</td>
                                        <td class="border-0">{{ $purchase->product->name }}</td>
                                        <td class="border-0">{{ $purchase->created_at->format('d M, Y') }}</td>
                                        <td class="border-0 fw-bold text-danger">₹{{ number_format($purchase->price_paid, 2) }}</td>
                                        <td class="border-0 text-end">
                                            <button class="btn btn-light btn-sm border" style="border-radius: 8px;" onclick="alert('Downloading invoice PDF for order #WMP-{{ $purchase->id + 4890 }}...')">
                                                <i class="bi bi-file-earmark-pdf text-danger"></i> PDF
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Help Desk Support History (Threaded) -->
            <div class="white-panel p-4 p-md-5">
                <h3 class="mb-4 d-flex align-items-center" style="font-weight: 800;">
                    <i class="bi bi-clock-history text-danger me-2"></i> Support Conversation Threads
                </h3>
                
                <div class="activity-feed">
                    @forelse ($tickets as $ticket)
                        <div class="activity-item p-3 border rounded-3 mb-4" style="background: var(--color-light); border-color: var(--border-color) !important;">
                            
                            <!-- Ticket Top Bar -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 fw-bold text-dark">{{ $ticket->topic }}</h6>
                                <div>
                                    <!-- Priority Badge -->
                                    <span class="badge rounded-pill px-2.5 py-1 text-uppercase me-1" style="font-size: 0.65rem; background: {{ $ticket->priority == 'urgent' ? '#E53935' : ($ticket->priority == 'high' ? '#ff9100' : ($ticket->priority == 'medium' ? '#1e88e5' : '#757575')) }}; color: #fff;">
                                        {{ $ticket->priority }}
                                    </span>
                                    <!-- Status Badge -->
                                    @if ($ticket->status == 'open')
                                        <span class="badge bg-danger text-white rounded-pill px-3 py-1">Open</span>
                                    @else
                                        <span class="badge bg-success text-white rounded-pill px-3 py-1">Resolved</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Conversational Message Thread -->
                            <div class="border rounded-3 p-3 bg-white mb-3" style="max-height: 280px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.75rem;">
                                @foreach ($ticket->messages as $msg)
                                    <div class="d-flex flex-column {{ $msg->user_id == Auth::id() ? 'align-items-end' : 'align-items-start' }}">
                                        <div class="p-2.5 rounded-3 text-dark small" style="max-width: 80%; background: {{ $msg->user_id == Auth::id() ? '#ffebee' : '#f5f5f5' }}; border: 1.5px solid {{ $msg->user_id == Auth::id() ? '#ffcdd2' : '#e0e0e0' }};">
                                            <small class="fw-bold d-block text-muted" style="font-size: 0.65rem;">
                                                {{ $msg->user_id == Auth::id() ? 'You' : $msg->user->name }}
                                            </small>
                                            <p class="mb-0 mt-0.5" style="line-height: 1.45;">{{ $msg->message }}</p>
                                        </div>
                                        <span class="text-muted mt-0.5" style="font-size: 0.6rem;">{{ $msg->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Live Inline Thread Quick Reply -->
                            <form method="POST" action="{{ route('tickets.messages.store', $ticket->id) }}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control" placeholder="Type reply message to developers..." style="border-radius: 10px 0 0 10px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" required>
                                    <button type="submit" class="btn btn-creative btn-sm px-3" style="border-radius: 0 10px 10px 0;">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-chat-left-text-fill display-4 d-block mb-2 text-secondary"></i>
                            No support queries registered. Submit an issue using the help desk sidebar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Account Side Summary (Right Col) -->
        <div class="col-lg-4">
            <div class="white-panel p-4 mb-4">
                <h4 class="mb-3" style="font-weight: 800;"><i class="bi bi-person-bounding-box text-danger me-2"></i>Account Details</h4>
                <div class="d-flex align-items-center gap-3 border-bottom border-light pb-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger bg-opacity-10" style="width: 50px; height: 50px;">
                        <i class="bi bi-shield-lock text-danger fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center small mb-2">
                    <span class="text-muted">Membership Level:</span>
                    <span class="badge bg-warning text-dark fw-bold" style="font-family: var(--font-brand);">★ Gold Member</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small mb-2">
                    <span class="text-muted">Account Registered:</span>
                    <span class="text-dark fw-semibold">{{ Auth::user()->created_at->format('M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <span class="text-muted">Library Products:</span>
                    <span class="text-dark fw-bold">{{ $purchases->count() }} Items</span>
                </div>
            </div>

            <!-- Submit Support Ticket Form -->
            <div class="white-panel p-4">
                <h4 class="mb-3" style="font-weight: 800;"><i class="bi bi-chat-right-quote text-danger me-2"></i>Help Desk Support</h4>
                <p class="text-muted small">Encountered issues running your templates or importing vector packs? Submit a direct inquiry.</p>
                
                <form method="POST" action="{{ route('tickets.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="topic" class="form-label-creative">INQUIRY TOPIC</label>
                        <select id="topic" name="topic" class="form-select" style="border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" required>
                            <option value="">Choose topic...</option>
                            <option value="Aura Web Template Setup">Aura Web Template Setup</option>
                            <option value="Apex UI Library Import">Apex UI Library Import</option>
                            <option value="Vector Asset Missing Files">Vector Asset Missing Files</option>
                            <option value="Laravel Boilerplate Db Issue">Laravel Boilerplate Db Issue</option>
                            <option value="Other Technical Query">Other Technical Query</option>
                        </select>
                    </div>
                    
                    <!-- Priority Level Select -->
                    <div class="mb-3">
                        <label for="priority" class="form-label-creative">PRIORITY LEVEL</label>
                        <select id="priority" name="priority" class="form-select" style="border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" required>
                            <option value="low">Low Priority</option>
                            <option value="medium" selected>Medium Priority</option>
                            <option value="high">High Priority</option>
                            <option value="urgent">Urgent Priority</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label-creative">MESSAGE DETAILS</label>
                        <textarea id="message" name="message" class="form-control" rows="3" placeholder="Provide setup logs or errors..." style="border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-creative btn-sm w-100 py-2">
                        Submit Support Ticket
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
