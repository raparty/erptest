<?php

declare(strict_types=1);

/**
 * Database class for mysqli operations
 * Provides a clean interface for database operations using mysqli
 */
final class Database
{
    private static ?mysqli $connection = null;

    /**
     * Initialize the database connection
     * 
     * @param array $config Database configuration
     * @throws RuntimeException If connection fails
     */
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

        // Verify MySQL version
        $serverInfo = $connection->server_info;
        if (stripos($serverInfo, 'mariadb') === false) {
            if (preg_match('/\d+(?:\.\d+){1,2}/', $serverInfo, $matches)) {
                $serverVersion = $matches[0];
                if (version_compare($serverVersion, '8.4.0', '<')) {
                    throw new RuntimeException('MySQL 8.4 or newer is required. Detected: ' . $serverVersion);
                }
            }
        }

        self::$connection = $connection;
    }

    /**
     * Get the mysqli connection instance
     * 
     * @return mysqli
     * @throws RuntimeException If connection not initialized
     */
    public static function connection(): mysqli
    {
        if (!self::$connection instanceof mysqli) {
            throw new RuntimeException('Database connection has not been initialized.');
        }

        return self::$connection;
    }

    /**
     * Execute a query and return the result
     * 
     * @param string $query SQL query
     * @return mysqli_result|bool
     */
    public static function query(string $query): mysqli_result|bool
    {
        return self::connection()->query($query);
    }

    /**
     * Escape a string for safe use in SQL queries
     * 
     * @param string $value Value to escape
     * @return string Escaped value
     */
    public static function escape(string $value): string
    {
        return self::connection()->real_escape_string($value);
    }

    /**
     * Get the number of rows in a result set
     * 
     * @param mysqli_result|bool $result Result from query
     * @return int Number of rows
     */
    public static function num_rows(mysqli_result|bool $result): int
    {
        return $result instanceof mysqli_result ? $result->num_rows : 0;
    }

    /**
     * Fetch a result row as an associative array, numeric array, or both
     * 
     * @param mysqli_result|bool $result Result from query
     * @param int $mode Fetch mode (MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH)
     * @return array|null
     */
    public static function fetch_array(mysqli_result|bool $result, int $mode = MYSQLI_BOTH): ?array
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }
        return $result->fetch_array($mode);
    }

    /**
     * Fetch a result row as an associative array
     * 
     * @param mysqli_result|bool $result Result from query
     * @return array|null
     */
    public static function fetch_assoc(mysqli_result|bool $result): ?array
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }
        return $result->fetch_assoc();
    }

    /**
     * Fetch a result row as a numeric array
     * 
     * @param mysqli_result|bool $result Result from query
     * @return array|null
     */
    public static function fetch_row(mysqli_result|bool $result): ?array
    {
        if (!$result instanceof mysqli_result) {
            return null;
        }
        return $result->fetch_row();
    }

    /**
     * Get the last error message
     * 
     * @return string Error message
     */
    public static function error(): string
    {
        return self::connection()->error;
    }

    /**
     * Get the last error number
     * 
     * @return int Error number
     */
    public static function errno(): int
    {
        return self::connection()->errno;
    }

    /**
     * Get the number of affected rows from the last query
     * 
     * @return int Number of affected rows
     */
    public static function affected_rows(): int
    {
        return self::connection()->affected_rows;
    }

    /**
     * Get the ID generated from the last INSERT query
     * 
     * @return int Insert ID
     */
    public static function insert_id(): int
    {
        return self::connection()->insert_id;
    }

    /**
     * Free result memory
     * 
     * @param mysqli_result|bool $result Result to free
     * @return bool Success
     */
    public static function free_result(mysqli_result|bool $result): bool
    {
        if ($result instanceof mysqli_result) {
            $result->free();
            return true;
        }
        return false;
    }

    /**
     * Close the database connection
     * 
     * @return bool Success
     */
    public static function close(): bool
    {
        if (self::$connection instanceof mysqli) {
            return self::$connection->close();
        }
        return false;
    }
}

// Helper functions for easier migration
function db_query(string $query): mysqli_result|bool
{
    return Database::query($query);
}

function db_escape(string $value): string
{
    return Database::escape($value);
}

function db_num_rows(mysqli_result|bool $result): int
{
    return Database::num_rows($result);
}

function db_fetch_array(mysqli_result|bool $result, int $mode = MYSQLI_BOTH): ?array
{
    return Database::fetch_array($result, $mode);
}

function db_fetch_assoc(mysqli_result|bool $result): ?array
{
    return Database::fetch_assoc($result);
}

function db_fetch_row(mysqli_result|bool $result): ?array
{
    return Database::fetch_row($result);
}

function db_error(): string
{
    return Database::error();
}

function db_errno(): int
{
    return Database::errno();
}

function db_affected_rows(): int
{
    return Database::affected_rows();
}

function db_insert_id(): int
{
    return Database::insert_id();
}

function db_free_result(mysqli_result|bool $result): bool
{
    return Database::free_result($result);
}

function db_connection(): mysqli
{
    return Database::connection();
}
