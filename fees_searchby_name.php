<?php
declare(strict_types=1);

/**
 * ID 2.2: Fee Student Search
 * Fix: Synchronized with 'admissions' table and corrected CSS distortion
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$conn = Database::connection();
$search_results = [];
$searched = false;

// 1. Unified Search Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searched = true;
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $class_id = (int)($_POST['class'] ?? 0);
    $stream_id = (int)($_POST['stream'] ?? 0);

    // Dynamic Query Builder targeting 'admissions' table
    $sql = "SELECT a.*, c.class_name 
            FROM admissions a 
            LEFT JOIN classes c ON a.class_id = c.id 
            WHERE 1=1";

    if (!empty($name)) $sql .= " AND a.student_name LIKE '%$name%'";
    if ($class_id > 0) $sql .= " AND a.class_id = $class_id";
    if ($stream_id > 0) $sql .= " AND a.stream_id = $stream_id";

    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $search_results[] = $row;
    }
}
?>

<div class="page_title">
    <span class="title_icon"><span class="money_dollar"></span></span>
    <h3>Fee Management: Student Search</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Search for Student</h6>
                    </div>
                    <div class="widget_content p-4">
                        <form action="fees_searchby_name.php" method="post">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Student Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter name...">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Class</label>
                                    <select name="class" class="form-control">
                                        <option value="">- All Classes -</option>
                                        <?php
                                        $classes = mysqli_query($conn, "SELECT * FROM classes");
                                        while($c = mysqli_fetch_assoc($classes)) {
                                            echo "<option value='{$c['id']}'>{$c['class_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn-fluent-primary w-100">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                                        </svg>
                                        Search Student
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if ($searched): ?>
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Search Results</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>Reg. No</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Guardian</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($search_results)): ?>
                                    <tr><td colspan="5" class="center text-danger">No students found matching your criteria.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($search_results as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['reg_no']); ?></td>
                                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['guardian_name'] ?? 'N/A'); ?></td>
                                        <td class="center">
                                            <a href="add_student_fees.php?registration_no=<?php echo urlencode($row['reg_no']); ?>" class="btn-fluent-primary" style="padding: 6px 20px; font-size: 12px; text-decoration: none;">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:4px;">
                                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" fill="currentColor"/>
                                                </svg>
                                                Collect Fees
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
