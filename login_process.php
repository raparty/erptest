<?php
declare(strict_types=1);

ob_start();

// 1. Load configuration and database first
require_once("includes/bootstrap.php");

// 2. Ensure session is started AFTER bootstrap to avoid header/ini warnings
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 3. Query using the correct column names found in your DESCRIBE users output
    $query = "SELECT id, user_id, password, role FROM users WHERE user_id = '" . db_escape($username) . "' LIMIT 1";
    $result = db_query($query);

    if (db_num_rows($result) > 0) {
        $row = db_fetch_assoc($result);

        // 4. Modern password verification for MySQL 8.4 hashes
        if (password_verify($password, $row['password'])) {
            // Success: Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];

            // 5. Redirect to the session selection page
            header('Location: session.php');
            exit;
        } else {
            // Invalid Password
            header('Location: index.php?errormsg=1');
            exit;
        }
    } else {
        // User not found
        header('Location: index.php?errormsg=1');
        exit;
    }
} else {
    // Direct access attempt
    header('Location: index.php?errormsg=2');
    exit;
}
