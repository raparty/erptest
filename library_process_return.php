<?php
declare(strict_types=1);

// 1. Initialize core logic and database connection
require_once("includes/bootstrap.php");
$conn = Database::connection();

// 2. Get the specific issue ID from the URL
$issue_id = (int)($_GET['id'] ?? 0);

if ($issue_id > 0) {
    // 3. Update the confirmed plural table 'student_books_details'
    // Set booking_status to '0' (Returned) and set return_date to today
    $today = date('Y-m-d');
    $sql = "UPDATE student_books_details 
            SET booking_status = '0', 
                return_date = '$today' 
            WHERE id = '$issue_id'";

    if (mysqli_query($conn, $sql)) {
        // Success: Redirect back to the return entry page with a success message
        header("Location: library_entry_student_return_books.php?msg=1");
        exit;
    } else {
        // Log error if update fails
        error_log("Return failed for ID $issue_id: " . mysqli_error($conn));
        die("Error processing return. Please contact admin.");
    }
} else {
    // Redirect if no valid ID is provided
    header("Location: library_entry_student_return_books.php");
    exit;
}
?>
