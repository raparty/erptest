<?php
declare(strict_types=1);

// Enable error reporting for debugging pluralization issues
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            
            <?php include_once("includes/library_setting_sidebar.php"); ?>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Issued Student Books</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="library_entry_add_student_books.php" class="btn_small btn_blue">
                                <span>+ Issue New Book</span>
                            </a>
                        </div>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">S.No.</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Book Name</th>
                                    <th>Book No.</th>
                                    <th>Issue Date</th>
                                    <th>Session</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $current_session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));
                                
                                // Updated to check pluralized student_books_details table
                                $sql = "SELECT * FROM student_books_details WHERE session = '$current_session' AND booking_status = '1'";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        // Fetch Student Info
                                        $reg_no = mysqli_real_escape_string($conn, (string)$row['registration_no']);
                                        $sql_std = "SELECT name, class FROM student_info WHERE registration_no = '$reg_no'";
                                        $res_std = mysqli_query($conn, $sql_std);
                                        $student_info = mysqli_fetch_assoc($res_std);
                                        
                                        // Fetch Class Info
                                        $class_id = (string)($student_info['class'] ?? '');
                                        $sql_cls = "SELECT class_name FROM classes WHERE class_id = '$class_id'";
                                        $res_cls = mysqli_query($conn, $sql_cls);
                                        $class_info = mysqli_fetch_assoc($res_cls);

                                        // Fetch Book Details from pluralized book_managers
                                        $book_num = mysqli_real_escape_string($conn, (string)$row['book_number']);
                                        $sql_bk = "SELECT book_name FROM book_managers WHERE book_number = '$book_num'";
                                        $res_bk = mysqli_query($conn, $sql_bk);
                                        $book_detail = mysqli_fetch_assoc($res_bk);
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars((string)($student_info['name'] ?? 'N/A')); ?></strong></td>
                                    <td class="center"><?php echo htmlspecialchars((string)($class_info['class_name'] ?? 'N/A')); ?></td>
                                    <td class="center"><?php echo htmlspecialchars((string)($book_detail['book_name'] ?? 'N/A')); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($book_num); ?></td>
                                    <td class="center"><?php echo !empty($row['issue_date']) ? date('d-m-Y', strtotime((string)$row['issue_date'])) : ''; ?></td>
                                    <td class="center"><?php echo htmlspecialchars((string)$row['session']); ?></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="library_edit_student_books.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="library_delete_student_books.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Confirm Delete?')">Delete</a></span>
                                    </td>
                                </tr>
                                <?php $i++; } 
                                } else { ?>
                                    <tr>
                                        <td colspan="8" class="center" style="padding: 40px; color: #999;">No issued book records found.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
