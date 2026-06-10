@extends('layouts.admin')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-9">
        <div class="form-card">
            <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $blog->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Publish Date <span class="text-danger">*</span></label>
                        <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at', $blog->published_at->format('Y-m-d')) }}" required>
                        @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Short Description / Excerpt <span class="text-danger">*</span></label>
                        <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea name="content" rows="12" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Featured Image</label>
                        @if($blog->image)
                        <div class="mb-2">
                            <img src="{{ $blog->image_url }}" alt="Current" style="height:120px;border-radius:10px;object-fit:cover;">
                            <small class="d-block text-muted mt-1">Current image. Upload a new one to replace it.</small>
                        </div>
                        @endif
                        <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp">
                        <small class="text-muted">JPG, PNG, WebP. Max 2MB.</small>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div id="imagePreview" class="mt-3" style="display:none;">
                            <img id="previewImg" src="" alt="Preview" style="max-height:200px;border-radius:10px;object-fit:cover;">
                        </div>
                    </div>

                    <div class="col-12 d-flex gap-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Update Post
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary" style="border-radius:8px;">
                            Cancel
                        </a>
                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank"
                           class="btn ms-auto" style="background:#f0fdf4;color:#10b981;border-radius:8px;font-weight:600;">
                            <i class="fas fa-eye me-1"></i>Preview
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (evt) => {
                document.getElementById('previewImg').src = evt.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
