<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

$msg = "";
if (isset($_POST['submit'])) {
    $class_id = (int)$_POST['class_id'];
    $stream_id = (int)($_POST['stream_id'] ?? 0);
    $subject_id = (int)$_POST['subject_id'];

    if ($class_id > 0 && $subject_id > 0) {
        $sql = "INSERT INTO allocate_class_subject (class_id, stream_id, subject_id) VALUES ($class_id, $stream_id, $subject_id)";
        if (db_query($sql)) {
            header("Location: allocate_subject.php?msg=1");
            exit;
        }
    } else {
        header("Location: add_allocate_subject.php?error=2");
        exit;
    }
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
                        <h6>Link Subject to Class</h6>
                    </div>
                    <div class="widget_content">
                        <form action="add_allocate_subject.php" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Select Class</label>
                                        <div class="form_input">
                                            <select name="class_id" style="width:100%" required>
                                                <option value="">- Choose Class -</option>
                                                <?php
                                                $res = db_query("SELECT id, class_name FROM classes ORDER BY id ASC");
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
                                        <label class="field_title">Select Stream (Optional)</label>
                                        <div class="form_input">
                                            <select name="stream_id" style="width:100%">
                                                <option value="0">No Stream (General)</option>
                                                <?php
                                                $res = db_query("SELECT id, stream_name FROM streams ORDER BY stream_name ASC");
                                                while($row = db_fetch_array($res)) {
                                                    echo "<option value='{$row['id']}'>{$row['stream_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Select Subject</label>
                                        <div class="form_input">
                                            <select name="subject_id" style="width:100%" required>
                                                <option value="">- Choose Subject -</option>
                                                <?php
                                                $res = db_query("SELECT id, subject_name FROM subjects ORDER BY subject_name ASC");
                                                while($row = db_fetch_array($res)) {
                                                    echo "<option value='{$row['id']}'>{$row['subject_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Link</span></button>
                                        <a href="allocate_subject.php" class="btn_small btn_orange"><span>Back</span></a>
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
