<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Project Worlds || TEST YOUR SKILL </title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/font.css">

  <!-- Optional jQuery (kept only if other scripts rely on it) -->
  <script src="js/jquery.js"></script>

 <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet">

<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>

<script>
function validateForm() {var y = document.forms["form"]["name"].value;	var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var z =document.forms["form"]["college"].value;if (z == null || z == "") {alert("college must be filled out.");return false;}var x = document.forms["form"]["email"].value;var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {alert("Not a valid e-mail address.");return false;}var a = document.forms["form"]["password"].value;if(a == null || a == ""){alert("Password must be filled out");return false;}if(a.length<5 || a.length>25){alert("Passwords must be 5 to 25 characters long.");return false;}
var b = document.forms["form"]["cpassword"].value;if (a!=b){alert("Passwords must match.");return false;}}
</script>

</head>

<body>
 <!-- Header (Unified with feedback.php) -->
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
        <li class="nav-item"><a class="nav-link text-white" href="#admin-pane" id="footer-admin-link">Admin Login</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="feedback.php">Feedback</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#developers">Developers</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">About us</a></li>
      </ul>

      <!-- Offcanvas Toggler (mobile only) -->
      <button class="navbar-toggler d-custom-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav" aria-controls="sideNav" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Offcanvas Side Nav -->
      <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sideNav" aria-labelledby="sideNavLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sideNavLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-column gap-2">
            <li class="nav-item"><a class="nav-link text-white" href="#admin-pane" id="footer-admin-link">Admin Login</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="feedback.php">Feedback</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#developers">Developers</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">About us</a></li>
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


  <!-- Background area -->
  <div class="bg1 min-vh-100 pt-5" style="min-height:100vh;">
    <div class="container py-4 h-100">
      <div id="global-alert-container" class="mb-3"></div>

      <div class="card shadow-lg p-4 mx-auto auth-card bg-glass">
        <!-- Tabs -->
       <ul class="nav nav-tabs justify-content-center mb-3 dark-tabs" id="authTabs" role="tablist">
  <li class="nav-item">
    <button class="nav-link active btn-success" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane" type="button" role="tab">
      <i class="bi bi-box-arrow-in-right me-1"></i>Login
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup-pane" type="button" role="tab">
      <i class="bi bi-person-plus me-1"></i>Sign Up
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-pane" type="button" role="tab">
      <i class="bi bi-shield-lock me-1"></i>Admin Login
    </button>
  </li>
</ul>


        <div class="tab-content" id="authTabsContent">
          <!-- Login -->
          <div class="tab-pane fade show active" id="login-pane" role="tabpanel">
            <form class="needs-validation" novalidate action="login.php?q=index.php" method="POST">
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <div class="form-floating flex-grow-1">
                  <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Email" required autocomplete="off">
                  <label for="loginEmail">Email</label>
                  <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <div class="form-floating flex-grow-1 position-relative">
                  <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required minlength="8" maxlength="16" autocomplete="new-password">
                  <label for="loginPassword">Password</label>
                  <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('loginPassword', this)"><i class="bi bi-eye"></i></button>
                  <div class="invalid-feedback">Password must be 8–16 characters.</div>
                </div>
              </div>

              <?php if (isset($_GET['error_login'])): ?>
                <p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_login']) ?></p>
              <?php endif; ?>

              <div class="d-grid"><button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-1"></i>Log In</button></div>
            </form>
          </div>

          <!-- Sign Up -->
          <div class="tab-pane fade" id="signup-pane" role="tabpanel">
            <form class="needs-validation mx-auto" novalidate action="sign.php?q=account.php" method="POST" style="max-width: 400px; min-width: 260px; padding: 16px 8px;">
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <div class="form-floating flex-grow-1">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required minlength="2" autocomplete="off">
                  <label for="name">Full Name</label>
                  <div class="invalid-feedback">Please enter your name.</div>
                </div>
              </div>

             <!-- Gender (checkboxes with floating label style) -->
