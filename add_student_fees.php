<?php
// 1. Force Error Reporting to stop the blank page
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$conn = Database::connection(); // Get active DB connection

// 2. Logic to process payment
$msg = "";
if (isset($_POST['submit'])) {
    $reg_no = mysqli_real_escape_string($conn, $_POST['registration_no']);
    $amount = (float)$_POST['fees_amount'];
    $pending = (float)$_POST['pending_amount'];
    $term_id = (int)$_POST['fees_term'];

    if ($amount > 0 && $amount <= $pending) {
        $res_max = mysqli_query($conn, "SELECT MAX(id) as max_id FROM student_fees_detail");
        $max_row = mysqli_fetch_assoc($res_max);
        $receipt_no = "FEES-" . (($max_row['max_id'] ?? 0) + 1001);

        $sql_in = "INSERT INTO student_fees_detail(registration_no, reciept_no, fees_term, fees_amount, payment_date) 
                   VALUES ('$reg_no', '$receipt_no', '$term_id', '$amount', NOW())";
        
        if (mysqli_query($conn, $sql_in)) {
            echo "<script>window.location='fees_receipt.php?receipt_no=$receipt_no';</script>";
            exit;
        }
    } else {
        $msg = "<div class='alert alert-danger'>Error: Amount exceeds pending balance or is zero.</div>";
    }
}

// 3. Fetch student from 'admissions' table
$reg_no = $_REQUEST['registration_no'] ?? '';
$student = null;
$pending_balance = 0;

if (!empty($reg_no)) {
    $safe_reg = mysqli_real_escape_string($conn, $reg_no);
    $sql = "SELECT a.*, c.class_name FROM admissions a 
            LEFT JOIN classes c ON a.class_id = c.id 
            WHERE a.reg_no = '$safe_reg' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);

    if ($student) {
        // Calculate Total Paid
        $paid_res = mysqli_query($conn, "SELECT SUM(fees_amount) as paid FROM student_fees_detail WHERE registration_no = '$safe_reg'");
        $paid_row = mysqli_fetch_assoc($paid_res);
        $total_paid = (float)($paid_row['paid'] ?? 0);
        
        // Use 'admission_fee' as total package from admissions module
        $total_package = (float)($student['admission_fee'] ?? 0);
        $pending_balance = $total_package - $total_paid;
    }
}
?>

<div class="page_title">
    
    <h3>Fee Collection Form</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <?php echo $msg; ?>

            <?php if (!$student): ?>
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_content p-4">
                        <div class="alert alert-warning">
                            <strong>No student selected.</strong> Please search for a student first.
                            <a href="fees_searchby_name.php" class="btn-fluent-primary mt-2">Search Student</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Fee Collection</h6>
                    </div>
                    <div class="widget_content p-4">
                        <form action="add_student_fees.php" method="post">
                            <input type="hidden" name="registration_no" value="<?php echo htmlspecialchars($reg_no); ?>">
                            <input type="hidden" name="pending_amount" value="<?php echo $pending_balance; ?>">

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Registration No</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($reg_no); ?>" readonly style="background:#f1f5f9;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Student Name</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['student_name']); ?>" readonly style="background:#f1f5f9;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Class</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['class_name'] ?? 'N/A'); ?>" readonly style="background:#f1f5f9;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-danger">Pending Balance</label>
                                    <input type="text" class="form-control fw-bold" value="<?php echo number_format($pending_balance, 2); ?>" readonly style="background:#fff5f5; border-color:#feb2b2;">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Fee Term <span class="text-danger">*</span></label>
                                    <select name="fees_term" class="form-control" required>
                                        <option value="">-- Select Term --</option>
                                        <?php
                                        $terms = mysqli_query($conn, "SELECT * FROM fees_term");
                                        while ($t = mysqli_fetch_assoc($terms)) {
                                            echo "<option value='{$t['id']}'>{$t['term_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Amount to Pay <span class="text-danger">*</span></label>
                                    <input type="number" name="fees_amount" step="0.01" class="form-control" placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="submit" class="btn-fluent-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" fill="currentColor"/>
                                    </svg>
                                    Post Payment
                                </button>
                                <a href="fees_manager.php" class="btn-fluent-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/>
                                    </svg>
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
