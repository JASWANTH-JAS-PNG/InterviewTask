@extends('layouts.app')

@section('title', $blog->title . ' - BlogHub')

@section('content')
<div class="container py-5">
    <div class="row">

        {{-- Main Content --}}
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb" style="font-size:.88rem;">
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}" style="color:var(--primary);">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('blogs.index') }}?category={{ $blog->category->slug }}" style="color:var(--primary);">
                            {{ $blog->category->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-truncate" style="max-width:200px;">{{ $blog->title }}</li>
                </ol>
            </nav>

            <article>
                <span class="card-category mb-3 d-inline-block">{{ $blog->category->name }}</span>
                <h1 style="font-size:2rem;font-weight:700;line-height:1.3;margin-bottom:1rem;">{{ $blog->title }}</h1>

                <div class="d-flex align-items-center gap-3 mb-4" style="color:var(--text-muted);font-size:.88rem;">
                    <span><i class="fas fa-calendar-alt me-1"></i>{{ $blog->published_at->format('F d, Y') }}</span>
                    <span><i class="fas fa-folder me-1"></i>{{ $blog->category->name }}</span>
                </div>

                @if($blog->image)
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="blog-detail-img">
                @endif

                <div class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>
            </article>

            {{-- Back button --}}
            <div class="mt-5">
                <a href="{{ route('blogs.index') }}" class="btn" style="background:var(--primary);color:#fff;border-radius:50px;padding:.6rem 1.5rem;font-weight:600;">
                    <i class="fas fa-arrow-left me-2"></i>Back to Blogs
                </a>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4 mt-5 mt-lg-0">
            @if($related->count())
            <div class="filter-card">
                <h5><i class="fas fa-layer-group me-2" style="color:var(--primary)"></i>Related Posts</h5>
                @foreach($related as $r)
                <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                    <img src="{{ $r->image_url }}" alt="{{ $r->title }}"
                         style="width:70px;height:60px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                    <div>
                        <a href="{{ route('blogs.show', $r->slug) }}"
                           style="font-size:.88rem;font-weight:600;color:var(--text-dark);text-decoration:none;line-height:1.3;display:block;">
                            {{ Str::limit($r->title, 60) }}
                        </a>
                        <small style="color:var(--text-muted);">{{ $r->published_at->format('M d, Y') }}</small>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <div class="filter-card">
                <h5><i class="fas fa-tags me-2" style="color:var(--primary)"></i>Browse by Category</h5>
                <a href="{{ route('blogs.index') }}"
                   class="d-block mb-2 px-3 py-2 rounded-3 text-decoration-none"
                   style="background:#f1f5f9;color:var(--text-dark);font-size:.9rem;font-weight:500;">
                    All Posts
                </a>
                @foreach(\App\Models\Category::withCount('blogs')->get() as $cat)
                <a href="{{ route('blogs.index') }}?category={{ $cat->slug }}"
                   class="d-flex justify-content-between align-items-center mb-2 px-3 py-2 rounded-3 text-decoration-none"
                   style="background:#f1f5f9;color:var(--text-dark);font-size:.9rem;font-weight:500;">
                    <span>{{ $cat->name }}</span>
                    <span class="badge" style="background:var(--primary);border-radius:50px;">{{ $cat->blogs_count }}</span>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
