<?php
// Authentication middleware for admin pages
session_start();

function requireAdminAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
}

function requireAdminRole($requiredRole = 'admin') {
    requireAdminAuth();
    
    if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] !== $requiredRole) {
        http_response_code(403);
        echo "Acces interzis. Nu ai permisiunile necesare pentru această acțiune.";
        exit;
    }
}

function getCurrentAdminUser() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return [
            'id' => $_SESSION['admin_user_id'] ?? null,
            'username' => $_SESSION['admin_username'] ?? null,
            'full_name' => $_SESSION['admin_full_name'] ?? null,
            'role' => $_SESSION['admin_role'] ?? null
        ];
    }
    return null;
}

function adminLogout() {
    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    header('Location: login.php');
    exit;
}