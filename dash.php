<?php
session_start();
include_once 'dbConnection.php';


// Ensure login
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email   = $_SESSION['email'];
$name    = $_SESSION['name'] ?? '';
$role    = $_SESSION['role'] ?? '';
$isAdmin = ($role === 'admin');   // true if role = "admin"


?>
<?php
if (!empty($_SESSION['flash_success'])) {
    echo '<div class="alert alert-success">'.htmlspecialchars($_SESSION['flash_success']).'</div>';
    unset($_SESSION['flash_success']);
}
if (!empty($_SESSION['flash_error'])) {
    echo '<div class="alert alert-danger">'.htmlspecialchars($_SESSION['flash_error']).'</div>';
    unset($_SESSION['flash_error']);
}
?>

<?php
if (!empty($_SESSION['flash_success'])) {
    echo '<div class="alert alert-success my-3">'.htmlspecialchars($_SESSION['flash_success']).'</div>';
    unset($_SESSION['flash_success']);
}
if (!empty($_SESSION['flash_error'])) {
    echo '<div class="alert alert-danger my-3">'.htmlspecialchars($_SESSION['flash_error']).'</div>';
    unset($_SESSION['flash_error']);
}
?>

<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PTI CBT|| ADMIN DASHBOARD</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery.js" type="text/javascript"></script>

  <!-- Fonts / CSS -->
  <link rel="stylesheet" href="css/dash.css">
  <link rel="stylesheet" href="css/font.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300&display=swap" rel="stylesheet">

<script>
$(function () {
    $(document).on( 'scroll', function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});</script>
</head>
<body  style="background:#eee;">

<header>
  <nav class="navbar navbar-dark bg-success border-bottom fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="dash.php?q=0">
        <img src="image/PTI.jpg" alt="PTI Logo" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
        <span class="pti-full">Petroleum Training Institute</span>
        <span class="pti-short">PTI</span>
      </a>

      <!-- Inline nav (desktop >=1250) -->
      <ul class="navbar-nav flex-row gap-3 d-1250-flex ms-auto">
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==0)?'active':'' ?>" href="dash.php?q=0">Exam</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==4)?'active':'' ?>" href="dash.php?q=4">Add Exam</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==5)?'active':'' ?>" href="dash.php?q=5">Manage Exam</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==7)?'active':'' ?>" href="dash.php?q=7">Add Students </a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==1)?'active':'' ?>" href="dash.php?q=1">Students</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==6)?'active':'' ?>" href="dash.php?q=6">Results</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==2)?'active':'' ?>" href="dash.php?q=2">Ranking</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==3)?'active':'' ?>" href="dash.php?q=3">Feedback</a></li>
        <li class="nav-item">
          <a class="nav-link text-white text-decoration-none" href="logout.php?q=account.php">Signout</a>
        </li>
      </ul>

      <!-- Offcanvas toggle (mobile <=1249) -->
      <button class="navbar-toggler d-1250-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav" aria-controls="sideNav" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Offcanvas -->
      <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sideNav" aria-labelledby="sideNavLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sideNavLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-column gap-2">
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==0)?'active':'' ?>" href="dash.php?q=0"><i class="bi bi-file-earmark-text me-1"></i> Exam</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==4)?'active':'' ?>" href="dash.php?q=4"><i class="bi bi-journal-plus me-1"></i> Add Exam</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==5)?'active':'' ?>" href="dash.php?q=5"><i class="bi bi-journal-minus me-1"></i>Manage Exam</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==7)?'active':'' ?>" href="dash.php?q=7"><i class="bi bi-person-plus me-1"></i> Add Students</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==1)?'active':'' ?>" href="dash.php?q=1"><i class="bi bi-people me-1"></i>Students</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==6)?'active':'' ?>" href="dash.php?q=6"><i class="bi bi-list-check me-1"></i> Results</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==2)?'active':'' ?>" href="dash.php?q=2"><i class="bi bi-bar-chart me-1"></i> Ranking</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==3)?'active':'' ?>" href="dash.php?q=3"><i class="bi bi-chat-dots me-1"></i> Feedback</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="logout.php?q=account.php"><i class="bi bi-box-arrow-right me-1"></i> Signout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<main class="container my-4 pt-5">
  <div class="row">
    <div class="col-12">

          <!-- HOME (q=0) --> 

<?php if(@$_GET['q']==0) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  ' <div class="main-content-spaced">
        <!-- Card markup / header uses same classes as account.php -->
        <div class="card shadow-sm mb-4">
          <div class="card-header exam-card-header bg-success text-white d-flex align-items-center">
            <i class="bi bi-file-earmark-text me-2"></i>
            <span class="fs-5 fw-bold">Available Exams</span>
          </div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table table-striped table-hover mb-0 align-middle">
 <thead class="table-primary">
                  <tr>
                    <th scope="col">S.N.</th>
                    <th scope="col">Exam Title</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Total Questions</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Time Limit</th>
                    <th scope="col"></th>
                  </tr>
                </thead>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
  $subject = $row['subject'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr>
  <td>'.$c++.'</td>
  <td>'.$title.'</td>
  <td>'.$subject.'</td>
  <td>'.$total.'</td>
  <td>'.$sahi*$total.'</td>
  <td>'.$time.'&nbsp;min</td>
	<td>
  </td>
  </tr>';
}
else
{
echo '<tr style="color:#99cc32">
<td>'.$c++.'</td>
<td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
<td>'.$subject.'</td> 
<td>'.$total.'</td>
<td>'.$sahi*$total.'</td>
<td>'.$time.'&nbsp;min</td>
	<td>
  </td>
  </tr>';
}
}
$c=0;
echo '</table></div></div>';

}

        //RANKING
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="main-content-spaced">
        <div class="card shadow-sm mb-4">
          <div class="card-header rank-card-header bg-success text-white d-flex align-items-center">
            <i class="bi bi-trophy me-2"></i>
            <span class="fs-5 fw-bold">Ranking</span>
          </div>
<div class="panel title">
 <div class="card-body p-0 ">
            <div class="table-responsive">
              <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-primary">
                  <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Score</th>
                    <th></th>
                  </tr>
                </thead>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];

}
$c++;
echo '<tr>
<td style="color:#99cc32"><b>'.$c.'</b></td>
<td>'.$name.'</td>
<td>'.$gender.'</td>

<td>'.$s.'</td>
<td>';
}
echo '</table></div></div>';}

?>

<!-- ADD STUDENT FORM (q=7) -->
<?php if(@$_GET['q']==7) { $year = date('Y'); ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="padding-top:20px; padding-bottom:20px;">
  <div class="card shadow-sm border-0 w-100" style="max-width: 720px;">
    <!-- Card Header -->
    <div class="card-header exam-card-header  text-white p-2" >
      <h5 class="mb-0 fw-semibold"><i class="bi bi-person-plus me-1"></i>Register New Student</h5>
    </div>

    <!-- Card Body -->
    <div class="card-body">
      <form class="needs-validation" novalidate action="update.php?q=addstudent" method="POST">

        <!-- Full Name -->
        <div class="mb-3">
          <label for="name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="name" name="name" required minlength="2" autocomplete="off">
        </div>

        <!-- Gender -->
        <div class="mb-3">
          <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
          <div class="d-flex gap-4">
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

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
        </div>

        <!-- REG Number -->
        <div class="mb-3">
          <label for="mob" class="form-label fw-semibold">REG Number <span class="text-danger">*</span></label>
          <input type="tel" class="form-control" id="mob" name="mob" required pattern="[\d+\-\s()]{7,}" autocomplete="off">
        </div>

        <!-- Password -->
        <div class="mb-3 position-relative">
          <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" required minlength="8" maxlength="16" autocomplete="new-password">
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('password', this)">
            <i class="bi bi-eye"></i>
          </button>
        </div>

        <!-- Password Strength -->
        <div class="mb-3" id="strengthWrapper" style="display:none;">
          <small id="strengthMessage" class="fw-semibold"></small>
          <div class="progress" style="height:5px;">
            <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%"></div>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3 position-relative">
          <label for="cpassword" class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="cpassword" name="cpassword" required autocomplete="new-password">
          <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0" onclick="togglePassword('cpassword', this)">
            <i class="bi bi-eye"></i>
          </button>
        </div>
        <div class="mb-2"><small id="matchHelp" class="fw-semibold"></small></div>

        <!-- Flash Messages -->
        <?php if (isset($_SESSION['flash_error'])): ?>
          
        <?php endif; ?>
        <?php if (isset($_SESSION['flash_success'])): ?>
         
        <?php endif; ?>

        <!-- Submit -->
        <div class="d-grid">
          <button type="submit" class="btn btn-success btn-lg">
            <i class="bi bi-person-plus me-1"></i> Add Student
          </button>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="card-footer text-center small text-muted">
      &copy; <?= $year ?> Petroleum Training Institute
    </div>
  </div>
</div>
<!-- Toasts -->
<?php if (isset($_SESSION['flash_success'])): ?>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index:1100">
    <div id="successToast" class="toast align-items-center text-bg-success border-0">
      <div class="d-flex">
        <div class="toast-body">
          <?= htmlspecialchars($_SESSION['flash_success']); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
  <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index:1200">
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0">
      <div class="d-flex">
        <div class="toast-body">
          <?= htmlspecialchars($_SESSION['flash_error']); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
  <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>
<?php } ?>



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



      <!--USERS-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM user") or die('Error');
echo  '<div class="main-content-spaced">
        <div class="card shadow-sm mb-4">
          <div class="card-header student-card-header bg-info text-white d-flex align-items-center">
            <i class="bi bi-people me-2"></i><span class="fs-5 fw-bold">User Details</span>
          </div>
 <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-primary">
                  <tr>
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Email</th>
                  <th>Registration NO</th>
                  <th>Delete</th>
                  <th>Edit</th>
                  
                  </tr>
                </thead>';
$c=1;
while($row = mysqli_fetch_array($result)) {
    $name   = $row['name'];
    $mob    = $row['mob'];
    $gender = $row['gender'];
    $email  = $row['email'];
    $pass   = $row['password'];

    echo '<tr>
      <td>'.$c++.'</td>
      <td>'.$name.'</td>
      <td>'.$gender.'</td>
      <td>'.$email.'</td>
      <td>'.$mob.'</td>
      <td>
        <button class="btn btn-danger btn-sm deleteBtn"  
                data-email="'.$email.'"
                data-name="'.$name.'">Delete</button>
      </td>
      <td>
        <button class="btn btn-warning btn-sm editBtn"
                data-name="'.htmlspecialchars($name, ENT_QUOTES).'"
                data-mob="'.htmlspecialchars($mob, ENT_QUOTES).'"
                data-email="'.htmlspecialchars($email, ENT_QUOTES).'"
                data-gender="'.htmlspecialchars($gender, ENT_QUOTES).'">
          Edit
        </button>
      </td>
    </tr>';
}

$c=0;
echo '</table></div></div>';

}?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <span id="userName" class="fw-bold"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a id="confirmDelete" href="#" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const deleteButtons = document.querySelectorAll(".deleteBtn");
  const userNameSpan = document.getElementById("userName");
  const confirmDeleteLink = document.getElementById("confirmDelete");

  deleteButtons.forEach(btn => {
    btn.addEventListener("click", function() {
      const email = this.getAttribute("data-email");
      const name  = this.getAttribute("data-name");

      // Update modal content
      userNameSpan.textContent = name;

      // Update confirm link
      confirmDeleteLink.href = "update.php?q=deluser&email=" + encodeURIComponent(email);


      // Show modal
      const modal = new bootstrap.Modal(document.getElementById("deleteModal"));
      modal.show();
    });
  });
});
</script>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="update.php?q=edituser">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Edit User Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="old_email" id="editOldEmail">

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="editName" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Registration No</label>
            <input type="text" name="mob" id="editMob" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="editEmail" class="form-control" required>
          </div>

          <div class="mb-3">
  <label class="form-label">New Password</label>
  <input type="password" name="password" id="editPassword" class="form-control">
</div>


          <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" id="editGender" class="form-select" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Existing delete modal logic remains unchanged

  const editButtons = document.querySelectorAll(".editBtn");
  const editModal = new bootstrap.Modal(document.getElementById("editUserModal"));

  editButtons.forEach(btn => {
    btn.addEventListener("click", function() {
      document.getElementById("editName").value = this.dataset.name;
      document.getElementById("editMob").value = this.dataset.mob;
      document.getElementById("editEmail").value = this.dataset.email;
      document.getElementById("editPassword").value = this.dataset.password;
      document.getElementById("editGender").value = this.dataset.gender;

      // keep old_email in hidden field so we know which user to update
      document.getElementById("editOldEmail").value = this.dataset.email;

      editModal.show();
    });
  });
});
</script>





<!-- RESULTS PAGE (q=6) -->
<?php
if (@$_GET['q'] == 6) {


        // Fetch completed attempts with just the fields we need
        $sql = "
            SELECT h.score, h.start_time, h.end_time, h.date, 
                   u.name AS student_name, q.subject AS exam_title
            FROM history h
            JOIN `user` u ON u.email = h.email
            JOIN quiz q ON q.eid = h.eid
            WHERE h.completed = 1
            ORDER BY h.date DESC
        ";

        $result = mysqli_query($con, $sql) or die('Error fetching results');

        echo '<div class="main-content-spaced">
                <div class="card shadow-sm mb-4">
                  <div class="card-header rank-card-header bg-success text-white d-flex align-items-center">
                    <i class="bi bi-list-check me-2"></i>
                    <span class="fs-5 fw-bold">Results</span>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-primary">
                          <tr>
                            <th>S.N.</th>
                            <th>Student</th>
                            <th>Exam</th>
                            <th>Score</th>
                            <th>Duration</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>';

        $c = 1;
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $student = htmlspecialchars($row['student_name'] ?? '-', ENT_QUOTES);
                $exam    = htmlspecialchars($row['exam_title'] ?? '-', ENT_QUOTES);
                $score   = is_null($row['score']) ? '-' : (int)$row['score'];

                // duration
                $start = !empty($row['start_time']) ? (int)$row['start_time'] : null;
                $end   = !empty($row['end_time'])   ? (int)$row['end_time']   : null;
                $duration = '-';
                if ($start && $end && $end > $start) {
                    $sec = $end - $start;
                    $h = floor($sec / 3600);
                    $m = floor(($sec % 3600) / 60);
                    $s = $sec % 60;
                    $duration = sprintf('%02d:%02d:%02d', $h, $m, $s);
                }

                // exam date
                $dateStr = !empty($row['date']) ? date("d-m-Y H:i:s", strtotime($row['date'])) : '-';

                echo '<tr>
                        <td>' . $c++ . '</td>
                        <td>' . $student . '</td>
                        <td>' . $exam . '</td>
                        <td>' . $score . '</td>
                        <td>' . $duration . '</td>
                        <td>' . $dateStr . '</td>
                      </tr>';
            }
           } else {
            echo '<tr><td colspan="6" class="text-center">No completed results found.</td></tr>';
        

        echo '          </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>';
    }
}
?>



<!--feedback start-->
<?php if(@$_GET['q']==3) {
    $result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
?>
<div class="main-content-spaced">
  <div class="card shadow-sm mb-4">
    <div class="card-header feedback-card-header bg-info text-white d-flex align-items-center">
      <i class="bi bi-chat-dots me-2"></i><span class="fs-5 fw-bold">Feedback</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0 align-middle">
          <thead class="table-primary">
            <tr>
              <th>S.N.</th>
              <th>Message</th>
              <th>Name</th>
              <th>Email</th>
              <th>Date</th>
              <th>Time</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
<?php
    $c = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $date    = date("d-m-Y", strtotime($row['date']));
        $name    = $row['name'];
        $subject = $row['subject'];
        $time    = $row['time'];
        $email   = $row['email'];
        $id      = $row['id'];
        $message = $row['feedback'];
?>
            <tr>
              <td><?= $c++ ?></td>

              <!-- clickable subject opens modal (data-* are HTML-escaped) -->
              <td>
                <a href="javascript:void(0)"
                   class="text-decoration-none open-feedback"
                   data-id="<?= htmlspecialchars($id, ENT_QUOTES) ?>"
                   data-name="<?= htmlspecialchars($name, ENT_QUOTES) ?>"
                   data-email="<?= htmlspecialchars($email, ENT_QUOTES) ?>"
                   data-date="<?= htmlspecialchars($date, ENT_QUOTES) ?>"
                   data-time="<?= htmlspecialchars($time, ENT_QUOTES) ?>"
                   data-message="<?= htmlspecialchars($message, ENT_QUOTES) ?>">
                  <?= htmlspecialchars($subject, ENT_QUOTES) ?>
                </a>
              </td>

              <td><?= htmlspecialchars($name, ENT_QUOTES) ?></td>
              <td><?= htmlspecialchars($email, ENT_QUOTES) ?></td>
              <td><?= htmlspecialchars($date, ENT_QUOTES) ?></td>
              <td><?= htmlspecialchars($time, ENT_QUOTES) ?></td>

              <!-- open icon also triggers modal (same class + data-*), useful for accessibility -->
              <td>
                <a href="javascript:void(0)"
                   class="open-feedback"
                   data-id="<?= htmlspecialchars($id, ENT_QUOTES) ?>"
                   data-name="<?= htmlspecialchars($name, ENT_QUOTES) ?>"
                   data-email="<?= htmlspecialchars($email, ENT_QUOTES) ?>"
                   data-date="<?= htmlspecialchars($date, ENT_QUOTES) ?>"
                   data-time="<?= htmlspecialchars($time, ENT_QUOTES) ?>"
                   data-message="<?= htmlspecialchars($message, ENT_QUOTES) ?>">
                  <b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b>
                </a>
              </td>

              <!-- delete (server link, unchanged) -->
              <td>
                <a title="Delete Feedback" href="update.php?fdid=<?= urlencode($id) ?>">
                  <b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b>
                </a>
              </td>
            </tr>
<?php
    } // end while
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } // end if q==3 ?>


<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header feedback-card-header text-white">
        <h5 class="modal-title">
          <span id="feedbackNameHeader"></span>'s Feedback
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <p><strong>Date:</strong> <span id="feedbackDate"></span></p>
        <p><strong>Time:</strong> <span id="feedbackTime"></span></p>
        <p><strong>By:</strong> <span id="feedbackName"></span> (<span id="feedbackEmail"></span>)</p>
        <hr>
        <div id="feedbackMessage" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>



<!--add exam start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
?>
<div class="main-content-spaced">
  <div class="card shadow-sm mb-4">
    <div class="card-header exam-card-header bg-success text-white d-flex align-items-center">
      <i class="bi bi-journal-plus me-2"></i>
      <span class="fs-5 fw-bold">Create New Exam</span>
    </div>

    <div class="card-body">
      <!-- Progress Indicator -->
      <div class="d-flex justify-content-center mb-4">
        <div class="position-relative d-flex align-items-center">
          <div class="position-relative d-flex align-items-center">
            <span class="badge rounded-circle bg-success p-3">
              <i class="bi bi-1-circle-fill fs-5"></i>
            </span>
            <span class="position-absolute start-100 top-50 translate-middle-y mx-2 fw-bold text-success">Exam Details</span>
          </div>
          <div class="border-bottom border-2 border-success" style="width: 100px;"></div>
          <div class=" position-relative d-flex align-items-center">
            <span class="badge rounded-circle bg-secondary p-3">
              <i class="bi bi-2-circle fs-5"></i>
            </span>
            <span class=" position-absolute start-100 top-50 translate-middle-y mx-2 fw-bold text-secondary">Add Questions</span>
          </div>
        </div>
      </div>

      <!-- Form Starts -->
      <form action="update.php?q=addquiz" name="form" method="POST" class="row g-3">
        
        <!-- Exam Title -->
        <div class="col-md-8">
          <label class="form-label">Exam Title <small class="text-muted">(required)</small></label>
          <input type="text" name="title" class="form-control" required 
            placeholder="e.g., Introduction to Computer Science - Final Exam"
            pattern="^[A-Za-z0-9\s\-_\.]{5,100}$"
            title="5-100 characters, alphanumeric, spaces, and -_. allowed">
          <div class="form-text">Choose a descriptive title for the exam</div>
        </div>

        <!-- Subject -->
        <div class="col-md-4">
          <label class="form-label">Subject Area <small class="text-muted">(required)</small></label>
          <select name="subject" class="form-select" required>
            <option value="">Select subject...</option>
            <option value="mathematics">Mathematics</option>
            <option value="physics">Physics</option>
            <option value="chemistry">Chemistry</option>
            <option value="biology">Biology</option>
            <option value="computer_science">Computer Science</option>
            <option value="english">English</option>
            <option value="other">Other</option>
          </select>
        </div>

        <!-- Description -->
        <div class="col-12">
          <label class="form-label">Description <small class="text-muted">(optional)</small></label>
          <textarea name="description" rows="3" class="form-control"
            placeholder="Enter exam description, syllabus coverage, or special instructions..."></textarea>
        </div>

        <!-- Total Questions -->
        <div class="col-md-3">
          <label class="form-label">Total Questions <small class="text-muted">(required)</small></label>
          <div class="input-group">
            <input type="number" name="total" min="1" max="100" value="10" class="form-control" required>
            <span class="input-group-text"><i class="bi bi-list-ol"></i></span>
          </div>
          <div class="form-text">Max 100 questions</div>
        </div>

        <!-- Time Limit -->
        <div class="col-md-3">
          <label class="form-label">Time Limit <small class="text-muted">(required)</small></label>
          <div class="input-group">
            <input type="number" name="time" min="5" max="180" value="20" class="form-control" required>
            <span class="input-group-text">minutes</span>
          </div>
        </div>

        <!-- Marks for Correct -->
        <div class="col-md-3">
          <label class="form-label">Marks per Correct <small class="text-muted">(required)</small></label>
          <div class="input-group">
            <input type="number" name="correct" min="1" max="10" value="1" class="form-control" required>
            <span class="input-group-text">points</span>
          </div>
        </div>

        <!-- Wrong Penalty -->
        <div class="col-md-3">
          <label class="form-label">Wrong Answer Penalty</label>
          <div class="input-group">
            <input type="number" name="wrong" min="0" max="5" value="0" class="form-control" required>
            <span class="input-group-text">points</span>
          </div>
        </div>

        <!-- Shuffle Option -->
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="shuffleQuestions" name="shuffle_questions" value="1">
            <label class="form-check-label" for="shuffleQuestions">
              Shuffle question order for each student
            </label>
          </div>
        </div>

        <!-- Info Alert -->
        <div class="col-12">
          <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <div>After creating the exam, you can add questions in the next step.</div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-arrow-right-circle"></i> Continue to Add Questions
          </button>
          <a href="dash.php?q=0" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}
?>


<!--add quiz step2 start-->
<?php
if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {
    $n   = intval($_GET['n'] ?? 0);
    $eid = htmlspecialchars($_GET['eid'] ?? '', ENT_QUOTES);
  
?>
    <div class="main-content-spaced">
      <div class="card shadow-sm mb-4">
        <div class="card-header exam-card-header bg-success text-white d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <i class="bi bi-file-earmark-text me-2"></i>
            <span class="fs-5 fw-bold">Add Questions</span>
          </div>
          <span class="badge bg-light text-success">
            Total: <?= $n ?> Questions
          </span>
        </div>

        <div class="card-body">
          <form action="update.php?q=addqns&n=<?= $n ?>&eid=<?= $eid ?>&ch=4" 
                method="POST" id="questionsForm">

              <?php 
            for ($i = 1; $i <= $n; $i++): 
              // Fetch existing question for this serial number
             $q_check = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$i'");
$qrow = mysqli_fetch_assoc($q_check);

$qns = $qrow['qns'] ?? '';
$qid = $qrow['qid'] ?? '';

// fetch options
$options = [];
if ($qid) {
    $opt_res = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ORDER BY optionid ASC");

    while ($opt = mysqli_fetch_assoc($opt_res)) {
        $options[$opt['optionid']] = $opt['option'];
    }

    // fetch answer
    $ans_res = mysqli_query($con, "SELECT ansid FROM answer WHERE qid='$qid' LIMIT 1");
    $ans_row = mysqli_fetch_assoc($ans_res);
    $correctAnsId = $ans_row['ansid'] ?? '';
}

// default empty
$optiona = $optionb = $optionc = $optiond = '';

// assign options in order found
$optValues = array_values($options);
if (isset($optValues[0])) $optiona = $optValues[0];
if (isset($optValues[1])) $optionb = $optValues[1];
if (isset($optValues[2])) $optionc = $optValues[2];
if (isset($optValues[3])) $optiond = $optValues[3];


// map correct answer to letter
$answer = '';
if (!empty($correctAnsId)) {
    $keys = array_keys($options);
    $index = array_search($correctAnsId, $keys);
    if ($index !== false) {
        $answer = ['a','b','c','d'][$index];
    }
}

            ?>
              <div class="question-block" id="question-<?= $i ?>" style="display: <?= $i === 1 ? 'block' : 'none' ?>;">
                <h5 class="fw-bold mb-3">Question <?= $i ?></h5>

                <!-- Question Text -->
                <div class="mb-4">
                  <label class="form-label">Question Text <small class="text-danger">*</small></label>
                  <textarea rows="3" name="qns<?= $i ?>" class="form-control" 
                    placeholder="Write question number <?= $i ?> here..." required><?= htmlspecialchars($qns) ?></textarea>
                </div>
                <!-- Hidden QID (important for updates) -->
              <input type="hidden" name="qid<?= $i ?>" value="<?= htmlspecialchars($qid) ?>">


                <!-- Options -->
               <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label">Option A *</label>
                    <input type="text" name="<?= $i ?>1" class="form-control" 
                          value="<?= htmlspecialchars($optiona) ?>" placeholder="Enter option A" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option B *</label>
                    <input type="text" name="<?= $i ?>2" class="form-control" 
                          value="<?= htmlspecialchars($optionb) ?>" placeholder="Enter option B" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option C *</label>
                    <input type="text" name="<?= $i ?>3" class="form-control" 
                          value="<?= htmlspecialchars($optionc) ?>" placeholder="Enter option C" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option D *</label>
                    <input type="text" name="<?= $i ?>4" class="form-control" 
                          value="<?= htmlspecialchars($optiond) ?>" placeholder="Enter option D" required>
                  </div>
                </div>

                <!-- Correct Answer -->
               <div class="mb-3">
    <label class="form-label fw-bold">Correct Answer *</label>
    <select name="ans<?= $i ?>" class="form-select" required>
      <option value="">Select correct option...</option>
      <option value="a" <?= $answer == 'a' ? 'selected' : '' ?>>Option A</option>
      <option value="b" <?= $answer == 'b' ? 'selected' : '' ?>>Option B</option>
      <option value="c" <?= $answer == 'c' ? 'selected' : '' ?>>Option C</option>
      <option value="d" <?= $answer == 'd' ? 'selected' : '' ?>>Option D</option>
    </select>
  </div>
</div>
            <?php endfor; ?>

            <!-- Navigation -->
            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
              <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
              <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Submit All</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
    let currentQuestion = 1;
    const totalQuestions = <?= $n ?>;

    function showQuestion(n) {
    for (let i = 1; i <= totalQuestions; i++) {
        document.getElementById("question-" + i).style.display = (i === n ? "block" : "none");
    }

    // Previous button
    document.getElementById("prevBtn").style.display = (n === 1 ? "none" : "inline-block");

    // Next/Submit button
    const nextBtn = document.getElementById("nextBtn");
    if (n === totalQuestions) {
        nextBtn.textContent = "Submit";
        nextBtn.type = "submit"; // changes button to submit the form
    } else {
        nextBtn.textContent = "Next";
        nextBtn.type = "button";
    }
}

    function nextPrev(step) {
        currentQuestion += step;
        if (currentQuestion < 1) currentQuestion = 1;
        if (currentQuestion > totalQuestions) currentQuestion = totalQuestions;
        showQuestion(currentQuestion);
    }

    // Init
    showQuestion(currentQuestion);
    </script>
<?php } ?>
<!--add quiz step 2 end-->



<!--remove quiz-->
<?php if(@$_GET['q']==5) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');

echo  '<div class="main-content-spaced">
        <!-- Card markup / header uses same classes as account.php -->
        <div class="card shadow-sm mb-4">
          <div class="card-header exam-card-header bg-success text-white d-flex align-items-center">
            <i class="bi bi-file-earmark-text me-2"></i>
            <span class="fs-5 fw-bold">Available Exams</span>
          </div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table table-striped table-hover mb-0 align-middle title1">
<thead class="table-primary">
<tr>
<td><b>S.N.</b></td>
<td><b>Topic</b></td>
<td><b>Subject</b></td>
<td><b>Total question</b></td>
<td><b>Marks</b></td>
<td><b>Time limit</b></td>
<td><b>Delete</b></td>
<td><b>Edit</b></td>
</tr>
</thead>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
  $subject = $row['subject'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
	echo '<tr>
  <td>'.$c++.'</td>
  <td>'.$title.'</td>
  <td>'.$subject.'</td>
  <td>'.$total.'</td>
  <td>'.$sahi*$total.'</td>
  <td>'.$time.'&nbsp;min</td>
	<td>
  <b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b>
  </td>
  <td>
 <a href="dash.php?q=editexam&eid=' . $eid . '" class="btn btn-warning btn-sm">
    <i class="bi bi-pencil-square"></i> Edit
  </a>
</td>

  </tr>';

  
 
}
$c=0;
echo '</table></div></div>';

}
?>

