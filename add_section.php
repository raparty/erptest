<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

if (isset($_POST['submit'])) {
    $section_name = db_escape(trim($_POST['section_name']));

    if (!empty($section_name)) {
        $sql = "INSERT INTO sections (section_name) VALUES ('$section_name')";
        if (db_query($sql)) {
            header("Location: section.php?msg=1");
            exit;
        }
    } else {
        header("Location: add_section.php?error=2");
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
                    <h3 style="padding:20px; color:#0078D4">Add New Section</h3>
                    <form action="add_section.php" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Section Name</label>
                                    <div class="form_input">
                                        <input name="section_name" type="text" style="width:100%" placeholder="e.g. Section A" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Section</span></button>
                                        <a href="section.php" class="btn_small btn_orange"><span>Cancel</span></a>
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
