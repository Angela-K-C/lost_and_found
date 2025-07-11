<?php
// Session and access control functions

function checkLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

function checkAdminAccess() {
    checkLogin();
    
    if (!isset($_SESSION['role_name']) || ($_SESSION['role_name'] !== 'Admin' && $_SESSION['role_name'] !== 'Super Admin')) {
        header("Location: dashboard.php");
        exit;
    }
}

function checkSuperAdminAccess() {
    checkLogin();
    
    if (!isset($_SESSION['role_name']) || $_SESSION['role_name'] !== 'Super Admin') {
        header("Location: dashboard.php");
        exit;
    }
}

function isAdmin() {
    return isset($_SESSION['role_name']) && ($_SESSION['role_name'] === 'Admin' || $_SESSION['role_name'] === 'Super Admin');
}

function isSuperAdmin() {
    return isset($_SESSION['role_name']) && $_SESSION['role_name'] === 'Super Admin';
}
?>
