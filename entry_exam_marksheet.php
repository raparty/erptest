<?php
declare(strict_types=1);

/**
 * ID 4.6: Marksheet Generation Selector
 * Group 4: Examinations
 * Fix: Standardized Find Student path to avoid incorrect redirection.
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// GET context: Pre-populate if coming from the student selector
$reg_no = $_GET['registration_no'] ?? '';
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Generate Academic Marksheet</h3>
        <a href="exam_show_maximum_marks.php" class="btn-outline-secondary">
            <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right:5px;"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
            Back to Grading List
        </a>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="azure-card" style="max-width: 800px; margin: 0 auto;">
        <div class="widget_top">
            <h6 class="fluent-card-header">Report Card Selection Criteria</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="exam_final_marksheet.php" method="get">
                <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                    
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Student Registration No.</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="registration_no" class="form-control fluent-input" 
                                   placeholder="e.g. 2025/AD/001" value="<?php echo htmlspecialchars($reg_no); ?>" required>
                            
                            <a href="exam_marksheet_student_selector.php" class="btn-outline-secondary" style="white-space: nowrap; display: flex; align-items: center; text-decoration: none;">
                                <svg viewBox="0 0 24 24" width="18" height="18" style="margin-right:5px;"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                                Find Student
                            </a>
                        </div>
                    </div>

                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Examination Term</label>
                        <select name="term_id" class="form-control fluent-input" required>
                            <option value="all">Generate Full Year Report</option>
                            <?php
                            $t_res = db_query("SELECT * FROM exam_nuber_of_term");
                            while($t = db_fetch_array($t_res)) {
                                echo "<option value='{$t['term_id']}'>{$t['term_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 25px;">
                    <button type="submit" class="btn-fluent-primary" style="width: 100%; justify-content: center; display: flex; align-items: center; gap: 10px;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="white"><path d="M19 8H5c-1.66 0-3 1.33-3 3v6h4v4h12v-4h4v-6c0-1.67-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                        Generate & Print Report Card
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Artifact Cleanup */
    .title_icon { display: none !important; }
    
    /* Standardized Input & Button Styles */
    .fluent-input { border: 1px solid var(--app-border); border-radius: 4px; padding: 10px; width: 100%; }
    .btn-fluent-primary { background: var(--app-primary); color: #fff; border: none; padding: 12px 24px; border-radius: 4px; font-weight: 600; cursor: pointer; transition: 0.2s; }
    .btn-fluent-primary:hover { background: #005a9e; }
    
    .btn-outline-secondary { border: 1px solid var(--app-border); background: #fff; color: var(--fluent-slate); padding: 8px 16px; border-radius: 4px; font-weight: 500; transition: 0.2s; }
    .btn-outline-secondary:hover { background: #f3f4f6; color: var(--app-primary); border-color: var(--app-primary); }
</style>

<?php require_once("includes/footer.php"); ?>
