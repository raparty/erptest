<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
$sid = (int)($_GET['sid'] ?? 0);
$row2 = db_fetch_array(db_query("SELECT * FROM allocate_class_subject WHERE id = '$sid'"));

if (isset($_POST['submit'])) {
    $class_id = (int)$_POST['class_id'];
    $stream_id = (int)($_POST['stream_id'] ?? 0);
    $subject_id = (int)$_POST['subject_id'];
    db_query("UPDATE allocate_class_subject SET class_id='$class_id', stream_id='$stream_id', subject_id='$subject_id' WHERE id='$sid'");
    header("Location: allocate_subject.php?msg=3");
    exit;
}
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/school_setting_sidebar.php");
?>
<div id="container"><div id="content"><div class="grid_container"><div class="grid_12"><div class="widget_wrap">
    <h3 style="padding:20px; color:#0078D4">Edit Subject Allocation</h3>
    <form action="edit_allocate_subject.php?sid=<?php echo $sid; ?>" method="post" class="form_container left_label">
        <ul>
            <li><label class="field_title">Class</label>
                <div class="form_input"><select name="class_id" style="width:100%"><?php
                    $res = db_query("SELECT id, class_name FROM classes");
                    while($c = db_fetch_array($res)) { $sel = ($c['id']==$row2['class_id']) ? "selected" : ""; echo "<option value='{$c['id']}' $sel>{$c['class_name']}</option>"; }
                ?></select></div>
            </li>
            <li><label class="field_title">Subject</label>
                <div class="form_input"><select name="subject_id" style="width:100%"><?php
                    $res = db_query("SELECT id, subject_name FROM subjects");
                    while($s = db_fetch_array($res)) { $sel = ($s['id']==$row2['subject_id']) ? "selected" : ""; echo "<option value='{$s['id']}' $sel>{$s['subject_name']}</option>"; }
                ?></select></div>
            </li>
            <li><div class="form_input"><button type="submit" name="submit" class="btn_small btn_blue"><span>Update</span></button></div></li>
        </ul>
    </form>
</div></div></div></div></div>
<?php include_once("includes/footer.php"); ?>
