<?php
declare(strict_types=1);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$msg = "";

if (isset($_POST['submit'])) {
    $input_reg = mysqli_real_escape_string($conn, trim((string)$_POST['registration_no']));
    $book_no = mysqli_real_escape_string($conn, trim((string)$_POST['book_number']));
    $session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));

    // STEP 1: VERIFY STUDENT_NAME IN DB BEFORE INSERTING
    $sql_check = "SELECT student_name FROM admissions WHERE reg_no = '$input_reg'";
    $res_check = mysqli_query($conn, $sql_check);

    if ($res_check && mysqli_num_rows($res_check) > 0) {
        $student = mysqli_fetch_assoc($res_check);
        $s_name = $student['student_name'];
        $issue_date = date('Y-m-d');

        // STEP 2: PROCEED ONLY IF STUDENT EXISTS
        $sql_ins = "INSERT INTO student_books_details (registration_no, book_number, issue_date, booking_status, session) 
                    VALUES ('$input_reg', '$book_no', '$issue_date', '1', '$session')";
        
        if (mysqli_query($conn, $sql_ins)) {
            echo "<script>alert('Verified: Book issued to $s_name'); window.location.href='library_student_books_manager.php?msg=1';</script>";
            exit;
        }
    } else {
        // STEP 3: BLOCK IF NAME LINK IS MISSING
        $msg = "<div class='alert alert-danger' style='background:#fee; color:#b00; padding:15px; border:1px solid #fcc; margin-bottom:15px;'>
                    <strong>Database Check Failed:</strong> The S.R. Number <strong>$input_reg</strong> was not found in the Admissions database. 
                    Please verify the student record first.
                </div>";
    }
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Issue Book (Verification Active)</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_content" style="padding: 25px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_entry_add_student_books.php" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">S.R. Number <span style="color:red;">*</span></label>
                                        <div class="form_input">
                                            <div style="display: flex; gap: 15px; align-items: center;">
                                                <input name="registration_no" type="text" placeholder="ADM-2026-002" required style="width:250px;" />
                                                <span style="font-weight:bold;">OR</span>
                                                <a href="library_student_searchby_name.php" class="btn_small btn_orange">
                                                    <span>Search by Name</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Book Number <span style="color:red;">*</span></label>
                                        <div class="form_input">
                                            <input name="book_number" type="text" placeholder="Enter Book Number" required style="width:250px;" />
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 25px; border-top: 1px solid #eee; padding-top: 20px;">
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Verify & Save</span></button>
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
