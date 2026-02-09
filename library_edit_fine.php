<?php
declare(strict_types=1);

// Enable error reporting to diagnose database mismatches immediately
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$sid = isset($_GET['sid']) ? mysqli_real_escape_string($conn, (string)$_GET['sid']) : '';
$msg = "";

// Process Update Logic
if (isset($_POST['submit'])) {
    $fine_rate = mysqli_real_escape_string($conn, trim((string)$_POST['fine_rate']));
    $no_of_days = mysqli_real_escape_string($conn, trim((string)$_POST['no_of_days']));

    if (!empty($fine_rate) && !empty($no_of_days)) {
        // Updated to target pluralized table 'library_fine_managers'
        $sql_update = "UPDATE library_fine_managers SET 
                       `fine_rate` = '$fine_rate', 
                       `no_of_days` = '$no_of_days' 
                       WHERE `fine_id` = '$sid'";
        
        if (mysqli_query($conn, $sql_update)) {
            // JS redirect prevents blank page issues from header conflicts
            echo "<script>window.location.href='library_fine_manager.php?msg=3';</script>";
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Update Error: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Please fill in all details.</div>";
    }
}

// Fetch existing data
if (empty($sid)) {
    echo "<script>window.location.href='library_fine_manager.php';</script>";
    exit;
}

$sql_fetch = "SELECT * FROM library_fine_managers WHERE `fine_id` = '$sid'";
$res_fetch = mysqli_query($conn, $sql_fetch);
$row2 = mysqli_fetch_assoc($res_fetch);

if (!$row2) {
    echo "<script>window.location.href='library_fine_manager.php?error=notfound';</script>";
    exit;
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Edit Fine Detail</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_edit_fine.php?sid=<?php echo htmlspecialchars($sid); ?>" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Fine Rate <span style="color:red;">*</span></label>
                                    <input name="fine_rate" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row2['fine_rate']); ?>" required />
                                </div>
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Grace Period (Days) <span style="color:red;">*</span></label>
                                    <input name="no_of_days" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row2['no_of_days']); ?>" required />
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                                <button type="submit" name="submit" class="btn_small btn_blue">
                                    <span>Update Fine Detail</span>
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
