@extends('user-auth.auth')

@section('title')
login
@endsection

@section('auth-content')

<div class="auth-box">
  <div class="floating-glow"></div>

  <h2>Hello Student</h2>

  {{-- Alerts (Backend) --}}
 @if(session('success'))
<div class="aurora-middle success" data-time="4200">
    <div class="aurora-glow"></div>

    <div class="aurora-card">
        <div class="aurora-icon">✔</div>
        <h3>Success</h3>
        <p>{{ session('success') }}</p>
        <div class="aurora-progress"></div>
    </div>
</div>
@endif

@if(session('error'))
<div class="aurora-middle error" data-time="4200">
    <div class="aurora-glow"></div>

    <div class="aurora-card">
        <div class="aurora-icon">🔒</div>
        <h3>Login Required</h3>
        <p>{{ session('error') }}</p>
        <div class="aurora-progress"></div>
    </div>
</div>
@endif


  <form id="loginForm" action="{{ route('login') }}" method="POST" novalidate>
    @csrf

    <div class="auth-input">
      <label>Username or Email</label>
      <input type="text" name="username" placeholder="Email / Username  " id="username" />
      <small class="error-msg"></small>
    </div>

    <div class="auth-input">
      <label>Password</label>
      <input type="password" name="password"  placeholder="Enter your password" id="password" />
      <small class="error-msg"></small>
    </div>

    <button class="auth-btn" id="loginBtn" type="submit">
      Login
    </button>
    <div class="social-login">
  <a href="{{ route('google.login') }}" class="google-btn">
    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
    Continue with Google
  </a>
</div>

  </form>

  <div class="auth-footer">
    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
  </div>
</div>

{{-- ================= CLIENT SIDE SCRIPT ================= --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const username = document.getElementById("username");
  const password = document.getElementById("password");
  const button = document.getElementById("loginBtn");

  function showError(input, message) {
    const small = input.nextElementSibling;
    small.innerText = message;
    input.classList.add("input-error");
    input.classList.remove("input-success");
  }

  function showSuccess(input) {
    const small = input.nextElementSibling;
    small.innerText = "";
    input.classList.remove("input-error");
    input.classList.add("input-success");
  }

  function validateEmailOrUsername(value) {
    return value.length >= 3;
  }

  function validatePassword(value) {
    return value.length >= 6;
  }

  username.addEventListener("input", () => {
    if (!validateEmailOrUsername(username.value.trim())) {
      showError(username, "Enter valid username or email");
    } else {
      showSuccess(username);
    }
  });

  password.addEventListener("input", () => {
    if (!validatePassword(password.value.trim())) {
      showError(password, "Password must be at least 6 characters");
    } else {
      showSuccess(password);
    }
  });

  form.addEventListener("submit", (e) => {
    let valid = true;

    if (!validateEmailOrUsername(username.value.trim())) {
      showError(username, "Username or email required");
      valid = false;
    }

    if (!validatePassword(password.value.trim())) {
      showError(password, "Password is required");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      return;
    }

    // UX: disable button + loading text
    button.disabled = true;
    button.innerText = "Logging in...";
  });
});


document.querySelectorAll('.aurora-middle').forEach(el => {
    const time = el.dataset.time || 4000;
    const progress = el.querySelector('.aurora-progress');
    progress.style.animationDuration = time + 'ms';

    setTimeout(() => {
        el.style.animation = 'fadeOut 0.5s ease forwards';
        el.querySelector('.aurora-card').style.transform = 'scale(0.9)';
        setTimeout(() => el.remove(), 600);
    }, time);
});




</script>

{{-- ================= MINIMAL CSS ================= --}}
<style>
.auth-input small {
  color: #ff5b5b;
  font-size: 12px;
  margin-top: 4px;
  display: block;
}

.input-error {
  border: 1px solid #ff5b5b !important;
}

.input-success {
  border: 1px solid #3ddc97 !important;
}

/* ===============================
   AURORA MIDDLE TOAST
================================ */

.aurora-middle {
    position: fixed;
    inset: 0;
    display: grid;
    place-items: center;
    z-index: 9999;
    background: rgba(0,0,0,0.35);
    backdrop-filter: blur(4px);
    animation: fadeIn 0.4s ease forwards;
}

/* Glow background */
.aurora-middle .aurora-glow {
    position: absolute;
    width: 520px;
    height: 520px;
    border-radius: 50%;
    filter: blur(90px);
    opacity: 0.6;
}

/* Card */
.aurora-card {
    position: relative;
    width: 360px;
    padding: 28px 26px 30px;
    border-radius: 22px;
    text-align: center;
    background: rgba(18,18,18,0.85);
    backdrop-filter: blur(18px);
    box-shadow:
        0 30px 80px rgba(0,0,0,0.6),
        inset 0 0 0 1px rgba(255,255,255,0.08);
    transform: scale(0.75);
    opacity: 0;
    animation: auroraPop 0.55s cubic-bezier(.2,.8,.2,1) forwards;
}

/* Icon */
.aurora-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 14px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 26px;
    font-weight: bold;
}

/* Text */
.aurora-card h3 {
    margin: 8px 0 6px;
    font-size: 20px;
    font-weight: 600;
    color: white
}

.aurora-card p {
    font-size: 14px;
    opacity: 0.9;
    color: #ddd;
}

/* Progress */
.aurora-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 100%;
    border-radius: 0 0 22px 22px;
    animation: progress linear forwards;
}

/* SUCCESS */
.aurora-middle.success .aurora-glow {
    background: radial-gradient(circle, #3ddc97, transparent 70%);
}
.aurora-middle.success .aurora-icon {
    background: linear-gradient(135deg, #3ddc97, #1fbf75);
    color: #000000;
}
.aurora-middle.success .aurora-progress {
    background: linear-gradient(90deg, #3ddc97, #1fbf75);
}

/* ERROR */
.aurora-middle.error .aurora-glow {
    background: radial-gradient(circle, #f59e0b, transparent 70%);
}
.aurora-middle.error .aurora-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #000;
}
.aurora-middle.error .aurora-progress {
    background: linear-gradient(90deg, #f59e0b, #d97706);
}

/* Animations */
@keyframes auroraPop {
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes fadeIn {
    from { opacity: 0 }
    to { opacity: 1 }
}

@keyframes fadeOut {
    to { opacity: 0 }
}

@keyframes progress {
    from { width: 100% }
    to { width: 0% }
}


</style>

@endsection
