<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

if (isset($_POST['submit'])) {
    $class_name = db_escape(trim($_POST['class_name']));
    $stream_status = (int)($_POST['stream_status'] ?? 0);

    if (!empty($class_name)) {
        $sql = "INSERT INTO classes (class_name, stream_status) VALUES ('$class_name', '$stream_status')";
        if (db_query($sql)) {
            header("Location: class.php?msg=1");
            exit;
        }
    } else {
        header("Location: add_class.php?error=2");
        exit;
    }
}

include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <h3 style="padding:20px; color:#0078D4">Add New Class</h3>
                    <form action="add_class.php" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Class Name</label>
                                    <div class="form_input">
                                        <input name="class_name" type="text" style="width:100%" placeholder="e.g. 7th Grade" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Enable Streams?</label>
                                    <div class="form_input">
                                        <select name="stream_status">
                                            <option value="0">No (Standard)</option>
                                            <option value="1">Yes (Science/Arts/Commerce)</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Class</span></button>
                                        <a href="class.php" class="btn_small btn_orange"><span>Cancel</span></a>
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
<?php include_once("includes/footer.php"); ?>
