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
    $_SESSION['db_error'] = true;
    error_log('Database connection failed: ' . $e->getMessage());
}

// Load RBAC (Role-Based Access Control) system
require_once __DIR__ . '/rbac.php';

// =========================================================================
// MASTER COMPATIBILITY LAYER
// This translates legacy GitHub code functions to modern mysqli.
// =========================================================================

if (!function_exists('db_query')) {
    /**
     * Replaces legacy db_query() calls
     */
    function db_query(string $sql): mixed {
        try {
            return mysqli_query(Database::connection(), $sql);
        } catch (Exception $e) {
            error_log("SQL Error in db_query: " . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('db_fetch_array')) {
    /**
     * Replaces legacy db_fetch_array() calls
     */
    function db_fetch_array($result): ?array {
        if (!$result) return null;
        return mysqli_fetch_array($result);
    }
}

if (!function_exists('db_num_rows')) {
    /**
     * Replaces legacy db_num_rows() calls
     */
    function db_num_rows($result): int {
        if (!$result) return 0;
        return mysqli_num_rows($result);
    }
}

if (!function_exists('db_error')) {
    /**
     * Replaces legacy db_error() calls
     */
    function db_error(): string {
        return mysqli_error(Database::connection());
    }
}

// =========================================================================

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
