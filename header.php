<?php
// header.php
// Reusable header/navigation. To use, set $currentPage = 'login'|'signup'|'admin' before including.
if (!isset($currentPage)) $currentPage = '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Worlds || TEST YOUR SKILL</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Styles (kept as in original) -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/font.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet">

  <!-- Small extra modern styling to lift the default Bootstrap look -->
  <style>
    /* Modern background gradient */
    body { 
      font-family: "Roboto", sans-serif;
      background: linear-gradient(160deg,#0f5132 0%, #1b6b48 40%, #083325 100%);
      color: #f8fafc;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      min-height:100vh;
    }
    .auth-card {
      max-width: 920px;
      border-radius: 16px;
      backdrop-filter: blur(6px) saturate(1.1);
      background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
      border: 1px solid rgba(255,255,255,0.06);
    }
    .bg-glass { box-shadow: 0 10px 30px rgba(2,6,23,0.6); }
    .navbar-brand .pti-full { letter-spacing: 0.2px; }
    .nav-link.active, .nav-link:hover { text-decoration: none; opacity: 0.95; }
    /* active indicator */
    .nav-item .active-indicator { display:inline-block; width:8px; height:8px; border-radius:50%; margin-left:6px; vertical-align:middle;}
    .nav-link.active .active-indicator { background:#ffd600; box-shadow:0 0 6px rgba(255,214,13,0.35); }
    .input-group-text { background: transparent; border-right:0; color: #e9f7ef; }
    .form-control { background: rgba(255,255,255,0.02); border-left:0; color: #fff; }
    .form-floating > label { color: rgba(255,255,255,0.8); }
    .btn-primary { background: linear-gradient(90deg,#198754,#0d6efd); border: none; box-shadow: 0 6px 18px rgba(13,110,253,0.12); }
    .progress-bar.weak { background: #dc3545; }
    .progress-bar.medium { background: #ffc107; }
    .progress-bar.strong { background: #198754; }
    .toast-body { color: #fff; }
    /* Mobile tweaks */
    @media (max-width: 576px) {
      .auth-card { margin: 1rem; padding: 1rem; border-radius: 12px; }
      .navbar-brand .pti-full { font-size: 0.95rem; }
    }
  </style>

  <!-- Optional jQuery (kept only if other scripts rely on it) -->
  <script src="js/jquery.js"></script>
  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
  <nav class="navbar navbar-dark bg-success fixed-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-5 d-flex align-items-center gap-2" href="login.php">
        <img src="image/PTI.jpg" alt="PTI Logo" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
        <span class="pti-full">Petroleum Training Institute</span>
      </a>

      <ul class="navbar-nav ms-auto d-none d-md-flex flex-row gap-3 align-items-center">
        <li class="nav-item">
          <a href="user-login.php" class="nav-link text-white <?= $currentPage === 'login' ? 'active' : '' ?>">
            Login
            <?php if ($currentPage === 'login'): ?><span class=""></span><?php endif; ?>
          </a>
        </li>
        <li class="nav-item">
          <a href="user-signup.php" class="nav-link text-white <?= $currentPage === 'signup' ? 'active' : '' ?>">
            Sign Up
            <?php if ($currentPage === 'signup'): ?><span class=""></span><?php endif; ?>
          </a>
        </li>
        <li class="nav-item">
          <a href="admin-login.php" class="nav-link text-white <?= $currentPage === 'admin' ? 'active' : '' ?>">
            Admin Login
            <?php if ($currentPage === 'admin'): ?><span class=""></span><?php endif; ?>
          </a>
        </li>
        
      </ul>

      <!-- Mobile offcanvas -->
      <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav" aria-controls="sideNav" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sideNav" aria-labelledby="sideNavLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sideNavLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-column gap-2">
            <li class="nav-item"><a class="nav-link text-white <?= $currentPage === 'login' ? 'active' : '' ?>" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= $currentPage === 'signup' ? 'active' : '' ?>" href="signup.php">Sign Up</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= $currentPage === 'admin' ? 'active' : '' ?>" href="admin-login.php">Admin Login</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="feedback.php">Feedback</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- spacing so content doesn't sit under fixed header -->
<div style="height:72px;"></div>
