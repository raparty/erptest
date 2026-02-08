<?php
declare(strict_types=1);

/**
 * ID 4.8: Exam Module Hub
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="margin-bottom: 30px;">
        <h3 style="font-weight: 300; font-size: 28px; color: var(--fluent-slate);">Examination Settings Dashboard</h3>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="azure-card-grid">
        <a href="exam_show_maximum_marks.php" class="azure-modern-card">
            <div class="azure-icon-wrapper">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="var(--app-primary)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <h4 class="azure-card-title">Grading Policy</h4>
            <p class="azure-card-desc">Define maximum marks for each subject and class.</p>
        </a>

        <a href="exam_time_table_detail.php" class="azure-modern-card">
            <div class="azure-icon-wrapper">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="var(--app-primary)"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5z"/></svg>
            </div>
            <h4 class="azure-card-title">Exam Timetable</h4>
            <p class="azure-card-desc">Schedule dates for specific subject examinations.</p>
        </a>

        <a href="entry_exam_marksheet.php" class="azure-modern-card">
            <div class="azure-icon-wrapper">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="var(--app-primary)"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
            </div>
            <h4 class="azure-card-title">Report Cards</h4>
            <p class="azure-card-desc">Generate and print student academic performance sheets.</p>
        </a>
    </div>
</div>

<style>
    /* Modern Dashboard Grid */
    .azure-card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-top: 20px; }
    .azure-modern-card { 
        background: #fff; border: 1px solid var(--app-border); padding: 30px; 
        border-radius: 8px; text-decoration: none; transition: 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .azure-modern-card:hover { transform: translateY(-5px); border-color: var(--app-primary); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .azure-icon-wrapper { margin-bottom: 20px; }
    .azure-card-title { color: var(--fluent-slate); margin-bottom: 10px; font-weight: 600; }
    .azure-card-desc { color: var(--app-muted); font-size: 13px; line-height: 1.6; }
</style>

<?php require_once("includes/footer.php"); ?>
