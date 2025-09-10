v
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>PTI CBT || USER ACCOUNT</title>

<!-- jQuery (must be loaded first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 5 & Icons (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />



<!-- Optional custom styles -->
<link rel="stylesheet" href="css/account.css" />
<link rel="stylesheet" href="css/font.css" />

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">

 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->
</head>
<?php
include_once 'dbConnection.php';
?>
<body class="bg-light">
<?php
include_once 'dbConnection.php';
session_start();
if(!(isset($_SESSION['email']))){
    header("location:index.php");
} else {
    $name  = $_SESSION['name'];
    $email = $_SESSION['email'];

    // ✅ Escape both email and eid immediately after getting them
    $safeEmail = mysqli_real_escape_string($con, $email);

    $eid = $_GET['eid'] ?? '';
    $safeEid = mysqli_real_escape_string($con, $eid);

    echo '<span class="pull-right top title1" >
            <span class="log1">
              <span class="bi bi-person" aria-hidden="true"></span>
              &nbsp;&nbsp;&nbsp;&nbsp;Hello,
            </span> 
            <a href="account.php?q=1" class="log log1">'.$name.'</a>
            &nbsp;|&nbsp;
            <a href="logout.php?q=account.php" class="log">
              <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout
            </a>
          </span>';

    // --- SAFETY: do NOT auto-create history rows here ---
// Only prepare sanitized variables. The actual insert/check happens
// when the user clicks Start (inside the quiz step=2 block).
$safeEmail = mysqli_real_escape_string($con, $email);
$eid = $_GET['eid'] ?? '';
$safeEid = mysqli_real_escape_string($con, $eid);

// Optional debug
// error_log("[INFO] account.php loaded for user={$safeEmail}, eid={$safeEid}");
}
?>



<header>
  <nav class="navbar navbar-dark bg-success border-bottom fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="account.php?q=1">
        <img src="image/PTI.jpg" alt="PTI Logo" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
        <span class="pti-full">Petroleum Training Institute</span>
        <span class="pti-short">PTI</span>
      </a>

      <ul class="navbar-nav flex-row gap-3 ms-auto d-1250-flex">
        <li class="nav-item"><a class="nav-link text-white <?= ($qParam=='1')?'active':'' ?>" href="account.php?q=1">Exams</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= ($qParam=='2')?'active':'' ?>" href="account.php?q=2">History</a></li>
        <li class="nav-item"><a class="nav-link text-white <?= ($qParam=='3')?'active':'' ?>" href="account.php?q=3">Ranking</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="index.php#admin-pane">Admin Login</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="logout.php?q=account.php">Signout</a></li>
      </ul>

      <!-- mobile offcanvas -->
      <button class="navbar-toggler d-1250-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-start bg-success text-white" id="sideNav">
        <div class="offcanvas-header"><h5 class="offcanvas-title">Menu</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-column gap-2">
            <li><a class="nav-link text-white <?= ($qParam=='1')?'active':'' ?>" href="account.php?q=1">Exams</a></li>
            <li><a class="nav-link text-white <?= ($qParam=='2')?'active':'' ?>" href="account.php?q=2">History</a></li>
            <li><a class="nav-link text-white <?= ($qParam=='3')?'active':'' ?>" href="account.php?q=3">Ranking</a></li>
            <li><a class="nav-link text-white" href="index.php#admin-pane">Admin Login</a></li>
            <li><a class="nav-link text-white" href="logout.php?q=account.php">Signout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>


<main class="container my-0 pt-4">
<script>
  document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('form').forEach(function(form){ form.classList.add('mt-form'); });
  document.querySelectorAll('table').forEach(function(table){ table.classList.add('mt-table'); });
});
</script>




<!--HOME TABLE-->
<?php 
if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
$c=1;
?>
<div class="main-content-spaced">
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
                  <th>S.N.</th>
                    <th>Topic</th>
                    <th>Total question</th>
                    <th>Marks</th>
                    <th>Time limit</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
<?php
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
  $time = $row['time'];
	$eid = $row['eid'];
// --- determine if this user truly completed this exam (not just has a history row)
$safeEid = mysqli_real_escape_string($con, $eid);
$safeEmail = mysqli_real_escape_string($con, $email);

