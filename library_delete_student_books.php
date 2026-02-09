<?php
declare(strict_types=1);

// Using bootstrap to ensure the $conn object is available
require_once("includes/bootstrap.php");
ob_start();

$conn = Database::connection();
$sid = (int)($_GET['sid'] ?? 0);

if ($sid > 0) {
    // FIX: Using the verified plural table 'student_books_details'
    $sid_safe = mysqli_real_escape_string($conn, (string)$sid);
    $sql = "DELETE FROM student_books_details WHERE id = '$sid_safe'";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to manager with success message 2 (Deleted Successfully)
        header("Location: library_student_books_manager.php?msg=2");
        exit;
    } else {
        // Log error if delete fails for technical reasons
        error_log("Delete failed: " . mysqli_error($conn));
        die("Error deleting record. Please check logs.");
    }
} else {
    // Redirect if no valid ID is provided
    header("Location: library_student_books_manager.php");
    exit;
}
?>
