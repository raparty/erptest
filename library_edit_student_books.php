<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
$msg = "";
$sid = $_GET['sid'] ?? '';

// 1. HANDLE UPDATE SUBMISSION
if(isset($_POST['submit'])) {
    $reg_no = mysqli_real_escape_string($conn, trim((string)$_POST['registration_no']));
    $book_no = mysqli_real_escape_string($conn, trim((string)$_POST['book_number']));
    $issue_date = date('Y-m-d', strtotime((string)$_POST['issue_date']));
    $session = mysqli_real_escape_string($conn, (string)$_SESSION['session']);

    // Check if another record already has this book for this student
    $sql_check = "SELECT id FROM student_books_details WHERE registration_no='$reg_no' AND book_number='$book_no' AND booking_status='1' AND id != '$sid'";
    $res_check = mysqli_query($conn, $sql_check);
    
    if(mysqli_num_rows($res_check) == 0) {
        $sql_upd = "UPDATE student_books_details SET 
                    registration_no='$reg_no', 
                    book_number='$book_no', 
                    issue_date='$issue_date' 
                    WHERE id='$sid'";
                    
        if(mysqli_query($conn, $sql_upd)) {
            echo "<script>window.location.href='library_student_books_manager.php?msg=3';</script>";
            exit;
        }
    } else {
        $msg = "<div class='alert alert-danger'><h4>Error: This book is already issued to this student.</h4></div>";
    }
}

// 2. FETCH CURRENT ISSUE RECORD
$sql_issue = "SELECT * FROM student_books_details WHERE id = '" . mysqli_real_escape_string($conn, (string)$sid) . "'";
$res_issue = mysqli_query($conn, $sql_issue);
$row_detail = mysqli_fetch_assoc($res_issue);

if (!$row_detail) {
    die("Record not found.");
}

$registration_no = $row_detail['registration_no'];

// 3. FETCH STUDENT DATA FROM ADMISSIONS
$reg_safe = mysqli_real_escape_string($conn, (string)$registration_no);
$sql_std = "SELECT student_name, class_id FROM admissions WHERE reg_no = '$reg_safe'";
$res_std = mysqli_query($conn, $sql_std);
$student = mysqli_fetch_assoc($res_std);
?>

<?php include_once("includes/library_setting_sidebar.php"); ?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <h3 style="padding:20px 0 0 20px; color:#0078D4">Edit Student Book Issue</h3>
                    <?php if($msg != "") echo $msg; ?>
                    
                    <form action="" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Registration No.</label>
                                    <div class="form_input">
                                        <input name="registration_no" type="text" value="<?php echo htmlspecialchars((string)$registration_no); ?>" readonly style="background:#f0f0f0;" />
                                        <span class="label_intro">Student ID cannot be changed here.</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Student Name</label>
                                    <div class="form_input">
                                        <input type="text" readonly value="<?php echo htmlspecialchars((string)($student['student_name'] ?? 'Not Found')); ?>" style="background:#f9f9f9; width:300px;"/>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Book Number</label>
                                    <div class="form_input">
                                        <input name="book_number" type="text" required value="<?php echo htmlspecialchars((string)$row_detail['book_number']); ?>" style="width:300px;" />
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Issue Date</label>
                                    <div class="form_input">
                                        <input name="issue_date" type="text" class="datepicker" value="<?php echo date('d-m-Y', strtotime((string)$row_detail['issue_date'])); ?>" required style="width:300px;" />
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_input">
                                    <button type="submit" name="submit" class="btn_small btn_blue"><span>Update Record</span></button>
                                    <a href="library_student_books_manager.php" class="btn_small btn_orange"><span>Back</span></a>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
