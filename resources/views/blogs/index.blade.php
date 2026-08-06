@extends('layouts.app')

@section('title', 'WMP Creative Blogs')

@section('content')
@include('layouts.header')

<!-- Blogs Hero Banner -->
<div class="bg-white border-bottom border-light py-5">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge rounded-pill mb-3 px-3 py-2" style="background: rgba(229, 57, 53, 0.08); color: var(--color-primary); font-family: var(--font-brand); font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">Insights & Articles</span>
                <h1 class="display-5 mb-3" style="font-weight: 800; line-height: 1.15;">
                    The <span class="text-gradient-red">WMP Creative</span> Journal
                </h1>
                <p class="text-muted fs-5 mb-0" style="line-height: 1.6; max-width: 700px;">
                    Explore specialized guides, creative design trends, technical walk-throughs, and digital growth marketing strategies compiled by our expert agency team.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main Blogs Content -->
<div class="container py-5 my-3">
    <div class="row g-5">
        <!-- Blogs Grid Column -->
        <div class="col-lg-8">
            <!-- Search & Active Filters Bar -->
            <div class="mb-4">
                <form action="{{ route('blogs.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" style="border: 1.5px solid var(--border-color); border-radius: 10px 0 0 10px; color: var(--text-muted);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search articles, tutorials, guides..." value="{{ request('search') }}" style="border: 1.5px solid var(--border-color); border-radius: 0 10px 10px 0; font-size: 0.95rem; padding: 0.75rem 1rem; box-shadow: none;">
                    </div>
                    @if (request('search') || isset($activeCategory) || isset($activeSubcategory))
                        <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary d-flex align-items-center px-3" style="border-radius: 10px; border: 1.5px solid var(--border-color);">
                            Clear
                        </a>
                    @endif
                    <button type="submit" class="btn btn-creative px-4" style="border-radius: 10px;">Search</button>
                </form>

                <!-- Active Filter Alert -->
                @if (isset($activeCategory))
                    <div class="alert alert-danger border-0 mt-3 d-flex align-items-center justify-content-between py-2 px-3 rounded-3" style="background: rgba(229, 57, 53, 0.06); color: var(--color-primary);">
                        <span class="small fw-bold"><i class="bi bi-tag-fill me-2"></i>Category: {{ $activeCategory->name }}</span>
                        <a href="{{ route('blogs.index') }}" class="text-danger text-decoration-none small fw-bold">✕ Remove Filter</a>
                    </div>
                @elseif (isset($activeSubcategory))
                    <div class="alert alert-danger border-0 mt-3 d-flex align-items-center justify-content-between py-2 px-3 rounded-3" style="background: rgba(229, 57, 53, 0.06); color: var(--color-primary);">
                        <span class="small fw-bold"><i class="bi bi-tags-fill me-2"></i>Subcategory: {{ $activeSubcategory->category->name }} &rsaquo; {{ $activeSubcategory->name }}</span>
                        <a href="{{ route('blogs.index') }}" class="text-danger text-decoration-none small fw-bold">✕ Remove Filter</a>
                    </div>
                @endif
            </div>

            <!-- Blogs Card Grid -->
            <div class="row g-4">
                @forelse ($blogs as $blog)
                    <div class="col-md-6">
                        <article class="store-card h-100 d-flex flex-column">
                            <div class="store-card-img-wrapper" style="height: 180px;">
                                @if ($blog->preview_image)
                                    <img src="{{ asset($blog->preview_image) }}" alt="{{ $blog->title }}" class="store-card-img">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted" style="font-size: 3rem;">
                                        <i class="bi bi-journal-text text-danger opacity-25"></i>
                                    </div>
                                @endif
                                @if ($blog->category)
                                    <div class="position-absolute" style="top: 12px; left: 12px;">
                                        <span class="store-card-category" style="font-size: 0.65rem;">{{ $blog->category->name }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2 text-muted" style="font-size: 0.75rem;">
                                    <span><i class="bi bi-person me-1"></i>{{ $blog->author }}</span>
                                    <span>&bull;</span>
                                    <span><i class="bi bi-calendar-event me-1"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                </div>
                                
                                <h4 class="h5 mb-2 fw-bold text-dark hover-color-primary" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.8rem;">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark hover-color-primary">
                                        {{ $blog->title }}
                                    </a>
                                </h4>
                                
                                <p class="text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 3.6rem; line-height: 1.6;">
                                    {{ strip_tags($blog->content) }}
                                </p>
                                
                                <div class="mt-auto pt-3 border-top border-light d-flex justify-content-between align-items-center">
                                    @if ($blog->subcategory)
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size: 0.65rem; font-weight: 700;">{{ $blog->subcategory->name }}</span>
                                    @else
                                        <span></span>
                                    @endif
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-danger fw-bold text-decoration-none small d-flex align-items-center gap-1 hover-link">
                                        Read Article <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="p-5 rounded-4 bg-white border border-light shadow-sm">
                            <i class="bi bi-journal-x text-danger display-3 d-block mb-3 opacity-50"></i>
                            <h3 class="fw-bold text-dark">No Articles Published</h3>
                            <p class="text-muted mb-0">We haven't posted any articles matching your search yet. Check back soon!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <!-- Categories Widget -->
            <div class="white-panel p-4 mb-4">
                <h4 class="h5 mb-4 fw-bold border-bottom pb-2" style="font-family: var(--font-brand);"><i class="bi bi-folder2-open text-danger me-2"></i>Categories</h4>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('blogs.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center py-2 px-3 rounded-3 {{ !isset($activeCategory) && !isset($activeSubcategory) ? 'bg-danger bg-opacity-10 text-danger fw-bold' : 'text-dark hover-color-primary' }}" style="font-size: 0.9rem; transition: var(--transition-smooth);">
                        <span>All Categories</span>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Total</span>
                    </a>
                    
                    @foreach ($categories as $cat)
                        @if($cat->blogs_count ?? $cat->blogs()->count() > 0 || true)
                            <div class="mb-1">
                                <a href="{{ route('blogs.category', $cat->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center py-2 px-3 rounded-3 {{ isset($activeCategory) && $activeCategory->id == $cat->id ? 'bg-danger bg-opacity-10 text-danger fw-bold' : 'text-dark hover-color-primary' }}" style="font-size: 0.9rem; transition: var(--transition-smooth);">
                                    <span><i class="bi bi-tag text-danger me-2"></i>{{ $cat->name }}</span>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">{{ $cat->blogs()->count() }}</span>
                                </a>
                                
                                <!-- Render Subcategories if any -->
                                @if ($cat->subcategories->count() > 0)
                                    <div class="ms-4 pl-3 border-start d-flex flex-column gap-1 mt-1" style="border-color: var(--border-color) !important; padding-left: 0.75rem;">
                                        @foreach ($cat->subcategories as $sub)
                                            <a href="{{ route('blogs.subcategory', $sub->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center py-1 px-2 rounded-2 {{ isset($activeSubcategory) && $activeSubcategory->id == $sub->id ? 'bg-danger bg-opacity-10 text-danger fw-bold' : 'text-muted hover-color-primary' }}" style="font-size: 0.8rem; transition: var(--transition-smooth);">
                                                <span>&rsaquo; {{ $sub->name }}</span>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill" style="font-size: 0.65rem;">{{ $sub->blogs()->count() }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Recent Posts Widget -->
            <div class="white-panel p-4">
                <h4 class="h5 mb-4 fw-bold border-bottom pb-2" style="font-family: var(--font-brand);"><i class="bi bi-clock-history text-danger me-2"></i>Recent Articles</h4>
                <div class="d-flex flex-column gap-3">
                    @forelse ($recentBlogs->take(4) as $recent)
                        <div class="d-flex gap-3 align-items-center">
                            <div class="flex-shrink-0 rounded bg-light border" style="width: 65px; height: 50px; overflow: hidden;">
                                @if ($recent->preview_image)
                                    <img src="{{ asset($recent->preview_image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-danger opacity-50" style="font-size: 1.25rem;">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                @endif
                            </div>
                            <div style="min-width: 0;">
                                <h6 class="mb-0 text-truncate fw-bold" style="font-size: 0.85rem;">
                                    <a href="{{ route('blogs.show', $recent->slug) }}" class="text-decoration-none text-dark hover-color-primary">
                                        {{ $recent->title }}
                                    </a>
                                </h6>
                                <small class="text-muted" style="font-size: 0.7rem;">{{ $recent->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0 text-center py-2">No recent posts.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
