@extends('layouts.main')

@push('title')
Student Study Zone
@endpush

@section('content')

<!-- ================= HERO ================= -->
<section id="hero" class="hero section">
  <div class="container">
    <div class="row align-items-center">
      
<div class="col-lg-6 hero-left-advanced" data-aos="fade-up">

  <span class="badge text-bg-primary mb-3 pulse-badge">
    STUDENTS ZONE • LIVE
  </span>

  <h1 class="display-5 fw-bold mt-3">
    Study Smarter.<br>
    <span class="text-primary">Together.</span>
  </h1>

  <!-- AI TYPING SUBTITLE -->
  <p class="lead mt-3 ai-typing">
    <span id="aiText"></span>
    <span class="cursor">|</span>
  </p>

    <div class="feature-chips mt-4">
    <span>📄 Smart PDFs</span>
    <span>🧠 AI-Assisted Learning</span>
    <span>📚 Organized Notes</span>
    <span>⚡ Instant Access</span>
  </div>

  <!-- SIGNAL / ACTIVITY INDICATOR -->
  {{-- <div class="learning-signal mt-4">
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <span>Learning activity detected</span>
  </div> --}}

  <!-- CTA -->
  <div class="mt-5 cta-glow">
    <button    class="btn btn-primary btn-lg me-2 get-started-btn" onclick="window.location.href='{{ route('my.documents') }}'">
      {{-- <a href="{{ route('register') }}"> --}}
   <span class="btn-text">Get Started</span>
{{-- </a> --}}
    </button>
    

    </div>

</div>

      <div class="knowledge-engine">
  <div class="engine-core">
    <span>STUDENT ZONE</span>
    <small>Knowledge Engine</small>
  </div>

  <div class="data-stream left">
    <div>📄 PDF</div>
    <div>📘 Notes</div>
    <div>🎥 Video</div>
  </div>

  <div class="data-stream right">
    <div>🧠 AI</div>
    <div>📚 Smart Notes</div>
    <div>⚡ Fast Access</div>
  </div>
</div>

{{-- 
      <div class="col-lg-6 text-center" data-aos="fade-left">
        <img src="assets/img/misc/study image.jpg"
             class="img-fluid rounded-4 shadow-lg"
             alt="Students Studying">
      </div> --}}

    </div>
  </div>
</section>

<!-- ================= CORE VALUE ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">

    <h2 class="mb-4">Why Student Study Zone?</h2>
    <p class="text-muted mb-5">
      Everything students need — in one trusted academic space.
    </p>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100  border-2 shadow-sm">
          <div class="card-body">
            <i class="bi bi-journal-bookmark fs-1 text-primary"></i>
            <h5 class="mt-3">Organized Resources</h5>
            <p class="text-muted">
              Notes, PDFs, assignments — structured by subject, year & semester.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-2 shadow-sm">
          <div class="card-body">
            <i class="bi bi-shield-lock fs-1 text-primary"></i>
            <h5 class="mt-3">Secure & Private</h5>
            <p class="text-muted">
              Your uploads stay protected and accessible only to students.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100  border-2 shadow-sm">
          <div class="card-body">
            <i class="bi bi-people fs-1 text-primary"></i>
            <h5 class="mt-3">Collaborative Learning</h5>
            <p class="text-muted">
              Learn together by sharing quality academic content.
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ================= HOW IT WORKS ================= -->
<section class="section">
  <div class="container text-center">

    <h2 class="mb-4">How It Works</h2>

    <div class="row g-4 mt-4">
      <div class="col-md-4">
        <h1 class="text-primary fw-bold">01</h1>
        <h5>Upload</h5>
        <p class="text-muted">
          Upload notes, PDFs, books, or project files.
        </p>
      </div>

      <div class="col-md-4">
        <h1 class="text-primary fw-bold">02</h1>
        <h5>Organize</h5>
        <p class="text-muted">
          Files are auto-organized by subject & semester.
        </p>
      </div>

      <div class="col-md-4">
        <h1 class="text-primary fw-bold">03</h1>
        <h5>Access</h5>
        <p class="text-muted">
          Access resources anytime, anywhere.
        </p>
      </div>
    </div>

  </div>
</section>

<!-- ================= TRUST / STATS ================= -->
<section class="section bg-dark text-light">
  <div class="container text-center">

    <div class="row g-4">
      <div class="col-md-4">
        <h2 class="fw-bold text-primary">100+</h2>
        <p class="text-muted">Resources Uploaded</p>
      </div>

      <div class="col-md-4">
        <h2 class="fw-bold text-primary">24/7</h2>
        <p class="text-muted">Access Anywhere</p>
      </div>

      <div class="col-md-4">
        <h2 class="fw-bold text-primary">Students</h2>
        <p class="text-muted">Built for Students</p>
      </div>
    </div>

  </div>
</section>

