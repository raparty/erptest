<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

$msg = "";
if (isset($_POST['submit'])) {
    $class_id = (int)$_POST['class_id'];
    $stream_id = (int)$_POST['stream_id'];

    if ($class_id > 0 && $stream_id > 0) {
        // Prevent duplicate allocation
        $check = db_query("SELECT id FROM allocate_class_stream WHERE class_id = $class_id AND stream_id = $stream_id");
        if (db_num_rows($check) == 0) {
            $sql = "INSERT INTO allocate_class_stream (class_id, stream_id) VALUES ($class_id, $stream_id)";
            if (db_query($sql)) {
                header("Location: allocate_stream.php?msg=1");
                exit;
            }
        } else {
            header("Location: add_allocate_stream.php?error=1");
            exit;
        }
    } else {
        header("Location: add_allocate_stream.php?error=2");
        exit;
    }
}

// Handle error messages for the UI
if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) $msg = "<span style='color:#FF0000;'><h4>Stream is already allocated to this class!</h4></span>";
    if ($_GET['error'] == 2) $msg = "<span style='color:#FF0000;'><h4>Please select both Class and Stream.</h4></span>";
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
                        <h6>Allocate Stream to Class</h6>
                    </div>
                    <div class="widget_content">
                        <?php if($msg != "") echo "<div style='padding:10px;'>$msg</div>"; ?>
                        <form action="add_allocate_stream.php" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Class Name</label>
                                        <div class="form_input">
                                            <select name="class_id" style="width:100%" required>
                                                <option value="">- Select Class -</option>
                                                <?php
                                                // Fetch classes that support streams
                                                $res = db_query("SELECT id, class_name FROM classes WHERE stream_status = '1' ORDER BY id ASC");
                                                while($row = db_fetch_array($res)) {
                                                    echo "<option value='{$row['id']}'>{$row['class_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Stream Name</label>
                                        <div class="form_input">
                                            <select name="stream_id" style="width:100%" required>
                                                <option value="">- Select Stream -</option>
                                                <?php
                                                $res = db_query("SELECT id, stream_name FROM streams ORDER BY id ASC");
                                                while($row = db_fetch_array($res)) {
                                                    echo "<option value='{$row['id']}'>{$row['stream_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Allocation</span></button>
                                        <a href="allocate_stream.php" class="btn_small btn_orange"><span>Back</span></a>
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
