<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

$sid = (int)($_GET['sid'] ?? 0);
$msg = "";

// Fetch current class data
$sql2 = "SELECT * FROM classes WHERE id = '$sid'";
$res2 = db_query($sql2);
$row2 = db_fetch_array($res2);

if (!$row2) {
    header("Location: class.php");
    exit;
}

if (isset($_POST['submit'])) {
    $class_name = db_escape(trim($_POST['class_name']));
    $stream_status = (int)$_POST['stream_status'];

    // Check for duplicates excluding current record
    $check = db_query("SELECT id FROM classes WHERE class_name = '$class_name' AND id != '$sid'");
    if (db_num_rows($check) == 0) {
        $sql3 = "UPDATE classes SET class_name = '$class_name', stream_status = '$stream_status' WHERE id = '$sid'";
        db_query($sql3);
        header("Location: class.php?msg=3");
        exit;
    } else {
        header("Location: edit_class.php?error=2&sid=$sid");
        exit;
    }
}

if (isset($_GET['error']) && $_GET['error'] == 2) {
    $msg = "<span style='color:#FF0000;'><h4>Class Name Already Exists</h4></span>";
}

include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/school_setting_sidebar.php");
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <h3 style="padding:20px; color:#0078D4">Edit Class Details</h3>
                    <?php if($msg != "") echo "<div style='padding-left:20px;'>$msg</div>"; ?>
                    <form action="edit_class.php?sid=<?php echo $sid; ?>" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Class Name</label>
                                    <div class="form_input">
                                        <input name="class_name" type="text" value="<?php echo htmlspecialchars($row2['class_name']); ?>" required style="width:100%">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Enable Streams?</label>
                                    <div class="form_input">
                                        <select name="stream_status">
                                            <option value="1" <?php if($row2['stream_status'] == 1) echo 'selected'; ?>>Yes</option>
                                            <option value="0" <?php if($row2['stream_status'] == 0) echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_input">
                                    <button type="submit" name="submit" class="btn_small btn_blue"><span>Update Class</span></button>
                                    <a href="class.php" class="btn_small btn_orange"><span>Cancel</span></a>
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
