<?php
declare(strict_types=1);

/**
 * ID 4.2: Add Student Marks
 * Group 4: Examinations
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Preserve Student/Term Context
$reg_no = db_escape($_GET['registration_no'] ?? '');
$term_id = (int)($_GET['term_id'] ?? 0);

// Data Retrieval for Student and Class Info
$student = db_fetch_array(db_query("SELECT student_name, class_id FROM admissions WHERE reg_no = '$reg_no'"));
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Enter Student Marks</h3>
        <a href="entry_exam_add_student_marks.php" class="btn-outline-secondary">Back to Selector</a>
    </div>

    <div class="azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Marking Sheet: <?php echo htmlspecialchars($student['student_name']); ?> (<?php echo $reg_no; ?>)</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="" method="post">
                <input type="hidden" name="registration_no" value="<?php echo $reg_no; ?>">
                <input type="hidden" name="class_id" value="<?php echo $student['class_id']; ?>">
                <input type="hidden" name="term_id" value="<?php echo $term_id; ?>">

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    <?php 
                    $sql = "SELECT s.*, m.max_marks 
                            FROM subjects s 
                            JOIN exam_add_maximum_marks m ON s.subject_id = m.subject_id 
                            WHERE s.class_id = '".$student['class_id']."' AND m.term_id = '$term_id'";
                    $res = db_query($sql);
                    while($sub = db_fetch_array($res)) { ?>
                    <div class="form_group" style="background: #f8fafc; border: 1px solid var(--app-border); padding: 15px; border-radius: 8px;">
                        <label style="font-weight: 600; color: var(--fluent-slate); margin-bottom: 10px; display: block;">
                            <?php echo htmlspecialchars($sub['subject_name']); ?> 
                            <span style="color: var(--app-muted); font-size: 11px;">(Max: <?php echo $sub['max_marks']; ?>)</span>
                        </label>
                        <input type="number" name="marks[]" class="form-control fluent-input" placeholder="Obtained Marks" max="<?php echo $sub['max_marks']; ?>" required>
                        <input type="hidden" name="subject_id[]" value="<?php echo $sub['subject_id']; ?>">
                    </div>
                    <?php } ?>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 25px;">
                    <button type="submit" name="submit" class="btn-fluent-primary">Save Academic Marks</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
