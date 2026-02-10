@extends('layouts.main')

@push('title')
Features | Student Study Zone
@endpush

@section('content')

<!-- ================= PAGE HEADER ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">
    <span class="badge text-bg-primary  mb-3">FEATURES</span>

    <h1 class="fw-bold mt-3">
      Everything You Need to <span class="text-primary">Study Better</span>
    </h1>

    <p class="lead mt-3 text-muted">
      Powerful tools designed to simplify academic life and encourage collaboration.
    </p>
  </div>
</section>

<!-- ================= MAIN FEATURES ================= -->
<section class="section">
  <div class="container">

    <div class="row g-4">

      <!-- Feature 1 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-folder2-open fs-1 text-primary"></i>
            <h5 class="mt-3">Organized Resource Library</h5>
            <p class="text-muted">
              Upload and browse notes, books, PDFs, and projects — neatly categorized by subject, year, and semester.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-shield-lock fs-1 text-primary"></i>
            <h5 class="mt-3">Secure & Private</h5>
            <p class="text-muted">
              Your files are protected. Only authorized students can access shared resources.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
            <h5 class="mt-3">Cloud-Based Access</h5>
            <p class="text-muted">
              Access your study materials anytime, from any device, without hassle.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-people fs-1 text-primary"></i>
            <h5 class="mt-3">Student Collaboration</h5>
            <p class="text-muted">
              Share resources, help classmates, and learn together in a collaborative environment.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature 5 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-bar-chart-line fs-1 text-primary"></i>
            <h5 class="mt-3">Resource Insights</h5>
            <p class="text-muted">
              Understand which resources are most useful through usage insights and feedback.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature 6 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body text-center">
            <i class="bi bi-search fs-1 text-primary"></i>
            <h5 class="mt-3">Smart Search</h5>
            <p class="text-muted">
              Quickly find the right material using keywords, subjects, and filters.
            </p>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ================= CTA ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">
    <h2 class="mb-3">Start Using These Features Today</h2>
    <p class="text-muted mb-4">
      Create a free account and access all tools instantly.
    </p>

    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
      Get Started Free
    </a>
  </div>
</section>
<style>
  
.row.g-4 .card {
  border-radius: 20px;
  background: linear-gradient(
    180deg,
    rgba(255,255,255,0.05),
    rgba(255,255,255,0.02)
  );
  backdrop-filter: blur(14px);
  transition: 
    transform 0.35s ease,
    box-shadow 0.35s ease,
    border 0.35s ease;
  position: relative;
  overflow: hidden;
}

/* Soft glowing border */
.row.g-4 .card::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 20px;
  padding: 1px;
  background: linear-gradient(
    135deg,
    transparent,
    rgba(56,189,248,0.6),
    transparent
  );
  -webkit-mask:
    linear-gradient(#000 0 0) content-box,
    linear-gradient(#000 0 0);
  -webkit-mask-composite: xor;
          mask-composite: exclude;
  opacity: 0;
  transition: opacity 0.35s ease;
}

/* Hover effect */
.row.g-4 .card:hover {
  transform: translateY(-8px);
  box-shadow: 0 30px 80px rgba(0,0,0,0.7);
}

.row.g-4 .card:hover::before {
  opacity: 1;
}

/* Card body */
.row.g-4 .card-body {
  padding: 40px 32px;
  text-align: center;
}

</style>
@endsection
