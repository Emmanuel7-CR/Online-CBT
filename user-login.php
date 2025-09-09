<?php
// login.php
$currentPage = 'login';
include 'header.php';
$year = date('Y');
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 p-4 auth-card" style="max-width: 450px; width:100%;">
    
    <!-- Logo -->
    <div class="text-center mb-3">
      <img src="image/PTI.jpg" alt="PTI Logo" class="img-fluid mb-2" style="width:80px; height:auto;">
      <h4 class="fw-bold mb-0">Petroleum Training Institute</h4>
    </div>

    <!-- Welcome Text -->
    <div class="text-center mb-4">
      <h5 class="fw-semibold">Student Login</h5>
    </div>

    <!-- Login form -->
    <form class="needs-validation" novalidate action="login.php?q=index.php" method="POST">
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-envelope"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Email" required autocomplete="off">
          <label for="loginEmail">Email</label>
          <div class="invalid-feedback">Please enter a valid email.</div>
        </div>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-lock"></i></span>
        <div class="form-floating flex-grow-1 position-relative">
          <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required minlength="8" maxlength="16" autocomplete="new-password">
          <label for="loginPassword">Password</label>
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('loginPassword', this)">
            <i class="bi bi-eye"></i>
          </button>
          <div class="invalid-feedback">Password must be 8–16 characters.</div>
        </div>
      </div>

      <?php if (isset($_GET['error_login'])): ?>
        <p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_login']) ?></p>
      <?php endif; ?>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-box-arrow-in-right me-1"></i> Log In
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

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1200">
  <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert">
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
    background: linear-gradient(135deg, #00416A, #198754); /* Clean gradient background */
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

  // auto-show error toast
  (function(){
    const errorToastEl = document.getElementById("errorToast");
    if(errorToastEl && errorToastEl.querySelector(".toast-body").textContent.trim()!==""){
      new bootstrap.Toast(errorToastEl,{delay:4000}).show();
    }
  })();

  // auto-show success toast
  (function(){
    const successToastEl = document.getElementById("successToast");
    if(successToastEl && successToastEl.querySelector(".toast-body").textContent.trim()!==""){
      new bootstrap.Toast(successToastEl,{delay:4000}).show();
    }
  })();
</script>
</body>
</html>
