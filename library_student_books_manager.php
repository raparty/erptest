<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
require_once("includes/pagination_helper.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();

// Pagination settings
$items_per_page = 20;
$current_page = (int)($_GET['page'] ?? 1);
$current_page = max(1, $current_page);
$offset = ($current_page - 1) * $items_per_page;

// Get total count
$session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));
$count_sql = "SELECT COUNT(*) as total FROM student_books_details WHERE session = '$session' AND booking_status = '1'";
$count_res = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_res);
$total_items = (int)$count_row['total'];
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            <?php include_once("includes/library_setting_sidebar.php"); ?>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Currently Issued Student Books</h6>
                        <div class="float-end" style=" padding: 5px;">
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
                                // Query with pagination
                                $sql = "SELECT * FROM student_books_details WHERE session = '$session' AND booking_status = '1' ORDER BY id DESC LIMIT $offset, $items_per_page";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    $i = $offset + 1;
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $reg_no = mysqli_real_escape_string($conn, trim((string)$row['registration_no']));

                                        // FIX: Cross-reference student_name from verified 'admissions' table
                                        $sql_std = "SELECT student_name FROM admissions WHERE reg_no = '$reg_no'";
                                        $res_std = mysqli_query($conn, $sql_std);
                                        $student = mysqli_fetch_assoc($res_std);
                                        
                                        // FIX: Look up book details from 'book_managers' catalog
                                        $book_num = mysqli_real_escape_string($conn, trim((string)$row['book_number']));
                                        $sql_bk = "SELECT book_name FROM book_managers WHERE book_number = '$book_num'";
                                        $res_bk = mysqli_query($conn, $sql_bk);
                                        $book = mysqli_fetch_assoc($res_bk);
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center">
                                        <strong><?php echo htmlspecialchars((string)($student['student_name'] ?? 'Record Missing')); ?></strong>
                                    </td>
                                    <td class="center"><code><?php echo htmlspecialchars($reg_no); ?></code></td>
                                    <td class="center" style="color:#1c75bc;"><?php echo htmlspecialchars((string)($book['book_name'] ?? 'N/A')); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($book_num); ?></td>
                                    <td class="center"><?php echo date('d-M-Y', strtotime((string)$row['issue_date'])); ?></td>
                                    <td class="center">
                                        <div style="display: flex; gap: 5px; justify-content: center;">
                                            <a class="action-icons c-edit" href="library_edit_student_books.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a>
                                            <a class="action-icons c-delete" href="library_delete_student_books.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Delete this issue record?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; } 
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="center" style="padding: 40px; color: #999;">No books currently issued.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                        <?php 
                        // Display pagination
                        echo generate_pagination($current_page, $total_items, $items_per_page, 'library_student_books_manager.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