$hRes = mysqli_query($con,
    "SELECT score, completed, end_time
     FROM history
     WHERE eid = '{$safeEid}' AND email = '{$safeEmail}'
     LIMIT 1"
) or die('Error98');

$completed = false;
if ($hRes && mysqli_num_rows($hRes) > 0) {
    $hRow = mysqli_fetch_assoc($hRes);

    // treat exam as completed only if:
    //  - score is not NULL (finalized), OR
    //  - completed flag is 1, OR
    //  - stored end_time has already passed
    if (!is_null($hRow['score']) || intval($hRow['completed']) === 1) {
    $completed = true;
}

}

if (!$completed) { ?>
    <tr>
        <td><?= $c++ ?></td>
        <td><?= htmlspecialchars($title) ?></td>
        <td><?= intval($total) ?></td>
        <td><?= intval($sahi) * intval($total) ?></td>
        <td><?= intval($time) ?>&nbsp;min</td>
        <td>
          <a href="account.php?q=quiz&step=2&eid=<?= htmlspecialchars($eid) ?>&n=1&t=<?= intval($total) ?>" 
             class="pull-right btn sub1 bg-success bg-opacity-20" 
             style="margin:0px;">
            <i class="bi bi-box-arrow-in-right"></i>
            <span class="title1 text-light"><b>Start</b></span>
          </a>
        </td>
    </tr>
<?php } else { ?>
    <tr style="color:#99cc32">
      <td><?= $c++ ?></td>
      <td>
        <?= htmlspecialchars($title) ?>
        <i class="bi bi-check-circle" title="You have already taken this exam"></i>
      </td>
      <td><?= intval($total) ?></td>
      <td><?= intval($sahi) * intval($total) ?></td>
      <td><?= intval($time) ?>&nbsp;min</td>
      <td>
        <button class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                title="You have already taken this exam" style="margin:0px;">
          <i class="bi bi-x-circle"></i>
          <span class="text-light"><b>Completed</b></span>
        </button>
      </td>
    </tr>
<?php 

}
}

  } ?>
  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
<!--<span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>-->

<!--END OF HOME TABLE-->



<!--EXAM START-->
<?php
// get user email from session
$email = $_SESSION['email'];  



// now continue to your existing step=2 logic
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    // sanitize GET values early
    $total = intval($_GET['t'] ?? 0);
    $eid   = trim($_GET['eid'] ?? '');

    // sanitize session email
    $email = $_SESSION['email'] ?? '';
    $safeEmail = mysqli_real_escape_string($con, $email);
    $safeEid   = mysqli_real_escape_string($con, $eid);

    // --- Only treat exam as "already taken" when a completion is recorded.
    // We use score IS NOT NULL as the completion marker (adjust if you use another field).
   $check = mysqli_query(
    $con,
    "SELECT * FROM history WHERE email='{$safeEmail}' AND eid='{$safeEid}' LIMIT 1"
) or die(mysqli_error($con));

$alreadyTaken = false;
if (mysqli_num_rows($check) > 0) {
    $row = mysqli_fetch_assoc($check);

    // Only mark as taken if score > 0 OR exam ended
    if (!is_null($row['score']) || intval($row['completed']) === 1) {
    $alreadyTaken = true;
}
}

