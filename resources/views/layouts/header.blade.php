<header id="header" class="header">

  <!-- LEFT: LOGO -->
  <div class="header-left">
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ asset('assets/img/transparent-logo-2.png') }}" alt="Student Zone Logo">
    </a>
  </div>

  <!-- CENTER: SLOGAN (ONLY FOR GUEST) -->
  @guest
  <div class="header-center slogan-box">
    <span class="slogan-text">
      From Notebooks to Network — Study Smarter Together
    </span>
  </div>
  @endguest

  <!-- CENTER: NAV (ONLY FOR AUTH) -->
  @auth
  <nav class="header-center nav-box">
    <ul class="nav-horizontal">

      <li class="nav-item mega-dropdown">
        <a href="javascript:void(0)" class="nav-link" id="moreToggle">More</a>

        <div class="mega-panel">
          <a href="{{ route('features') }}" class="mega-item">Features</a>
          <a href="{{ route('faq') }}" class="mega-item">FAQ</a>
          <a href="{{ route('contact') }}" class="mega-item">Contact</a>
        </div>
      </li>

      <li><a href="{{ route('explore.resources') }}">Explore</a></li>
      <li><a href="{{ route('resources.view') }}">Resources</a></li>
      <li><a href="{{ route('fields.upload') }}">Upload</a></li>

    </ul>
  </nav>
  @endauth

  <!-- RIGHT -->
  <div class="header-right">
    <ul class="nav-horizontal">

      @guest
        <li>
          <a href="{{ route('login') }}" class="btn-login">
           <i class="bi bi-box-arrow-in-right"></i> Login
          </a>
        </li>
      @endguest

      @auth
        {{-- <li class="icon-btn">
          <i class="bi bi-bell"></i>
        </li> --}}

<li class="icon-btn notification-bell">
  <i class="bi bi-bell"></i>
  <span class="notify-dot" id="notifyDot"></span>
</li>


        <li class="dropdown user-dropdown">
          <img
            src="{{ Auth::user()->profile_photo
              ? asset('storage/' . Auth::user()->profile_photo)
              : asset('images/default-avatar.png') }}"
            class="nav-avatar"
            onclick="toggleDropdown()">

          <ul class="dropdown-menu">
            <li><a href="{{ route('account.profile') }}">Profile</a></li>
            <li><a href="{{ route('account.settings') }}">Settings</a></li>
            <li><a href="{{ route('fields.upload.store') }}">My Fields</a></li>
            {{-- <li><a href="{{ route('account.resources') }}">My Resources</a></li> --}}
            <li class="divider"></li>
            <li>
            <form method="POST" action="{{ route('logout') }}" onsubmit="clearLoginAnim()">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
          </form>
            </li>
          </ul>
        </li>
      @endauth

    </ul>
  </div>

</header>

@auth
<div id="loginSuccessAnim" class="login-success-anim">
  <span>Welcome back, {{ Auth::user()->name }} 👋</span>
</div>
@endauth

{{--  FIRST LOGIN NOTICE --}}
@auth
<div id="firstLoginNotice" class="first-login-notice">
  <h6>Welcome to Student Study Zone 🎓</h6>
  <p>
    Your account has been successfully set up.
    Start exploring resources, uploading materials, and collaborating smarter.
  </p>
</div>
@endauth


<script>
document.addEventListener('DOMContentLoaded', function () {


  /* ======================
     AUTH CHECK
  ====================== */
  const isAuth = {{ Auth::check() ? 'true' : 'false' }};
  const anim   = document.getElementById('loginSuccessAnim');
  const notice = document.getElementById('firstLoginNotice');
  const dot    = document.getElementById('notifyDot');

  if (isAuth) {
    const played = localStorage.getItem('loginAnimPlayed');

  if (!played) {
  // play animation only once
  if (anim) anim.classList.add('show');
  localStorage.setItem('loginAnimPlayed', 'true');
}

// 🔵 notification state (independent)
if (localStorage.getItem('hasUnreadNotice') === 'true') {
  if (dot) dot.classList.add('show');
} else {
  // first login → create unread notice
  localStorage.setItem('hasUnreadNotice', 'true');
  if (dot) dot.classList.add('show');
}


  }

  /* ======================
     MORE (MEGA DROPDOWN)
  ====================== */
  const moreToggle = document.getElementById('moreToggle');

  if (moreToggle) {
    const megaDropdown = moreToggle.closest('.mega-dropdown');

    moreToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      megaDropdown.classList.toggle('active');

      const userDrop = document.querySelector('.user-dropdown');
      if (userDrop) userDrop.classList.remove('active');
    });

    document.addEventListener('click', function () {
      megaDropdown.classList.remove('active');
    });
  }

  /* ======================
     USER AVATAR DROPDOWN
  ====================== */
  const avatar = document.querySelector('.user-dropdown img');

  if (avatar) {
    avatar.addEventListener('click', function (e) {
      e.stopPropagation();
      avatar.closest('.user-dropdown').classList.toggle('active');

      const mega = document.querySelector('.mega-dropdown');
      if (mega) mega.classList.remove('active');
    });
  }

  document.addEventListener('click', function () {
    document
      .querySelectorAll('.user-dropdown')
      .forEach(d => d.classList.remove('active'));
  });


  const bell = document.querySelector('.notification-bell');

  if (bell && notice) {
  bell.addEventListener('click', function (e) {
    e.stopPropagation();

    notice.classList.toggle('open');

    // mark as read
    if (dot) dot.classList.remove('show');
    localStorage.removeItem('hasUnreadNotice');
  });
}


