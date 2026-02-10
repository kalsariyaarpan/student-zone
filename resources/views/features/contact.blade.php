  @extends('layouts.main')

  @push('title')
  Contact | Student Study Zone
  @endpush

  @section('content')

  <!-- ================= PAGE HEADER ================= -->
  <section class="section bg-dark text-light">
    <div class="container text-center">
      <span class="badge text-bg-primary mb-3">CONTACT</span>

      <h1 class="fw-bold mt-3">
        Get in <span class="text-primary">Touch</span>
      </h1>
      <p class="text-muted mt-3">
        Questions, feedback, or support — we’re here to help you.
      </p>
    </div>
  </section>

  <!-- ================= CONTACT CONTENT ================= -->
  <section class="section">
    <div class="container">
      <div class="row g-5 align-items-start">

        <!-- CONTACT INFO -->
        <div class="col-lg-5">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

              <h4 class="mb-4">Contact Information</h4>

              <div class="d-flex align-items-start mb-3">
                <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                <div>
                  <h6 class="mb-1">Location</h6>
                  <p class="text-muted mb-0">Katargam, Surat – 395004</p>
                </div>
              </div>

              <div class="d-flex align-items-start mb-3">
                <i class="bi bi-envelope fs-4 text-primary me-3"></i>
                <div>
                  <h6 class="mb-1">Email</h6>
                  <p class="text-muted mb-0">kalsariyaarpan1257@gmail.com</p>
                </div>
              </div>

              <div class="d-flex align-items-start mb-4">
                <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                <div>
                  <h6 class="mb-1">Phone</h6>
                  <p class="text-muted mb-0">+91 72850 45716</p>
                </div>
              </div>

              <hr>

              <h6 class="mb-3">Follow Us</h6>
              <div class="d-flex gap-3">
                <a href="https://www.instagram.com/arpann_01" target="_blank" class="text-primary fs-5">
                  <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/in/kalsariya-arpan-a474a8379/" target="_blank" class="text-primary fs-5">
                  <i class="bi bi-linkedin"></i>
                </a>
                <a href="#" class="text-primary fs-5">
                  <i class="bi bi-facebook"></i>
                </a>
              </div>

            </div>
          </div>
        </div>

        <!-- CONTACT FORM -->
        <div class="col-lg-7">
          <div class="card border-0 shadow-sm">
            <div class="card-body">

              <h4 class="mb-4">Send a Message</h4>

            <form id="contactForm">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Your name" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" >Email Address</label>
                   <input type="email" id="email" class="form-control" placeholder="you@example.com" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input type="text" id="subject" class="form-control" placeholder="Subject" required>  
                </div>

                <div class="mb-4">
                  <label class="form-label">Message</label>
                  <textarea id="message" class="form-control" rows="5" placeholder="Write your message..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                  Send Message <i class="bi bi-send ms-2"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CTA ================= -->
  <section class="section bg-dark text-light">
    <div class="container text-center">
      <h3 class="mb-3">Need Quick Help?</h3>
      <p class="text-muted mb-4">
        Reach us instantly via WhatsApp support.
      </p>
      <a href="https://wa.me/917285045716" target="_blank" class="btn btn-success btn-lg">
        Chat on WhatsApp
      </a>
    </div>
  </section>

  <!-- ================= EMAIL JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

<script>
  (function () {
    emailjs.init("WiJHuDCrdjaCGTSmL"); // 👈 PUBLIC KEY HERE
  })();

  document.getElementById("contactForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const btn = this.querySelector("button");
  btn.disabled = true;
  btn.innerHTML = 'Sending...';

  emailjs.send(
    "service_n6br3jv",   // 👈 SERVICE ID
    "template_lcyzmdg",  // 👈 TEMPLATE ID
    {
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      subject: document.getElementById("subject").value,
      message: document.getElementById("message").value,
    }
  )
  .then(() => {
    btn.innerHTML = 'Sent ✅';
    this.reset();
    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = 'Send Message';
    }, 2000);
  })
  .catch(() => {
    btn.innerHTML = 'Failed ❌';
    btn.disabled = false;
  });
});
</script>

  @endsection
