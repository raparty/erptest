<?php
declare(strict_types=1);

/**
 * ID 4.3: Final Student Marksheet (Printable)
 * Group 4: Examinations
 */
require_once("config/config.inc.php");
ob_start();

$reg_no = db_escape($_GET['registration_no'] ?? '');
// Logic for gathering scores, calculating totals, and percentages
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academic Report Card</title>
    <link rel="stylesheet" href="css/enterprise.css">
    <style>
        body { background: #fff; padding: 40px; font-family: 'Segoe UI', sans-serif; }
        .marksheet-container { max-width: 900px; margin: 0 auto; border: 2px solid #333; padding: 40px; position: relative; }
        .report-header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .student-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .fluent-report-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .fluent-report-table th, .fluent-report-table td { border: 1px solid #333; padding: 10px; text-align: center; }
        .fluent-report-table th { background: #f3f4f6; text-transform: uppercase; font-size: 12px; }
        .summary-box { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; border: 1px solid #333; }
        .summary-item { border-right: 1px solid #333; padding: 15px; text-align: center; }
        .summary-item:last-child { border-right: none; }
        @media print { #hidebutton { display: none !important; } .marksheet-container { border: none; } }
    </style>
</head>
<body>

<div class="marksheet-container">
    <div class="report-header">
        <h1 style="margin:0; font-size: 28px;">PROGRESS REPORT</h1>
        <p style="margin:5px 0;">Academic Session: <?php echo $_SESSION['session']; ?></p>
    </div>

    <div class="student-meta">
        <div>
            <p><strong>Student Name:</strong> <?php echo $student_name; ?></p>
            <p><strong>Registration No:</strong> <?php echo $reg_no; ?></p>
        </div>
        <div style="text-align: right;">
            <p><strong>Class:</strong> <?php echo $class_name; ?></p>
            <p><strong>Examination:</strong> Final Term</p>
        </div>
    </div>

    <table class="fluent-report-table">
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Maximum Marks</th>
                <th>Obtained Marks</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mathematics</td>
                <td>100</td>
                <td>85</td>
                <td>Pass</td>
            </tr>
        </tbody>
    </table>

    <div class="summary-box">
        <div class="summary-item"><strong>Grand Total:</strong><br>500 / 600</div>
        <div class="summary-item"><strong>Percentage:</strong><br>83.33%</div>
        <div class="summary-item"><strong>Division:</strong><br>I Division</div>
        <div class="summary-item"><strong>Result:</strong><br><span style="color:#059669; font-weight:bold;">PASSED</span></div>
    </div>

    <div id="hidebutton" style="margin-top: 50px; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 30px;">
        <a href="entry_exam_marksheet.php" class="btn-outline-secondary" style="text-decoration: none; display: inline-block; padding: 10px 25px;">Back to Selection</a>
        <button onclick="window.print()" class="btn-fluent-primary" style="margin-left: 15px; padding: 10px 25px; border: none; cursor: pointer;">Print Report Card</button>
    </div>
</div>

</body>
</html>
