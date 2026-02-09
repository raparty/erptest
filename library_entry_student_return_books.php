<?php
// 1. FORCE ERROR VISIBILITY
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");

// 2. USE MODERN MYSQLI
$conn = Database::connection();
$msg = "";
$redirect_js = "";

if (isset($_POST['submit_verify'])) {
    $search = mysqli_real_escape_string($conn, trim((string)$_POST['registration_no']));

    if ($search != "") {
        // Query confirmed table 'admissions'
        $sql = "SELECT reg_no FROM admissions 
                WHERE reg_no = '$search' 
                OR student_name LIKE '%$search%' 
                LIMIT 1";
        
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            $data = mysqli_fetch_assoc($res);
            $reg = urlencode((string)$data['reg_no']);
            
            // USE JAVASCRIPT REDIRECT TO AVOID 500 ERRORS
            $redirect_js = "<script>window.location.href='library_student_return_books.php?registration_no=$reg';</script>";
        } else {
            $msg = "<div style='color:red; background:#fee; padding:10px; border:1px solid red; margin-bottom:10px;'>
                        Student '$search' not found in Admissions.
                    </div>";
        }
    }
}

// 3. START UI
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

// Output any redirection script if generated
echo $redirect_js;
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:15px 0 0 20px; color:#0078D4">Return Book: Verify Identity</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_content" style="padding: 25px;">
                        <?php if($msg != "") echo $msg; ?>
                        
                        <form action="" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Enter Name or S.R. Number</label>
                                        <div class="form_input">
                                            <div style="display: flex; gap: 10px; align-items: center;">
                                                <input name="registration_no" type="text" placeholder="e.g. kishore" required style="width:300px;" />
                                                <button type="submit" name="submit_verify" class="btn_small btn_blue"><span>Verify Student</span></button>
                                            </div>
                                            <span class="label_intro">Search admissions by registration number or full name.</span>
                                        </div>
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
