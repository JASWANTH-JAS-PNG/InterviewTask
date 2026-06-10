@extends('layouts.app')

@section('title', 'BlogHub - Latest Blogs')

@section('content')

<div class="hero">
    <div class="container">
        <h1>Explore Our Blogs</h1>
        <p>Stay up to date with the latest admit cards, results, and important announcements.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">

        {{-- Sidebar Filters --}}
        <div class="col-lg-3 mb-4">

            {{-- Category Filter --}}
            <div class="filter-card">
                <h5><i class="fas fa-tag me-2" style="color:var(--primary)"></i>Categories</h5>
                <button class="category-btn active" data-category="">All Posts</button>
                @foreach($categories as $cat)
                    <button class="category-btn" data-category="{{ $cat->slug }}">
                        {{ $cat->name }}
                        <span class="badge">{{ $cat->blogs_count }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Date Filter --}}
            <div class="filter-card">
                <h5><i class="fas fa-calendar me-2" style="color:var(--primary)"></i>Filter by Date</h5>
                <input type="date" id="date-filter" class="form-control" style="border-radius:8px;font-size:.9rem;" value="{{ request('date') }}">
                <button id="clear-date" class="btn btn-sm btn-outline-secondary mt-2 w-100" style="border-radius:8px;">
                    <i class="fas fa-times me-1"></i> Clear Date
                </button>
            </div>

        </div>

        {{-- Blog Cards --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 style="font-weight:700;margin:0;" id="results-heading">All Blogs</h4>
                <span class="text-muted" style="font-size:.88rem;" id="results-count">{{ $blogs->total() }} posts</span>
            </div>

            <div id="loading-spinner">
                <div class="spinner"></div>
                <p class="mt-2 text-muted" style="font-size:.9rem;">Loading blogs...</p>
            </div>

            <div id="blog-list">
                @include('blogs.partials.blog-cards', ['blogs' => $blogs])
            </div>

            <div id="pagination-links" class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    let currentCategory = '{{ request("category", "") }}';
    let currentDate     = '{{ request("date", "") }}';
    let currentSearch   = '{{ request("search", "") }}';

    function fetchBlogs(page = 1) {
        $('#loading-spinner').show();
        $('#blog-list').css('opacity', '.4');

        $.ajax({
            url: '{{ route("blogs.index") }}',
            method: 'GET',
            data: {
                category : currentCategory,
                date     : currentDate,
                search   : currentSearch,
                page     : page
            },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (response) {
                $('#blog-list').html(response.html).css('opacity', '1');
                $('#pagination-links').html(response.pagination);
                $('#loading-spinner').hide();
                bindPagination();
            },
            error: function () {
                $('#loading-spinner').hide();
                $('#blog-list').css('opacity', '1');
            }
        });
    }

    // Category filter
    $(document).on('click', '.category-btn', function () {
        $('.category-btn').removeClass('active');
        $(this).addClass('active');
        currentCategory = $(this).data('category');
        fetchBlogs();
    });

    // Date filter
    $('#date-filter').on('change', function () {
        currentDate = $(this).val();
        fetchBlogs();
    });

    // Clear date
    $('#clear-date').on('click', function () {
        $('#date-filter').val('');
        currentDate = '';
        fetchBlogs();
    });

    // Search
    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        currentSearch = $('#search-input').val();
        fetchBlogs();
    });

    // Pagination (delegated — works after AJAX render)
    function bindPagination() {
        $('#pagination-links a').off('click').on('click', function (e) {
            e.preventDefault();
            const url   = $(this).attr('href');
            const page  = new URL(url).searchParams.get('page') || 1;
            fetchBlogs(page);
            $('html, body').animate({ scrollTop: $('#blog-list').offset().top - 80 }, 400);
        });
    }

    bindPagination();

    // Highlight active category from URL
    const urlParams = new URLSearchParams(window.location.search);
    const catParam  = urlParams.get('category');
    if (catParam) {
        $('.category-btn').removeClass('active');
        $('[data-category="' + catParam + '"]').addClass('active');
        currentCategory = catParam;
    }
});
</script>
@endpush
