@extends('layouts.main')

@push('title')
FAQ | Student Study Zone
@endpush

@section('content')

<!-- ================= PAGE HEADER ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">
    <span class="badge text-bg-primary mb-3">FAQ</span>
    <h1 class="fw-bold mt-3">
      Frequently Asked <span class="text-primary">Questions</span>
    </h1>
    <p class="text-muted mt-3">
      Quick answers to common questions about Student Study Zone.
    </p>
  </div>
</section>

<!-- ================= FAQ CONTENT ================= -->
<!-- ================= FAQ CONTENT ================= -->
<section class="section faq-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">

        <div class="accordion faq-accordion" id="faqAccordion">

          @php
            $faqs = [
              ['id'=>1,'q'=>'How do I create an account?','a'=>'Click on the Register button, fill in your details, and submit the form. Once registered, you can immediately start uploading and accessing study resources.'],
              ['id'=>2,'q'=>'What type of resources can I upload?','a'=>'You can upload handwritten notes, PDFs, books, assignments, images, and project-related academic files.'],
              ['id'=>3,'q'=>'Is my data safe and private?','a'=>'Yes. Your data is securely stored and accessible only to authorized users. We never sell or share your files.'],
              ['id'=>4,'q'=>'Can I access resources on mobile?','a'=>'Absolutely. Student Study Zone is fully responsive and works on mobile, tablet, and desktop devices.'],
              ['id'=>5,'q'=>'How can I get support?','a'=>'Visit the Contact page or reach out via WhatsApp support. We are always happy to help.'],
            ];
          @endphp

          @foreach($faqs as $faq)
          <div class="accordion-item faq-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed faq-btn"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#faq{{ $faq['id'] }}">
                <span class="faq-icon">❓</span>
                {{ $faq['q'] }}
              </button>
            </h2>

            <div id="faq{{ $faq['id'] }}" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
              <div class="accordion-body faq-body">
                {{ $faq['a'] }}
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </div>
  </div>
</section>

<!-- ================= CTA ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">
    <h3 class="mb-3">Still Have Questions?</h3>
    <p class="text-muted mb-4">
      Reach out to us anytime — we’re here to help.
    </p>
    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
      Contact Support
    </a>
  </div>
</section>

@endsection