if ($alreadyTaken) {
    echo "<div class='alert alert-danger mt-3'>You have already taken this exam.</div>";
    echo "DEBUG: end_time=" . $row['end_time'] . ", current_time=" . time() . ", score=" . var_export($row['score'], true);
echo "</pre>";
    exit;
}



    // fetch exam duration (in minutes) from quiz table
    $quizResult = mysqli_query($con,
        "SELECT `time` FROM quiz WHERE eid='" . mysqli_real_escape_string($con, $eid) . "' LIMIT 1"
    );
    $quizRow = mysqli_fetch_assoc($quizResult);
    $exam_duration_minutes = $quizRow ? intval($quizRow['time']) : 0;

    // compute start/end
    $duration   = $exam_duration_minutes * 60;
    $start_time = time();
    $end_time   = $start_time + $duration;

    // check if a history row already exists (in-progress)
    $check2 = mysqli_query(
        $con,
        "SELECT end_time FROM history WHERE email='{$safeEmail}' AND eid='{$safeEid}' LIMIT 1"
    ) or die(mysqli_error($con));

    if (mysqli_num_rows($check2) == 0) {
        // first attempt → insert (in-progress). Use escaped values.
        $safeStart = intval($start_time);
        $safeEnd   = intval($end_time);
        mysqli_query(
            $con,
            "INSERT INTO history (email, eid, start_time, end_time) VALUES ('{$safeEmail}', '{$safeEid}', '{$safeStart}', '{$safeEnd}')"
        ) or die(mysqli_error($con));
    } else {
        // already started → don’t overwrite start/end, just reuse end_time
        $row = mysqli_fetch_assoc($check2);
        $end_time = $row['end_time'];
    }

    // load quiz & questions as before
    $quizQuery = mysqli_query($con, "SELECT * FROM quiz WHERE eid='" . mysqli_real_escape_string($con, $eid) . "' LIMIT 1")
        or die(mysqli_error($con));
    $quizRow = mysqli_fetch_assoc($quizQuery);

    if ($quizRow) {
        $exam_duration_minutes = intval($quizRow['time']);
    } else {
        $exam_duration_minutes = 0;
        echo "<p style='color:red'>Error: Exam not found for eid=" . htmlspecialchars($eid) . "</p>";
    }

    // fetch questions
    $questions = mysqli_query($con,
        "SELECT * FROM questions WHERE eid='" . mysqli_real_escape_string($con, $eid) . "' ORDER BY sn ASC")
        or die(mysqli_error($con));

    $allQuestions = [];
    while ($row = mysqli_fetch_assoc($questions)) {
        $qid = $row['qid'];
        $qns = $row['qns'];

        $optRes = mysqli_query($con, "SELECT * FROM options WHERE qid='" . mysqli_real_escape_string($con, $qid) . "'")
            or die(mysqli_error($con));
        $options = mysqli_fetch_all($optRes, MYSQLI_ASSOC);

        $allQuestions[] = [
            'qid'     => $qid,
            'qns'     => $qns,
            'options' => $options
        ];
    }

    // fetch end_time once for JS timer
    $res = mysqli_query($con,
        "SELECT end_time FROM history WHERE email='" . $safeEmail . "' AND eid='" . $safeEid . "' LIMIT 1")
        or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($res);
    $exam_end_time = $row ? $row['end_time'] : time() + ($exam_duration_minutes * 60);
?>
<script>
  const examEndTime = <?= json_encode($exam_end_time) ?> * 1000;
</script>

<form method="POST" id="quizForm">
  <input type="hidden" id="hiddenAns" name="ans" value="">
    <input type="hidden" name="q" value="quiz">
    <input type="hidden" name="step" value="2">
    <input type="hidden" name="eid" value="<?= htmlspecialchars($eid) ?>">
    <input type="hidden" name="t" value="<?= intval($total) ?>">

    <div class="panel" style="margin:5%">

        <!-- Global Timer (visible across all questions) -->
 <div class="exam-global-timer text-center my-3">
  <span id="globalExamTimer" class="pulse badge exam-card-header fs-3 fw-bold rounded-pill px-3 py-2 shadow"></span>
</div>

        <?php foreach ($allQuestions as $index => $q) :
            // sn is 1-based question number
            $sn = $index + 1;
            ?>
           
         


            <div class="question-container" data-index="<?= $index ?>" data-qid="<?= htmlspecialchars($q['qid']) ?>" style="<?= $index === 0 ? '' : 'display:none;' ?>">
                <div class="" >
                    <div class="card shadow-lg border-0 mb-4" >
                        <div class="card-header question-card-header bg-info text-white d-flex justify-content-between align-items-center py-3">
    <div class="fw-bold fs-5">
        <i class="bi bi-question-circle me-2"></i>
        Question <?= $sn ?> of <?= count($allQuestions) ?>
    </div>
    <!-- Timer for this question -->
    <!--<span class="badge bg-light fw-bold text-danger question-timer" data-index="<?= $index ?>">00:00:00</span> -->
