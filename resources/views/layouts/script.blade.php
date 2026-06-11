  <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
  <!-- Preloader -->
  {{-- <div id="preloader"></div> --}}
   
{{-- 
  <div id="intro-loader">
    <div class="loader-content">
      <div class="logo-orb">
        <span>SSZ</span>
      </div>
      <h1 class="loader-title">
        Welcome to <span>Student Study Zone</span>
      </h1>
      <p class="loader-subtitle">
        A focused space to <strong>learn, practice</strong> and <strong>grow</strong> every day.
      </p>

      <div class="loading-bar">
        <span></span>
      </div>
      <div class="loader-small-text">Preparing your study space…</div>

      <button class="skip-btn" onclick="hideIntro()">
        Skip intro
      </button>
    </div>
  </div>

  
  <script>
    // Automatically hide intro after 3.2 seconds
    window.addEventListener('load', () => {
      setTimeout(hideIntro, 3200);
    });

    function hideIntro() {
      const intro = document.getElementById('intro-loader');
      const content = document.getElementById('site-content');

      if (!intro.classList.contains('hide')) {
        intro.classList.add('hide');        // fade out intro
        content.classList.add('show');      // fade in site
      }
    }
  </script> --}}


  {{-- <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script> --}}

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>