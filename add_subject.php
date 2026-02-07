<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

if (isset($_POST['submit'])) {
    $subject_name = db_escape(trim($_POST['subject_name']));

    if (!empty($subject_name)) {
        $sql = "INSERT INTO subjects (subject_name) VALUES ('$subject_name')";
        if (db_query($sql)) {
            header("Location: subject.php?msg=1");
            exit;
        }
    } else {
        header("Location: add_subject.php?error=2");
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
                    <h3 style="padding:20px; color:#0078D4">Add New Subject</h3>
                    <form action="add_subject.php" method="post" class="form_container left_label">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">Subject Name</label>
                                    <div class="form_input">
                                        <input name="subject_name" type="text" style="width:100%" placeholder="e.g. Mathematics" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Save Subject</span></button>
                                        <a href="subject.php" class="btn_small btn_orange"><span>Cancel</span></a>
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
