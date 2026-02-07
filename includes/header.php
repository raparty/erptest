<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';

// Authentication Guard
$currentScript = basename($_SERVER['SCRIPT_NAME']);
$publicPages = ['index.php', 'login_process.php', 'logout.php'];
if (!in_array($currentScript, $publicPages, true)) {
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
}

$appName = app_config('name', 'School ERP');
$mysqlServerInfo = 'N/A';
try {
    $mysqlServerInfo = Database::connection()->server_info;
} catch (RuntimeException $e) { }
$mysqlServerInfoSafe = htmlspecialchars($mysqlServerInfo, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($appName); ?> | Enterprise Admin</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/enterprise.css">
    <link rel="stylesheet" href="assets/css/legacy-bridge.css">

    <style>
        :root { --sidebar-w: 260px; --bg-page: #f8fafc; }
        .app-shell { display: flex !important; min-height: 100vh; width: 100%; align-items: stretch; }
        #sidebar { width: var(--sidebar-w); flex-shrink: 0; background: #fff; border-right: 1px solid #e2e8f0; }
        #container { flex: 1; padding: 30px; background: var(--bg-page); }
    </style>
</head>
<body class="app-body">
    <header class="app-header shadow-sm" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 10px 30px; display: flex; justify-content: space-between; align-items: center; height: 75px;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="background: #1c75bc; color: #fff; padding: 6px 14px; border-radius: 8px; font-weight: 800; font-size: 18px;">ERP</div>
            <div>
                <div style="font-weight: 700; font-size: 16px;"><?php echo htmlspecialchars($appName); ?></div>
                <div style="font-size: 10px; color: #64748b; text-transform: uppercase;">Enterprise School Management</div>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <span style="font-size: 13px;">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Sign Out</a>
        </div>
    </header>
    <div class="app-shell">
