<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
$sid = (int)($_GET['sid'] ?? 0);
$row2 = db_fetch_array(db_query("SELECT * FROM subjects WHERE id = '$sid'"));

if (isset($_POST['submit'])) {
    $subject_name = db_escape(trim($_POST['subject_name']));
    db_query("UPDATE subjects SET subject_name = '$subject_name' WHERE id = '$sid'");
    header("Location: subject.php?msg=3");
    exit;
}
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/school_setting_sidebar.php");
?>
<div id="container"><div id="content"><div class="grid_container"><div class="grid_12"><div class="widget_wrap">
    <h3 style="padding:20px; color:#0078D4">Edit Subject</h3>
    <form action="edit_subject.php?sid=<?php echo $sid; ?>" method="post" class="form_container left_label">
        <ul>
            <li><label class="field_title">Subject Name</label>
                <div class="form_input"><input name="subject_name" type="text" value="<?php echo htmlspecialchars($row2['subject_name']); ?>" required style="width:100%"></div>
            </li>
            <li><div class="form_input"><button type="submit" name="submit" class="btn_small btn_blue"><span>Update</span></button></div></li>
        </ul>
    </form>
</div></div></div></div></div>
<?php include_once("includes/footer.php"); ?>
