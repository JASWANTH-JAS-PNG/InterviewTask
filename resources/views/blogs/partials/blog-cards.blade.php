@if($blogs->count())
<div class="row g-4">
    @foreach($blogs as $blog)
    <div class="col-md-6 col-xl-4">
        <div class="blog-card">
            <a href="{{ route('blogs.show', $blog->slug) }}">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" loading="lazy">
            </a>
            <div class="card-body-custom">
                <span class="card-category">{{ $blog->category->name ?? 'General' }}</span>
                <h6 class="card-title-custom">
                    <a href="{{ route('blogs.show', $blog->slug) }}" style="text-decoration:none;color:inherit;">
                        {{ Str::limit($blog->title, 70) }}
                    </a>
                </h6>
                <p class="card-excerpt">{{ Str::limit($blog->excerpt, 120) }}</p>
                <div class="card-footer-custom">
                    <span class="card-date"><i class="fas fa-calendar-alt me-1"></i>{{ $blog->published_at->format('M d, Y') }}</span>
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn-read">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="no-results">
    <i class="fas fa-search-minus d-block"></i>
    <h5>No blogs found</h5>
    <p>Try adjusting your filters or search term.</p>
</div>
@endif