// close notice on outside click
document.addEventListener('click', function () {
  if (notice) notice.classList.remove('open');
});

  // restore unread notification on reload
if (isAuth && localStorage.getItem('hasUnreadNotice') === 'true') {
  if (dot) dot.classList.add('show');
}



});

/* ======================
   CLEAR ON LOGOUT
====================== */
function clearLoginAnim() {
  localStorage.removeItem('loginAnimPlayed');
  localStorage.removeItem('hasUnreadNotice');
}

</script>

<style>
    /* ===============================
   HEADER – PREMIUM AI NAVBAR
================================ */

.header {
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: center;
  padding: 14px 36px;
  background: linear-gradient(
    180deg,
    rgba(2,6,23,0.75),
    rgba(2,6,23,0.55)
  );
  backdrop-filter: blur(18px);
  border-bottom: 1px solid rgba(56,189,248,0.15);
  position: sticky;
  top: 0;
  z-index: 997;
}
/* =======================
   HEADER LEFT (LOGO)
======================= */

.header-left {
  display: flex;
  align-items: center;
}


/* =======================
   HEADER LEFT (LOGO)
======================= */

.header-left {
  display: flex;
  align-items: center;
}

/* Logo Image */
.header-left .logo img {
  height: 60px;
  width: auto;
  display: block;
  object-fit: contain;

  /* Smooth animation */
  transition: all 0.3s ease;
}

/* Hover Effect */
.header-left .logo:hover img {
  transform: scale(1.08);

  /* Glow effect (perfect for dark background) */
  filter: drop-shadow(0 0 8px rgba(56,189,248,0.6))
          drop-shadow(0 0 15px rgba(56,189,248,0.4));
}

/* =======================
   OPTIONAL: LOGO TEXT STYLE (if needed)
======================= */

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}

/* =======================
   RESPONSIVE DESIGN
======================= */

/* Tablet */
@media (max-width: 992px) {
  .header-left .logo img {
    height: 50px;
  }
}

/* Mobile */
@media (max-width: 576px) {
  .header-left .logo img {
    height: 42px;
  }
}
/* ===============================
   CENTER AREA
================================ */

.header-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* SLOGAN */
.slogan-box {
  text-align: center;
  animation: fadeSlideIn 0.6s ease forwards;
}

