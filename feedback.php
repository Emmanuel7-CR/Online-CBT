<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PTI Online CBT | Feedback</title>
  <!-- Bootstrap 5 & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
   
  <!-- Custom Fonts -->
  <link rel="stylesheet" href="css/feedback.css">
  <link rel="stylesheet" href="css/font.css">

<!-- Scripts -->
  <script src="js/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->
</head>

<body>

<header>
  <nav class="navbar navbar-dark bg-success fixed-top">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="#">
        <img src="image/PTI.jpg" alt="PTI Logo" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
        <span class="pti-full">Petroleum Training Institute</span>
        <span class="pti-short d-none">PTI</span>
      </a>

      <!-- Desktop Nav (visible on md+ screens) -->
     <ul class="navbar-nav ms-auto d-none d-custom-flex flex-row gap-3">
      <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="index.php#admin-pane">Admin Login</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#developers">Developers</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="#" target="_blank">About us</a></li>
</ul>

      <!-- Offcanvas Toggler (visible only on small screens) -->
      <button class="navbar-toggler d-custom-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav" aria-controls="sideNav" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Offcanvas Side Nav (for small screens) -->
      <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sideNav" aria-labelledby="sideNavLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sideNavLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
         <ul class="navbar-nav flex-column gap-2">
  <li><hr class="dropdown-divider"></li>
  <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="index.php#admin-pane">Admin Login</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#developers">Developers</a></li>
  <li class="nav-item"><a class="nav-link text-white" href="#" target="_blank">About us</a></li>
</ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<script>
  // Close offcanvas if resizing from mobile → desktop
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 1000) {
      let offcanvasEl = document.querySelector('#sideNav');
      let offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
      if (offcanvas) offcanvas.hide();
    }
  });
</script>





  <!-- Main Content -->
  <div class="bg1 d-flex align-items-center py-5 min-vh-100 pt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
          <div class="card shadow-lg p-4 mx-auto auth-card bg-glass mt-5" style="margin-top:4rem;">
            <h2 class="text-center mb-3 text-white" style="font-family:'typo'">FEEDBACK</h2>
            <div class="text-white-50 small mb-4">
              <?php if(@$_GET['q']): ?>
                <div class="alert alert-success py-2 px-3">
                  <i class="bi bi-check-circle me-1"></i><?php echo @$_GET['q']; ?>
                </div>
              <?php else: ?>
                <p class="mb-3 text-light text-center">Submit your feedback using the form below</p>
              <?php endif; ?>
            </div>
            <?php if(!@$_GET['q']): ?>
              <form class="needs-validation" novalidate action="feed.php?q=feedback.php" method="POST">
                <!-- Full Name -->
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="fbName" name="name" placeholder="Your full name" required minlength="2" autocomplete="off">
                    <label for="fbName">Full Name</label>
                    <div class="invalid-feedback">Please enter your name.</div>
                  </div>
                </div>
                <!-- Subject -->
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                  <div class="form-floating flex-grow-1">
                    <input type="text" class="form-control" id="fbSubject" name="subject" placeholder="Subject" required minlength="2" autocomplete="off">
                    <label for="fbSubject">Subject</label>
                    <div class="invalid-feedback">Please enter a subject.</div>
                  </div>
                </div>
                <!-- Email -->
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <div class="form-floating flex-grow-1">
                    <input type="email" class="form-control" id="fbEmail" name="email" placeholder="name@example.com" required autocomplete="off">
                    <label for="fbEmail">Email address</label>
                    <div class="invalid-feedback">Enter a valid email.</div>
                  </div>
                </div>
                <!-- Feedback -->
                <div class="input-group mb-3">
                  <span class="input-group-text align-items-start pt-3"><i class="bi bi-chat-dots"></i></span>
                  <div class="form-floating flex-grow-1">
                    <textarea class="form-control" id="fbMessage" name="feedback" placeholder="Write your feedback" style="height:80px" required autocomplete="off"></textarea>
                    <label for="fbMessage">Your Feedback</label>
                    <div class="invalid-feedback">Please enter your feedback.</div>
                  </div>
                </div>
                <!-- Submit -->
                <div class="d-grid">
                  <button type="submit" name="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i>Submit
                  </button>
                </div>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ...existing code... -->

  <!-- Developers Modal -->
  <div class="modal fade" id="developers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title">Developers</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          
        <ul class="mb-0">
          <li>Jonathan Ikpen — Lead Developer</li>
          <li>Team PTI — Contributors</li>
        </ul>
        
        </div>
      </div>
    </div>
  </div>

  <!-- Admin Login Modal -->
  <div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #FFBB33;">Admin Login</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form role="form" class="needs-validation" novalidate method="post" action="admin.php?q=index.php">
            <div class="mb-3">
              <label for="adminUser" class="form-label">Admin user id</label>
              <input type="text" id="adminUser" name="uname" maxlength="20" class="form-control" required autocomplete="off">
              <div class="invalid-feedback">Enter admin user id.</div>
            </div>
            <div class="mb-3">
              <label for="adminPass" class="form-label">Password</label>
              <input type="password" id="adminPass" name="password" maxlength="15" class="form-control" required autocomplete="new-password">
              <div class="invalid-feedback">Enter password.</div>
            </div>
            <div class="text-center">
              <button type="submit" name="login" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-1"></i>Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Bootstrap form validation
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