<!-- ================= CTA ================= -->
<section class="section">
  <div class="container text-center">

    <h2 class="mb-3">Ready to Study Smarter?</h2>
    <p class="text-muted mb-4">
      Join Student Study Zone and simplify your academic life.
    </p>

    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
      Create Free Account
    </a>

  </div>
</section>
<script>
const engine = document.querySelector('.engine-core');

document.addEventListener('mousemove', e => {
  const x = (window.innerWidth / 2 - e.clientX) / 20;
  const y = (window.innerHeight / 2 - e.clientY) / 20;
  engine.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
});

document.addEventListener("DOMContentLoaded", () => {

  const sentences = [
    "A centralized platform for students to upload, organize, and access academic resources.",
    "Share notes, PDFs, books, and projects in one trusted place.",
    "Learn smarter with organized resources by subject and semester.",
    "Built by students, for students — simple, secure, and collaborative.",
    "Access academic resources anytime, anywhere."
  ];

  const textElement = document.getElementById("aiText");

  let sentenceIndex = 0;
  let charIndex = 0;
  let isDeleting = false;

  function typeLoop() {
    const current = sentences[sentenceIndex];

    if (!isDeleting) {
      // Typing
      textElement.textContent = current.substring(0, charIndex + 1);
      charIndex++;

      if (charIndex === current.length) {
        setTimeout(() => isDeleting = true, 1600); // pause after typing
      }
    } else {
      // Deleting
      textElement.textContent = current.substring(0, charIndex - 1);
      charIndex--;

      if (charIndex === 0) {
        isDeleting = false;
        sentenceIndex = (sentenceIndex + 1) % sentences.length;
      }
    }

    setTimeout(typeLoop, isDeleting ? 35 : 45);
  }

  typeLoop();
});

// GetStarted

document.querySelectorAll('.get-started-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    this.classList.add('active');

    const text = this.querySelector('.btn-text');
    if (text) {
      text.textContent = "Preparing your space…";
    }
  });
});

</script>

<style>
  /* =====================
   GLOBAL IMPROVEMENTS
===================== */

body {
  background-color: #020617; /* deep slate */
  color: #e5e7eb;
}

.section {
  padding: 96px 0; /* BIG professional spacing */
}

@media (max-width: 768px) {
  .section {
    padding: 64px 0;
  }
}

/* =====================
   HERO SECTION
   
===================== */

#hero {
  padding: 120px 0;
  background: radial-gradient(
    80% 60% at 50% 0%,
    rgba(56, 189, 248, 0.12),
    transparent 70%
  );
}

#hero .badge {
  font-size: 13px;
  letter-spacing: 1px;
  padding: 8px 14px;
}

#hero h1 {
  line-height: 1.15;
  letter-spacing: -0.02em;
}

#hero p.lead {
  max-width: 520px;
  font-size: 18px;
  color: #cbd5f5;
}

/* Hero Image */
#hero img {
  max-width: 90%;
  margin-left: auto;
  border-radius: 20px;
  box-shadow:
    0 20px 40px rgba(0,0,0,0.6),
    inset 0 0 0 1px rgba(255,255,255,0.05);
}


/* ============================
   CORE VALUE CARDS – PREMIUM
============================ */
  
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

