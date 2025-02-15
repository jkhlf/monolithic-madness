<?php
require_once '../config/config.php';
require_once 'functions.php';

function registerUser($username, $email, $password) {
    global $conn;
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    
    return $stmt->execute();
}

function loginUser($username, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? AND status = 'active'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Atualizar último login
            $updateStmt = $conn->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
            $updateStmt->bind_param("i", $user['id']);
            $updateStmt->execute();
            
            // Log da tentativa bem-sucedida
            logLoginAttempt($user['id'], true);
            
            return $user;
        }
    }

    logLoginAttempt(null, false);
    return false;
}