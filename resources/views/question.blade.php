@extends('layouts.app')

@section('title', 'Service Selection - Professional Services')

@section('content')
<div class="form-container">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary mb-3">Choose Your Service Path</h2>
        <p class="text-muted lead">Select the option that best describes your needs</p>
        
        <!-- Progress Indicator -->
        <div class="progress mb-4" style="height: 8px;">
            <div class="progress-bar" role="progressbar" style="width: 66%"></div>
        </div>
        <small class="text-muted">Step 2 of 3</small>
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

    <form action="{{ route('submit.question') }}" method="POST" id="questionForm">
        @csrf
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 option-card" data-value="option1">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-business-time fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Business Solutions</h4>
                        <p class="card-text text-muted">
                            Professional business consulting, strategy development, and enterprise solutions 
                            designed to help your company grow and succeed in today's competitive market.
                        </p>
                        <div class="mt-4">
                            <span class="badge bg-primary px-3 py-2">Enterprise Ready</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 option-card" data-value="option2">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-users fa-3x text-success"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Personal Services</h4>
                        <p class="card-text text-muted">
                            Personalized consulting, individual coaching, and tailored solutions 
                            to help you achieve your personal and professional goals.
                        </p>
                        <div class="mt-4">
                            <span class="badge bg-success px-3 py-2">Individual Focus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="question_answer" id="selectedOption">

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn" disabled>
                <i class="fas fa-arrow-right me-2"></i>Continue to Results
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Contact Form
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionCards = document.querySelectorAll('.option-card');
        const selectedOptionInput = document.getElementById('selectedOption');
        const submitBtn = document.getElementById('submitBtn');

        optionCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove active class from all cards
                optionCards.forEach(c => {
                    c.classList.remove('border-primary', 'bg-light');
                    c.style.transform = 'scale(1)';
                });

                // Add active class to clicked card
                this.classList.add('border-primary', 'bg-light');
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'all 0.3s ease';

                // Set the selected value
                selectedOptionInput.value = this.dataset.value;
                submitBtn.disabled = false;
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-success');
            });

            // Add hover effects
            card.style.cursor = 'pointer';
            card.style.transition = 'all 0.3s ease';
            
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('border-primary')) {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('border-primary')) {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
                }
            });
        });
    });
</script>
@endpush 