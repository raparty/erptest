<?php
declare(strict_types=1);

/**
 * ID 4.1: Assign Subject Max Marks
 * Group 4: Examinations
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Preserve Subject/Marks Array Processing
?>

<div class="grid_container">
    <div class="page_title" style="margin-bottom: 25px;">
        <h3>Set Maximum Marks</h3>
    </div>

    <div class="azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Academic Grading Configuration</h6>
        </div>
        <div class="widget_content" style="padding: 25px;">
            <form action="" method="post">
                <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 25px; display: flex; gap: 30px;">
                    <span><strong>Class:</strong> <?php echo htmlspecialchars($_POST['class_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                    <span><strong>Term:</strong> <?php echo htmlspecialchars($_POST['term_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <?php 
                    // Subject loop from your original logic
                    $sql="SELECT * FROM subjects WHERE class_id='".$_POST['class_id']."'";
                    $res=db_query($sql);
                    while($subject = db_fetch_array($res)) { ?>
                    <div class="form_group" style="background: #fff; border: 1px solid var(--app-border); padding: 15px; border-radius: 6px;">
                        <label style="font-weight: 600; color: var(--app-primary); display: block; margin-bottom: 10px;">
                            <?php echo ucfirst($subject['subject_name']); ?>
                        </label>
                        <input type="text" name="marks[]" class="form-control fluent-input" placeholder="Enter Max Marks" required>
                        <input type="hidden" name="subject_id[]" value="<?php echo $subject['subject_id']; ?>">
                    </div>
                    <?php } ?>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 20px;">
                    <button type="submit" name="submit" class="btn-fluent-primary">Confirm Marks Configuration</button>
                    <a href="entry_add_max_marks.php" class="btn-outline-secondary" style="margin-left: 10px;">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
