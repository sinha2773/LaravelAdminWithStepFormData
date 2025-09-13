@extends('layouts.app')

@section('title', 'Admin Panel - Content Management')

@section('content')
<div class="form-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-2">Content Management</h2>
            <p class="text-muted">Manage your service pages and content</p>
        </div>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Page
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($pages->count() > 0)
        <div class="row g-4">
            @foreach($pages as $page)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">{{ $page->title }}</h5>
                            <small class="opacity-75">{{ $page->slug }}</small>
                        </div>
                        
                        @if($page->getMedia('images')->count() > 0)
                            <div class="position-relative">
                                <img src="{{ $page->getFirstMediaUrl('images') }}" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;" 
                                     alt="{{ $page->title }}">
                                <span class="badge bg-dark position-absolute top-0 end-0 m-2">
                                    {{ $page->getMedia('images')->count() }} 
                                    {{ $page->getMedia('images')->count() == 1 ? 'image' : 'images' }}
                                </span>
                            </div>
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <div>No images uploaded</div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <p class="card-text text-muted">
                                {{ Str::limit($page->description, 100) }}
                            </p>
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    Created: {{ $page->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('result', $page->slug) }}" 
                                   class="btn btn-outline-primary btn-sm" 
                                   target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i>View
                                </a>
                                <a href="{{ route('admin.edit', $page) }}" 
                                   class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-outline-danger btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $page->id }}">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $page->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete "<strong>{{ $page->title }}</strong>"?</p>
                                    <p class="text-danger">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        This action cannot be undone.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.destroy', $page) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Page</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-file-alt fa-4x text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">No Content Pages Yet</h4>
            <p class="text-muted mb-4">Create your first content page to get started.</p>
            <a href="{{ route('admin.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Create First Page
            </a>
        </div>
    @endif

    <div class="text-center mt-5 pt-4 border-top">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
    </div>
</div>
@endsection 