</div>

                    </div>

                    <div class="question-header mb-3">
                        <div class="text-muted small"><?= nl2br(htmlspecialchars($q['qns'], ENT_QUOTES)) ?></div>
                    </div>

                    <div class="options-list">
                        <?php foreach ($q['options'] as $option) :
                            // radio names can be anything — we'll find the checked one in JS
                            $optId = 'q' . $q['qid'] . '-opt' . $option['optionid'];
                        ?>
                        <div class="option-row mb-2">
                            <input type="radio" class="option-input" id="<?= $optId ?>" name="opt_<?= $q['qid'] ?>" value="<?= htmlspecialchars($option['optionid']) ?>">
                            <label for="<?= $optId ?>" class="option-label d-flex align-items-start gap-3 p-3 rounded-3">
                                <span class="option-bullet d-flex align-items-center justify-content-center">
                                    <i class="bi bi-circle-fill"></i>
                                </span>
                                <div class="option-text flex-grow-1"><?= htmlspecialchars($option['option'], ENT_QUOTES) ?></div>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-secondary" id="prevBtn" style="display:none;">Previous</button>

            <!-- Next is a button that will POST the current question to update.php (server handles redirect) -->
            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>

            <!-- Submit will behave same as Next for last question -->
            <button type="button" class="btn btn-success" id="submitBtn" style="display:none;">Submit</button>
        </div>
    </div>
</form>

<script>
/* --- Defensive/debugging AJAX submit for quiz --- */
/* Replace existing submitCurrentQuestionAJAX() and event listeners with this block. */

