<?php
session_start();
include_once 'dbConnection.php';

// If already logged in, you probably shouldn't destroy session here — just continue.
// If you truly want to log out before logging back in, call session_unset()/session_destroy() then start a fresh session.
// session_unset(); session_destroy(); session_start();

$ref = $_GET['q'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header("Location: " . ($ref ?: 'index.php') . "?w=Missing credentials");
    exit;
}

// NOTE: keep your existing password hashing (md5) only if your DB already stores md5.
// Strong recommendation: migrate to password_hash() + password_verify() later.
$pw_hash = md5($password);

// Prepared statement to avoid SQL injection and to fetch role too
if ($stmt = $con->prepare("SELECT name, role FROM user WHERE email = ? AND password = ? LIMIT 1")) {
    $stmt->bind_param("ss", $email, $pw_hash);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        $_SESSION["name"]  = $row['name'];
        $_SESSION["email"] = $email;
        $_SESSION["role"]  = $row['role'] ?? null; // will be null only if DB value is null
        // optionally set other session vars
        header("Location: account.php?q=1");
        exit;
    } else {
        // bad credentials
        header("Location: " . ($ref ?: 'index.php') . "?w=Wrong Username or Password");
        exit;
    }
} else {
    // prepare failed
    error_log("login prepare failed: " . $con->error);
    header("Location: " . ($ref ?: 'index.php') . "?w=Server error");
    exit;
}
?>
