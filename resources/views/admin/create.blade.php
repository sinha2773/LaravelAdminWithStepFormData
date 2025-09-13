@extends('layouts.app')

@section('title', 'Create New Page - Admin Panel')

@section('content')
<div class="form-container">
    <div class="mb-4">
        <h2 class="fw-bold text-primary mb-2">Create New Content Page</h2>
        <p class="text-muted">Add a new service page with content and images</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label fw-semibold">
                    <i class="fas fa-heading text-primary me-2"></i>Page Title
                </label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       placeholder="Enter page title"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="slug" class="form-label fw-semibold">
                    <i class="fas fa-link text-primary me-2"></i>Page Slug (URL)
                </label>
                <input type="text" 
                       class="form-control @error('slug') is-invalid @enderror" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug') }}"
                       placeholder="page-url-slug"
                       required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Used in the URL (e.g., page1, page2)</small>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">
                <i class="fas fa-align-left text-primary me-2"></i>Description
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" 
                      name="description" 
                      rows="5"
                      placeholder="Enter the main description for this service page..."
                      required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label fw-semibold">
                <i class="fas fa-list-ul text-primary me-2"></i>Instructions & Next Steps
            </label>
            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                      id="instructions" 
                      name="instructions" 
                      rows="6"
                      placeholder="Enter detailed instructions and next steps for users..."
                      required>{{ old('instructions') }}</textarea>
            @error('instructions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="images" class="form-label fw-semibold">
                <i class="fas fa-images text-primary me-2"></i>Upload Images
            </label>
            <input type="file" 
                   class="form-control @error('images.*') is-invalid @enderror" 
                   id="images" 
                   name="images[]" 
                   multiple
                   accept="image/*">
            @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">
                Select multiple images (JPEG, PNG, JPG, GIF). Maximum 2MB per image.
            </small>
            
            <!-- Image Preview Container -->
            <div id="imagePreview" class="media-gallery mt-3" style="display: none;"></div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-grid">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Cancel
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Create Page
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });

    // Image preview functionality
    document.getElementById('images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        
        if (e.target.files.length > 0) {
            previewContainer.style.display = 'block';
            
            Array.from(e.target.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'media-item';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-dark">${index + 1}</span>
                            </div>
                        `;
                        previewContainer.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endpush 