<div class="input-group mb-2">
  <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
  <div class="form-floating flex-grow-1 position-relative">
    <div class="floating-gender-label" style="position:absolute;top:0.2rem;left:1.2rem;color:rgba(255,255,255,0.8);font-weight:600;pointer-events:none;z-index:2;">Gender</div>
    <div class="pt-4">
      <div class="form-check form-check-inline">
        <input class="form-check-input gender-checkbox" type="checkbox" id="genderM" name="gender" value="M">
        <label class="form-check-label" for="genderM">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input gender-checkbox" type="checkbox" id="genderF" name="gender" value="F">
        <label class="form-check-label" for="genderF">Female</label>
      </div>
    </div>
    <div class="invalid-feedback">Please select a gender.</div>
  </div>
</div>


             

              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <div class="form-floating flex-grow-1">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off">
                  <label for="email">Email</label>
                  <div class="invalid-feedback">Enter valid email.</div>
                </div>
              </div>

              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-card-checklist"></i></span>
                <div class="form-floating flex-grow-1">
                  <input type="tel" class="form-control" id="mob" name="mob" placeholder="Mobile Number" required pattern="[\d+\-\s()]{7,}" autocomplete="off">
                  <label for="mob">REG Number</label>
                  <div class="invalid-feedback">Enter valid REG number.</div>
                </div>
              </div>

              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <div class="form-floating flex-grow-1 position-relative">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required minlength="8" maxlength="16" autocomplete="new-password">
                  <label for="password">Password</label>
                  <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('password', this)"><i class="bi bi-eye"></i></button>
                  <div class="invalid-feedback">Password must be 8–16 characters.</div>
                </div>
              </div>

              <!-- Strength meter (hidden until typing) -->
              <div class="mb-2" id="strengthWrapper" style="display:none;">
                <small id="strengthMessage" class="fw-semibold"></small>
                <div class="progress" style="height:5px;">
                  <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%"></div>
                </div>
              </div>

              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                <div class="form-floating flex-grow-1 position-relative">
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required autocomplete="new-password">
                  <label for="cpassword">Confirm Password</label>
                  <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('cpassword', this)"><i class="bi bi-eye"></i></button>
                  <div class="invalid-feedback">Please confirm password.</div>
                </div>
              </div>

              <div class="mb-2"><small id="matchHelp" class="fw-semibold"></small></div>

              <?php if (isset($_GET['error_signup'])): ?><p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_signup']) ?></p><?php endif; ?>
              <?php if (isset($_GET['q7'])): ?><p class="text-danger small mb-2"><?= htmlspecialchars($_GET['q7']) ?></p><?php endif; ?>

              <div class="d-grid"><button type="submit" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Sign Up</button></div>
            </form>
          </div>

          <!-- Admin Login -->
          <div class="tab-pane fade" id="admin-pane" role="tabpanel">
            <form class="needs-validation" novalidate action="admin.php?q=index.php" method="POST">
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <div class="form-floating flex-grow-1">
                  <input type="text" class="form-control" id="adminUser" name="uname" placeholder="Admin user id" required maxlength="20" autocomplete="off">
                  <label for="adminUser">Admin user id</label>
                  <div class="invalid-feedback">Enter admin ID.</div>
                </div>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <div class="form-floating flex-grow-1 position-relative">
                  <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Password" required minlength="5" maxlength="15" autocomplete="new-password">
                  <label for="adminPassword">Password</label>
                  <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('adminPassword', this)"><i class="bi bi-eye"></i></button>
                  <div class="invalid-feedback">Password must be 5–15 characters.</div>
                </div>
              </div>

              <?php if (isset($_GET['error_admin'])): ?><p class="text-danger small mb-2"><?= htmlspecialchars($_GET['error_admin']) ?></p><?php endif; ?>

              <div class="d-grid"><button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right me-1"></i>Admin Login</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Developers Modal -->
  <div class="modal fade" id="developers" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title">Developers</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-dark text-white"> <ul class="mb-0">
          <li>Jonathan Ikpen — Lead Developer</li>
          <li>Team PTI — Contributors</li>
        </ul></div>
      </div>
    </div>
  </div>

    <!-- Success Toast (server-side only) -->
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

  <script>
    // Bootstrap validation
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

    // Toggle password
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

    // Confirm password check
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

    // Password strength meter
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
          case 1: bar.style.width="25%"; bar.className="progress-bar weak"; msg.textContent="Weak"; msg.className="text-danger fw-semibold"; break;
          case 2: bar.style.width="50%"; bar.className="progress-bar medium"; msg.textContent="Medium"; msg.className="text-warning fw-semibold"; break;
          case 3: bar.style.width="75%"; bar.className="progress-bar medium"; msg.textContent="Strong"; msg.className="text-primary fw-semibold"; break;
          case 4: bar.style.width="100%"; bar.className="progress-bar strong"; msg.textContent="Very Strong"; msg.className="text-success fw-semibold"; break;
        }
      });
    })();

    // Auto-show server-side success toast if message exists
    (function(){
      const successToastEl = document.getElementById("successToast");
      if(successToastEl && successToastEl.querySelector(".toast-body").textContent.trim()!==""){
        new bootstrap.Toast(successToastEl,{delay:4000}).show();
      }
    })();

    // Persist active tab across reloads
    (function(){
      const authTabs = document.getElementById('authTabs');
      if(!authTabs) return;
      const savedTab = localStorage.getItem('activeAuthTab');
      if(savedTab){
        const triggerEl = document.querySelector(`#authTabs button[data-bs-target="${savedTab}"]`);
        if(triggerEl){
          const tab = new bootstrap.Tab(triggerEl);
          tab.show();
        }
      }
      authTabs.addEventListener('shown.bs.tab', (event) => {
        localStorage.setItem('activeAuthTab', event.target.getAttribute('data-bs-target'));
      });
    })();

    // Ensure only one gender checkbox can be checked and validate
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

  // Form validation for at least one gender
  const signupForm = document.querySelector('#signup-pane form');
  if(signupForm){
    signupForm.addEventListener('submit', function(e){
      const anyChecked = Array.from(genderCheckboxes).some(cb => cb.checked);
      if(!anyChecked){
        e.preventDefault();
        e.stopPropagation();
        genderCheckboxes[0].closest('.form-floating').classList.add('was-validated');
      }
    });
  }
});


    // Footer Admin Login link activates admin-pane tab
    document.addEventListener('DOMContentLoaded', function() {
      var adminLink = document.getElementById('footer-admin-link');
      if (adminLink) {
        adminLink.addEventListener('click', function(e) {
          e.preventDefault();
          var adminTab = document.getElementById('admin-tab');
          if (adminTab) {
            var tab = new bootstrap.Tab(adminTab);
            tab.show();
            // Scroll to the tab content for better UX
            var tabContent = document.getElementById('authTabsContent');
            if(tabContent) tabContent.scrollIntoView({behavior:'smooth'});
          }
        });
      }
    });
    // Auto-activate tab based on query parameter
// Handle query params for tabs and modals
document.addEventListener('DOMContentLoaded', function(){
  const urlParams = new URLSearchParams(window.location.search);

  // 1️⃣ Admin tab
  const tabParam = urlParams.get('tab');
  if(tabParam === 'admin'){
    const adminTab = document.getElementById('admin-tab');
    if(adminTab){
      const tab = new bootstrap.Tab(adminTab);
      tab.show();
      const tabContent = document.getElementById('authTabsContent');
      if(tabContent) tabContent.scrollIntoView({behavior:'smooth'});
    }
  }

  // 2️⃣ Developers modal
  const modalParam = urlParams.get('modal');
  if(modalParam === 'developers'){
    const devModalEl = document.getElementById('developers');
    if(devModalEl){
      const devModal = new bootstrap.Modal(devModalEl);
      devModal.show();
    }
  }
    // Sidebar nav-link active effect
    var sidebarLinks = document.querySelectorAll('#sideNav .nav-link');
    sidebarLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        sidebarLinks.forEach(function(l) { l.classList.remove('active'); });
        this.classList.add('active');
      });
    });
});


  </script>

</body>
</html>
