@extends('layouts.app')

@section('title', 'Contact Information - Professional Services')

@section('content')
<div class="form-container">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary mb-3">Welcome to Our Professional Services</h2>
        <p class="text-muted lead">Please provide your contact information to get started</p>
        
        <!-- Progress Indicator -->
        <div class="progress mb-4" style="height: 8px;">
            <div class="progress-bar" role="progressbar" style="width: 33%"></div>
        </div>
        <small class="text-muted">Step 1 of 3</small>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('submit.form') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label fw-semibold">
                    <i class="fas fa-user text-primary me-2"></i>Full Name
                </label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       placeholder="Enter your full name"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label fw-semibold">
                    <i class="fas fa-phone text-primary me-2"></i>Phone Number
                </label>
                <input type="tel" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone') }}"
                       placeholder="(555) 123-4567"
                       required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-semibold">
                    <i class="fas fa-envelope text-primary me-2"></i>Email Address
                </label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="your.email@example.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Continue to Next Step
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <small class="text-muted">
            <i class="fas fa-lock me-1"></i>
            Your information is secure and will never be shared with third parties
        </small>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
</script>
@endpush 