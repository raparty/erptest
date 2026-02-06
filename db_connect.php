<?php
// Core connection parameters
$servername = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "erp_admin";
$password = getenv('DB_PASSWORD') ?: "SchoolERP@2026";
$dbname = getenv('DB_NAME') ?: "school_erp_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
