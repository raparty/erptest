<?php
declare(strict_types=1);

// Enable error reporting to diagnose database issues
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$msg = "";

if (isset($_POST['submit'])) {
    $fine_rate = mysqli_real_escape_string($conn, trim((string)$_POST['fine_rate']));
    $no_of_days = mysqli_real_escape_string($conn, trim((string)$_POST['no_of_days']));
    $current_session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));

    if (!empty($fine_rate) && !empty($no_of_days)) {
        // Updated to pluralized table 'library_fine_managers'
        $sql_check = "SELECT * FROM library_fine_managers WHERE session='$current_session'";
        $res_check = mysqli_query($conn, $sql_check);

        if ($res_check && mysqli_num_rows($res_check) == 0) {
            $sql_ins = "INSERT INTO library_fine_managers (fine_rate, no_of_days, session) VALUES ('$fine_rate', '$no_of_days', '$current_session')";
            if (mysqli_query($conn, $sql_ins)) {
                // JS redirect prevents blank pages from header conflicts
                echo "<script>window.location.href='library_fine_manager.php?msg=1';</script>";
                exit;
            } else {
                $msg = "<div class='alert alert-danger'>Database Error: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Fine setting for this session already exists.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Please fill in all details.</div>";
    }
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Add Fine Detail</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_add_fine.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Fine Rate <span style="color:red;">*</span></label>
                                    <input name="fine_rate" type="text" style="width:100%;" placeholder="e.g. 5.00" required />
                                </div>
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Grace Period (Days) <span style="color:red;">*</span></label>
                                    <input name="no_of_days" type="text" style="width:100%;" placeholder="e.g. 7" required />
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                                <button type="submit" name="submit" class="btn_small btn_blue">
                                    <span>Save Fine Detail</span>
                                </button>
                                <a href="library_fine_manager.php" class="btn_small btn_orange" style="margin-left:10px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
