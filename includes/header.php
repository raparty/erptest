<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

// Check if user is authenticated (exclude login and logout pages)
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
} catch (RuntimeException $e) {
    // Database not connected
}
$mysqlServerInfoSafe = htmlspecialchars($mysqlServerInfo, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/enterprise.css">
    <link rel="stylesheet" href="assets/css/legacy-bridge.css">
</head>
<body class="app-body">
    <header class="app-header shadow-sm">
        <div class="container-fluid d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center gap-3">
                <div class="app-logo">ERP</div>
                <div>
                    <div class="app-title"><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-subtitle">Enterprise School Management</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <form class="app-search" method="get" action="searchby_name.php">
                    <input class="form-control" type="search" name="q" placeholder="Search modules" aria-label="Search modules">
                </form>
                <div class="app-user">
                    <span class="badge bg-primary">Active</span>
                    <span class="ms-2">Welcome<?php echo isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') : ''; ?></span>
                </div>
                <a href="change_password.php" class="btn btn-outline-secondary btn-sm" title="Change Password">
                    <span>Change Password</span>
                </a>
                <a href="logout.php" class="btn btn-outline-danger btn-sm" title="Logout">
                    <span>Logout</span>
                </a>
                <span class="runtime-badge" data-runtime-badge="true" data-php-version="<?php echo PHP_VERSION; ?>" data-mysql-version="<?php echo $mysqlServerInfoSafe; ?>">
                    PHP <?php echo PHP_VERSION; ?> · MySQL <?php echo $mysqlServerInfoSafe; ?>
                </span>
            </div>
        </div>
    </header>
    <div class="app-shell">
