@extends('layouts.admin')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('content')
<div class="admin-table">
    <div class="table-header">
        <h6 class="fw-bold mb-0">All Blog Posts <span class="text-muted fw-normal" style="font-size:.85rem;">({{ $blogs->total() }})</span></h6>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary-custom">
            <i class="fas fa-plus me-1"></i> New Post
        </a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th style="width:70px;">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th style="width:140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td class="text-muted" style="font-size:.85rem;">{{ $blog->id }}</td>
                    <td>
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}"
                             style="width:52px;height:44px;object-fit:cover;border-radius:8px;">
                    </td>
                    <td>
                        <div class="fw-semibold" style="font-size:.9rem;">{{ Str::limit($blog->title, 55) }}</div>
                        <div class="text-muted" style="font-size:.8rem;">{{ Str::limit($blog->excerpt, 60) }}</div>
                    </td>
                    <td><span class="badge-category">{{ $blog->category->name ?? '-' }}</span></td>
                    <td style="font-size:.85rem;color:#64748b;white-space:nowrap;">{{ $blog->published_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank"
                               class="btn btn-sm" title="Preview"
                               style="background:#f0fdf4;color:#10b981;border-radius:6px;padding:.35rem .6rem;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                               class="btn btn-sm" title="Edit"
                               style="background:#eff6ff;color:#3b82f6;border-radius:6px;padding:.35rem .6rem;">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}"
                                  onsubmit="return confirm('Delete this blog post?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Delete"
                                        style="background:#fef2f2;color:#ef4444;border-radius:6px;padding:.35rem .6rem;border:none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-newspaper fa-2x mb-2 d-block opacity-25"></i>
                        No blog posts yet.
                        <a href="{{ route('admin.blogs.create') }}" style="color:#4f46e5;">Create your first post!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
    <div class="px-4 py-3 border-top">{{ $blogs->links() }}</div>
    @endif
</div>
@endsection
