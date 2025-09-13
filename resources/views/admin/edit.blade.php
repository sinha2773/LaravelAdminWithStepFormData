@extends('layouts.app')

@section('title', 'Edit Page - Admin Panel')

@section('content')
<div class="form-container">
    <div class="mb-4">
        <h2 class="fw-bold text-primary mb-2">Edit Content Page</h2>
        <p class="text-muted">Update the content and images for "{{ $page->title }}"</p>
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

    <form action="{{ route('admin.update', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label fw-semibold">
                    <i class="fas fa-heading text-primary me-2"></i>Page Title
                </label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $page->title) }}"
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
                       value="{{ old('slug', $page->slug) }}"
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
                      required>{{ old('description', $page->description) }}</textarea>
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
                      required>{{ old('instructions', $page->instructions) }}</textarea>
            @error('instructions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Existing Images -->
        @if($page->getMedia('images')->count() > 0)
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    <i class="fas fa-images text-primary me-2"></i>Current Images
                </label>
                <div class="media-gallery">
                    @foreach($page->getMedia('images') as $image)
                        <div class="media-item" id="image-{{ $image->id }}">
                            <img src="{{ $image->getUrl() }}" alt="Current Image" class="img-fluid">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button type="button" 
                                        class="btn btn-danger btn-sm"
                                        onclick="removeImage({{ $image->id }})"
                                        data-bs-toggle="tooltip"
                                        title="Remove Image">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-4">
            <label for="images" class="form-label fw-semibold">
                <i class="fas fa-upload text-primary me-2"></i>Upload Additional Images
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
                Select multiple images to add (JPEG, PNG, JPG, GIF). Maximum 2MB per image.
            </small>
            
            <!-- Image Preview Container -->
            <div id="imagePreview" class="media-gallery mt-3" style="display: none;"></div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="d-grid">
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Cancel
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid">
                    <a href="{{ route('result', $page->slug) }}" 
                       class="btn btn-outline-primary btn-lg" 
                       target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Preview
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save me-2"></i>Update Page
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title (only if slug is empty or matches current title pattern)
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        
        // Only auto-update slug if it's currently matching the title pattern
        const currentSlug = document.getElementById('slug').value;
        const currentTitle = '{{ $page->title }}';
        const currentTitleSlug = currentTitle.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
            
        if (currentSlug === currentTitleSlug || currentSlug === '') {
            document.getElementById('slug').value = slug;
        }
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
                                <span class="badge bg-success">New ${index + 1}</span>
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

    // Remove image function
    function removeImage(mediaId) {
        if (confirm('Are you sure you want to remove this image?')) {
            fetch(`{{ route('admin.remove.image', $page) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    media_id: mediaId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('image-' + mediaId).remove();
                } else {
                    alert('Failed to remove image. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }
    }

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush 