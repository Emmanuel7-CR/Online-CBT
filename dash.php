<?php
 include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];

// --- determine if current user is admin ---
$isAdmin = false;
if (isset($email) && $email) {
    // Try to read role from user table (preferred)
    $safeEmail = mysqli_real_escape_string($con, $email);
    $r = mysqli_query($con, "SELECT role FROM user WHERE email='$safeEmail' LIMIT 1");
    if ($r && mysqli_num_rows($r) > 0) {
        $rowRole = mysqli_fetch_assoc($r);
        // if your user table uses 'role' column and stores 'admin' for admins
        if (isset($rowRole['role']) && strtolower($rowRole['role']) === 'admin') {
            $isAdmin = true;
        }
    }

    // Fallback: if there is no role column, check specific admin emails (adjust as needed)
    if (!$isAdmin) {
        $admins = ['sunnygkp10@gmail.com']; // <-- replace with real admin email(s)
        if (in_array($email, $admins, true)) $isAdmin = true;
    }
}

  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];;


include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
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
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==5)?'active':'' ?>" href="dash.php?q=5">Remove Exam</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==1)?'active':'' ?>" href="dash.php?q=1">Students</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==2)?'active':'' ?>" href="dash.php?q=2">Ranking</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==3)?'active':'' ?>" href="dash.php?q=3">Feedback</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="index.php" target="_blank">Home</a></li>
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
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==5)?'active':'' ?>" href="dash.php?q=5"><i class="bi bi-journal-minus me-1"></i> Remove Exam</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==1)?'active':'' ?>" href="dash.php?q=1"><i class="bi bi-people me-1"></i> Students</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==2)?'active':'' ?>" href="dash.php?q=2"><i class="bi bi-bar-chart me-1"></i> Ranking</a></li>
            <li class="nav-item"><a class="nav-link text-white <?= (@$_GET['q']==3)?'active':'' ?>" href="dash.php?q=3"><i class="bi bi-chat-dots me-1"></i> Feedback</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php" target="_blank"><i class="bi bi-house-door me-1"></i> Home</a></li>
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
                  <th></th>
                  </tr>
                </thead>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$mob = $row['mob'];
	$gender = $row['gender'];
    $email = $row['email'];
	

	echo '<tr>
  <td>'.$c++.'</td>
  <td>'.$name.'</td>
  <td>'.$gender.'</td>
  
  <td>'.$email.'</td>
  <td>'.$mob.'</td>
	<td><a title="Delete User" href="update.php?demail='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div></div>';

}?>


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

            <?php for ($i = 1; $i <= $n; $i++): ?>
              <div class="question-block" id="question-<?= $i ?>" style="display: <?= $i === 1 ? 'block' : 'none' ?>;">
                <h5 class="fw-bold mb-3">Question <?= $i ?></h5>

                <!-- Question Text -->
                <div class="mb-4">
                  <label class="form-label">Question Text <small class="text-danger">*</small></label>
                  <textarea rows="3" name="qns<?= $i ?>" class="form-control" 
                    placeholder="Write question number <?= $i ?> here..." required></textarea>
                </div>

                <!-- Options -->
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label">Option A *</label>
                    <input type="text" name="<?= $i ?>1" class="form-control" placeholder="Enter option A" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option B *</label>
                    <input type="text" name="<?= $i ?>2" class="form-control" placeholder="Enter option B" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option C *</label>
                    <input type="text" name="<?= $i ?>3" class="form-control" placeholder="Enter option C" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Option D *</label>
                    <input type="text" name="<?= $i ?>4" class="form-control" placeholder="Enter option D" required>
                  </div>
                </div>

                <!-- Correct Answer -->
                <div class="mb-3">
                  <label class="form-label fw-bold">Correct Answer *</label>
                  <select name="ans<?= $i ?>" class="form-select" required>
                    <option value="">Select correct option...</option>
                    <option value="a">Option A</option>
                    <option value="b">Option B</option>
                    <option value="c">Option C</option>
                    <option value="d">Option D</option>
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
<td><b>Action</b></td>
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
	<td><b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
}
$c=0;
echo '</table></div></div>';

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
