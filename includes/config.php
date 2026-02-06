<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'School ERP',
        'env' => getenv('APP_ENV') ?: 'production',
        'timezone' => getenv('APP_TIMEZONE') ?: 'UTC',
        'base_url' => rtrim(getenv('APP_BASE_URL') ?: '', '/'),
    ],
    'db' => [
        'host' => getenv('ERP_DB_HOST') ?: '127.0.0.1',
        'port' => (int) (getenv('ERP_DB_PORT') ?: 3306),
        'name' => getenv('ERP_DB_NAME') ?: 'school_erp_db',
        'user' => getenv('ERP_DB_USER') ?: 'erp_admin',
        'pass' => getenv('ERP_DB_PASS') ?: 'SchoolERP@2026',
        'charset' => 'utf8mb4',
    ],
    'session' => [
        'name' => getenv('ERP_SESSION_NAME') ?: 'school_erp_session',
        'lifetime' => (int) (getenv('ERP_SESSION_LIFETIME') ?: 0),
        'secure' => (bool) getenv('ERP_SESSION_SECURE'),
        'httponly' => true,
        'samesite' => getenv('ERP_SESSION_SAMESITE') ?: 'Lax',
    ],
];
