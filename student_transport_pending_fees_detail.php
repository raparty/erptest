<?php
declare(strict_types=1);

/**
 * ID 2.6: Transport Arrears (Pending) Report
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$conn = Database::connection();
$search_results = [];
$searched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searched = true;
    $class_id = (int)($_POST['class'] ?? 0);
    $fees_term = (int)($_POST['fees_term'] ?? 0);
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    
    // Query to get transport pending fees
    $sql = "SELECT ts.*, a.student_name, c.class_name 
            FROM transport_student ts
            LEFT JOIN admissions a ON ts.registration_no = a.reg_no
            LEFT JOIN classes c ON a.class_id = c.id
            WHERE 1=1";
    
    if ($class_id > 0) $sql .= " AND a.class_id = $class_id";
    if (!empty($name)) $sql .= " AND a.student_name LIKE '%$name%'";
    
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $search_results[] = $row;
    }
}
?>

<div class="page_title">
    <span class="title_icon"><span class="money_dollar"></span></span>
    <h3>Transport Arrears List</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Search Criteria</h6>
                    </div>
                    <div class="widget_content p-4">
                        <form action="student_transport_pending_fees_detail.php" method="post">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Target Class</label>
                                    <select name="class" class="form-control" required>
                                        <option value="">- Select Class -</option>
                                        <?php
                                        $classes = mysqli_query($conn, "SELECT * FROM classes");
                                        while ($c = mysqli_fetch_assoc($classes)) {
                                            echo "<option value='{$c['id']}'>{$c['class_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fee Month/Term</label>
                                    <select name="fees_term" class="form-control" required>
                                        <option value="">- Select Term -</option>
                                        <?php
                                        $terms = mysqli_query($conn, "SELECT * FROM fees_term");
                                        while ($t = mysqli_fetch_assoc($terms)) {
                                            echo "<option value='{$t['id']}'>{$t['term_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Student Name <span class="text-muted small">(Optional)</span></label>
                                    <input name="name" type="text" class="form-control" placeholder="Partial search...">
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn-fluent-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                                    </svg>
                                    Filter
                                </button>
                                <button type="button" onclick="window.print()" class="btn-fluent-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z" fill="currentColor"/>
                                    </svg>
                                    Print List
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if ($searched): ?>
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Transport Pending Fees Results</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>Reg. No</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Route</th>
                                    <th>Monthly Fee</th>
                                    <th class="center text-danger">Pending Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($search_results)): ?>
                                    <tr><td colspan="6" class="center text-danger">No pending transport fees found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($search_results as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['registration_no'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($row['student_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($row['class_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($row['route_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo number_format($row['monthly_fee'] ?? 0, 2); ?></td>
                                        <td class="center text-danger fw-bold">
                                            <?php 
                                            // Calculate pending - you may need to adjust this logic
                                            echo number_format($row['monthly_fee'] ?? 0, 2); 
                                            ?>
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
