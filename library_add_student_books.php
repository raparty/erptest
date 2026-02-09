<?php
declare(strict_types=1);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$msg = "";

// Use the correct pluralized table name for students
$registration_no = $_REQUEST['registration_no'] ?? $_SESSION['registration_no'] ?? '';
if ($registration_no) {
    $_SESSION['registration_no'] = $registration_no;
    $reg_safe = mysqli_real_escape_string($conn, (string)$registration_no);
    $sql_std = "SELECT * FROM student_info WHERE registration_no='$reg_safe'";
    $res_std = mysqli_query($conn, $sql_std);
    $student = mysqli_fetch_assoc($res_std);
}

if (isset($_POST['submit'])) {
    $reg_no = mysqli_real_escape_string($conn, (string)$_POST['registration_no']);
    $book_no = mysqli_real_escape_string($conn, (string)$_POST['book_number']);
    $issue_dt = date('Y-m-d', strtotime((string)$_POST['issue_date']));
    $session = mysqli_real_escape_string($conn, (string)$_SESSION['session']);

    $sql_ins = "INSERT INTO student_books_details (registration_no, book_number, issue_date, booking_status, session) 
                VALUES ('$reg_no', '$book_no', '$issue_dt', '1', '$session')";
    
    if (mysqli_query($conn, $sql_ins)) {
        echo "<script>window.location.href='library_student_books_manager.php?msg=1';</script>";
        exit;
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Add Student Book Detail</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_content" style="padding: 25px;">
                        <?php if ($msg) echo $msg; ?>
                        
                        <form action="library_add_student_books.php" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">S.R. Number <span style="color:red;">*</span></label>
                                        <div class="form_input">
                                            <input name="registration_no" type="text" value="<?php echo htmlspecialchars((string)$registration_no); ?>" 
                                                   onBlur="window.location.href='library_add_student_books.php?registration_no='+this.value" 
                                                   placeholder="Enter Registration No." required style="width:250px;" />
                                        </div>
                                    </div>
                                </li>

                                <?php if (isset($student['name'])): ?>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Student Name</label>
                                        <div class="form_input">
                                            <input type="text" value="<?php echo htmlspecialchars($student['name']); ?>" readonly style="background:#eee; width:250px;" />
                                        </div>
                                    </div>
                                </li>
                                <?php endif; ?>

                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Book Number <span style="color:red;">*</span></label>
                                        <div class="form_input">
                                            <input name="book_number" type="text" required style="width:250px;" placeholder="e.g. BK-101" />
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Issue Date <span style="color:red;">*</span></label>
                                        <div class="form_input">
                                            <input name="issue_date" type="text" class="datepicker" value="<?php echo date('m/d/Y'); ?>" required />
                                        </div>
                                    </div>
                                </li>

                                <li style="margin-top:20px;">
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save</span></button>
                                        <a href="library_student_books_manager.php" class="btn_small btn_orange" style="margin-left:10px;"><span>Back</span></a>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
