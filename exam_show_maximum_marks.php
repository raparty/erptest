<?php
declare(strict_types=1);

/**
 * ID 4.4: Maximum Marks Master List
 * Group 4: Examinations
 */
require_once("includes/bootstrap.php");
require_once("includes/pagination_helper.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$conn = Database::connection();

// Handle Deletion logic
if(isset($_GET['sid'])) {
    db_query("DELETE FROM exam_add_maximum_marks WHERE exam_max_marks_id='".(int)$_GET['sid']."'");	
}

// Pagination settings
$items_per_page = 20;
$current_page = (int)($_GET['page'] ?? 1);
$current_page = max(1, $current_page);
$offset = ($current_page - 1) * $items_per_page;

// Get total count
$session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));
$count_sql = "SELECT COUNT(*) as total FROM exam_add_maximum_marks WHERE session = '$session'";
$count_res = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_res);
$total_items = (int)$count_row['total'];
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Exam Grading Policies</h3>
        <a href="entry_add_max_marks.php" class="btn-fluent-primary">+ Set Maximum Marks</a>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Subject-wise Max Marks Configuration</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Exam Term</th>
                        <th class="center">Max Marks</th>
                        <th class="center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Query with pagination
                    $sql = "SELECT m.*, c.class_name, s.subject_name, t.term_name 
                            FROM exam_add_maximum_marks m
                            JOIN classes c ON m.class_id = c.id
                            JOIN subjects s ON m.subject_id = s.subject_id
                            JOIN exam_nuber_of_term t ON m.term_id = t.term_id
                            WHERE m.session = '$session'
                            ORDER BY c.class_name ASC, t.term_name ASC
                            LIMIT $offset, $items_per_page";
                    $res = db_query($sql);
                    $i = $offset + 1;
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td><span class="fluent-badge-outline"><?php echo htmlspecialchars($row['class_name']); ?></span></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td class="center"><?php echo htmlspecialchars($row['term_name']); ?></td>
                        <td class="center" style="font-weight: 700; color: var(--app-primary);"><?php echo $row['max_marks']; ?></td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="exam_edit_maximum_marks.php?sid=<?php echo $row['exam_max_marks_id']; ?>" class="fluent-btn-icon" title="Edit">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="exam_show_maximum_marks.php?sid=<?php echo $row['exam_max_marks_id']; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Permanently delete this grading policy?')" title="Delete">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
            
            <?php 
            // Display pagination
            echo generate_pagination($current_page, $total_items, $items_per_page, 'exam_show_maximum_marks.php');
            ?>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
