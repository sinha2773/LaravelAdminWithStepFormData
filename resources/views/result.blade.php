@extends('layouts.app')

@section('title', $contentPage->title . ' - Professional Services')

@section('content')
<div class="form-container">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary mb-3">{{ $contentPage->title }}</h1>
        
        <!-- Progress Indicator -->
        <div class="progress mb-4" style="height: 8px;">
            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
        </div>
        <small class="text-success">
            <i class="fas fa-check-circle me-1"></i>Complete - Step 3 of 3
        </small>
    </div>

    <!-- Content Description -->
    <div class="mb-5">
        <div class="card border-0 bg-light">
            <div class="card-body p-4">
                <h3 class="card-title text-primary mb-3">
                    <i class="fas fa-info-circle me-2"></i>Service Information
                </h3>
                <div class="text-muted lead">
                    {!! nl2br(e($contentPage->description)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Images Gallery -->
    @if($contentPage->getMedia('images')->count() > 0)
        <div class="mb-5">
            <h3 class="text-primary mb-4">
                <i class="fas fa-images me-2"></i>Gallery
            </h3>
            <div class="media-gallery">
                @foreach($contentPage->getMedia('images') as $image)
                    <div class="media-item">
                        <img src="{{ $image->getUrl() }}" 
                             alt="Service Image" 
                             class="img-fluid"
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal{{ $loop->index }}"
                             style="cursor: pointer;">
                    </div>

                    <!-- Image Modal -->
                    <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ $image->getUrl() }}" alt="Service Image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Instructions -->
    <div class="mb-5">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-list-ul me-2"></i>Next Steps & Instructions
                </h3>
            </div>
            <div class="card-body p-4">
                <div class="text-dark">
                    {!! nl2br(e($contentPage->instructions)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="d-grid">
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-redo me-2"></i>Start Over
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-grid">
                <button type="button" class="btn btn-success btn-lg" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print This Page
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="text-center mt-5 pt-4 border-top">
        <h4 class="text-primary mb-3">Need More Information?</h4>
        <p class="text-muted mb-3">Our team is here to help you with any questions you may have.</p>
        <div class="row g-3 justify-content-center">
            <div class="col-auto">
                <a href="tel:+1234567890" class="btn btn-outline-primary">
                    <i class="fas fa-phone me-2"></i>Call Us
                </a>
            </div>
            <div class="col-auto">
                <a href="mailto:info@company.com" class="btn btn-outline-primary">
                    <i class="fas fa-envelope me-2"></i>Email Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    @media print {
        .btn, .modal, .border-top {
            display: none !important;
        }
        
        .main-container {
            box-shadow: none !important;
            margin: 0 !important;
        }
        
        .header-logo {
            position: static !important;
        }
    }
</style>
@endpush 