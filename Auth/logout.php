<?php
session_start();

// Log the logout action if user is logged in
if (isset($_SESSION['user_id'])) {
    require_once '../Database/db.php';
    
    $log_sql = "INSERT INTO audit_log (user_id, action, details, ip_address) VALUES (?, 'logout', 'User logged out successfully', ?)";
    $log_stmt = $conn->prepare($log_sql);
    $ip = $_SERVER['REMOTE_ADDR'];
    $log_stmt->bind_param("is", $_SESSION['user_id'], $ip);
    $log_stmt->execute();
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: index.php');
exit();
?> 