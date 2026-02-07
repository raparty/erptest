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
        /* Microsoft Fluent UI Color Palette */
        :root { 
            --fluent-slate: #605E5C;
            --fluent-slate-light: #8A8886;
            --fluent-slate-lighter: #F3F2F1;
            --fluent-azure: #0078D4;
            --fluent-azure-dark: #106EBE;
            --fluent-azure-darker: #005A9E;
            --fluent-white: #FFFFFF;
            --fluent-white-soft: #FAF9F8;
            --fluent-white-softer: #F3F2F1;
            --sidebar-w: 260px; 
            --bg-page: var(--fluent-white-soft);
        }
        
        /* Robust Flexbox Shell */
        body { margin: 0; padding: 0; min-height: 100vh; display: flex; flex-direction: column; }
        .app-shell { display: flex !important; flex: 1; width: 100%; align-items: stretch; }
        #sidebar { width: var(--sidebar-w); flex-shrink: 0; background: var(--fluent-white); border-right: 1px solid var(--fluent-slate-lighter); }
        #container { flex: 1; padding: 30px; background: var(--bg-page); min-width: 0; }
        
        /* Responsive Flexbox */
        @media (max-width: 768px) {
            .app-shell { flex-direction: column; }
            #sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--fluent-slate-lighter); }
        }
    </style>
</head>
<body class="app-body">
    <header class="app-header shadow-sm" style="background: var(--fluent-white); border-bottom: 1px solid var(--fluent-slate-lighter); padding: 10px 30px; display: flex; justify-content: space-between; align-items: center; height: 75px; flex-shrink: 0;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="background: var(--fluent-azure); color: var(--fluent-white); padding: 6px 14px; border-radius: 4px; font-weight: 600; font-size: 18px; box-shadow: var(--app-shadow);">ERP</div>
            <div>
                <div style="font-weight: 600; font-size: 16px; color: var(--fluent-slate);"><?php echo htmlspecialchars($appName); ?></div>
                <div style="font-size: 13px; color: var(--fluent-slate-light); text-transform: uppercase; letter-spacing: 0.5px;">Enterprise School Management</div>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <span style="font-size: 13px; color: var(--fluent-slate);">Welcome, <strong style="color: var(--fluent-azure);"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong></span>
            <a href="logout.php" class="btn btn-sm btn-fluent-primary">Sign Out</a>
        </div>
    </header>
    <div class="app-shell">
