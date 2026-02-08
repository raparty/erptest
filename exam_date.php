<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Exam Schedule Manager</h3>
        <a href="exam_time_table_detail.php" class="btn-outline-secondary">View Timetable</a>
    </div>

    <div class="azure-card" style="max-width: 800px; margin: 0 auto;">
        <div class="widget_top">
            <h6 class="fluent-card-header">Assign Subject Exam Date</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="" method="post">
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
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Subject</label>
                        <select name="subject_id" class="form-control fluent-input" required>
                            <option value=""> - Select Subject - </option>
                            <?php 
                            $s_res = db_query("SELECT subject_id, subject_name FROM subjects ORDER BY subject_name ASC");
                            while($s = db_fetch_array($s_res)) {
                                echo "<option value='{$s['subject_id']}'>{$s['subject_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Exam Date (MM/DD/YYYY)</label>
                        <div class="input-with-icon">
                            <input type="text" name="date" id="exam_datepicker" class="form-control fluent-input" placeholder="Click to select date" readonly required>
                            <svg class="input-icon" viewBox="0 0 24 24" width="18" height="18" style="position: absolute; right: 10px; top: 38px; fill: #666;"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 25px;">
                    <button type="submit" name="submit" class="btn-fluent-primary">Save Exam Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    if (typeof $.fn.datepicker !== 'undefined') {
        $("#exam_datepicker").datepicker({
            dateFormat: 'mm/dd/yy', // MM/DD/YYYY format
            changeMonth: true,
            changeYear: true,
            showAnim: "fadeIn"
        });
    }
});
</script>

<style>
    .ui-datepicker { z-index: 9999 !important; border: 1px solid #ddd !important; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .datepicker { cursor: pointer !important; background: #fff !important; }
</style>

<?php require_once("includes/footer.php"); ?>
