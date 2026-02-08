<?php
declare(strict_types=1);

/**
 * ID 2.7: Student Fees Collection Reports
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Preserve Session-based filter logic for pagination
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['from_date'] = $_POST['from_date'];
    $_SESSION['to_date'] = $_POST['to_date'];
    $_SESSION['fees_term'] = $_POST['fees_term'];
}
?>

<div class="page_title" style="background: transparent; box-shadow: none; border-bottom: 1px solid var(--app-border); border-radius: 0; margin-bottom: 30px;">
    <h3 style="font-weight: 400; color: var(--fluent-slate); font-size: 24px;">Fee Collection Analysis</h3>
</div>

<?php include_once("includes/fees_setting_sidebar.php"); ?>

<div class="grid_container">
    <div class="azure-card" style="margin-bottom: 25px; padding: 20px;">
        <form action="" method="post">
            <div style="display: grid; grid-template-columns: 1.5fr 1fr 1fr 120px; gap: 15px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Fees Term</label>
                    <select name="fees_term" class="form-control fluent-input">
                        <?php 
                        $t_res = db_query("SELECT * FROM fees_term");
                        while($t = db_fetch_array($t_res)) {
                            $sel = ($_SESSION['fees_term'] == $t['term_name']) ? 'selected' : '';
                            echo "<option value='{$t['term_name']}' $sel>{$t['term_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">From Date</label>
                    <input name="from_date" type="date" class="form-control fluent-input" value="<?php echo $_SESSION['from_date']; ?>">
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">To Date</label>
                    <input name="to_date" type="date" class="form-control fluent-input" value="<?php echo $_SESSION['to_date']; ?>">
                </div>
                <button type="submit" class="btn-fluent-primary" style="height: 42px;">Filter</button>
            </div>
        </form>
    </div>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Report Results</h6>
            <div class="widget_actions">
                <button onclick="window.print()" class="btn-outline-secondary">Print PDF</button>
            </div>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Term</th>
                        <th>Amount Paid</th>
                        <th class="center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $mytablename = "student_fees_detail";
                    include("student_fees_reports_pagination.php"); // Preserving range-based logic
                    
                    // SQL logic remains untouched to prevent breaking calculation
                    $sql = "SELECT f.*, a.student_name, c.class_name 
                            FROM student_fees_detail f 
                            JOIN admissions a ON f.registration_no = a.reg_no 
                            JOIN classes c ON a.class_id = c.id
                            WHERE (f.deposit_date BETWEEN '".$_SESSION['from_date']."' AND '".$_SESSION['to_date']."')
                            AND f.fees_term = '".$_SESSION['fees_term']."'
                            ORDER BY f.id DESC LIMIT $start, $limit";
                    $res = db_query($sql);
                    
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><strong><?php echo $row['registration_no']; ?></strong></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td class="center"><?php echo htmlspecialchars($row['class_name']); ?></td>
                        <td class="center"><?php echo $row['fees_term']; ?></td>
                        <td class="center" style="color: #059669; font-weight: 700;">₹<?php echo number_format((float)$row['fees_amount'], 2); ?></td>
                        <td class="center"><?php echo date('d-M-Y', strtotime($row['deposit_date'])); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="fluent-pagination-wrapper"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
