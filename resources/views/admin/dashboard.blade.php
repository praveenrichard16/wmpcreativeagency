@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="admin-layout-wrapper">
    <!-- LEFT SIDEBAR -->
    <aside class="admin-sidebar">
        <div>
            <!-- Sidebar Header -->
            <div class="admin-sidebar-header d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}?v={{ file_exists(public_path('images/logo.png')) ? filemtime(public_path('images/logo.png')) : time() }}" alt="WMP" class="logo-img" style="height: 38px;">
                <div>
                    <h6 class="mb-0 text-white fw-bold" style="font-family: var(--font-brand);">WMP CREATIVE</h6>
                    <small class="text-danger fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.05em; text-transform: uppercase;">Control Desk</small>
                </div>
            </div>

            <!-- Sidebar Navigation Tabs -->
            <ul class="admin-sidebar-menu nav flex-column" id="adminTab" role="tablist">
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link active w-100 text-start border-0" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard-pane" type="button" role="tab" aria-controls="dashboard-pane" aria-selected="true">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab" aria-controls="users-pane" aria-selected="false">
                        <i class="bi bi-people"></i> Users & Clients
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-pane" type="button" role="tab" aria-controls="products-pane" aria-selected="false">
                        <i class="bi bi-box-seam"></i> Products Catalog
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="transactions-tab" data-bs-toggle="tab" data-bs-target="#transactions-pane" type="button" role="tab" aria-controls="transactions-pane" aria-selected="false">
                        <i class="bi bi-wallet2"></i> Transactions
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="support-tab" data-bs-toggle="tab" data-bs-target="#support-pane" type="button" role="tab" aria-controls="support-pane" aria-selected="false">
                        <i class="bi bi-envelope-exclamation"></i> Support Inbox 
                        @if ($openTicketsCount > 0)
                            <span class="badge bg-danger ms-auto">{{ $openTicketsCount }}</span>
                        @endif
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="blogs-tab" data-bs-toggle="tab" data-bs-target="#blogs-pane" type="button" role="tab" aria-controls="blogs-pane" aria-selected="false">
                        <i class="bi bi-journal-text"></i> Blogs Manager
                    </button>
                </li>
                <li class="admin-sidebar-menu-item nav-item" role="presentation">
                    <button class="nav-link admin-sidebar-link w-100 text-start border-0" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings-pane" type="button" role="tab" aria-controls="settings-pane" aria-selected="false">
                        <i class="bi bi-sliders2"></i> System Settings
                    </button>
                </li>
            </ul>
        </div>

        <!-- Sidebar Footer -->
        <div class="admin-sidebar-footer">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-danger bg-opacity-20 d-flex align-items-center justify-content-center text-danger" style="width: 32px; height: 32px;">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-white small fw-bold">{{ Auth::user()->name }}</h6>
                        <small class="text-muted" style="font-size: 0.7rem;">Admin Role</small>
                    </div>
                </div>
                <!-- Logout Trigger -->
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted p-0 text-decoration-none">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- RIGHT MAIN CONTENT PANEL -->
    <main class="admin-main">
        <!-- TOP MENU BAR -->
        <header class="admin-topnav">
            <div>
                <h5 class="mb-0 fw-bold" style="font-family: var(--font-brand);"><i class="bi bi-shield-check text-danger me-2"></i>WMP Store Management Platform</h5>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <!-- Search bar -->
                <div class="d-none d-md-flex align-items-center bg-light border px-2 py-1 rounded-3" style="width: 280px;">
                    <i class="bi bi-search text-muted mx-2"></i>
                    <input type="text" class="form-control border-0 bg-transparent p-0 small" placeholder="Search catalog, users, orders..." style="font-size: 0.8rem; box-shadow: none;">
                </div>
                
                <!-- Quick links -->
                <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm py-2 px-3" style="border-radius: 8px;">
                    <i class="bi bi-globe me-1"></i> Public Storefront
                </a>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="admin-content-area">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3 d-flex align-items-center" role="alert" style="background: rgba(46, 204, 113, 0.1); color: #27ae60;">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(30%) sepia(80%) saturate(500%) hue-rotate(100deg); margin-left: auto;"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3 d-flex align-items-center" role="alert" style="background: rgba(231, 76, 60, 0.1); color: #c0392b;">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(20%) sepia(85%) saturate(1500%) hue-rotate(330deg); margin-left: auto;"></button>
                </div>
            @endif

            <div class="tab-content" id="adminTabContent">
                
                <!-- 1. DASHBOARD OVERVIEW PANE -->
                <div class="tab-pane fade show active" id="dashboard-pane" role="tabpanel" aria-labelledby="dashboard-tab">
                    <h2 class="mb-4" style="font-weight: 800;">Analytics Overview</h2>
                    
                    <!-- Stats Grid -->
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-label">Total Revenue</div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="stat-value text-danger">₹{{ number_format($totalSales, 2) }}</span>
                                    <i class="bi bi-currency-rupee text-danger fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-label">Platform Users</div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="stat-value text-dark">{{ $totalUsersCount }}</span>
                                    <i class="bi bi-people-fill text-warning fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-label">Active Products</div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="stat-value text-dark">{{ $totalProductsCount }}</span>
                                    <i class="bi bi-box-seam-fill text-info fs-3"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div class="stat-label">Pending Tickets</div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="stat-value text-danger">{{ $openTicketsCount }}</span>
                                    <i class="bi bi-envelope-exclamation-fill text-danger fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Platform Activities Row -->
                    <div class="row g-4">
                        <!-- Recent Transactions Summary -->
                        <div class="col-lg-7">
                            <div class="white-panel p-4 h-100">
                                <h4 class="mb-3 fw-bold"><i class="bi bi-receipt text-danger me-2"></i>Recent Sales Log</h4>
                                <div class="table-responsive">
                                    <table class="table align-middle border-0">
                                        <thead>
                                            <tr class="text-muted border-bottom border-light">
                                                <th scope="col" class="pb-2 border-0">ORDER</th>
                                                <th scope="col" class="pb-2 border-0">CUSTOMER</th>
                                                <th scope="col" class="pb-2 border-0 text-end">REVENUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions->take(4) as $transaction)
                                                <tr class="border-bottom border-light">
                                                    <td class="py-3 border-0">
                                                        <h6 class="mb-0 fw-bold">#WMP-{{ $transaction->id + 4890 }}</h6>
                                                        <small class="text-muted">{{ $transaction->product->name }}</small>
                                                    </td>
                                                    <td class="border-0">{{ $transaction->user->name }}</td>
                                                    <td class="border-0 text-end fw-bold text-danger">₹{{ number_format($transaction->price_paid, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4 text-muted border-0">No purchases completed yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Activity Summary -->
                        <div class="col-lg-5">
                            <div class="white-panel p-4 h-100">
                                <h4 class="mb-3 fw-bold"><i class="bi bi-inbox text-danger me-2"></i>Inquiries Overview</h4>
                                <div class="activity-feed">
                                    @forelse ($tickets->take(3) as $ticket)
                                        <div class="activity-item pb-3 mb-3 border-bottom border-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-1 fw-bold text-dark">{{ $ticket->user->name }}</h6>
                                                @if ($ticket->status == 'open')
                                                    <span class="badge bg-danger text-white rounded-pill px-2 py-0.5" style="font-size: 0.6rem;">Open</span>
                                                @else
                                                    <span class="badge bg-success text-white rounded-pill px-2 py-0.5" style="font-size: 0.6rem;">Resolved</span>
                                                @endif
                                            </div>
                                            <small class="text-muted d-block mb-1">{{ $ticket->topic }}</small>
                                            <p class="text-muted small mb-0 text-truncate">"{{ $ticket->message }}"</p>
                                        </div>
                                    @empty
                                        <p class="text-muted text-center py-4 mb-0">No support tickets found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. USERS MANAGEMENT PANE -->
                <div class="tab-pane fade" id="users-pane" role="tabpanel" aria-labelledby="users-tab">
                    <h2 class="mb-4" style="font-weight: 800;">Registered Platform Users</h2>
                    
                    <div class="white-panel p-4 p-md-5">
                        <div class="table-responsive">
                            <table class="table align-middle border-0" style="background: transparent;">
                                <thead>
                                    <tr class="text-muted" style="border-bottom: 1.5px solid var(--border-color);">
                                        <th scope="col" class="pb-3 border-0">USER ID</th>
                                        <th scope="col" class="pb-3 border-0">NAME</th>
                                        <th scope="col" class="pb-3 border-0">EMAIL ADDRESS</th>
                                        <th scope="col" class="pb-3 border-0">ROLE</th>
                                        <th scope="col" class="pb-3 border-0 text-end">REGISTERED DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr style="border-bottom: 1px solid var(--border-color);">
                                            <td class="py-3 fw-bold border-0">#USR-{{ $user->id + 1000 }}</td>
                                            <td class="border-0 fw-bold">{{ $user->name }}</td>
                                            <td class="border-0">{{ $user->email }}</td>
                                            <td class="border-0">
                                                @if ($user->is_admin)
                                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">Administrator</span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">Client / Customer</span>
                                                @endif
                                            </td>
                                            <td class="border-0 text-end text-muted">{{ $user->created_at->format('d M, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 3. PRODUCTS CATALOG PANE -->
                <div class="tab-pane fade" id="products-pane" role="tabpanel" aria-labelledby="products-tab">
                    <div class="row g-5">
                        <!-- Add Product Form -->
                        <div class="col-lg-6">
                            <div class="white-panel p-4 p-md-5">
                                <h3 class="mb-4 fw-extrabold" style="font-weight: 800;"><i class="bi bi-plus-circle text-danger me-2"></i>Publish Digital Product</h3>
                                
                                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group-creative">
                                                <label for="name" class="form-label-creative">PRODUCT NAME</label>
                                                <input id="name" type="text" name="name" class="form-control form-control-creative" placeholder="e.g. Zenith UI Component Pack" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group-creative">
                                                <label for="price" class="form-label-creative">PRICE (USD)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-end-0" style="border: 1.5px solid var(--border-color); border-radius: 10px 0 0 10px; color: var(--text-muted);">$</span>
                                                    <input id="price" type="number" step="0.01" min="0" name="price" class="form-control form-control-creative border-start-0" placeholder="49.00" style="border-radius: 0 10px 10px 0;" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="category" class="form-label-creative">CATEGORY</label>
                                                <select id="category" name="category" class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;" required>
                                                    <option value="UI Templates">UI Templates</option>
                                                    <option value="UI Components">UI Components</option>
                                                    <option value="Graphics & Vectors">Graphics & Vectors</option>
                                                    <option value="Code Scripts">Code Scripts</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="preview_image" class="form-label-creative">PREVIEW IMAGE</label>
                                                <input id="preview_image" type="file" name="preview_image" class="form-control" style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-creative">
                                        <label for="download_file" class="form-label-creative">ZIP FILE PACKAGE (OPTIONAL)</label>
                                        <input id="download_file" type="file" name="download_file" class="form-control" style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" accept=".zip,.rar,.tar">
                                    </div>

                                    <div class="form-group-creative">
                                        <label for="description" class="form-label-creative">DESCRIPTION</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Describe the product details..." style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.9rem;" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-creative w-100 py-3 mt-2">
                                        <i class="bi bi-check2-circle me-1"></i> Save and Publish Product
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Product Catalog Table List -->
                        <div class="col-lg-6">
                            <div class="white-panel p-4 p-md-5">
                                <h3 class="mb-4" style="font-weight: 800;"><i class="bi bi-journal-bookmark text-danger me-2"></i>Product Catalog Listing</h3>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle border-0" style="background: transparent;">
                                        <thead>
                                            <tr class="text-muted" style="border-bottom: 1.5px solid var(--border-color);">
                                                <th scope="col" class="pb-3 border-0">NAME</th>
                                                <th scope="col" class="pb-3 border-0">CATEGORY</th>
                                                <th scope="col" class="pb-3 border-0 text-end">PRICE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product)
                                                <tr style="border-bottom: 1px solid var(--border-color);">
                                                    <td class="py-3 fw-bold border-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="bi bi-file-earmark-arrow-up text-danger"></i>
                                                            <span>{{ $product->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="border-0">
                                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1" style="font-size: 0.7rem;">{{ $product->category }}</span>
                                                    </td>
                                                    <td class="border-0 text-end fw-bold text-dark">₹{{ number_format($product->price, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4 text-muted border-0">
                                                        No assets in the catalog yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. TRANSACTIONS MANAGEMENT PANE -->
                <div class="tab-pane fade" id="transactions-pane" role="tabpanel" aria-labelledby="transactions-tab">
                    <h2 class="mb-4" style="font-weight: 800;">Platform Sales Registry</h2>
                    
                    <div class="white-panel p-4 p-md-5">
                        <div class="table-responsive">
                            <table class="table align-middle border-0" style="background: transparent;">
                                <thead>
                                    <tr class="text-muted" style="border-bottom: 1.5px solid var(--border-color);">
                                        <th scope="col" class="pb-3 border-0">ORDER ID</th>
                                        <th scope="col" class="pb-3 border-0">CUSTOMER</th>
                                        <th scope="col" class="pb-3 border-0">EMAIL</th>
                                        <th scope="col" class="pb-3 border-0">PRODUCT ACQUIRED</th>
                                        <th scope="col" class="pb-3 border-0">PURCHASE DATE</th>
                                        <th scope="col" class="pb-3 border-0 text-end">PRICE PAID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr style="border-bottom: 1px solid var(--border-color);">
                                            <td class="py-3 fw-bold border-0">#WMP-{{ $transaction->id + 4890 }}</td>
                                            <td class="border-0 fw-bold">{{ $transaction->user->name }}</td>
                                            <td class="border-0">{{ $transaction->user->email }}</td>
                                            <td class="border-0">{{ $transaction->product->name }}</td>
                                            <td class="border-0 text-muted">{{ $transaction->created_at->format('d M, Y • H:i') }}</td>
                                            <td class="border-0 text-end fw-bold text-danger">₹{{ number_format($transaction->price_paid, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted border-0">
                                                <i class="bi bi-wallet-fill display-4 d-block mb-2"></i>
                                                No customer purchases have been recorded in the platform ledger.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                <!-- 5. SUPPORT INBOX PANE -->
                <div class="tab-pane fade" id="support-pane" role="tabpanel" aria-labelledby="support-tab">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                        <div>
                            <h2 class="mb-1" style="font-weight: 800;">Customer Inquiries Desk</h2>
                            <p class="text-muted mb-0">Respond to customer issues and log internal technical notes.</p>
                        </div>
                        
                        <!-- Queue Filter Buttons -->
                        <div class="d-flex gap-2">
                            <button id="btn-filter-all" class="btn btn-creative filter-btn btn-sm py-2 px-3" onclick="filterTickets('all')">All Tickets</button>
                            <button id="btn-filter-open" class="btn btn-creative-outline filter-btn btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);" onclick="filterTickets('open')">Open Desk</button>
                            <button id="btn-filter-resolved" class="btn btn-creative-outline filter-btn btn-sm py-2 px-3" style="border-color: var(--border-color); color: var(--color-dark);" onclick="filterTickets('resolved')">Resolved Logs</button>
                        </div>
                    </div>
                    
                    <div class="white-panel p-4 p-md-5">
                        <div class="activity-feed">
                            @forelse ($tickets as $ticket)
                                <!-- Ticket Card with status filter classes -->
                                <div class="admin-ticket-card status-{{ $ticket->status }} p-4 border rounded-4 mb-4 bg-light bg-opacity-25" style="border-color: var(--border-color) !important;">
                                    
                                    <!-- Header Info -->
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge rounded-pill px-3 py-1.5 text-uppercase" style="font-size: 0.65rem; background: {{ $ticket->priority == 'urgent' ? '#E53935' : ($ticket->priority == 'high' ? '#ff9100' : ($ticket->priority == 'medium' ? '#1e88e5' : '#757575')) }}; color: #fff; font-family: var(--font-brand); font-weight: 700;">
                                                {{ $ticket->priority }} Priority
                                            </span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1.5" style="font-size: 0.65rem; font-family: var(--font-brand); font-weight: 700; text-transform: uppercase;">
                                                Topic: {{ $ticket->topic }}
                                            </span>
                                        </div>
                                        <div>
                                            @if ($ticket->status == 'open')
                                                <span class="badge bg-danger text-white rounded-pill px-3 py-1.5" style="font-size: 0.65rem; font-weight: 700;">Open Desk</span>
                                            @else
                                                <span class="badge bg-success text-white rounded-pill px-3 py-1.5" style="font-size: 0.65rem; font-weight: 700;">Resolved</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Customer Profile Context -->
                                    <div class="p-3 bg-white border rounded-3 mb-3" style="border-color: var(--border-color) !important;">
                                        <div class="row align-items-center g-2">
                                            <div class="col-sm-6">
                                                <small class="text-muted d-block">CUSTOMER ACCOUNT</small>
                                                <h6 class="mb-0 fw-bold text-dark">{{ $ticket->user->name }} ({{ $ticket->user->email }})</h6>
                                            </div>
                                            <div class="col-sm-6 text-sm-end">
                                                <small class="text-muted d-block">STORE SPEND CONTEXT</small>
                                                <span class="badge bg-warning text-dark fw-bold" style="font-family: var(--font-brand); font-size: 0.75rem;">
                                                    ★ Spend: ₹{{ number_format($ticket->user->purchasedProducts->sum('price'), 2) }} ({{ $ticket->user->purchasedProducts->count() }} items)
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conversational Message Thread -->
                                    <div class="border rounded-3 p-3 bg-white mb-3" style="max-height: 300px; overflow-y: auto; display: flex; flex-direction: column; gap: 0.75rem;">
                                        @foreach ($ticket->messages as $msg)
                                            <div class="d-flex flex-column {{ $msg->user_id == Auth::id() ? 'align-items-end' : 'align-items-start' }}">
                                                <div class="p-2.5 rounded-3 text-dark small" style="max-width: 80%; background: {{ $msg->user_id == Auth::id() ? '#ffebee' : '#f5f5f5' }}; border: 1.5px solid {{ $msg->user_id == Auth::id() ? '#ffcdd2' : '#e0e0e0' }};">
                                                    <small class="fw-bold d-block text-muted" style="font-size: 0.65rem;">
                                                        {{ $msg->user_id == Auth::id() ? 'You (WMP Support)' : $msg->user->name }}
                                                    </small>
                                                    <p class="mb-0 mt-0.5" style="line-height: 1.45;">{{ $msg->message }}</p>
                                                </div>
                                                <span class="text-muted mt-0.5" style="font-size: 0.6rem;">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Reply and Note Workspace Row -->
                                    <div class="row g-3">
                                        <!-- Reply Form Column -->
                                        <div class="col-md-7 border-end-md">
                                            <form method="POST" action="{{ route('tickets.messages.store', $ticket->id) }}">
                                                @csrf
                                                <div class="mb-2">
                                                    <label class="form-label-creative">SEND CONVERSATION REPLY</label>
                                                    <textarea name="message" class="form-control" rows="2" placeholder="Send reply message to customer..." style="border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-creative btn-sm py-2 px-3 text-white">
                                                    <i class="bi sm bi-send-fill me-1"></i> Send Reply
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- Internal Notes Column -->
                                        <div class="col-md-5">
                                            <form method="POST" action="{{ route('admin.tickets.note', $ticket->id) }}">
                                                @csrf
                                                <div class="mb-2">
                                                    <label class="form-label-creative text-danger"><i class="bi bi-pin-angle-fill me-1"></i>INTERNAL ADMIN NOTES (HIDDEN)</label>
                                                    <textarea name="internal_note" class="form-control" rows="2" placeholder="Private staff notes on checkout or zip errors..." style="border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.85rem; background: #fffde7; border-color: #fff59d !important;">{{ $ticket->internal_note }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-outline-secondary btn-sm py-2 px-3" style="border-radius: 8px;">
                                                    <i class="bi bi-save me-1"></i> Save Note
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-envelope-open-fill display-4 d-block mb-2 text-secondary"></i>
                                    Customer help desk is empty. No inquiries have been logged.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- 5.5. BLOGS MANAGER PANE -->
                <div class="tab-pane fade" id="blogs-pane" role="tabpanel" aria-labelledby="blogs-tab">
                    <div class="row g-5">
                        <!-- Left Column: Manage Categories & Subcategories -->
                        <div class="col-lg-5">
                            <!-- Category Creation Card -->
                            <div class="white-panel p-4 mb-4">
                                <h4 class="mb-4 fw-extrabold" style="font-weight: 800;"><i class="bi bi-tag text-danger me-2"></i>Create Blog Category</h4>
                                <form method="POST" action="{{ route('admin.blogs.categories.store') }}">
                                    @csrf
                                    <div class="form-group-creative">
                                        <label for="cat_name" class="form-label-creative">CATEGORY NAME</label>
                                        <input id="cat_name" type="text" name="name" class="form-control form-control-creative" placeholder="e.g. Technology, Design, SEO" required>
                                    </div>
                                    <button type="submit" class="btn btn-creative btn-sm py-2 px-3 w-100">
                                        <i class="bi bi-plus-circle me-1"></i> Add Category
                                    </button>
                                </form>
                            </div>

                            <!-- Subcategory Creation Card -->
                            <div class="white-panel p-4 mb-4">
                                <h4 class="mb-4 fw-extrabold" style="font-weight: 800;"><i class="bi bi-tags text-danger me-2"></i>Create Blog Subcategory</h4>
                                <form method="POST" action="{{ route('admin.blogs.subcategories.store') }}">
                                    @csrf
                                    <div class="form-group-creative">
                                        <label for="parent_category" class="form-label-creative">PARENT CATEGORY</label>
                                        <select id="parent_category" name="category_id" class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;" required>
                                            <option value="" disabled selected>Select Parent Category</option>
                                            @foreach ($blogCategories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group-creative">
                                        <label for="sub_name" class="form-label-creative">SUBCATEGORY NAME</label>
                                        <input id="sub_name" type="text" name="name" class="form-control form-control-creative" placeholder="e.g. Laravel Guides, Poster Tips" required>
                                    </div>
                                    <button type="submit" class="btn btn-creative btn-sm py-2 px-3 w-100">
                                        <i class="bi bi-plus-circle me-1"></i> Add Subcategory
                                    </button>
                                </form>
                            </div>

                            <!-- Categories and Subcategories Registry Table -->
                            <div class="white-panel p-4">
                                <h4 class="mb-4 fw-bold" style="font-family: var(--font-brand);"><i class="bi bi-list-nested text-danger me-2"></i>Categories Registry</h4>
                                
                                <div class="mb-4">
                                    <h6 class="text-muted fw-bold border-bottom pb-2" style="font-size: 0.75rem;">CATEGORIES</h6>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-sm">
                                            <thead>
                                                <tr class="text-muted" style="font-size: 0.75rem;">
                                                    <th>NAME</th>
                                                    <th class="text-end">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($blogCategories as $cat)
                                                    <tr>
                                                        <td><strong>{{ $cat->name }}</strong></td>
                                                        <td class="text-end">
                                                            <form method="POST" action="{{ route('admin.blogs.categories.destroy', $cat->id) }}" onsubmit="return confirm('Deleting this category will set nested blog posts categories to NULL. Continue?')" class="mb-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="2" class="text-center text-muted py-2" style="font-size: 0.8rem;">No categories.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div>
                                    <h6 class="text-muted fw-bold border-bottom pb-2" style="font-size: 0.75rem;">SUBCATEGORIES</h6>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-sm">
                                            <thead>
                                                <tr class="text-muted" style="font-size: 0.75rem;">
                                                    <th>NAME</th>
                                                    <th>PARENT</th>
                                                    <th class="text-end">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($blogSubcategories as $sub)
                                                    <tr>
                                                        <td>{{ $sub->name }}</td>
                                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size: 0.65rem;">{{ $sub->category->name }}</span></td>
                                                        <td class="text-end">
                                                            <form method="POST" action="{{ route('admin.blogs.subcategories.destroy', $sub->id) }}" onsubmit="return confirm('Delete subcategory?')" class="mb-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="3" class="text-center text-muted py-2" style="font-size: 0.8rem;">No subcategories.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Publish Blog Post & Blog posts table -->
                        <div class="col-lg-7">
                            <div class="white-panel p-4 p-md-5 mb-4">
                                <h3 class="mb-4 fw-extrabold" style="font-weight: 800;"><i class="bi bi-pencil-square text-danger me-2"></i>Publish Blog Article</h3>
                                
                                <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group-creative">
                                        <label for="blog_title" class="form-label-creative">ARTICLE TITLE</label>
                                        <input id="blog_title" type="text" name="title" class="form-control form-control-creative" placeholder="e.g. 10 Best Practices in Tailwind CSS Layouts" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="blog_category" class="form-label-creative">CATEGORY</label>
                                                <select id="blog_category" name="category_id" class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;">
                                                    <option value="" selected>None (Uncategorized)</option>
                                                    @foreach ($blogCategories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="blog_subcategory" class="form-label-creative">SUBCATEGORY</label>
                                                <select id="blog_subcategory" name="subcategory_id" class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;">
                                                    <option value="" selected>None</option>
                                                    @foreach ($blogSubcategories as $sub)
                                                        <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}">{{ $sub->name }} ({{ $sub->category->name }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="blog_image" class="form-label-creative">PREVIEW IMAGE</label>
                                                <input id="blog_image" type="file" name="preview_image" class="form-control" style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-creative">
                                                <label for="blog_author" class="form-label-creative">AUTHOR NAME</label>
                                                <input id="blog_author" type="text" name="author" class="form-control form-control-creative" placeholder="e.g. WMP Admin" value="WMP Admin">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-creative">
                                        <label for="blog_content" class="form-label-creative">ARTICLE CONTENT</label>
                                        <textarea id="blog_content" name="content" class="form-control" rows="8" placeholder="Write full article body text..." style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.9rem;" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-creative w-100 py-3 mt-2">
                                        <i class="bi bi-send-fill me-1"></i> Save and Publish Article
                                    </button>
                                </form>
                            </div>

                            <!-- Blogs Listing Table Card -->
                            <div class="white-panel p-4 p-md-5">
                                <h3 class="mb-4" style="font-weight: 800;"><i class="bi bi-journal-bookmark text-danger me-2"></i>Published Articles</h3>
                                
                                <div class="table-responsive">
                                    <table class="table align-middle border-0" style="background: transparent;">
                                        <thead>
                                            <tr class="text-muted" style="border-bottom: 1.5px solid var(--border-color);">
                                                <th scope="col" class="pb-3 border-0">TITLE</th>
                                                <th scope="col" class="pb-3 border-0">CATEGORY</th>
                                                <th scope="col" class="pb-3 border-0 text-end">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($blogs as $post)
                                                <tr style="border-bottom: 1px solid var(--border-color);">
                                                    <td class="py-3 fw-bold border-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="bi bi-file-text text-danger"></i>
                                                            <span>{{ $post->title }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="border-0">
                                                        @if ($post->category)
                                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1" style="font-size: 0.7rem;">{{ $post->category->name }}</span>
                                                        @else
                                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-2 py-1" style="font-size: 0.7rem;">Uncategorized</span>
                                                        @endif
                                                    </td>
                                                    <td class="border-0 text-end">
                                                        <form method="POST" action="{{ route('admin.blogs.destroy', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this blog post?')" class="mb-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1" style="border-radius: 6px;">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4 text-muted border-0">
                                                        No blog articles published yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. SYSTEM SETTINGS PANE -->
                <div class="tab-pane fade" id="settings-pane" role="tabpanel" aria-labelledby="settings-tab">
                    <h2 class="mb-4" style="font-weight: 800;">System Platform Settings</h2>
                    
                    <div class="white-panel p-4 p-md-5 mb-4" style="max-width: 700px;">
                        <h5 class="mb-4 text-danger fw-bold border-bottom pb-2" style="font-family: var(--font-brand);">Brand Identity</h5>
                        
                        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Logo Preview and Upload Workspace -->
                            <div class="mb-4 p-3 border rounded-3 bg-light bg-opacity-25" style="border-color: var(--border-color) !important;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="p-2 bg-white rounded border d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        @php
                                            $logoPath = public_path('images/logo.png');
                                            $logoVer = file_exists($logoPath) ? filemtime($logoPath) : time();
                                        @endphp
                                        <img src="{{ asset('images/logo.png') }}?v={{ $logoVer }}" alt="Current Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark">Current Platform Logo</h6>
                                        <small class="text-muted d-block">Overwrites the file used across the storefront, auth views, and client dash.</small>
                                    </div>
                                </div>
                                
                                <div class="form-group-creative mb-0">
                                    <label for="logo" class="form-label-creative">SELECT NEW LOGO IMAGE</label>
                                    <input id="logo" type="file" name="logo" class="form-control" style="border-radius: 10px; border: 1.5px solid var(--border-color); font-size: 0.85rem;" accept="image/png, image/jpeg, image/jpg, image/svg+xml" required>
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Supports PNG, JPG, or SVG (transparent background recommended, max 2MB).</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-creative py-3 px-4">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Upload and Apply Logo
                            </button>
                        </form>
                    </div>

                    <div class="white-panel p-4 p-md-5" style="max-width: 700px;">
                        <form onsubmit="event.preventDefault(); alert('System configurations saved successfully!');">
                            <h5 class="mb-4 text-danger fw-bold border-bottom pb-2" style="font-family: var(--font-brand);">Store Configuration (Read-only Preview)</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-creative">PLATFORM SITE NAME</label>
                                    <input type="text" class="form-control form-control-creative" value="WMP Creative Assets Store" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-creative">SUPPORT DESK EMAIL</label>
                                    <input type="email" class="form-control form-control-creative" value="support@wmpcreativeagency.com" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-creative">STORE CURRENCY</label>
                                    <select class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;" disabled>
                                        <option value="USD" selected>USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="GBP">GBP (£)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label-creative">PAYMENT METHOD ENVIRONMENT</label>
                                    <select class="form-select" style="border-radius: 10px; border: 1.5px solid var(--border-color); padding: 0.8rem 1.1rem; font-size: 0.9rem;" disabled>
                                        <option value="sandbox" selected>Sandbox Mode (Test Checkouts)</option>
                                        <option value="live">Live Checkout Environment</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3 text-danger fw-bold border-bottom pb-2" style="font-family: var(--font-brand);">Gateway API Credentials</h5>
                            
                            <div class="mb-3">
                                <label class="form-label-creative">STRIPE PUBLISHABLE KEY</label>
                                <input type="text" class="form-control form-control-creative" value="pk_test_51NxWMPCreativeMockKey0001890" style="font-family: monospace;" disabled>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label-creative">STRIPE SECRET API KEY</label>
                                <input type="password" class="form-control form-control-creative" value="sk_test_51NxWMPCreativeMockSecretKey" style="font-family: monospace;" disabled>
                            </div>

                            <button type="submit" class="btn btn-creative py-3 px-4" disabled>
                                <i class="bi bi-save-fill me-1"></i> Save Configurations
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function filterTickets(status) {
    document.querySelectorAll('.admin-ticket-card').forEach(card => {
        if (status === 'all') {
            card.style.display = 'block';
        } else {
            card.style.display = card.classList.contains('status-' + status) ? 'block' : 'none';
        }
    });
    
    // Toggle active classes on filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('btn-creative');
        btn.classList.add('btn-creative-outline');
        btn.style.color = 'var(--color-dark)';
        btn.style.borderColor = 'var(--border-color)';
    });
    
    const activeBtn = document.getElementById('btn-filter-' + status);
    activeBtn.classList.remove('btn-creative-outline');
    activeBtn.classList.add('btn-creative');
    activeBtn.style.color = '#fff';
    activeBtn.style.borderColor = 'var(--color-primary)';
}

document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    if (tab) {
        const tabTrigger = document.getElementById(tab + '-tab');
        if (tabTrigger) {
            // Activate the tab
            const tabInstance = new bootstrap.Tab(tabTrigger);
            tabInstance.show();
        }
    }
});
</script>
@endsection




