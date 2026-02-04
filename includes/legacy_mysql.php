<?php

declare(strict_types=1);

if (!defined('MYSQL_ASSOC')) {
    define('MYSQL_ASSOC', 1);
}
if (!defined('MYSQL_NUM')) {
    define('MYSQL_NUM', 2);
}
if (!defined('MYSQL_BOTH')) {
    define('MYSQL_BOTH', 3);
}

final class LegacyMysql
{
    private static ?mysqli $connection = null;

    public static function init(array $config): void
    {
        if (self::$connection instanceof mysqli) {
            return;
        }

        $connection = mysqli_init();
        if ($connection === false) {
            throw new RuntimeException('Failed to initialize mysqli.');
        }

        $connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
        $connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);

        if (!@$connection->real_connect(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['name'],
            $config['port']
        )) {
            throw new RuntimeException('Database connection failed: ' . $connection->connect_error);
        }

        $charset = $config['charset'] ?? 'utf8mb4';
        if (!$connection->set_charset($charset)) {
            throw new RuntimeException('Failed to set charset: ' . $connection->error);
        }

        self::$connection = $connection;
    }

    public static function connection(): mysqli
    {
        if (!self::$connection instanceof mysqli) {
            throw new RuntimeException('Database connection has not been initialized.');
        }

        return self::$connection;
    }
}

if (!function_exists('mysql_connect')) {
    function mysql_connect(
        string $host = '',
        string $user = '',
        string $password = '',
        bool $newLink = false,
        int $clientFlags = 0
    ) {
        $config = [
            'host' => $host !== '' ? $host : '127.0.0.1',
            'user' => $user !== '' ? $user : 'root',
            'pass' => $password,
            'name' => '',
            'port' => 3306,
            'charset' => 'utf8mb4',
        ];

        LegacyMysql::init($config);

        return LegacyMysql::connection();
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db(string $databaseName, $linkIdentifier = null): bool
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->select_db($databaseName);
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query(string $query, $linkIdentifier = null)
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->query($query);
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result): int
    {
        return $result instanceof mysqli_result ? $result->num_rows : 0;
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($linkIdentifier = null): int
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->affected_rows;
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, int $resultType = MYSQL_BOTH)
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }

        $typeMap = [
            MYSQL_ASSOC => MYSQLI_ASSOC,
            MYSQL_NUM => MYSQLI_NUM,
            MYSQL_BOTH => MYSQLI_BOTH,
        ];

        $mode = $typeMap[$resultType] ?? MYSQLI_BOTH;

        return $result->fetch_array($mode);
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result)
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }

        return $result->fetch_row();
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result)
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }

        return $result->fetch_assoc();
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, int $rowNumber): bool
    {
        if (!$result instanceof mysqli_result) {
            return false;
        }

        return $result->data_seek($rowNumber);
    }
}

if (!function_exists('mysql_free_result')) {
    function mysql_free_result($result): bool
    {
        if (!$result instanceof mysqli_result) {
            return false;
        }

        $result->free();

        return true;
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string(string $unescapedString, $linkIdentifier = null): string
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->real_escape_string($unescapedString);
    }
}

if (!function_exists('mysql_errno')) {
    function mysql_errno($linkIdentifier = null): int
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->errno;
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($linkIdentifier = null): string
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->error;
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close($linkIdentifier = null): bool
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->close();
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($linkIdentifier = null): int
    {
        $connection = $linkIdentifier instanceof mysqli ? $linkIdentifier : LegacyMysql::connection();

        return $connection->insert_id;
    }
}
