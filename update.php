<?php

// update.php - safe admin and question handlers + student handlers for your dash.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'dbConnection.php';
session_start();

// require login
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'];

// replace the old isAdmin() with this DB-backed check
// put this in update.php (replace old isAdmin())
function isAdmin() {
    global $con;
    if (empty($_SESSION['email'])) return false;

    // Optional legacy key fallback (remove if you don't want it)
    if (!empty($_SESSION['key']) && $_SESSION['key'] === 'sunny7785068889') return true;

    // Query the DB for the user's role
    $email = $_SESSION['email'];
    $stmt = $con->prepare("SELECT role FROM user WHERE email = ? LIMIT 1");
    if ($stmt === false) {
        // fallback to false if prepare fails
        error_log("isAdmin prepare failed: " . $con->error);
        return false;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if (!$res || $res->num_rows === 0) {
        $stmt->close();
        return false;
    }
    $row = $res->fetch_assoc();
    $stmt->close();
    return (isset($row['role']) && strtolower($row['role']) === 'admin');
}

function json_response(array $payload, int $status = 200): void {
    http_response_code($status);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($payload);
    exit;
}


// helper: safe int
function intOr($arr, $k, $d = 0) {
    return isset($arr[$k]) && $arr[$k] !== '' ? (int)$arr[$k] : $d;
}

// action detection (support q via GET or action via POST)
$action = null;
if (!empty($_REQUEST['q'])) $action = $_REQUEST['q'];
if (!empty($_POST['action'])) $action = $_POST['action'];

// ------------------------ ADMIN: Add Quiz ------------------------
if ($action === 'addquiz') {
    if (!isAdmin()) {
        header("Location: dash.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Invalid request method for addquiz.";
        exit;
    }

    // Accept multiple possible field names from dash.php
    $title   = trim($_POST['title'] ?? $_POST['name'] ?? '');
    $total   = intOr($_POST, 'total', 0);
    $sahi    = isset($_POST['right']) ? (int)$_POST['right'] : (isset($_POST['correct']) ? (int)$_POST['correct'] : 1);
    $wrong   = isset($_POST['wrong']) ? (int)$_POST['wrong'] : 0;
    $time    = intOr($_POST, 'time', 0);
    $subject = ucfirst(strtolower(trim($_POST['subject'])));   
    $tag     = trim($_POST['tag'] ?? '');       
    $intro   = trim($_POST['desc'] ?? $_POST['description'] ?? $_POST['intro'] ?? '');

    if ($title === '' || $total <= 0 || $subject === '') {
        echo "Invalid request: missing title, subject, or total questions.";
        exit;
    }

    // create unique exam id consistent with your app (eid)
    $eid = str_replace('.', '', uniqid('eid_', true));

    // Insert into quiz: now with subject included
    $stmt = $con->prepare("INSERT INTO quiz (eid, title, subject, sahi, `wrong`, total, `time`, intro, tag, `date`) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    if ($stmt === false) { 
        echo "DB prepare failed: " . htmlspecialchars($con->error); 
        exit; 
    }

    $stmt->bind_param("sssiiiiss", $eid, $title, $subject, $sahi, $wrong, $total, $time, $intro, $tag);
    
    if (!$stmt->execute()) {
        echo "Error inserting quiz: " . htmlspecialchars($stmt->error);
        $stmt->close();
        exit;
    }
    $stmt->close();

    // redirect admin to question entry step
    header("Location: dash.php?q=4&step=2&eid=" . rawurlencode($eid) . "&n=" . intval($total));
    exit;
}


// ------------------------ ADMIN: Add Questions ------------------------
if ($action === 'addqns') {
    if (!isAdmin()) {
        header("Location: dash.php");
        exit;
    }

    $eid   = $_GET['eid'] ?? '';
    $total = intval($_GET['n'] ?? 0);

    if ($eid === '' || $total <= 0) {
        echo "Invalid request";
        exit;
    }

    for ($i = 1; $i <= $total; $i++) {
        $qns = trim($_POST['qns'.$i] ?? '');
        $optA = trim($_POST[$i.'1'] ?? '');
        $optB = trim($_POST[$i.'2'] ?? '');
        $optC = trim($_POST[$i.'3'] ?? '');
        $optD = trim($_POST[$i.'4'] ?? '');
        $ansLetter = strtolower(trim($_POST['ans'.$i] ?? ''));

        // ✅ get qid for this question (hidden field in form)
        $qid = $_POST['qid'.$i] ?? '';

        if ($qns === '' || $optA === '' || $optB === '' || $optC === '' || $optD === '' || $ansLetter === '') {
            continue;
        }

        if ($qid !== '') {
            // 🔹 UPDATE MODE
            $stmt = $con->prepare("UPDATE questions SET qns=? WHERE qid=?");
            $stmt->bind_param("ss", $qns, $qid);
            $stmt->execute();
            $stmt->close();

            // fetch existing options
            $o = $con->prepare("SELECT optionid FROM options WHERE qid=? ORDER BY optionid ASC");
            $o->bind_param("s", $qid);
            $o->execute();
            $res = $o->get_result();
            $existing = $res->fetch_all(MYSQLI_ASSOC);
            $o->close();

            $letters = ['a'=>$optA, 'b'=>$optB, 'c'=>$optC, 'd'=>$optD];
            $i2 = 0; 
            $correctOptionId = null;

            foreach ($letters as $letter=>$text) {
                $optionid = $existing[$i2]['optionid'] ?? uniqid('opt_',true);

                if (isset($existing[$i2])) {
                    $stmtO = $con->prepare("UPDATE options SET option=? WHERE optionid=?");
                    $stmtO->bind_param("ss", $text, $optionid);
                } else {
                    $stmtO = $con->prepare("INSERT INTO options (qid, optionid, option) VALUES (?, ?, ?)");
                    $stmtO->bind_param("sss", $qid, $optionid, $text);
                }
                $stmtO->execute();
                $stmtO->close();

                if ($letter === $ansLetter) {
                    $correctOptionId = $optionid;
                }
                $i2++;
            }

            if (!empty($correctOptionId)) {
                $stmtA = $con->prepare("UPDATE answer SET ansid=? WHERE qid=?");
                $stmtA->bind_param("ss", $correctOptionId, $qid);
                $stmtA->execute();
                $stmtA->close();
            }

        } else {
            // 🔹 INSERT MODE
            $qid = uniqid('qid_', true);
            $stmtQ = $con->prepare("INSERT INTO questions (eid, qid, qns, sn) VALUES (?, ?, ?, ?)");
            $stmtQ->bind_param("sssi", $eid, $qid, $qns, $i);
            $stmtQ->execute();
            $stmtQ->close();

            $letters = ['a'=>$optA, 'b'=>$optB, 'c'=>$optC, 'd'=>$optD];
            $correctOptionId = null;

            foreach ($letters as $letter=>$text) {
                $optionid = uniqid('opt_', true);
                $stmtO = $con->prepare("INSERT INTO options (qid, optionid, option) VALUES (?, ?, ?)");
                $stmtO->bind_param("sss", $qid, $optionid, $text);
                $stmtO->execute();
                $stmtO->close();

                if ($letter === $ansLetter) {
                    $correctOptionId = $optionid;
                }
            }

            if ($correctOptionId) {
                $stmtA = $con->prepare("INSERT INTO answer (qid, ansid) VALUES (?, ?)");
                $stmtA->bind_param("ss", $qid, $correctOptionId);
                $stmtA->execute();
                $stmtA->close();
            }
        }
    }

    header("Location: dash.php?q=0");
    exit;
}





// ------------------------ ADMIN: Remove Quiz (production) ------------------------
if ($action === 'rmquiz') {
    if (!isAdmin()) {
        $_SESSION['flash_error'] = "Permission denied: admin required.";
        header("Location: dash.php");
        exit;
    }

    $eid = trim($_REQUEST['eid'] ?? '');
    if ($eid === '') {
        $_SESSION['flash_error'] = "Invalid request: missing exam id.";
        header("Location: dash.php?q=5");
        exit;
    }

    // Start transaction
    if (!$con->begin_transaction()) {
        error_log("[rmquiz] failed to start transaction: " . $con->error);
        $_SESSION['flash_error'] = "Server error: unable to remove exam.";
        header("Location: dash.php?q=5");
        exit;
    }

    try {
        // collect qids
        $stmt = $con->prepare("SELECT qid FROM questions WHERE eid = ?");
        $stmt->bind_param("s", $eid);
        $stmt->execute();
        $res = $stmt->get_result();
        $qids = [];
        while ($r = $res->fetch_assoc()) $qids[] = $r['qid'];
        $stmt->close();

        // delete options & answers
        $delOpt = $con->prepare("DELETE FROM options WHERE qid = ?");
        $delAns = $con->prepare("DELETE FROM answer  WHERE qid = ?");
        foreach ($qids as $qid) {
            $delOpt->bind_param("s", $qid); $delOpt->execute();
            $delAns->bind_param("s", $qid); $delAns->execute();
        }
        if ($delOpt) $delOpt->close();
        if ($delAns) $delAns->close();

        // delete questions, history, quiz
        $stmtQ = $con->prepare("DELETE FROM questions WHERE eid = ?");
        $stmtQ->bind_param("s", $eid); $stmtQ->execute(); $stmtQ->close();

        $stmtH = $con->prepare("DELETE FROM history WHERE eid = ?");
        $stmtH->bind_param("s", $eid); $stmtH->execute(); $stmtH->close();

        $stmtQuiz = $con->prepare("DELETE FROM quiz WHERE eid = ?");
        $stmtQuiz->bind_param("s", $eid); $stmtQuiz->execute(); $stmtQuiz->close();

        $con->commit();
        error_log("[rmquiz] success eid={$eid} by {$_SESSION['email']}");
        $_SESSION['flash_success'] = "Exam removed successfully.";
        header("Location: dash.php?q=5");
        exit;
    } catch (Exception $ex) {
        $con->rollback();
        error_log("[rmquiz] exception: " . $ex->getMessage());
        $_SESSION['flash_error'] = "Failed to remove exam. Server error logged.";
        header("Location: dash.php?q=5");
        exit;
    }
}

 // ------------------------ ADMIN: Edit Question ------------------------
 if (@$_GET['q'] == 'editexam' && isset($_GET['eid'])) {
    $eid     = $_GET['eid'];
    $title   = $_POST['title'];
    $subject = $_POST['subject'];
    $sahi    = $_POST['sahi'];
    $wrong   = $_POST['wrong'];
    $total   = $_POST['total'];
    $time    = $_POST['time'];
    $intro   = $_POST['intro'];
    $tag     = $_POST['tag'];

    $query = "UPDATE quiz 
              SET title='$title', subject='$subject', sahi='$sahi', wrong='$wrong', 
                  total='$total', time='$time', intro='$intro', tag='$tag' 
              WHERE eid='$eid'";

    mysqli_query($con, $query) or die('Error updating exam');

    // After update → redirect to add/edit questions form
    header("Location: dash.php?q=4&step=2&eid=$eid&n=$total");
    exit();
}


// ------------------------ ADMIN: Delete feedback ------------------------
if ($action === 'fdid' || isset($_REQUEST['fdid'])) {
    if (!isAdmin()) {
        header("Location: dash.php");
        exit;
    }
    $id = $_REQUEST['fdid'] ?? '';
    if ($id === '') { header("Location: dash.php?q=3"); exit; }
    $stmt = $con->prepare("DELETE FROM feedback WHERE id=?"); if ($stmt) { $stmt->bind_param("s", $id); $stmt->execute(); $stmt->close(); }
    header("Location: dash.php?q=3");
    exit;
}

// ------------------------ STUDENT: Start exam (optional) ------------------------
if ($action === 'exam' || (isset($_GET['q']) && $_GET['q'] === 'exam')) {
    $eid = $_REQUEST['eid'] ?? '';
    if ($eid === '') { echo "Invalid request: missing eid."; exit; }
    if (!isset($_SESSION['exam_start']) || !is_array($_SESSION['exam_start'])) $_SESSION['exam_start'] = [];
    $_SESSION['exam_start'][$eid] = time();
    header("Location: account.php?q=quiz&step=2&eid=" . rawurlencode($eid) . "&n=1");
    exit;
}

// -------------------- STUDENT: Per-question submission (AJAX-ready) --------------------
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
          && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if (!function_exists('json_response')) {
    function json_response(array $payload, int $status = 200): void {
        http_response_code($status);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($payload);
        exit;
    }
}


if (
    isset($_REQUEST['q']) && $_REQUEST['q'] === 'quiz'
    && isset($_REQUEST['step']) && (int)$_REQUEST['step'] === 2
) {
    // Read from REQUEST so this works for both POST (AJAX) and GET (fallback)
    $eid           = trim($_REQUEST['eid'] ?? '');
    $sn            = (int)($_REQUEST['n'] ?? 1);      // 1-based current question number
    $total         = (int)($_REQUEST['t'] ?? 0);
    $qid           = trim($_REQUEST['qid'] ?? '');
    $selected_ans  = trim($_REQUEST['ans'] ?? '');    // optionid string or ''

    if ($eid === '') {
        if ($isAjax) json_response(['error' => 'Missing eid'], 400);
        header("Location: dash.php"); exit;
    }

    // Ensure there is a history row (in-progress)
    $stmt = $con->prepare("SELECT * FROM history WHERE eid=? AND email=? LIMIT 1");
    $stmt->bind_param("ss", $eid, $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        $stmtIns = $con->prepare("INSERT INTO history (email, eid, date) VALUES (?, ?, NOW())");
        $stmtIns->bind_param("ss", $email, $eid);
        $stmtIns->execute();
        $stmtIns->close();
    }
    $stmt->close();

    // Save/overwrite the student's answer for this qid (if provided)
    if ($qid !== '') {
        $stmtAns = $con->prepare(
            "INSERT INTO history_answers (email, eid, qid, answer)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE answer=VALUES(answer)"
        );
        $stmtAns->bind_param("ssss", $email, $eid, $qid, $selected_ans);
        $stmtAns->execute();
        $stmtAns->close();
    }

    // Recompute progress counts (correct, attempted, wrong) from saved answers
    $correct_count = 0;
    $attempted = 0;

    // attempted answers
    $stmtA = $con->prepare(
        "SELECT COUNT(*) AS cnt FROM history_answers WHERE email=? AND eid=? AND answer <> ''"
    );
    $stmtA->bind_param("ss", $email, $eid);
    $stmtA->execute();
    $rsA = $stmtA->get_result();
    if ($rsA && $row = $rsA->fetch_assoc()) {
        $attempted = (int)$row['cnt'];
    }
    $stmtA->close();

    // correct answers
    $stmtC = $con->prepare(
        "SELECT COUNT(*) AS cnt
         FROM history_answers ha
         JOIN answer a ON a.qid = ha.qid
         WHERE ha.email=? AND ha.eid=? AND ha.answer = a.ansid"
    );
    $stmtC->bind_param("ss", $email, $eid);
    $stmtC->execute();
    $rsC = $stmtC->get_result();
    if ($rsC && $row = $rsC->fetch_assoc()) {
        $correct_count = (int)$row['cnt'];
    }
    $stmtC->close();

    $wrong_count = max(0, $attempted - $correct_count);

    // Persist progress (no final score here)
    $stmtU = $con->prepare("UPDATE history SET level=?, sahi=?, wrong=?, date=NOW() WHERE email=? AND eid=?");
    $stmtU->bind_param("iiiss", $attempted, $correct_count, $wrong_count, $email, $eid);
    $stmtU->execute();
    $stmtU->close();

    // If this was the last question, finalize score + ranking once
    if ($sn >= $total && $total > 0) {
        // fetch marking scheme
        $marks_per_correct = 1;
        $penalty_per_wrong = 0;
        $stmtQ = $con->prepare("SELECT sahi, `wrong` FROM quiz WHERE eid=? LIMIT 1");
        $stmtQ->bind_param("s", $eid);
        $stmtQ->execute();
        $rsQ = $stmtQ->get_result();
        if ($rsQ && $cfg = $rsQ->fetch_assoc()) {
            $marks_per_correct = (int)$cfg['sahi'];
            $penalty_per_wrong = (int)$cfg['wrong'];
        }
        $stmtQ->close();

        $finalScore = ($correct_count * $marks_per_correct) - ($wrong_count * $penalty_per_wrong);
        if ($finalScore < 0) $finalScore = 0;

        // finalize once
        $con->begin_transaction();
        try {
            $stmtF = $con->prepare(
                "UPDATE history
                 SET score=?, completed=1, date=NOW()
                 WHERE email=? AND eid=? AND (completed IS NULL OR completed=0)"
            );
            $stmtF->bind_param("iss", $finalScore, $email, $eid);
            $stmtF->execute();
            $stmtF->close();

            // update rank (additive)
            $stmtR = $con->prepare("SELECT score FROM rank WHERE email=? LIMIT 1");
            $stmtR->bind_param("s", $email);
            $stmtR->execute();
            $rsR = $stmtR->get_result();

            if ($rsR->num_rows === 0) {
                $stmtIns = $con->prepare("INSERT INTO rank (email, score, time) VALUES (?, ?, NOW())");
                $stmtIns->bind_param("si", $email, $finalScore);
                $stmtIns->execute();
                $stmtIns->close();
            } else {
                $existing = (int)$rsR->fetch_assoc()['score'];
                $newScore = max(0, $existing + $finalScore);
                $stmtUp = $con->prepare("UPDATE rank SET score=?, time=NOW() WHERE email=?");
                $stmtUp->bind_param("is", $newScore, $email);
                $stmtUp->execute();
                $stmtUp->close();
            }
            $stmtR->close();

            $con->commit();
        } catch (Throwable $e) {
            $con->rollback();
            // If something goes wrong, still return completed so the UI can move forward.
        }

        if ($isAjax) {
            json_response(['completed' => true]);
        } else {
            header("Location: account.php?q=result&eid=" . rawurlencode($eid));
            exit;
        }
    }

    // Not the last question → tell the UI the next zero-based index.
    // Frontend uses zero-based `currentQuestion`. Current sn is 1-based.
    // Next zero-based index = current sn (e.g., sn=1 → next index 1).
    $nextIndex = $sn; 
    if ($isAjax) {
        json_response([
            'completed' => false,
            'nextQuestionIndex' => $nextIndex
        ]);
    } else {
        header("Location: account.php?q=quiz&step=2&eid=" . rawurlencode($eid) . "&n=" . ($sn + 1) . "&t=" . $total);
        exit;
    }
}
// -------------------- END student per-question submission --------------------





   // Ensure history exists — insert a stub row if missing but DO NOT set score here
$stmt = $con->prepare("SELECT * FROM history WHERE eid=? AND email=? LIMIT 1");
$stmt->bind_param("ss", $eid, $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    // Insert stub row without score/level so score stays NULL until completion
    $stmtIns = $con->prepare("INSERT INTO history (email, eid, date) VALUES (?, ?, NOW())");
    $stmtIns->bind_param("ss", $email, $eid);
    $stmtIns->execute();
    $stmtIns->close();

    // reselect
    $stmt->execute();
    $res = $stmt->get_result();
}
$stmt->close();


    $rowH = $res->fetch_assoc();
    // NOTE: history columns assumed: email,eid,score,level,sahi,wrong,date
    $correct_count = (int)($rowH['sahi'] ?? 0);
    $wrong_count   = (int)($rowH['wrong'] ?? 0);

    // Update counts based on this response
    if ($selected_ans !== '') {
        // The student's posted 'ans' should be the option's optionid (string).
        if ($selected_ans === $correct_ansid) {
            $correct_count++;
        } else {
            $wrong_count++;
        }
    } // unanswered -> remain uncounted

    $attempted = $correct_count + $wrong_count;

    // compute score
    $computed_score = ($correct_count * $marks_per_correct) - ($wrong_count * $penalty_per_wrong);
    if ($computed_score < 0) $computed_score = 0;

    // Persist progress only — do NOT set score until final submission / timeout
$stmt = $con->prepare("UPDATE history SET level=?, sahi=?, wrong=?, date=NOW() WHERE email=? AND eid=?");
$stmt->bind_param("iiiss", $attempted, $correct_count, $wrong_count, $email, $eid);
$stmt->execute();
$stmt->close();


    // If not last question, go to next
    if ($sn < $total) {
        $next = $sn + 1;
        header("Location: account.php?q=quiz&step=2&eid=" . rawurlencode($eid) . "&n=" . $next . "&t=" . $total . "&time=" . intval($quizTime));
        exit;
    }

    // Last question: finalize rank (avoid double counting if already finalized)
    $stmt = $con->prepare("SELECT level, sahi, wrong FROM history WHERE eid=? AND email=? LIMIT 1");
    $stmt->bind_param("ss", $eid, $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $h_level = $h_sahi = $h_wrong = 0;
    if ($res && $res->num_rows) {
        $r = $res->fetch_assoc();
        $h_level = (int)$r['level'];
        $h_sahi = (int)$r['sahi'];
        $h_wrong = (int)$r['wrong'];
    }
    $stmt->close();

   // compute final score (you already have this)
$finalScore = ($h_sahi * $marks_per_correct) - ($h_wrong * $penalty_per_wrong);
if ($finalScore < 0) $finalScore = 0;

$alreadyFinished = !empty($rowH['completed']); // new flag check

if (!$alreadyFinished) {
    // Start transaction so history + rank updates are atomic
    if (!$con->begin_transaction()) {
        error_log("[quiz-finalize] failed to start transaction: " . $con->error);
        // fallback: try best-effort, but better to show error
    }

    try {
         // 1) Persist final score into history and mark completed
        $stmtFinal = $con->prepare(
            "UPDATE history SET score=?, level=?, sahi=?, wrong=?, completed=1, date=NOW() WHERE email=? AND eid=?"
        );
        if ($stmtFinal === false) throw new Exception("prepare failed: " . $con->error);
        $stmtFinal->bind_param("iiiiss", $finalScore, $attempted, $h_sahi, $h_wrong, $email, $eid);
        $stmtFinal->execute();
        $stmtFinal->close();

        // 2) Update rank
        $stmt = $con->prepare("SELECT score FROM rank WHERE email=? LIMIT 1");
        if ($stmt === false) throw new Exception("prepare failed: " . $con->error);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 0) {
            $stmtIns = $con->prepare("INSERT INTO rank (email, score, time) VALUES (?, ?, NOW())");
            if ($stmtIns === false) throw new Exception("prepare failed: " . $con->error);
            $stmtIns->bind_param("si", $email, $finalScore);
            if (!$stmtIns->execute()) throw new Exception("rank insert failed: " . $stmtIns->error);
            $stmtIns->close();
        } else {
            $existing = (int)$res->fetch_assoc()['score'];
            $newScore = max(0, $existing + (int)$finalScore);
            $stmtUpd = $con->prepare("UPDATE rank SET score=?, time=NOW() WHERE email=?");
            if ($stmtUpd === false) throw new Exception("prepare failed: " . $con->error);
            $stmtUpd->bind_param("is", $newScore, $email);
            if (!$stmtUpd->execute()) throw new Exception("rank update failed: " . $stmtUpd->error);
            $stmtUpd->close();
        }
        $stmt->close();

        // 3) commit
        if (!$con->commit()) throw new Exception("commit failed: " . $con->error);

    } catch (Exception $ex) {
        // rollback and log
        $con->rollback();
        error_log("[quiz-finalize] exception: " . $ex->getMessage());
        // Optionally set a flash message / show user friendly error
        $_SESSION['flash_error'] = "Server error while finalizing exam. Please contact admin.";
        header("Location: account.php?q=result&eid=" . rawurlencode($eid));
        exit;
    }
}


// server-side cleanup and redirect (same as yours)
if (!empty($_SESSION['exam_start']) && isset($_SESSION['exam_start'][$eid])) {
    unset($_SESSION['exam_start'][$eid]);
}
if ($isAjax) {
   header('Content-Type: application/json');
   echo json_encode(['completed' => true]);
   exit;
} else {
   // old HTML redirect
   echo '<!doctype html><html><head>...<script>window.location.href=...</script></head></html>';
   exit;
}

exit;


// -------------------- STUDENT: TIMEOUT FINALIZATION --------------------
if (!empty($_GET['q']) && $_GET['q'] === 'timeout' && !empty($_GET['eid'])) {
    $eid = $_GET['eid'];

    // get quiz config
    $stmt = $con->prepare("SELECT sahi, `wrong`, `total` FROM quiz WHERE eid=? LIMIT 1");
    $stmt->bind_param("s", $eid);
    $stmt->execute();
    $res = $stmt->get_result();
    if (!$res || $res->num_rows === 0) {
        header("Location: dash.php?q=0");
        exit;
    }
    $qr = $res->fetch_assoc();
    $marks_per_correct = (int)$qr['sahi'];
    $penalty_per_wrong = (int)$qr['wrong'];
    $quiz_total = (int)$qr['total'];
    $stmt->close();

    // ensure history exists
    $stmt = $con->prepare("SELECT * FROM history WHERE eid=? AND email=? LIMIT 1");
    $stmt->bind_param("ss", $eid, $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        $zero = 0;
        $stmtIns = $con->prepare("INSERT INTO history (email,eid,score,level,sahi,wrong,date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmtIns->bind_param("ssiiii", $email, $eid, $zero, $zero, $zero, $zero);
        $stmtIns->execute();
        $stmtIns->close();

        // reselect
        $stmt->execute();
        $res = $stmt->get_result();
    }
    $stmt->close();

    $rowH = $res->fetch_assoc();
    $correct_count = (int)($rowH['sahi'] ?? 0);
    $wrong_count   = (int)($rowH['wrong'] ?? 0);
    $attempted = $correct_count + $wrong_count;

    // mark remaining unanswered as wrong
    $remaining = max(0, $quiz_total - $attempted);
    if ($remaining > 0) {
        $wrong_count += $remaining;
        $attempted = $quiz_total;
    }

    // compute score
    $computed_score = ($correct_count * $marks_per_correct) - ($wrong_count * $penalty_per_wrong);
    if ($computed_score < 0) $computed_score = 0;

    // persist history
    $stmt = $con->prepare("UPDATE history SET score=?, level=?, sahi=?, wrong=?, date=NOW() WHERE email=? AND eid=?");
    $stmt->bind_param("iiiiss", $computed_score, $attempted, $correct_count, $wrong_count, $email, $eid);
    $stmt->execute();
    $stmt->close();

    
// ---------- SERVER-SIDE: immediate timeout check after saving history ----------
$stmtCheck = $con->prepare("SELECT end_time FROM history WHERE email=? AND eid=? LIMIT 1");
if ($stmtCheck) {
    $stmtCheck->bind_param("ss", $email, $eid);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    if ($resCheck && $resCheck->num_rows) {
        $rowCheck = $resCheck->fetch_assoc();
        $stored_end = intval($rowCheck['end_time'] ?? 0);

        // If end_time is set and already passed, forward to timeout finalizer
        if ($stored_end > 0 && time() >= $stored_end) {
            $stmtCheck->close();

            // Optional: cleanup session marker now exam is finished
            if (!empty($_SESSION['exam_start']) && isset($_SESSION['exam_start'][$eid])) {
                unset($_SESSION['exam_start'][$eid]);
            }

            // Redirect into your existing timeout handler which finalizes & shows result
            header("Location: update.php?q=timeout&eid=" . rawurlencode($eid));
            exit;
        }
    }
    $stmtCheck->close();
}

    // update rank only if not already finalized
    $previous_level = (int)($rowH['level'] ?? 0);
    if ($previous_level < $quiz_total) {
        $stmt = $con->prepare("SELECT score FROM rank WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows === 0) {
            $stmtIns = $con->prepare("INSERT INTO rank (email,score,time) VALUES (?, ?, NOW())");
            $stmtIns->bind_param("si", $email, $computed_score);
            $stmtIns->execute();
            $stmtIns->close();
        } else {
            $existing = (int)$res->fetch_assoc()['score'];
            $newScore = $existing + (int)$computed_score;
            if ($newScore < 0) $newScore = 0;
            $stmtUpd = $con->prepare("UPDATE rank SET score=?, time=NOW() WHERE email=?");
            $stmtUpd->bind_param("is", $newScore, $email);
            $stmtUpd->execute();
            $stmtUpd->close();
        }
        $stmt->close();
    }

    // SERVER-SIDE CLEANUP: remove session exam start for this eid
    if (!empty($_SESSION['exam_start']) && isset($_SESSION['exam_start'][$eid])) {
        unset($_SESSION['exam_start'][$eid]);
    }

    // redirect to result
    echo '<!doctype html><html><head><meta charset="utf-8"><script>';
    echo 'try { localStorage.removeItem(' . json_encode('quiz_end_'.$eid) . '); sessionStorage.removeItem(' . json_encode('quiz_timeout_in_progress_'.$eid) . '); } catch(e){}';
    echo 'window.location.href = "account.php?q=result&eid=' . rawurlencode($eid) . '";';
    echo '</script></head><body></body></html>';
    exit;
}

// -------------------- STUDENT: RESTART --------------------
if (!empty($_GET['q']) && $_GET['q'] === 'quizre' && @$_GET['step'] == 25) {
    $eid = $_GET['eid'] ?? '';
    $t = isset($_GET['t']) ? (int)$_GET['t'] : 0;
    $quizTime = $_GET['time'] ?? 0;
    if ($eid === '') { header("Location: dash.php"); exit; }

    // get previous history score to subtract from rank
    $stmt = $con->prepare("SELECT score FROM history WHERE eid=? AND email=? LIMIT 1");
    $stmt->bind_param("ss", $eid, $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $prevScore = 0;
    if ($res && $res->num_rows) $prevScore = (int)$res->fetch_assoc()['score'];
    $stmt->close();

    // delete history row
    $stmt = $con->prepare("DELETE FROM history WHERE eid=? AND email=?");
    $stmt->bind_param("ss", $eid, $email);
    $stmt->execute();
    $stmt->close();

    // adjust rank
    $stmt = $con->prepare("SELECT score FROM rank WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows) {
        $existing = (int)$res->fetch_assoc()['score'];
        $newScore = max(0, $existing - $prevScore);
        $stmtUpd = $con->prepare("UPDATE rank SET score=?, time=NOW() WHERE email=?");
        $stmtUpd->bind_param("is", $newScore, $email);
        $stmtUpd->execute();
        $stmtUpd->close();
    }
    $stmt->close();

    // server-side cleanup
    if (!empty($_SESSION['exam_start']) && isset($_SESSION['exam_start'][$eid])) {
        unset($_SESSION['exam_start'][$eid]);
    }

    // redirect to first question to restart
    echo '<!doctype html><html><head><meta charset="utf-8"><script>
        try { localStorage.removeItem(' . json_encode('quiz_end_'.$eid) . '); sessionStorage.removeItem(' . json_encode('quiz_started_'.$eid) . '); } catch(e){}
        window.location.href = "account.php?q=quiz&step=2&eid=' . rawurlencode($eid) . '&n=1&t=' . intval($t) . '&time=' . intval($quizTime) . '&reset=1";
        </script></head><body></body></html>';
    exit;
}

// default fallback
header("Location: dash.php");
exit;
