<?php
declare(strict_types=1);

// Enable error reporting to diagnose any hidden database connectivity issues
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Use your standard bootstrap file to establish the database connection
require_once("includes/bootstrap.php");

$conn = Database::connection();
$sid = isset($_GET['sid']) ? (int)$_GET['sid'] : 0;

if ($sid > 0) {
    // Updated to pluralized table name 'book_managers' to match your recent database changes
    $sid_escaped = mysqli_real_escape_string($conn, (string)$sid);
    $delete_query = "DELETE FROM book_managers WHERE book_id = '$sid_escaped'";
    
    if (mysqli_query($conn, $delete_query)) {
        // Use JavaScript redirect to avoid blank pages or 500 errors caused by header conflicts
        echo "<script>window.location.href='library_book_manager.php?msg=2';</script>";
        exit;
    } else {
        // Output the specific error if the query fails
        die("Deletion Failed: " . mysqli_error($conn));
    }
} else {
    // If no valid ID is provided, redirect back to the manager list
    echo "<script>window.location.href='library_book_manager.php';</script>";
    exit;
}
?>
