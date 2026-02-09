<?php
declare(strict_types=1);

// Enable error reporting to catch any hidden issues
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Use your standard bootstrap instead of the missing config file
require_once("includes/bootstrap.php");

$conn = Database::connection();
$sid = isset($_GET['sid']) ? mysqli_real_escape_string($conn, (string)$_GET['sid']) : '';

if (!empty($sid)) {
    // Updated to pluralized table 'library_categories' and correct column 'category_id'
    $delete_query = "DELETE FROM library_categories WHERE category_id = '$sid'";
    
    if (mysqli_query($conn, $delete_query)) {
        // Using JS redirect to prevent blank pages or 500 errors during header shifts
        echo "<script>window.location.href='library_book_category.php?msg=2';</script>";
        exit;
    } else {
        die("Deletion Failed: " . mysqli_error($conn));
    }
} else {
    // If no SID is provided, just go back to the list
    echo "<script>window.location.href='library_book_category.php';</script>";
    exit;
}
?>
