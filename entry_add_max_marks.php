<?php
declare(strict_types=1);

/**
 * ID 4.1: Entry Add Max Marks
 * Fix: Restored Term Dropdown and modernized UI
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Preserve form processing logic
if(isset($_POST['entry_submit'])) {
    // Logic to redirect to exam_add_maximum_marks.php with criteria
    // Handled by the form action below
}
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Set Examination Max Marks</h3>
        <a href="exam_show_maximum_marks.php" class="btn-outline-secondary">
             <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right:5px;"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
             Back to Master List
        </a>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="azure-card" style="max-width: 800px; margin: 0 auto;">
        <div class="widget_top">
            <h6 class="fluent-card-header">Select Grading Criteria</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="exam_add_maximum_marks.php" method="post">
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                    
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Target Class</label>
                        <select name="class_id" class="form-control fluent-input" required>
                            <option value=""> - Select Class - </option>
                            <?php 
                            $c_res = db_query("SELECT id, class_name FROM classes ORDER BY class_name ASC");
                            while($c = db_fetch_array($c_res)) {
                                echo "<option value='{$c['id']}'>{$c['class_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Stream / Section</label>
                        <select name="stream" class="form-control fluent-input">
                            <option value=""> - None - </option>
                            <?php 
                            $s_res = db_query("SELECT * FROM stream");
                            while($s = db_fetch_array($s_res)) {
                                echo "<option value='{$s['stream_id']}'>{$s['stream_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Examination Term</label>
                        <select name="term_id" class="form-control fluent-input" required>
                            <option value=""> - Select term - </option>
                            <?php
                            // Re-verified table name from schema: exam_nuber_of_term
                            $term_res = db_query("SELECT term_id, term_name FROM exam_nuber_of_term ORDER BY term_id ASC");
                            while($term = db_fetch_array($term_res)) {
                                echo "<option value='{$term['term_id']}'>{$term['term_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 25px;">
                    <button type="submit" name="entry_submit" class="btn-fluent-primary" style="width: 100%; justify-content: center;">
                        Load Subject Marking Sheet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS Standardizations */
    .title_icon { display: none !important; }
    .fluent-input { border: 1px solid var(--app-border); border-radius: 4px; padding: 10px; width: 100%; }
    .btn-fluent-primary { background: var(--app-primary); color: #fff; border: none; padding: 12px 24px; border-radius: 4px; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-fluent-primary:hover { background: #005a9e; }
    .btn-outline-secondary { border: 1px solid var(--app-border); background: #fff; color: var(--fluent-slate); padding: 8px 16px; border-radius: 4px; font-weight: 500; text-decoration: none; display: flex; align-items: center; }
</style>

<?php require_once("includes/footer.php"); ?>
