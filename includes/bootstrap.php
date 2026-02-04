<?php

declare(strict_types=1);

$config = require __DIR__ . '/config.php';

if (!headers_sent()) {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}

date_default_timezone_set($config['app']['timezone']);

ini_set('session.cookie_httponly', $config['session']['httponly'] ? '1' : '0');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_samesite', $config['session']['samesite']);
if ($config['session']['secure']) {
    ini_set('session.cookie_secure', '1');
}

session_name($config['session']['name']);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/legacy_mysql.php';
LegacyMysql::init($config['db']);

function app_config(string $key, mixed $default = null): mixed
{
    static $configCache = null;

    if ($configCache === null) {
        $configCache = require __DIR__ . '/config.php';
    }

    return $configCache['app'][$key] ?? $default;
}
