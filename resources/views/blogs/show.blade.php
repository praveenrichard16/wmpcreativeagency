@extends('layouts.app')

@section('title', $blog->title)

@section('content')
@include('layouts.header')

<!-- Blog Header Section -->
<div class="bg-white border-bottom border-light py-5">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <!-- Breadcrumbs & Category -->
                <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                    <a href="{{ route('blogs.index') }}" class="text-decoration-none text-muted small hover-color-primary">Journal</a>
                    <span class="text-muted small">&rsaquo;</span>
                    @if ($blog->category)
                        <a href="{{ route('blogs.category', $blog->category->slug) }}" class="text-decoration-none text-danger small fw-bold hover-color-primary">{{ $blog->category->name }}</a>
                    @endif
                    @if ($blog->subcategory)
                        <span class="text-muted small">&rsaquo;</span>
                        <a href="{{ route('blogs.subcategory', $blog->subcategory->slug) }}" class="text-decoration-none text-secondary small hover-color-primary">{{ $blog->subcategory->name }}</a>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="display-5 mb-4 fw-extrabold" style="font-weight: 800; line-height: 1.25; color: var(--color-dark);">
                    {{ $blog->title }}
                </h1>

                <!-- Meta Info -->
                <div class="d-flex align-items-center gap-3 border-top border-bottom border-light py-3 text-muted" style="font-size: 0.85rem;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center text-danger" style="width: 36px; height: 36px; font-weight: 700;">
                            {{ strtoupper(substr($blog->author, 0, 1)) }}
                        </div>
                        <div>
                            <span class="d-block text-dark fw-bold" style="line-height: 1.2;">{{ $blog->author }}</span>
                            <small class="text-muted" style="font-size: 0.75rem;">Author</small>
                        </div>
                    </div>
                    
                    <div class="vr" style="height: 25px; opacity: 0.15;"></div>
                    
                    <div>
                        <span class="d-block text-dark fw-bold" style="line-height: 1.2;">{{ $blog->created_at->format('F d, Y') }}</span>
                        <small class="text-muted" style="font-size: 0.75rem;">Published Date</small>
                    </div>

                    <div class="vr" style="height: 25px; opacity: 0.15;"></div>

                    <div>
                        <span class="d-block text-dark fw-bold" style="line-height: 1.2;">
                            {{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min
                        </span>
                        <small class="text-muted" style="font-size: 0.75rem;">Read Time</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Content Body & Sidebar -->
<div class="container py-5 my-3">
    <div class="row g-5">
        <!-- Article Main Content Column -->
        <div class="col-lg-8">
            <article class="bg-white p-4 p-md-5 rounded-4 border border-light shadow-sm">
                <!-- Blog Main Preview Image -->
                @if ($blog->preview_image)
                    <div class="rounded-4 mb-5 overflow-hidden border" style="max-height: 450px; background: var(--color-light);">
                        <img src="{{ asset($blog->preview_image) }}" alt="{{ $blog->title }}" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                @endif

                <!-- Content Body -->
                <div class="blog-content text-dark" style="font-size: 1.1rem; line-height: 1.85; font-family: var(--font-body);">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <!-- Footer Tags/Shares -->
                <div class="mt-5 pt-4 border-top border-light d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-bookmark-fill text-danger"></i>
                        <span class="text-muted small">Filed under:</span>
                        @if ($blog->category)
                            <a href="{{ route('blogs.category', $blog->category->slug) }}" class="badge bg-danger bg-opacity-10 text-danger text-decoration-none px-3 py-2" style="border-radius: 8px;">{{ $blog->category->name }}</a>
                        @endif
                        @if ($blog->subcategory)
                            <a href="{{ route('blogs.subcategory', $blog->subcategory->slug) }}" class="badge bg-secondary bg-opacity-10 text-secondary text-decoration-none px-3 py-2" style="border-radius: 8px;">{{ $blog->subcategory->name }}</a>
                        @endif
                    </div>
                    
                    <div>
                        <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2" style="border-radius: 8px;">
                            <i class="bi bi-arrow-left me-1"></i> Back to Journal
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <!-- Categories Widget -->
            <div class="white-panel p-4 mb-4">
                <h4 class="h5 mb-4 fw-bold border-bottom pb-2" style="font-family: var(--font-brand);"><i class="bi bi-folder2-open text-danger me-2"></i>Categories</h4>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('blogs.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center py-2 px-3 rounded-3 text-dark hover-color-primary" style="font-size: 0.9rem; transition: var(--transition-smooth);">
                        <span>All Categories</span>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Total</span>
                    </a>
                    
                    @foreach ($categories as $cat)
                        <div class="mb-1">
                            <a href="{{ route('blogs.category', $cat->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center py-2 px-3 rounded-3 {{ $blog->category_id == $cat->id ? 'bg-danger bg-opacity-10 text-danger fw-bold' : 'text-dark hover-color-primary' }}" style="font-size: 0.9rem; transition: var(--transition-smooth);">
                                <span><i class="bi bi-tag text-danger me-2"></i>{{ $cat->name }}</span>
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">{{ $cat->blogs()->count() }}</span>
                            </a>
                            
                            @if ($cat->subcategories->count() > 0)
                                <div class="ms-4 pl-3 border-start d-flex flex-column gap-1 mt-1" style="border-color: var(--border-color) !important; padding-left: 0.75rem;">
                                    @foreach ($cat->subcategories as $sub)
                                        <a href="{{ route('blogs.subcategory', $sub->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center py-1 px-2 rounded-2 {{ $blog->subcategory_id == $sub->id ? 'bg-danger bg-opacity-10 text-danger fw-bold' : 'text-muted hover-color-primary' }}" style="font-size: 0.8rem; transition: var(--transition-smooth);">
                                            <span>&rsaquo; {{ $sub->name }}</span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill" style="font-size: 0.65rem;">{{ $sub->blogs()->count() }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
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
