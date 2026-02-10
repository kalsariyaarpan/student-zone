/**
* Template Name: Visible
* Template URL: https://bootstrapmade.com/visible-bootstrap-agency-template/
* Updated: May 22 2025 with Bootstrap v5.3.6
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle, .faq-item .faq-header').forEach((faqItem) => {
  faqItem.addEventListener('click', () => {
    faqItem.parentNode.classList.toggle('faq-active');
  });
});

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function(e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();

//for logo

    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    // Optional: Close dropdown if clicked outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('userDropdown');
        const avatar = document.querySelector('.user-avatar');
        if (!dropdown.contains(e.target) && !avatar.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });


//    //for image 
//    const wrapper = document.querySelector(".hero .hero-visual .image-wrapper");

// wrapper.addEventListener("mousemove", (e) => {
//   const rect = wrapper.getBoundingClientRect();
//   const x = e.clientX - rect.left; // mouse X relative
//   const y = e.clientY - rect.top;  // mouse Y relative

//   const rotateY = ((x / rect.width) - 0.5) * 20; // tilt range
//   const rotateX = ((y / rect.height) - 0.5) * -20;

//   wrapper.style.transform = `perspective(1200px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
// });

// wrapper.addEventListener("mouseleave", () => {
//   wrapper.style.transform = "perspective(1200px) rotateX(0) rotateY(0) scale(1)";
// });
 

// Show Code Compiler with Animation

function showCompiler(event) {

  if(event) event.preventDefault(); // Stop default behavior

  const intro = document.querySelector(".compiler-intro");
  const compiler = document.getElementById("code-compiler");

  // Fade-out intro
  intro.classList.add("hide");

  // Remove intro from layout after animation
  setTimeout(() => {
    intro.style.display = "none";
  }, 800);

  // Show compiler smoothly
  compiler.classList.add("show");

  // Hide button
  document.getElementById("show-compiler-btn").style.display = "none";

  /* OPTIONAL: If you DO want smooth scroll without jump,
     Delay scroll until animation is stable */
  setTimeout(() => {
    compiler.scrollIntoView({
      behavior: "smooth",
      block: "start"
    });
  }, 900); // AFTER fade + expand
}




// loader
// phrases for typing effect
const typingPhrases = [
  "Loading notes…",
  "Preparing quizzes…",
  "Setting up your tools…",
  "Building your focus zone…"
];

let phraseIndex = 0;
let charIndex = 0;
let typingEl = document.getElementById("typing-text");
let progressEl = document.getElementById("loader-progress");
let typingInterval;
let progress = 0;

// typewriter effect
function typeLoop() {
  const current = typingPhrases[phraseIndex];
  typingEl.textContent = current.slice(0, charIndex);

  charIndex++;
  if (charIndex > current.length) {
    setTimeout(() => {
      charIndex = 0;
      phraseIndex = (phraseIndex + 1) % typingPhrases.length;
    }, 700);
  }
}

// fake progress %
function progressLoop() {
  if (progress < 100) {
    progress += Math.floor(Math.random() * 8) + 3; // 3–10
    if (progress > 100) progress = 100;
    progressEl.textContent = progress + "%";
  }
}

// hide intro and show site
function hideIntro() {
  const intro = document.getElementById("intro-loader");
  const content = document.getElementById("site-content");

  if (!intro.classList.contains("hide")) {
    intro.classList.add("hide");
    content.classList.add("show");

    clearInterval(typingInterval);
    clearInterval(progressInterval);
  }
}

window.addEventListener("load", () => {
  typingInterval = setInterval(typeLoop, 90);
  progressInterval = setInterval(progressLoop, 250);

  // auto-hide after ~3.5 seconds
  setTimeout(hideIntro, 3500);
});

// make hideIntro available to Blade onclick
window.hideIntro = hideIntro;
