<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$appName = app_config('name', 'School ERP');
$error = $_GET['errormsg'] ?? '';
$message = '';
if ($error === '1') {
    $message = 'Invalid username or password.';
} elseif ($error === '2') {
    $message = 'Your account was not found.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?> | Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/enterprise.css">
    <style>
        body.app-body {
            display: grid;
            place-items: center;
            min-height: 100vh;
        }
        .login-card {
            width: min(420px, 92vw);
            background: var(--app-surface);
            border-radius: var(--app-radius);
            box-shadow: var(--app-shadow);
            padding: 32px;
        }
    </style>
</head>
<body class="app-body">
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="app-logo mx-auto mb-3">ERP</div>
            <h1 class="h4 mb-1">Welcome back</h1>
            <p class="text-muted">Sign in to <?php echo htmlspecialchars($appName, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <?php if ($message !== ''): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="login_process.php" class="d-grid gap-3">
            <div>
                <label class="form-label" for="username">Username</label>
                <input class="form-control" id="username" name="username" type="text" required>
            </div>
            <div>
                <label class="form-label" for="password">Password</label>
                <input class="form-control" id="password" name="password" type="password" required>
            </div>
            <button class="btn btn-primary btn-lg" type="submit" name="login">Sign In</button>
        </form>
        <div class="text-center text-muted mt-4">Secure enterprise access portal</div>
    </div>
</body>
</html>
