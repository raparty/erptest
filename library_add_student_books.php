<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
$msg = "";

// Handle Form Submission
if(isset($_POST['submit'])) {
    $reg_no = mysqli_real_escape_string($conn, trim((string)$_POST['registration_no']));
    $book_no = mysqli_real_escape_string($conn, trim((string)$_POST['book_number']));
    $issue_date = date('Y-m-d', strtotime((string)$_POST['issue_date']));
    $session = mysqli_real_escape_string($conn, (string)$_SESSION['session']);

    // Check if this book is already issued to this student
    $sql_check = "SELECT id FROM student_books_details WHERE registration_no='$reg_no' AND book_number='$book_no' AND booking_status='1'";
    $res_check = mysqli_query($conn, $sql_check);
    
    if(mysqli_num_rows($res_check) == 0) {
        $sql_ins = "INSERT INTO student_books_details (registration_no, book_number, issue_date, booking_status, session) 
                    VALUES ('$reg_no', '$book_no', '$issue_date', '1', '$session')";
        if(mysqli_query($conn, $sql_ins)) {
            echo "<script>window.location.href='library_student_books_manager.php?msg=1';</script>";
            exit;
        }
    } else {
        $msg = "<span style='color:#FF0000;'><h4>This book is already issued to this student.</h4></span>";
    }
}

// Logic to get the registration number from GET or POST
$registration_no = $_REQUEST['registration_no'] ?? ($_SESSION['registration_no'] ?? '');
if ($registration_no) {
    $_SESSION['registration_no'] = $registration_no;
}

// Fetch Student Data from the CORRECT 'admissions' table
$student = null;
if ($registration_no) {
    $reg_safe = mysqli_real_escape_string($conn, $registration_no);
    $sql_std = "SELECT student_name, class_id FROM admissions WHERE reg_no = '$reg_safe'";
    $res_std = mysqli_query($conn, $sql_std);
    $student = mysqli_fetch_assoc($res_std);
}
?>

<?php include_once("includes/library_setting_sidebar.php");?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <h3 style="padding:20px 0 0 20px; color:#0078D4">Add Student Books</h3>
                    <?php if($msg != "") echo $msg; ?>
                    
                    <form action="" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Registration No.</label>
                                    <div class="form_input">
                                        <input name="registration_no" type="text" value="<?php echo htmlspecialchars((string)$registration_no); ?>" 
                                               onBlur="window.location.href='?registration_no='+this.value" required />
                                        <span class="label_intro">Press Tab to load student details</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Student Name</label>
                                    <div class="form_input">
                                        <input type="text" readonly value="<?php echo htmlspecialchars((string)($student['student_name'] ?? 'Not Found')); ?>" style="background:#f9f9f9;"/>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Book Number</label>
                                    <div class="form_input">
                                        <input name="book_number" type="text" required placeholder="e.g. LIB-101" />
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Issue Date</label>
                                    <div class="form_input">
                                        <input name="issue_date" type="text" class="datepicker" value="<?php echo date('d-m-Y'); ?>" required />
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="form_input">
                                    <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Issue</span></button>
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
<?php include_once("includes/footer.php");?>
