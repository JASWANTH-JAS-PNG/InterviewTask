@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:.85rem;">Total Blogs</p>
                    <h2 class="fw-bold mb-0">{{ $totalBlogs }}</h2>
                </div>
                <div class="stat-icon" style="background:rgba(79,70,229,.1);color:#4f46e5;">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:.85rem;">Categories</p>
                    <h2 class="fw-bold mb-0">{{ $totalCategories }}</h2>
                </div>
                <div class="stat-icon" style="background:rgba(6,182,212,.1);color:#06b6d4;">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:.85rem;">This Month</p>
                    <h2 class="fw-bold mb-0">{{ \App\Models\Blog::whereMonth('created_at', now()->month)->count() }}</h2>
                </div>
                <div class="stat-icon" style="background:rgba(16,185,129,.1);color:#10b981;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:.85rem;">Welcome</p>
                    <h5 class="fw-bold mb-0" style="font-size:1rem;">{{ Auth::guard('admin')->user()->name }}</h5>
                </div>
                <div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef4444;">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-table">
            <div class="table-header">
                <h6 class="fw-bold mb-0">Recent Blog Posts</h6>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm" style="background:rgba(79,70,229,.1);color:#4f46e5;border-radius:8px;font-weight:600;">View All</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBlogs as $blog)
                    <tr>
                        <td style="max-width:240px;">
                            <span class="fw-semibold" style="font-size:.88rem;">{{ Str::limit($blog->title, 50) }}</span>
                        </td>
                        <td><span class="badge-category">{{ $blog->category->name ?? '-' }}</span></td>
                        <td style="font-size:.85rem;color:#64748b;">{{ $blog->published_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm" style="border-radius:6px;background:#f1f5f9;color:#374151;font-size:.8rem;">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No blogs yet. <a href="{{ route('admin.blogs.create') }}">Create one!</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="fw-bold mb-3">Quick Actions</h6>
            <a href="{{ route('admin.blogs.create') }}" class="d-flex align-items-center gap-3 p-3 rounded-3 mb-2 text-decoration-none" style="background:#f1f5f9;">
                <div style="width:38px;height:38px;border-radius:10px;background:rgba(79,70,229,.1);display:flex;align-items:center;justify-content:center;color:#4f46e5;flex-shrink:0;">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <div style="font-weight:600;font-size:.9rem;color:#1e293b;">New Blog Post</div>
                    <div style="font-size:.8rem;color:#64748b;">Write and publish a post</div>
                </div>
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="d-flex align-items-center gap-3 p-3 rounded-3 mb-2 text-decoration-none" style="background:#f1f5f9;">
                <div style="width:38px;height:38px;border-radius:10px;background:rgba(6,182,212,.1);display:flex;align-items:center;justify-content:center;color:#06b6d4;flex-shrink:0;">
                    <i class="fas fa-list"></i>
                </div>
                <div>
                    <div style="font-weight:600;font-size:.9rem;color:#1e293b;">Manage Blogs</div>
                    <div style="font-size:.8rem;color:#64748b;">Edit or delete posts</div>
                </div>
            </a>
            <a href="{{ route('blogs.index') }}" target="_blank" class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none" style="background:#f1f5f9;">
                <div style="width:38px;height:38px;border-radius:10px;background:rgba(16,185,129,.1);display:flex;align-items:center;justify-content:center;color:#10b981;flex-shrink:0;">
                    <i class="fas fa-globe"></i>
                </div>
                <div>
                    <div style="font-weight:600;font-size:.9rem;color:#1e293b;">View Website</div>
                    <div style="font-size:.8rem;color:#64748b;">See public blog listing</div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
