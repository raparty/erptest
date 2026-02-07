<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

$sid = (int)($_GET['sid'] ?? 0);
$msg = "";

$sql2 = "SELECT * FROM allocate_class_section WHERE id = '$sid'";
$row2 = db_fetch_array(db_query($sql2));

if (!$row2) {
    header("Location: allocate_section.php");
    exit;
}

if (isset($_POST['submit'])) {
    $class_id = (int)$_POST['class_id'];
    $section_id = (int)$_POST['section_id'];

    $sql3 = "UPDATE allocate_class_section SET class_id = '$class_id', section_id = '$section_id' WHERE id = '$sid'";
    db_query($sql3);
    header("Location: allocate_section.php?msg=3");
    exit;
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
                    <h3 style="padding:20px; color:#0078D4">Edit Section Allocation</h3>
                    <form action="edit_allocate_section.php?sid=<?php echo $sid; ?>" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Select Class</label>
                                    <div class="form_input">
                                        <select name="class_id" required style="width:100%">
                                            <?php
                                            $classes = db_query("SELECT id, class_name FROM classes ORDER BY id ASC");
                                            while($c = db_fetch_array($classes)) {
                                                $sel = ($c['id'] == $row2['class_id']) ? "selected" : "";
                                                echo "<option value='{$c['id']}' $sel>{$c['class_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Select Section</label>
                                    <div class="form_input">
                                        <select name="section_id" required style="width:100%">
                                            <?php
                                            $sections = db_query("SELECT id, section_name FROM sections ORDER BY id ASC");
                                            while($s = db_fetch_array($sections)) {
                                                $sel = ($s['id'] == $row2['section_id']) ? "selected" : "";
                                                echo "<option value='{$s['id']}' $sel>{$s['section_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_input">
                                    <button type="submit" name="submit" class="btn_small btn_blue"><span>Update Allocation</span></button>
                                    <a href="allocate_section.php" class="btn_small btn_orange"><span>Cancel</span></a>
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