(function(){
  console.log("[QUIZ] Init enhanced AJAX handler");

  // Ensure required things exist
  const form = document.getElementById('quizForm');
  const containers = Array.from(document.querySelectorAll('.question-container'));
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const submitBtn = document.getElementById('submitBtn');

  if (!form) return console.error("[QUIZ] form#quizForm not found");
  if (!nextBtn) return console.error("[QUIZ] #nextBtn not found");
  if (!submitBtn) console.warn("[QUIZ] #submitBtn not found (ok for non-last pages)");
  if (!containers.length) return console.error("[QUIZ] no .question-container elements found");

  // Ensure currentQuestion exists (fallback to 0)
  if (typeof window.currentQuestion === 'undefined') window.currentQuestion = 0;
  console.log("[QUIZ] start currentQuestion =", window.currentQuestion, "containers=", containers.length);

  function getSelectedOptionForIndex(index) {
    const container = containers[index];
    if (!container) return '';
    const checked = container.querySelector('input[type="radio"]:checked');
    return checked ? checked.value : '';
  }

  function buildPostPayload(qid, sn, selected) {
    // use URLSearchParams so Content-Type x-www-form-urlencoded works
    const params = new URLSearchParams();
    params.append('q', 'quiz');
    params.append('step', '2');
    params.append('eid', <?= json_encode($eid) ?>); // server-inserted eid
    params.append('n', String(sn));
    params.append('t', String(<?= intval($total) ?>)); // server-inserted total
    params.append('qid', qid || '');
    params.append('ans', selected || '');
    return params.toString();
  }

  async function submitCurrentQuestionAJAX(next = true) {
    try {
      console.log("[QUIZ] submitCurrentQuestionAJAX called, currentQuestion=", window.currentQuestion);

      const container = containers[window.currentQuestion];
      if (!container) {
        console.error("[QUIZ] current container not found (index)", window.currentQuestion);
        return;
      }

      const qid = container.dataset.qid || '';
      const sn = window.currentQuestion + 1; // 1-based for server
      const selected = getSelectedOptionForIndex(window.currentQuestion);

      console.log("[QUIZ] qid=", qid, "sn=", sn, "selected=", selected);

      // Build query-string too (legacy servers that check $_GET)
      const qs = new URLSearchParams({
        q: 'quiz',
        step: '2',
        eid: <?= json_encode($eid) ?>,
        n: String(sn),
        t: String(<?= intval($total) ?>)
      }).toString();

      const body = buildPostPayload(qid, sn, selected);

      const resp = await fetch('update.php?' + qs, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        body: body,
        credentials: 'same-origin'
      });

      // network-level failure
      if (!resp.ok) {
        const text = await resp.text();
        console.error("[QUIZ] Server returned non-OK:", resp.status, text);
        throw new Error("Server error " + resp.status);
      }

      const contentType = resp.headers.get('Content-Type') || '';
      if (!contentType.includes('application/json')) {
        const text = await resp.text();
        console.error("[QUIZ] Expected JSON but got:", text);
        throw new Error("Invalid JSON from server");
      }

      const data = await resp.json();
      console.log("[QUIZ] AJAX response:", data);

      if (data.completed === true || data.completed === "1") {
        // finished
        window.location.href = `account.php?q=result&eid=${encodeURIComponent(<?= json_encode($eid) ?>)}`;
        return;
      }

      if (data.nextQuestionIndex !== undefined && data.nextQuestionIndex !== null) {
        window.currentQuestion = Number(data.nextQuestionIndex);
        console.log("[QUIZ] moving to index", window.currentQuestion);
        // showQuestion must exist on page
        if (typeof showQuestion === 'function') {
          showQuestion(window.currentQuestion);
        } else {
          // fallback: change visibility manually
          containers.forEach((c, i) => c.style.display = (i === window.currentQuestion) ? '' : 'none');
        }
        return;
      }

      console.warn("[QUIZ] Response did not contain nextQuestionIndex or completed flag", data);

    } catch (err) {
      console.error("[QUIZ] AJAX submit failed:", err);
      // fallback: add hidden inputs and do normal form submit to legacy endpoint
      try {
        if (!form.querySelector('input[name="qid"]')) {
          const inQ = document.createElement('input'); inQ.type='hidden'; inQ.name='qid'; inQ.value = containers[window.currentQuestion].dataset.qid || ''; form.appendChild(inQ);
        } else form.querySelector('input[name="qid"]').value = containers[window.currentQuestion].dataset.qid || '';
        if (!form.querySelector('input[name="ans"]')) {
          const inA = document.createElement('input'); inA.type='hidden'; inA.name='ans'; inA.value = getSelectedOptionForIndex(window.currentQuestion); form.appendChild(inA);
        } else form.querySelector('input[name="ans"]').value = getSelectedOptionForIndex(window.currentQuestion);

        form.action = 'update.php?q=quiz&step=2&eid=' + encodeURIComponent(<?= json_encode($eid) ?>);
        form.method = 'POST';
        form.submit();
      } catch (e) {
        console.error("[QUIZ] fallback submit also failed:", e);
      }
    }
  }

  // attach event listeners (avoid double-binding)
  nextBtn.removeEventListener('click', submitCurrentQuestionAJAX);
  nextBtn.addEventListener('click', function(){ submitCurrentQuestionAJAX(true); });

  function showQuestion(index) {
  containers.forEach((c, i) => c.style.display = (i === index) ? '' : 'none');
  prevBtn.style.display = (index > 0) ? '' : 'none';
  nextBtn.style.display = (index < containers.length - 1) ? '' : 'none';
  submitBtn.style.display = (index === containers.length - 1) ? '' : 'none';
}

  if (submitBtn) {
    submitBtn.removeEventListener('click', submitCurrentQuestionAJAX);
    submitBtn.addEventListener('click', function(){ submitCurrentQuestionAJAX(false); });
  }

  if (prevBtn) {
    prevBtn.removeEventListener('click', window.__quiz_prev_handler__);
    window.__quiz_prev_handler__ = function(){
      if (window.currentQuestion > 0) {
        window.currentQuestion--;
        if (typeof showQuestion === 'function') showQuestion(window.currentQuestion);
        else containers.forEach((c,i)=> c.style.display = (i===window.currentQuestion)?'':'none');
      }
    };
    prevBtn.addEventListener('click', window.__quiz_prev_handler__);
  }

  console.log("[QUIZ] handlers attached");
})();
</script>

<?php
} // end quiz step 2
?>




