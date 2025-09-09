<?php
// signup.php
$currentPage = 'signup';
include 'header.php';
$year = date('Y');
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 p-4 auth-card" style="max-width: 520px; width:100%;">
    
    <!-- Logo -->
    <div class="text-center mb-3">
      <img src="image/PTI.jpg" alt="PTI Logo" class="img-fluid mb-2" style="width:80px; height:auto;">
      <h4 class="fw-bold mb-0">Petroleum Training Institute</h4>
    </div>

    <!-- Title -->
    <div class="text-center mb-4">
      <h5 class="fw-semibold">Create your account</h5>
    </div>

    <!-- Signup form -->
    <form class="needs-validation mx-auto" novalidate action="sign.php?q=account.php" method="POST">

      <!-- Full Name -->
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-person"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required minlength="2" autocomplete="off">
          <label for="name">Full Name</label>
          <div class="invalid-feedback">Please enter your name.</div>
        </div>
      </div>

     <!-- Gender -->
<div class="input-group mb-3">
  <span class="input-group-text bg-dark"><i class="bi bi-gender-ambiguous"></i></span>
  <div class="form-control d-flex align-items-center justify-content-between">
    <div class="form-check">
      <input class="form-check-input gender-checkbox" type="checkbox" id="genderM" name="gender" value="M">
      <label class="form-check-label" for="genderM">Male</label>
    </div>
    <div class="form-check">
      <input class="form-check-input gender-checkbox" type="checkbox" id="genderF" name="gender" value="F">
      <label class="form-check-label" for="genderF">Female</label>
    </div>
  </div>
</div>
<div class="invalid-feedback ">Please select a gender.</div>


      <!-- Email -->
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-envelope"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off">
          <label for="email">Email</label>
          <div class="invalid-feedback">Enter valid email.</div>
        </div>
      </div>

      <!-- REG Number -->
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-card-checklist"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="tel" class="form-control" id="mob" name="mob" placeholder="REG Number" required pattern="[\d+\-\s()]{7,}" autocomplete="off">
          <label for="mob">REG Number</label>
          <div class="invalid-feedback">Enter valid REG number.</div>
        </div>
      </div>

      <!-- Password -->
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-lock"></i></span>
        <div class="form-floating flex-grow-1 position-relative">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required minlength="8" maxlength="16" autocomplete="new-password">
          <label for="password">Password</label>
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('password', this)">
            <i class="bi bi-eye"></i>
          </button>
          <div class="invalid-feedback">Password must be 8–16 characters.</div>
        </div>
      </div>

      <!-- Strength meter -->
      <div class="mb-3" id="strengthWrapper" style="display:none;">
        <small id="strengthMessage" class="fw-semibold"></small>
        <div class="progress" style="height:5px;">
          <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%"></div>
        </div>
      </div>

      <!-- Confirm Password -->
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-shield-lock"></i></span>
        <div class="form-floating flex-grow-1 position-relative">
          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required autocomplete="new-password">
          <label for="cpassword">Confirm Password</label>
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('cpassword', this)">
            <i class="bi bi-eye"></i>
          </button>
          <div class="invalid-feedback">Please confirm password.</div>
        </div>
      </div>

      <div class="mb-2"><small id="matchHelp" class="fw-semibold"></small></div>

      <!-- Error messages -->
      <?php if (isset($_GET['error_signup'])): ?><p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_signup']) ?></p><?php endif; ?>
      <?php if (isset($_GET['q7'])): ?><p class="text-danger small mb-2"><?= htmlspecialchars($_GET['q7']) ?></p><?php endif; ?>

      <!-- Submit -->
      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-person-plus me-1"></i> Sign Up
        </button>
      </div>
    </form>

    <!-- Footer -->
    <p class="text-center mt-4 small text-muted mb-0">
      &copy; <?= $year ?> Petroleum Training Institute
    </p>
  </div>
</div>

