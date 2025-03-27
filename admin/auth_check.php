<?php
session_start();

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?> 