<?php
//result display
if (@$_GET['q'] == 'result' && @$_GET['eid']) {
    $eid = @$_GET['eid'];
    $q   = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
    ?>
   <!-- Result card (HTML + PHP kept intact) -->
<div class="main-content-spaced">
  <div class="card result-card mb-4">
    <div class="card-header result-card-header d-flex align-items-center">
      <i class="bi bi-award-fill me-2 result-icon"></i>
      <span class="fs-5 fw-bold">Result</span>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table result-table mb-0 align-middle">
          <thead>
            <tr>
              <th class="result-th">Metric</th>
              <th class="result-th text-end">Value</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_array($q)) : ?>
              <tr class="result-table-row result-row-bg-info">
                <td data-label="Total Questions" colspan="2" class="metric-cell">
                  <i class="bi bi-list-ol metric-icon"></i>
                  <span class="metric-label">Total Questions</span>
                </td>
                <td class="metric-value"><?= $row['level'] ?></td>
              </tr>

              <tr class="result-table-row result-row-bg-success">
                <td data-label="Right Answer" colspan="2" class="metric-cell">
                  <i class="bi bi-check-circle metric-icon"></i>
                  <span class="metric-label">Right Answer</span>
                </td>
                <td class="metric-value"><?= $row['sahi'] ?></td>
              </tr>

              <tr class="result-table-row result-row-bg-danger">
                <td data-label="Wrong Answer" colspan="2" class="metric-cell">
                  <i class="bi bi-x-circle metric-icon"></i>
                  <span class="metric-label">Wrong Answer</span>
                </td>
                <td class="metric-value"><?= $row['wrong'] ?></td>
              </tr>

              <tr class="result-table-row result-row-bg-warning">
                <td data-label="Score" colspan="2" class="metric-cell">
                  <i class="bi bi-star-fill metric-icon"></i>
                  <span class="metric-label">Score</span>
                </td>
                <td class="metric-value"><?= $row['score'] ?></td>
              </tr>
            <?php endwhile; ?>

            <?php 
            $q = mysqli_query($con, "SELECT * FROM rank WHERE email='$email' ") or die('Error157');
            while ($row = mysqli_fetch_array($q)) : ?>
              <tr class="result-table-row result-row-bg-primary">
               <!-- <td data-label="Overall Score" colspan="2" class="metric-cell">
                  <i class="bi bi-bar-chart-fill metric-icon"></i>
                  <span class="metric-label">Overall Score</span>
                </td>  
                <td class="metric-value"><?= $row['score'] ?></td>   -->
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php
} // end result
?>

<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="main-content-spaced">
         <div class="card shadow-sm mb-4">
    <div class="card-header history-card-header bg-primary text-white d-flex align-items-center">
      <i class="bi bi-clock-history me-2"></i><span class="fs-5 fw-bold">Exam History</span>
    </div>
 <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0 align-middle">
          <thead class="table-primary">
            <tr>
              <th>S.N.</th>
              <th>Exam</th>
              <th>Questions Solved</th>
              <th>Right</th>
              <th>Wrong</th>
              <th>Score</th>
            </tr>
          </thead>
          <tbody>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="main-content-spaced">
  <div class="card shadow-sm mb-4">
    <div class="card-header rank-card-header bg-primary text-white d-flex align-items-center">
      <i class="bi bi-trophy me-2"></i><span class="fs-5 fw-bold">Ranking</span>
    </div>
<div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0 align-middle">
          <thead class="table-primary">
          <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Gender</th>
            <th>College</th>
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
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$s.'</td><td>';
}
echo '</table></div></div>';}
?>

</div></div></div></div>

<!-- Time Up Modal -->
<!-- <div class="modal fade" id="timeUpModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <h5 class="fw-bold mb-3">⏰ Time’s Up!</h5>
      <p>Your exam time has ended.</p>
      <p>Submitting automatically in <span id="timeUpCountdown">3</span> seconds...</p>
    </div>
  </div>
</div>  -->

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="timeUpToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Time has elapsed. Submitting your exam...
      </div>
    </div>
  </div>
