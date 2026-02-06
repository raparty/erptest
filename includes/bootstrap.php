<?php

declare(strict_types=1);

// Enforce modern PHP environment
if (version_compare(PHP_VERSION, '8.3.0', '<')) {
    throw new RuntimeException('School ERP requires PHP 8.3 or newer.');
}

$config = require __DIR__ . '/config.php';

// Set secure response headers
if (!headers_sent()) {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}

date_default_timezone_set($config['app']['timezone']);

// Configure secure session handling
ini_set('session.cookie_httponly', $config['session']['httponly'] ? '1' : '0');
ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', $config['session']['samesite']);
ini_set('session.gc_maxlifetime', (string) $config['session']['lifetime']);
if ($config['session']['secure']) {
    ini_set('session.cookie_secure', '1');
}

session_name($config['session']['name']);
session_set_cookie_params([
    'lifetime' => $config['session']['lifetime'],
    'path' => '/',
    'secure' => $config['session']['secure'],
    'httponly' => $config['session']['httponly'],
    'samesite' => $config['session']['samesite'],
]);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Load and initialize database
require_once __DIR__ . '/database.php';
try {
    Database::init($config['db']);
} catch (RuntimeException $e) {
    // Store generic error flag in session (detailed error logged server-side)
    $_SESSION['db_error'] = true;
    // Log the detailed error for debugging (don't expose to users)
    error_log('Database connection failed: ' . $e->getMessage());
    // Don't crash the application - let pages handle missing database gracefully
}

/**
 * Access application configuration values
 */
function app_config(string $key, mixed $default = null): mixed
{
    static $configCache = null;

    if ($configCache === null) {
        $configCache = require __DIR__ . '/config.php';
    }

    return $configCache['app'][$key] ?? $default;
}
