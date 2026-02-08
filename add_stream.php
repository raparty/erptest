<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

$msg = "";
if (isset($_POST['submit'])) {
    $stream_name = db_escape(trim($_POST['stream_name']));

    if (!empty($stream_name)) {
        // Check for duplicates first
        $check = db_query("SELECT id FROM streams WHERE stream_name = '$stream_name'");
        if (db_num_rows($check) == 0) {
            $sql = "INSERT INTO streams (stream_name) VALUES ('$stream_name')";
            if (db_query($sql)) {
                header("Location: stream.php?msg=1");
                exit;
            }
        } else {
            header("Location: add_stream.php?error=1");
            exit;
        }
    } else {
        header("Location: add_stream.php?error=2");
        exit;
    }
}

// Handle GET messages
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 1) $msg = "<span style='color:#009900;'><h4>Stream Added Successfully</h4></span>";
} else if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) $msg = "<span style='color:#FF0000;'><h4>Stream Already Exists</h4></span>";
    if ($_GET['error'] == 2) $msg = "<span style='color:#FF0000;'><h4>Please fill all details</h4></span>";
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
                    <div class="widget_top">
                        <h6>Add New Stream</h6>
                    </div>
                    <div class="widget_content">
                        <?php if($msg != "") echo "<div style='padding:10px;'>$msg</div>"; ?>
                        <form action="add_stream.php" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Stream Name</label>
                                        <div class="form_input">
                                            <input name="stream_name" type="text" style="width:100%" placeholder="e.g. Science, Commerce, Arts" required>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_grid_12">
                                        <div class="form_input">
                                            <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Stream</span></button>
                                            <a href="stream.php" class="btn_small btn_orange"><span>Cancel</span></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <span class="clear"></span>
        </div>
        <span class="clear"></span>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
