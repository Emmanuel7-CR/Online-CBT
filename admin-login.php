<?php
// admin-login.php
// Admin login page. Field IDs and names preserved exactly.
$currentPage = 'admin';
include 'header.php';
$year = date('Y');
?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 p-4 auth-card" style="max-width: 450px; width:100%;">
    
    <!-- Logo / Brand -->
    <div class="text-center mb-3">
      <img src="image/PTI.jpg" alt="PTI Logo" class="img-fluid mb-2" style="width:80px; height:auto;">
      <h4 class="fw-bold mb-0">Petroleum Training Institute</h4>
    </div>

    <!-- Header -->
    <div class="text-center mb-4">
      <h5 class="fw-semibold">Admin Login</h5>
     
    </div>

    <!-- Login form (keeps IDs and names exactly as original) -->
    <form class="needs-validation" novalidate action="admin.php?q=index.php" method="POST" style="width:100%;">
      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-person-badge"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="text" class="form-control" id="adminUser" name="uname" placeholder="" required maxlength="20" autocomplete="off">
          <label for="adminUser">Admin user id</label>
          <div class="invalid-feedback">Enter admin ID.</div>
        </div>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text bg-dark"><i class="bi bi-lock-fill"></i></span>
        <div class="form-floating flex-grow-1 position-relative">
          <input type="password" class="form-control" id="adminPassword" name="password" placeholder="" required minlength="5" maxlength="15" autocomplete="new-password">
          <label for="adminPassword">Password</label>
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('adminPassword', this)">
            <i class="bi bi-eye"></i>
          </button>
          <div class="invalid-feedback">Password must be 5–15 characters.</div>
        </div>
      </div>

      <?php if (isset($_GET['error_admin'])): ?>
        <p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_admin']) ?></p>
      <?php endif; ?>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-box-arrow-in-right me-1"></i> Admin Login
        </button>
      </div>
    </form>

    <p class="text-center mt-4 small text-muted mb-0">&copy; <?= $year ?> Petroleum Training Institute</p>
  </div>
</div>

<!-- Developers modal (centered, closes on backdrop click or Close button) -->
<div class="modal fade" id="developers" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">Developers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="mb-0">
          <li>Jonathan Ikpen — Lead Developer</li>
          <li>Team PTI — Contributors</li>
        </ul>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Success & Error Toasts -->
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
    background: linear-gradient(135deg, #00416A, #198754);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .auth-card {
    border-radius: 1rem;
    background: #fff;
  }
  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.18);
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
  /* Modal polish */
  .modal-content {
    border-radius: .85rem;
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
  // Bootstrap validation (behavior preserved)
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

  // Toggle password (kept identical)
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

  // Auto-show toasts if message exists
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

  // close offcanvas when resizing to desktop (kept from original)
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 1000) {
      let offcanvasEl = document.querySelector('#sideNav');
      if (offcanvasEl) {
        let offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (offcanvas) offcanvas.hide();
      }
    }
  });
</script>

</body>
</html>
