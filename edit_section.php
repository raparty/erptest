<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
$sid = (int)($_GET['sid'] ?? 0);

$row2 = db_fetch_array(db_query("SELECT * FROM sections WHERE id = '$sid'"));
if (!$row2) { header("Location: section.php"); exit; }

if (isset($_POST['submit'])) {
    $section_name = db_escape(trim($_POST['section_name']));
    $check = db_query("SELECT id FROM sections WHERE section_name = '$section_name' AND id != '$sid'");
    if (db_num_rows($check) == 0) {
        db_query("UPDATE sections SET section_name = '$section_name' WHERE id = '$sid'");
        header("Location: section.php?msg=3");
        exit;
    }
}
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/school_setting_sidebar.php");
?>
<div id="container"><div id="content"><div class="grid_container"><div class="grid_12"><div class="widget_wrap">
    <h3 style="padding:20px; color:#0078D4">Edit Section</h3>
    <form action="edit_section.php?sid=<?php echo $sid; ?>" method="post" class="form_container left_label">
        <ul>
            <li><label class="field_title">Section Name</label>
                <div class="form_input"><input name="section_name" type="text" value="<?php echo htmlspecialchars($row2['section_name']); ?>" required style="width:100%"></div>
            </li>
            <li><div class="form_input"><button type="submit" name="submit" class="btn_small btn_blue"><span>Update</span></button></div></li>
        </ul>
    </form>
</div></div></div></div></div>
<?php include_once("includes/footer.php"); ?>