<!-- Toasts -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:1100">
  <div id="successToast" class="toast align-items-center text-bg-success border-0">
    <div class="d-flex">
      <div class="toast-body">
        <?php echo isset($_GET['success']) ? htmlspecialchars($_GET['success']) : ''; ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index:1200">
  <div id="errorToast" class="toast align-items-center text-bg-danger border-0">
    <div class="d-flex">
      <div class="toast-body">
        <?php echo isset($_GET['w']) ? htmlspecialchars($_GET['w']) : ''; ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<style>
  body {
    background: linear-gradient(135deg, #00416A, #198754);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .auth-card {
    border-radius: 1rem;
    background: #fff;
  }
  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    border-color: #0d6efd;
  }
  .btn-primary {
    border-radius: 50px;
    font-weight: 600;
  }
  .input-group-text {
    border-top-left-radius: .75rem !important;
    border-bottom-left-radius: .75rem !important;
  }
  .form-floating > label {
    color: #6c757d;
  }
  .auth-card .form-control {
  border: 1px solid black !important;
  box-shadow: none !important;
}
/* For all form inputs */
.form-control {
  border: 1px solid black !important;  /* black outline */
  color: black !important;             /* black text when typing */
  background-color: white !important;  /* ensure white background */
  box-shadow: none !important;
}

/* Black text for placeholders too */


/* Keep border black on focus */
.form-control:focus {
  border-color: black !important;
  box-shadow: none !important;
}
</style>

<script>
  // validation
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();

  // toggle password
  function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (input.type === "password") {
      input.type = "text";
      icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
      input.type = "password";
      icon.classList.replace("bi-eye-slash", "bi-eye");
    }
  }

  // confirm password check
  (function(){
    const pw = document.getElementById("password");
    const cpw = document.getElementById("cpassword");
    const help = document.getElementById("matchHelp");
    if(!pw || !cpw) return;
    const check = () => {
      if(!cpw.value){
        help.textContent = '';
        cpw.setCustomValidity('');
        return;
      }
      if(pw.value !== cpw.value){
        help.textContent = "Passwords do not match";
        help.className = "text-danger fw-semibold";
        cpw.setCustomValidity("Mismatch");
      } else {
        help.textContent = "Passwords match";
        help.className = "text-success fw-semibold";
        cpw.setCustomValidity("");
      }
    };
    pw.addEventListener("input", check);
    cpw.addEventListener("input", check);
  })();

  // password strength meter
  (function(){
    const pw = document.getElementById("password");
    const bar = document.getElementById("strengthBar");
    const msg = document.getElementById("strengthMessage");
    const wrap = document.getElementById("strengthWrapper");
    if(!pw) return;
    pw.addEventListener("input", () => {
      if(!pw.value){
        wrap.style.display = "none";
        bar.style.width = "0%";
        msg.textContent = "";
        return;
      }
      wrap.style.display = "block";
      let s=0;
      if(pw.value.length>=8) s++;
      if(/[A-Z]/.test(pw.value)) s++;
      if(/[0-9]/.test(pw.value)) s++;
      if(/[^A-Za-z0-9]/.test(pw.value)) s++;
      switch(s){
        case 1: bar.style.width="25%"; bar.className="progress-bar bg-danger"; msg.textContent="Weak"; msg.className="text-danger fw-semibold"; break;
        case 2: bar.style.width="50%"; bar.className="progress-bar bg-warning"; msg.textContent="Medium"; msg.className="text-warning fw-semibold"; break;
        case 3: bar.style.width="75%"; bar.className="progress-bar bg-primary"; msg.textContent="Strong"; msg.className="text-primary fw-semibold"; break;
        case 4: bar.style.width="100%"; bar.className="progress-bar bg-success"; msg.textContent="Very Strong"; msg.className="text-success fw-semibold"; break;
      }
    });
  })();

  // gender checkbox (only one allowed)
  document.addEventListener('DOMContentLoaded', function() {
    var genderCheckboxes = document.querySelectorAll('.gender-checkbox');
    genderCheckboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          genderCheckboxes.forEach(function(cb) {
            if (cb !== checkbox) cb.checked = false;
          });
        }
      });
    });
  });

  // auto-show toasts
  (function(){
    const errorToastEl = document.getElementById("errorToast");
    if(errorToastEl && errorToastEl.querySelector(".toast-body").textContent.trim()!==""){
      new bootstrap.Toast(errorToastEl,{delay:4000}).show();
    }
    const successToastEl = document.getElementById("successToast");
    if(successToastEl && successToastEl.querySelector(".toast-body").textContent.trim()!==""){
      new bootstrap.Toast(successToastEl,{delay:4000}).show();
    }
  })();
</script>
</body>
</html>
