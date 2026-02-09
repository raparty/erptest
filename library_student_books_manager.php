<?php
declare(strict_types=1);
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
                        <h6>Issued Student Books Detail</h6>
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
                                    <th>Reg. No.</th>
                                    <th>Book Name</th>
                                    <th>Book No.</th>
                                    <th>Issue Date</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));
                                
                                // Query confirming pluralized table 'student_books_details'
                                $sql = "SELECT * FROM student_books_details WHERE session = '$session' AND booking_status = '1' ORDER BY id DESC";
                                $res = mysqli_query($conn, $sql);
                                
                                while($row = mysqli_fetch_assoc($res)) {
                                    $reg_no = mysqli_real_escape_string($conn, trim((string)$row['registration_no']));

                                    // FIX: Look up student_name from admissions table using reg_no
                                    $sql_std = "SELECT student_name FROM admissions WHERE reg_no = '$reg_no'";
                                    $res_std = mysqli_query($conn, $sql_std);
                                    $student = mysqli_fetch_assoc($res_std);
                                    
                                    // Look up book details from book_managers
                                    $book_num = mysqli_real_escape_string($conn, trim((string)$row['book_number']));
                                    $sql_bk = "SELECT book_name FROM book_managers WHERE book_number = '$book_num'";
                                    $res_bk = mysqli_query($conn, $sql_bk);
                                    $book = mysqli_fetch_assoc($res_bk);
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center">
                                        <strong><?php echo htmlspecialchars((string)($student['student_name'] ?? 'Not Found')); ?></strong>
                                    </td>
                                    <td class="center"><code><?php echo htmlspecialchars($reg_no); ?></code></td>
                                    <td class="center"><?php echo htmlspecialchars((string)($book['book_name'] ?? 'N/A')); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($book_num); ?></td>
                                    <td class="center"><?php echo date('d-m-Y', strtotime((string)$row['issue_date'])); ?></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="library_edit_student_books.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="library_delete_student_books.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete?')">Delete</a></span>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