</div>


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





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function startExamTimer(endTime) {
    function getCurrentQuestionTimer() {
    const currentContainer = containers[currentQuestion];
    if (!currentContainer) return null;
    return currentContainer.querySelector(".question-timer");
}

   

    const examForm = document.getElementById("quizForm"); // ensure your <form id="quizForm"> exists
    let interval;
    let submitted = false; // prevent double-submit

    function updateTimer() {
    const now = Date.now();
    const distance = endTime - now;

    // Get the currently visible question container
    const currentContainer = document.querySelector('.question-container:not([style*="display:none"])');
    const timerElement = currentContainer ? currentContainer.querySelector(".question-timer") : null;

    if (!timerElement) return; // exit if no timer element found

    if (distance <= 0) {
        timerElement.textContent = "00:00:00";
        clearInterval(interval);

        if (examForm && !submitted) {
            submitted = true;
            console.log("[Timer] ⏰ Time expired, preparing auto-submit…");

         

            // Optional beep
            try {
                const beep = new Audio("beep.mp3");
                beep.play().catch(() => {});
                console.log("[Timer] Beep sound attempted");
            } catch (e) {
                console.error("[Timer] Beep failed", e);
            }

            // Countdown in modal before submission
            let countdown = 3;
            const countdownEl = document.getElementById("timeUpCountdown");
            if (countdownEl) countdownEl.textContent = countdown;

            const countdownTimer = setInterval(() => {
                countdown--;
                if (countdownEl) countdownEl.textContent = Math.max(0, countdown);
                console.log("[Timer] Modal countdown:", countdown);

                if (countdown <= 0) {
                    clearInterval(countdownTimer);
                    console.log("[Timer] Countdown finished, submitting now…");

                    // Use existing submit function if available
                    if (typeof submitCurrentQuestion === "function") {
                        try {
                            console.log("[Timer] Calling submitCurrentQuestion()");
                            submitCurrentQuestion();
                        } catch (err) {
                            console.error("[Timer] submitCurrentQuestion() failed", err);
                        }
                    } else if (examForm) {
                        console.log("[Timer] Falling back to direct form.submit()");

                        // capture current question info
                        const qid = currentContainer ? encodeURIComponent(currentContainer.dataset.qid) : '';
                        const sn = currentContainer ? parseInt(currentContainer.dataset.index || 0) + 1 : 1;
                        const selected = currentContainer ? (currentContainer.querySelector('input[type="radio"]:checked') || { value: '' }).value : '';
                        const hiddenAns = document.getElementById('hiddenAns');
                        if (hiddenAns) hiddenAns.value = selected;

                        console.log("[Timer] Captured ans=", selected, " qid=", qid, " sn=", sn);

                        // force result redirect
                        const eid = encodeURIComponent(<?= json_encode($eid) ?>);
                        examForm.action = `update.php?q=result&eid=${eid}`;
                        examForm.method = "POST";
                        examForm.submit();
                    } else {
                        console.error("[Timer] ❌ No form found to submit!");
                    }
                }
            }, 1000);

        }
        return;
    }

        // Normal ticking
        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        const format = n => String(n).padStart(2, "0");
        timerElement.textContent = `${format(hours)}:${format(minutes)}:${format(seconds)}`;

        // Pulse effect when <= 5 minutes
        if (distance <= 5 * 60 * 1000) {
            timerElement.classList.add("pulse");
        } else {
            timerElement.classList.remove("pulse");
        }
    }

    // start
    console.log("[Timer] Timer started, endTime=", new Date(endTime).toISOString());
    updateTimer();
    interval = setInterval(updateTimer, 1000);
}

// start the timer (examEndTime must be set by PHP earlier on the page)
if (typeof examEndTime !== "undefined") {
startExamTimer(examEndTime);
}
</script>

<script>
(function() {
  function updateTimer() {
    const now = Date.now();
    const remaining = Math.max(0, Math.floor((examEndTime - now) / 1000));

    const hours   = String(Math.floor(remaining / 3600)).padStart(2, '0');
    const minutes = String(Math.floor((remaining % 3600) / 60)).padStart(2, '0');
    const seconds = String(remaining % 60).padStart(2, '0');

    const display = `${hours}:${minutes}:${seconds}`;
    document.getElementById('globalExamTimer').textContent = display;

    if (remaining <= 0) {
      clearInterval(timerInterval);
      // Show toast instead of alert
      var toastElement = document.getElementById('timeUpToast');
      var toast = new bootstrap.Toast(toastElement, { delay: 3000 });
      toast.show();
      document.getElementById('submitBtn').click();
    }
  }

  updateTimer(); // run immediately
  const timerInterval = setInterval(updateTimer, 1000);
})();
</script>

<!-- Disabled button tooltip -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});
</script>

</body>
</html>