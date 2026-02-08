<?php
declare(strict_types=1);

/**
 * ID 2.1: Fees Receipt View
 * Group 2: Fees & Accounts
 */
require_once("config/config.inc.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fees Receipt - Institutional Portal</title>
    <link rel="stylesheet" href="css/enterprise.css">
    <style>
        body { background: #fff; padding: 40px; }
        .receipt-container { max-width: 800px; margin: 0 auto; border: 1px solid #e2e8f0; padding: 40px; border-radius: 8px; }
        .receipt-header { display: flex; justify-content: space-between; border-bottom: 2px solid var(--app-primary); padding-bottom: 20px; margin-bottom: 30px; }
        .receipt-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .receipt-table th { background: #f8fafc; text-align: left; padding: 12px; border: 1px solid #e2e8f0; font-size: 13px; text-transform: uppercase; color: var(--app-muted); }
        .receipt-table td { padding: 12px; border: 1px solid #e2e8f0; color: var(--fluent-slate); }
        @media print { #hidebutton { display: none !important; } body { padding: 0; } .receipt-container { border: none; } }
    </style>
</head>
<body>

<div class="receipt-container">
    <div class="receipt-header">
        <div>
            <h2 style="color: var(--app-primary); margin: 0;">OFFICIAL FEES RECEIPT</h2>
            <p style="color: var(--app-muted); font-size: 14px;">Academic Session: <?php echo $_SESSION['session']; ?></p>
        </div>
        <div style="text-align: right;">
            <p><strong>Date:</strong> <?php echo date('d-M-Y'); ?></p>
        </div>
    </div>

    <?php
    $reg_no = db_escape($_GET['registration_no'] ?? '');
    $sql_student = "SELECT a.*, c.class_name FROM admissions a LEFT JOIN classes c ON a.class_id = c.id WHERE a.reg_no = '$reg_no'";
    $student = db_fetch_array(db_query($sql_student));
    ?>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <div>
            <p style="color: var(--app-muted); font-size: 12px; text-transform: uppercase; font-weight: 700;">Student Details</p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['student_name']); ?></p>
            <p><strong>Reg No:</strong> <?php echo htmlspecialchars($student['reg_no']); ?></p>
            <p><strong>Class:</strong> <?php echo htmlspecialchars($student['class_name']); ?></p>
        </div>
        <div style="text-align: right;">
            <p style="color: var(--app-muted); font-size: 12px; text-transform: uppercase; font-weight: 700;">Payment Summary</p>
            <p><strong>Status:</strong> <span style="color: #059669; font-weight: 700;">PAID</span></p>
        </div>
    </div>

    <table class="receipt-table">
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Institutional Tuition Fees</td>
                <td style="text-align: right;">₹<?php echo number_format(5000, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div id="hidebutton" style="margin-top: 50px; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 30px;">
        <a href="fees_manager.php" class="btn-outline-secondary" style="text-decoration: none; display: inline-block; padding: 10px 25px;">Close Receipt</a>
        <button onclick="window.print()" class="btn-fluent-primary" style="margin-left: 15px; padding: 10px 25px; border: none; cursor: pointer;">Print Receipt</button>
    </div>
</div>

</body>
</html>
