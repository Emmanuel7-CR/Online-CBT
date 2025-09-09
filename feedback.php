<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PTI Online CBT | Feedback</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #00416A, #198754);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .auth-card {
      border-radius: 1rem;
      background: #fff;
    }
    .form-control {
      border: 1px solid black !important;
      color: black !important;
      background-color: white !important;
      box-shadow: none !important;
    }
    .form-control:focus {
      border-color: black !important;
      box-shadow: none !important;
    }
    .input-group-text {
      background-color: #212529;
      color: white;
      border-top-left-radius: .75rem !important;
      border-bottom-left-radius: .75rem !important;
    }
    .btn-primary {
      border-radius: 50px;
      font-weight: 600;
    }
    .form-floating > label {
      color: #6c757d;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 p-4 auth-card" style="max-width:520px;width:100%;">
    
    <!-- Logo -->
    <div class="text-center mb-3">
      <img src="image/PTI.jpg" alt="PTI Logo" class="img-fluid mb-2" style="width:80px;height:auto;">
      <h4 class="fw-bold mb-0">Petroleum Training Institute</h4>
    </div>

    <!-- Title -->
    <div class="text-center mb-4">
      <h5 class="fw-semibold">Feedback Form</h5>
      <p class="small text-muted mb-0">We’d love to hear your thoughts</p>
    </div>

    <!-- Success Alert -->
    <?php if(@$_GET['q']): ?>
      <div class="alert alert-success py-2 px-3">
        <i class="bi bi-check-circle me-1"></i><?php echo @$_GET['q']; ?>
      </div>
    <?php endif; ?>

    <!-- Feedback Form -->
    <?php if(!@$_GET['q']): ?>
    <form class="needs-validation" novalidate action="feed.php?q=feedback.php" method="POST">
      
      <!-- Full Name -->
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="text" class="form-control" id="fbName" name="name" placeholder="Full Name" required minlength="2">
          <label for="fbName">Full Name</label>
          <div class="invalid-feedback">Please enter your name.</div>
        </div>
      </div>

      <!-- Subject -->
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="text" class="form-control" id="fbSubject" name="subject" placeholder="Subject" required minlength="2">
          <label for="fbSubject">Subject</label>
          <div class="invalid-feedback">Please enter a subject.</div>
        </div>
      </div>

      <!-- Email -->
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <div class="form-floating flex-grow-1">
          <input type="email" class="form-control" id="fbEmail" name="email" placeholder="name@example.com" required>
          <label for="fbEmail">Email address</label>
          <div class="invalid-feedback">Enter a valid email.</div>
        </div>
      </div>

      <!-- Feedback -->
      <div class="input-group mb-3">
        <span class="input-group-text align-items-start pt-3"><i class="bi bi-chat-dots"></i></span>
        <div class="form-floating flex-grow-1">
          <textarea class="form-control" id="fbMessage" name="feedback" placeholder="Write your feedback" style="height:100px" required></textarea>
          <label for="fbMessage">Your Feedback</label>
          <div class="invalid-feedback">Please enter your feedback.</div>
        </div>
      </div>

      <!-- Submit -->
      <div class="d-grid">
        <button type="submit" name="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-send me-1"></i> Submit Feedback
        </button>
      </div>

    </form>
    <?php endif; ?>

    <!-- Footer -->
    <p class="text-center mt-4 small text-muted mb-0">
      &copy; <?= date('Y') ?> Petroleum Training Institute
    </p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
</script>
</body>
</html>
