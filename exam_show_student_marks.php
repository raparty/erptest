<?php
declare(strict_types=1);

/**
 * ID 4.7: Student Exam Marks Master List
 * Group 4: Examinations
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Handle Deletion logic
if(isset($_GET['sid'])) {
    db_query("DELETE FROM exam_subject_marks WHERE exam_marks_id='".(int)$_GET['sid']."'");	
}
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Student Performance Ledger</h3>
        <a href="entry_exam_add_student_marks.php" class="btn-fluent-primary">+ Add New Marks</a>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Subject-wise Academic Records</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Reg. No</th>
                        <th>Student Name</th>
                        <th>Subject</th>
                        <th>Exam Term</th>
                        <th class="center">Obtained Marks</th>
                        <th class="center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $sql = "SELECT m.*, a.student_name, s.subject_name, t.term_name 
                            FROM exam_subject_marks m
                            JOIN admissions a ON m.registration_no = a.reg_no
                            JOIN subjects s ON m.subject_id = s.subject_id
                            JOIN exam_nuber_of_term t ON m.term_id = t.term_id
                            WHERE m.session = '".$_SESSION['session']."'
                            ORDER BY m.registration_no ASC, t.term_name ASC";
                    $res = db_query($sql);
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td class="center"><strong><?php echo $row['registration_no']; ?></strong></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td class="center"><?php echo htmlspecialchars($row['term_name']); ?></td>
                        <td class="center" style="font-weight: 700; color: #059669;"><?php echo $row['marks']; ?></td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="exam_edit_student_marks.php?sid=<?php echo $row['exam_marks_id']; ?>" class="fluent-btn-icon" title="Edit Score">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="exam_show_student_marks.php?sid=<?php echo $row['exam_marks_id']; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Remove this student score?')" title="Delete">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
