<?php
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/login.php');
    }
}

function logLoginAttempt($userId, $success) {
    global $conn;
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("INSERT INTO login_attempts (user_id, ip_address, success) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $ip, $success);
    $stmt->execute();
}