<!-- Edit Exam -->
 <?php
if (@$_GET['q'] == 'editexam' && isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    $result = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'") or die('Error');
    if ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="main-content-spaced">
          <div class="card shadow-sm mb-4">
            <div class="card-header exam-card-header bg-warning text-white d-flex align-items-center">
              <i class="bi bi-pencil-square me-2"></i>
              <span class="fs-5 fw-bold">Edit Exam</span>
            </div>
            <div class="card-body">
              <form action="update.php?q=editexam&eid=<?php echo $eid; ?>" method="POST" class="row g-3">

                <!-- Title -->
                <div class="col-md-8">
                  <label class="form-label">Exam Title</label>
                  <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" class="form-control" required>
                </div>

                <!-- Subject -->
                <div class="col-md-4">
                  <label class="form-label">Subject Area</label>
                  <input type="text" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" class="form-control" required>
                </div>

                <!-- Total Questions -->
                <div class="col-md-3">
                  <label class="form-label">Total Questions</label>
                  <input type="number" name="total" value="<?php echo $row['total']; ?>" class="form-control" required>
                </div>

                <!-- Time -->
                <div class="col-md-3">
                  <label class="form-label">Time Limit (minutes)</label>
                  <input type="number" name="time" value="<?php echo $row['time']; ?>" class="form-control" required>
                </div>

                <!-- Correct -->
                <div class="col-md-3">
                  <label class="form-label">Marks per Correct</label>
                  <input type="number" name="sahi" value="<?php echo $row['sahi']; ?>" class="form-control" required>
                </div>

                <!-- Wrong -->
                <div class="col-md-3">
                  <label class="form-label">Wrong Penalty</label>
                  <input type="number" name="wrong" value="<?php echo $row['wrong']; ?>" class="form-control" required>
                </div>

                <!-- Description -->
                <div class="col-12">
                  <label class="form-label">Description</label>
                  <textarea name="intro" class="form-control" rows="3"><?php echo htmlspecialchars($row['intro']); ?></textarea>
                </div>

                <!-- Tag -->
                <div class="col-md-6">
                  <label class="form-label">Tag</label>
                  <input type="text" name="tag" value="<?php echo htmlspecialchars($row['tag']); ?>" class="form-control">
                </div>

                <div class="col-12 d-flex gap-2">
                  <button type="submit" class="btn btn-success">Update Exam</button>
                  <a href="dash.php?q=5" class="btn btn-outline-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php
    }
}
?>


</div><!--container closed-->
</div></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // same helper used in account.php
  document.querySelectorAll('form').forEach(f => f.classList.add('mt-form'));
  document.querySelectorAll('table').forEach(t => t.classList.add('mt-table'));

  // Close offcanvas when switching to desktop (>=1250)
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 1250) {
      const offcanvasEl = document.querySelector('#sideNav');
      if (!offcanvasEl) return;
      const oc = bootstrap.Offcanvas.getInstance(offcanvasEl);
      if (oc) oc.hide();
    }
  });
});
</script>

<script>
document.addEventListener('click', function (e) {
  const el = e.target.closest('.open-feedback');
  if (!el) return;

  const feedback = {
    id: el.dataset.id || '',
    name: el.dataset.name || '',
    email: el.dataset.email || '',
    date: el.dataset.date || '',
    time: el.dataset.time || '',
    message: el.dataset.message || ''
  };

  // populate modal
  document.getElementById('feedbackNameHeader').textContent = feedback.name || 'User';
  document.getElementById('feedbackDate').textContent = feedback.date;
  document.getElementById('feedbackTime').textContent = feedback.time;
  document.getElementById('feedbackName').textContent = feedback.name;
  document.getElementById('feedbackEmail').textContent = feedback.email;
  // use textContent to avoid XSS; pre-wrap CSS preserves line breaks
  document.getElementById('feedbackMessage').textContent = feedback.message;

  // show modal (requires bootstrap bundle loaded)
  var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
  feedbackModal.show();
});
</script>

</body>
</html>
