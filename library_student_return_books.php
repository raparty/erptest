<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
// Support both 'registration_no' and 'reg_no' from URL
$reg_no = mysqli_real_escape_string($conn, trim((string)($_GET['registration_no'] ?? $_GET['reg_no'] ?? '')));

// 1. Fetch Student Details from Admissions
$student_name = "Unknown Student";
if ($reg_no) {
    $sql_std = "SELECT student_name FROM admissions WHERE reg_no = '$reg_no'";
    $res_std = mysqli_query($conn, $sql_std);
    if ($row_std = mysqli_fetch_assoc($res_std)) {
        $student_name = $row_std['student_name'];
    }
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:15px 0 0 20px; color:#0078D4">Student Return Books Detail</h3>
            
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Currently Issued Books for: <?php echo htmlspecialchars($student_name); ?> (<?php echo htmlspecialchars($reg_no); ?>)</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Student Name</th>
                                    <th>Book Name</th>
                                    <th>Book Number</th>
                                    <th>Issue Date</th>
                                    <th>Session</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // 2. Querying confirmed plural table
                                $sql = "SELECT * FROM student_books_details 
                                        WHERE registration_no = '$reg_no' 
                                        AND booking_status = '1'";
                                
                                $res = mysqli_query($conn, $sql);

                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i++; ?></td>
                                    <td class="center"><?php echo htmlspecialchars($student_name); ?></td>
                                    <td class="center">
                                        <?php 
                                        // Fetch book name from book_managers
                                        $bn = mysqli_query($conn, "SELECT book_name FROM book_managers WHERE book_number='".$row['book_number']."'");
                                        $b_data = mysqli_fetch_assoc($bn);
                                        echo htmlspecialchars($b_data['book_name'] ?? 'N/A');
                                        ?>
                                    </td>
                                    <td class="center"><?php echo htmlspecialchars($row['book_number']); ?></td>
                                    <td class="center"><?php echo date('d-m-Y', strtotime($row['issue_date'])); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($row['session']); ?></td>
                                    <td class="center">
                                        <a href="library_process_return.php?id=<?php echo $row['id']; ?>" class="btn_small btn_blue" onclick="return confirm('Confirm book return?')">
                                            <span>Return</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="7" class="center" style="padding:20px; color:red;">
                                            No issued books found for this student.
                                        </td>
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