.slogan-text {
  font-size: 15px;
  font-weight: 500;
  letter-spacing: 0.5px;
  background: linear-gradient(90deg, #cbd5f5, #38bdf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* ===============================
   NAVIGATION
================================ */

.nav-horizontal {
  display: flex;
  gap: 32px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.nav-horizontal a {
  position: relative;
  color: #e5e7eb;
  font-size: 15px;
  font-weight: 500;
  text-decoration: none;
  padding: 6px 0;
  transition: color 0.3s ease;
}

/* Hover underline glow */
.nav-horizontal a::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -6px;
  width: 0;
  height: 2px;
  background: #38bdf8;
  box-shadow: 0 0 10px rgba(56,189,248,0.9);
  transform: translateX(-50%);
  transition: width 0.3s ease;
}

.nav-horizontal a:hover {
  color: #38bdf8;
}

.nav-horizontal a:hover::after {
  width: 100%;
}

/* ===============================
   LOGIN BUTTON (FINAL ANIMATION)
================================ */

.btn-login {
  padding: 8px 22px;
  border-radius: 999px;
  background: linear-gradient(135deg, #38bdf8, #0ea5e9);
  color: #020617;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 8px 24px rgba(56,189,248,0.35);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.btn-login:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 40px rgba(56,189,248,0.65);
}

/* ===============================
   MEGA DROPDOWN
================================ */

.mega-dropdown {
  position: relative;
}

.mega-panel {
  position: absolute;
  top: calc(100% + 16px);
  left: 50%;
  transform: translateX(-50%) translateY(8px);
  min-width: 230px;
  padding: 10px;
  background: linear-gradient(180deg, rgba(8,12,25,0.95), rgba(4,6,15,0.95));
  border-radius: 16px;
  border: 1px solid rgba(56,189,248,0.25);
  box-shadow: 0 30px 80px rgba(0,0,0,0.8);
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: all 0.25s ease;
  z-index: 9999;
}

.mega-dropdown.active .mega-panel {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
  transform: translateX(-50%) translateY(0);
}

.mega-item {
  display: block;
  padding: 12px 16px;
  border-radius: 12px;
  font-size: 14.5px;
  color: #e5e7eb;
  text-decoration: none;
  transition: background 0.25s ease, color 0.25s ease;
}

.mega-item:hover {
  background: rgba(56,189,248,0.15);
  color: #38bdf8;
}

/* ===============================
   USER AVATAR
================================ */

.header-right {
  display: flex;
  align-items: center;
}

.nav-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid rgba(56,189,248,0.4);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.nav-avatar:hover {
  transform: scale(1.05);
  box-shadow: 0 0 18px rgba(56,189,248,0.8);
}

/* ===============================
   USER DROPDOWN
================================ */

.user-dropdown {
  position: relative;
}

.user-dropdown .dropdown-menu {
  display: none;
  position: absolute;
  right: 0;
  top: calc(100% + 14px);
  min-width: 200px;
  background: rgba(8,12,25,0.95);
  border-radius: 16px;
  padding: 8px;
  box-shadow: 0 30px 80px rgba(0,0,0,0.8);
}

.user-dropdown.active .dropdown-menu {
  display: block;
}

/* ===============================
   ANIMATION
================================ */

@keyframes fadeSlideIn {
  from {
    opacity: 0;
    transform: translateY(8px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ===============================
   LOGIN SUCCESS ANIMATION
================================ */

.login-success-anim {
  position: fixed;
  top: 90px;
  left: 50%;
  transform: translateX(-50%) translateY(-10px);
  background: linear-gradient(135deg, #38bdf8, #0ea5e9);
  color: #020617;
  padding: 12px 26px;
  border-radius: 999px;
  font-size: 14.5px;
  font-weight: 600;
  box-shadow: 0 20px 50px rgba(56,189,248,0.6);
  opacity: 0;
  pointer-events: none;
  z-index: 9999;
}

/* Play animation */
.login-success-anim.show {
  animation: loginPop 2.6s ease forwards;
}

@keyframes loginPop {
  0% {
    opacity: 0;
    transform: translateX(-50%) translateY(-12px);
  }
  15% {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }
  85% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: translateX(-50%) translateY(-10px);
  }
}


/* ===============================
   NOTIFICATION BELL DOT
================================ */

.notification-bell {
  position: relative;
}

.notify-dot {
  position: absolute;
  top: 4px;
  right: 4px;
  width: 8px;
  height: 8px;
  background: #38bdf8;
  border-radius: 50%;
  display: none;
  box-shadow: 0 0 10px rgba(56,189,248,0.9);
}

.notify-dot.show {
  display: block;
}

/* ===============================
   FIRST LOGIN NOTICE
================================ */

.first-login-notice {
  position: fixed;
  top: 140px;
  right: 30px;
  width: 320px;
  background: linear-gradient(180deg, rgba(8,12,25,0.95), rgba(4,6,15,0.95));
  border: 1px solid rgba(56,189,248,0.25);
  border-radius: 16px;
  padding: 16px 18px;
  box-shadow: 0 30px 80px rgba(0,0,0,0.8);
  opacity: 0;
  transform: translateY(10px);
pointer-events: auto;
display: none;

  z-index: 9999;
}


.first-login-notice.open {
  display: block;
  opacity: 1;
  transform: translateY(0);
}


.first-login-notice h6 {
  margin: 0 0 6px;
  font-weight: 600;
  color: #38bdf8;
}

.first-login-notice p {
  margin: 0;
  font-size: 13.5px;
  color: #e5e7eb;
  line-height: 1.5;
}

.first-login-notice.show {
  animation: noticeSlide 4.5s ease forwards;
}

@keyframes noticeSlide {
  0% {
    opacity: 0;
    transform: translateY(12px);
  }
  15% {
    opacity: 1;
    transform: translateY(0);
  }
  85% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: translateY(-6px);
  }
}


</style>