/* Icons */
.row.g-4 i {
  font-size: 44px;
  background: linear-gradient(135deg, #38bdf8, #0ea5e9);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Title */
.row.g-4 h5 {
  font-weight: 600;
  margin-top: 18px;
  margin-bottom: 12px;
  letter-spacing: 0.3px;
}

/* Description */
.row.g-4 p {
  font-size: 15px;
  line-height: 1.65;
  color: #9aa4bf !important;
}

/* Subtle hover glow pulse */
.row.g-4 .card:hover i {
  filter: drop-shadow(0 0 14px rgba(56,189,248,0.7));
}

/* Mobile spacing */
@media (max-width: 768px) {
  .row.g-4 .card-body {
    padding: 32px 24px;
  }
}


/* =====================
   HOW IT WORKS
===================== */

.section h2 {
  font-weight: 700;
  letter-spacing: -0.02em;
}

.section h5 {
  font-weight: 600;
}

.section p.text-muted {
  color: #9aa4bf !important;
}

.section .text-primary {
  color: #38bdf8 !important;
}

/* Step numbers */
.section h1.text-primary {
  font-size: 56px;
  opacity: 0.85;
}

/* =====================
   STATS SECTION
===================== */

.section.bg-dark {
  background-color: #020617 !important;
}

.section.bg-dark h2 {
  font-size: 44px;
}

.section.bg-dark p {
  font-size: 15px;
  letter-spacing: 0.3px;
}

/* =====================
   CTA SECTION
===================== */

.section:last-of-type {
  padding-bottom: 120px;
}

.section:last-of-type h2 {
  max-width: 640px;
  margin: 0 auto 16px;
}

.section:last-of-type p {
  max-width: 520px;
  margin: 0 auto 32px;
}

/* CTA Button */
.btn-primary {
  background: linear-gradient(
    135deg,
    #38bdf8,
    #0ea5e9
  );
  border: none;
  padding: 14px 32px;
  border-radius: 999px;
  font-weight: 600;
  box-shadow: 0 12px 30px rgba(56,189,248,0.35);
}

.btn-primary:hover {
  transform: translateY(-1px);
}

.btn-outline-light {
  border-radius: 999px;
  padding: 14px 30px;
  font-weight: 500;
}




/* Knowledge Engine styles */
.knowledge-engine {
  position: relative;
  width: 600px;
  height: 400px;
  margin-left: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  perspective: 1200px;
}

.engine-core {
  width: 260px;
  height: 260px;
  border-radius: 30px;
  background: linear-gradient(145deg, rgba(0,255,255,0.15), rgba(0,100,255,0.05));
  backdrop-filter: blur(30px);
  border: 1px solid rgba(0,255,255,0.3);
  box-shadow: 0 0 120px rgba(0,200,255,0.4);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #00eaff;
  font-weight: 700;
  text-align: center;
  animation: float 6s infinite ease-in-out;
}

.engine-core span {
  font-size: 28px;
  letter-spacing: 2px;
}

.engine-core small {
  opacity: 0.7;
  font-size: 14px;
}

@keyframes float {
  0%,100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

/* Data streams */
.data-stream {
  position: absolute;
  display: flex;
  flex-direction: column;
  gap: 15px;
  color: #00d9ff;
  font-size: 16px;
}

.data-stream div {
  padding: 10px 16px;
  background: rgba(0,255,255,0.1);
  border: 1px solid rgba(0,255,255,0.3);
  border-radius: 12px;
  backdrop-filter: blur(10px);
  animation: flow 4s infinite alternate;
}

.data-stream.left {
  left: 0;
}

.data-stream.right {
  right: 0;
}

@keyframes flow {
  from { transform: translateY(0); opacity: 0.4; }
  to { transform: translateY(-30px); opacity: 1; }
}



/* ============================
   HERO LEFT – ADVANCED
============================ */

.hero-left-advanced {
  position: relative;
}

/* Pulsing badge */
.pulse-badge {
  animation: pulseGlow 2.5s infinite;
}

@keyframes pulseGlow {
  0% { box-shadow: 0 0 0 rgba(56,189,248,0.0); }
  50% { box-shadow: 0 0 25px rgba(56,189,248,0.6); }
  100% { box-shadow: 0 0 0 rgba(56,189,248,0.0); }
}

/* Typing effect */
.ai-typing {
  max-width: 520px;
  color: #cbd5f5;
}

.cursor {
  animation: blink 1.2s infinite;
}

@keyframes blink {
  0%,50% { opacity: 1; }
  51%,100% { opacity: 0; }
}

/* Learning signal */
.learning-signal {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  color: #9aa4bf;
}

.learning-signal .bar {
  width: 4px;
  height: 14px;
  background: #38bdf8;
  border-radius: 2px;
  animation: signalMove 1.4s infinite ease-in-out;
}

.learning-signal .bar:nth-child(1) { animation-delay: 0s; }
.learning-signal .bar:nth-child(2) { animation-delay: .2s; }
.learning-signal .bar:nth-child(3) { animation-delay: .4s; }

@keyframes signalMove {
  0%,100% { height: 6px; opacity: .4; }
  50% { height: 16px; opacity: 1; }
}

/* CTA glow on hover */
.cta-glow:hover {
  filter: drop-shadow(0 0 30px rgba(56,189,248,0.45));
  transition: filter .3s ease;
}


/*  features  */
/* Feature chips */
.feature-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}

.feature-chips span {
  padding: 10px 16px;
  border-radius: 999px;
  font-size: 14px;
  font-weight: 500;
  background: rgba(56,189,248,0.12);
  border: 1px solid rgba(56,189,248,0.3);
  color: #e5e7eb;
  backdrop-filter: blur(10px);
  animation: chipFloat 6s ease-in-out infinite;
}

.feature-chips span:nth-child(2) { animation-delay: 1s; }
.feature-chips span:nth-child(3) { animation-delay: 2s; }
.feature-chips span:nth-child(4) { animation-delay: 3s; }

@keyframes chipFloat {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-6px); }
}

/* =========================
   GET STARTED – MICRO UX
========================= */

.get-started-btn {
  position: relative;
  overflow: hidden;
}

.get-started-btn::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    120deg,
    transparent,
    rgba(255,255,255,0.35),
    transparent
  );
  transform: translateX(-120%);
}

.get-started-btn.active::after {
  animation: shine 0.6s ease;
}

@keyframes shine {
  to {
    transform: translateX(120%);
  }
}



</style>
@endsection
