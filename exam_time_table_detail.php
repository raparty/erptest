<?php
declare(strict_types=1);

/**
 * ID 4.5: Examination Timetable Detail
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Examination Schedule</h3>
        <a href="exam_date.php" class="btn-fluent-primary">+ Schedule New Exam</a>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class</th>
                        <th>Subject Name</th>
                        <th class="center">Exam Date (MM/DD/YYYY)</th>
                        <th class="center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $sql = "SELECT t.*, c.class_name, s.subject_name 
                            FROM exam_time_table t
                            JOIN classes c ON t.class_id = c.id
                            JOIN subjects s ON t.subject_id = s.subject_id
                            WHERE t.session = '".$_SESSION['session']."'
                            ORDER BY t.date ASC";
                    $res = db_query($sql);
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td class="center">
                            <span class="fluent-badge-outline" style="background:#f0f7ff; color:var(--app-primary); font-weight:700;">
                                <?php echo date('m/d/Y', strtotime($row['date'])); ?>
                            </span>
                        </td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="exam_edit_time_table.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon" title="Edit">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="exam_time_table_detail.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Remove this exam from timetable?')" title="Delete">
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
