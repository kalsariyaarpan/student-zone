@extends('user-auth.auth')

@section('title')
register
@endsection

@section('auth-content')

<div class="auth-box">
  <div class="floating-glow"></div>

  <h2>Create Account</h2>

  <div class="auth-footer">
    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
  </div>

  {{-- Backend Validation --}}
  @if ($errors->any())
      <div class="alert alert-danger" style="padding:10px;">
          <ul style="margin:0;">
              @foreach ($errors->all() as $error)
                  <li style="color:rgb(230,100,100)">{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form id="registerForm" action="{{ route('register.store') }}" method="POST" novalidate>
    @csrf

    <div class="auth-input">
      <label>Username</label>
      <input type="text" name="username" placeholder="Username" id="username">
      <small class="error-msg"></small>
    </div>

    <div class="two-inputs">
      <div>
        <input type="text" name="first_name" id="first_name" placeholder="First Name">
        <small class="error-msg"></small>
      </div>
      <div>
        <input type="text" name="last_name" id="last_name" placeholder="Last Name">
        <small class="error-msg"></small>
      </div>
    </div>

    <div class="auth-input">
      <label>Email</label>
      <input type="email"  placeholder="ex :myname@example.com" name="email" id="email">
      <small class="error-msg"></small>
    </div>

    <div class="auth-input">
      <label>Password</label>
      <input type="password" name="password"  placeholder="Enter your password" id="password">
      <small class="error-msg"></small>
      <div class="password-strength" id="strengthText"></div>
    </div>

    <div class="auth-input">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation"  placeholder="Confirm your password" id="confirm_password">
      <small class="error-msg"></small>
    </div>

    <button type="submit" class="auth-btn" id="registerBtn">
      Sign Up
    </button>
  </form>
</div>

{{-- ================= CLIENT SIDE SCRIPT ================= --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("registerForm");
  const btn = document.getElementById("registerBtn");

  const fields = {
    username: document.getElementById("username"),
    firstName: document.getElementById("first_name"),
    lastName: document.getElementById("last_name"),
    email: document.getElementById("email"),
    password: document.getElementById("password"),
    confirm: document.getElementById("confirm_password"),
  };

  const strengthText = document.getElementById("strengthText");

  function error(input, msg) {
  const wrapper = input.closest('.auth-input') || input.parentElement;
  const small = wrapper.querySelector('.error-msg');

  input.classList.add("input-error");
  input.classList.remove("input-success");

  if (small) small.innerText = msg;
}

function success(input) {
  const wrapper = input.closest('.auth-input') || input.parentElement;
  const small = wrapper.querySelector('.error-msg');

  input.classList.remove("input-error");
  input.classList.add("input-success");
 
  


  if (small) small.innerText = "";
}

  function emailValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }


  function passwordStrength(pwd) {
    let strength = 0;
    if (pwd.length >= 8) strength++;
    if (/[A-Z]/.test(pwd)) strength++;
    if (/[0-9]/.test(pwd)) strength++;
    if (/[^A-Za-z0-9]/.test(pwd)) strength++;

    if (strength <= 1) return "Weak";
    if (strength === 2) return "Medium";
    return "Strong";
  }

  fields.password.addEventListener("input", () => {
    const value = fields.password.value;
    if (value.length < 6) {
      error(fields.password, "Minimum 6 characters");
      strengthText.innerText = "";
    } else {
      success(fields.password);
      const strength = passwordStrength(value);
      strengthText.innerText = "Password Strength: " + strength;
      strengthText.style.color =
        strength === "Strong" ? "#3ddc97" : strength === "Medium" ? "#f9c74f" : "#ff5b5b";
    }
  });

  fields.confirm.addEventListener("input", () => {
    if (fields.confirm.value !== fields.password.value) {
      error(fields.confirm, "Passwords do not match");
    } else {
      success(fields.confirm);
    }
  });

  function resetErrors() {
  document.querySelectorAll(".error-msg").forEach(el => el.innerText = "");
  document.querySelectorAll(".input-error").forEach(el => {
    el.classList.remove("input-error");
  });
}

 form.addEventListener("submit", (e) => {
  resetErrors(); // 🔥 CLEAR OLD ERRORS FIRST

  let valid = true;

  if (fields.username.value.length < 3) {
    error(fields.username, "Username must be 3+ characters");
    valid = false;
  }

  if (!fields.firstName.value.trim()) {
    error(fields.firstName, "First name required");
    valid = false;
  }

  if (!fields.lastName.value.trim()) {
    error(fields.lastName, "Last name required");
    valid = false;
  }

  if (!emailValid(fields.email.value)) {
    error(fields.email, "Invalid email");
    valid = false;
  }

  if (fields.password.value.length < 6) {
    error(fields.password, "Password too short");
    valid = false;
  }

  if (fields.confirm.value !== fields.password.value) {
    error(fields.confirm, "Password do not match");
    valid = false;
  }

  if (!valid) {
    e.preventDefault();
    return;
  }

  btn.disabled = true;
  btn.innerText = "Creating account...";
  });

  //mail check
  let emailTimer = null;

fields.email.addEventListener("input", () => {
  const email = fields.email.value.trim();

  // Clear previous timer
  clearTimeout(emailTimer);

  // Reset UI
  success(fields.email);

  if (!emailValid(email)) {
    error(fields.email, "Invalid email format");
    return;
  }

  // Debounce (wait user stops typing)
  emailTimer = setTimeout(() => {
    checkEmailAvailability(email);
  }, 600);
});

function checkEmailAvailability(email) {
  const token = document.querySelector('input[name="_token"]').value;
  const wrapper = fields.email.closest('.auth-input');
  const small = wrapper.querySelector('.error-msg');

  small.innerText = "Checking email...";
  small.style.color = "#f9c74f";

  fetch("{{ route('check.email') }}", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
  },
  body: JSON.stringify({ email })
})


  .then(res => res.json())
  .then(data => {
    if (data.exists) {
      error(fields.email, "Email already registered");
    } else {
      success(fields.email);
      small.innerText = "Email available";
      small.style.color = "#3ddc97";
    }
  })
  .catch(() => {
    error(fields.email, "Unable to check email right now");
  });
}

});
</script>

{{-- ================= MINIMAL CSS ================= --}}
<style>
.error-msg {
  font-size: 12px;
  color: #ff6b6b;
  margin-top: 6px;
  display: block;
  min-height: 14px; /* keeps layout stable */
}

.input-error {
  border-color: #ff6b6b !important;
}

.input-success {
  border-color: #3ddc97 !important;
}


.two-inputs {
  display: flex;
  gap: 12px;
  margin-bottom: 18px;
}

.two-inputs > div {
  flex: 1;
}

.two-inputs input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 8px;
  border: 1px solid #444;
  /* background: #1e1e1e; */
  color: #fff;
}

.password-strength {
  font-size: 12px;
  margin-top: 6px;
  color: #aaa;
}
.error-msg:empty {
  display: none;
}

.auth-input {
  margin-bottom: 18px;
} 


.auth-input label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
  color: #cfcfcf;
}




.auth-input input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 8px;
  border: 1px solid #444;
  /* background: #1e1e1e; */
  color: #fff;
  outline: none;
}

.auth-btn {
  margin-top: 10px;
  padding: 12px;
  border-radius: 10px;
  font-size: 16px;
  font-weight: 600;
</style>

@endsection
{{-- 

  


--}}
{{-- 

} --}}

