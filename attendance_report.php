<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();

// Set default month and year to current if not selected
$selected_month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <h3 style="padding:20px 0 10px 20px; color:#0078D4; border-bottom:1px solid #e2e8f0;">Staff Attendance Report</h3>
            </div>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_content" style="padding: 20px; background: #f8f9fa;">
                        <form action="" method="get" style="display: flex; gap: 15px; align-items: center;">
                            <label><strong>Month:</strong></label>
                            <select name="month" style="padding: 5px;">
                                <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $month_name = date('F', mktime(0, 0, 0, $m, 1));
                                    $selected = ($m == $selected_month) ? 'selected' : '';
                                    echo "<option value='$m' $selected>$month_name</option>";
                                }
                                ?>
                            </select>

                            <label><strong>Year:</strong></label>
                            <select name="year" style="padding: 5px;">
                                <?php
                                $start_year = (int)date('Y') - 5;
                                for ($y = $start_year; $y <= (int)date('Y') + 1; $y++) {
                                    $selected = ($y == $selected_year) ? 'selected' : '';
                                    echo "<option value='$y' $selected>$y</option>";
                                }
                                ?>
                            </select>

                            <button type="submit" class="btn_small btn_blue"><span>Generate Report</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Summary for <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Department</th>
                                    <th style="text-align:center; color: green;">Present</th>
                                    <th style="text-align:center; color: red;">Absent</th>
                                    <th style="text-align:center; color: orange;">Leave</th>
                                    <th style="text-align:center; font-weight: bold;">Total Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Optimized query to calculate totals per staff
                                $sql = "SELECT e.first, e.last, d.staff_department,
                                        SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END) as total_present,
                                        SUM(CASE WHEN a.status = 'Absent' THEN 1 ELSE 0 END) as total_absent,
                                        SUM(CASE WHEN a.status = 'Leave' THEN 1 ELSE 0 END) as total_leave
                                        FROM staff_employee e
                                        LEFT JOIN staff_department d ON e.staff_department_id = d.staff_department_id
                                        LEFT JOIN staff_attendance a ON e.staff_id = a.staff_id 
                                        AND MONTH(a.att_date) = $selected_month 
                                        AND YEAR(a.att_date) = $selected_year
                                        GROUP BY e.staff_id
                                        ORDER BY e.first ASC";
                                
                                $res = mysqli_query($conn, $sql);
                                
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $total = (int)$row['total_present'] + (int)$row['total_absent'] + (int)$row['total_leave'];
                                ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($row['first'] . " " . $row['last']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['staff_department'] ?? 'N/A'); ?></td>
                                    <td class="center"><?php echo $row['total_present']; ?></td>
                                    <td class="center"><?php echo $row['total_absent']; ?></td>
                                    <td class="center"><?php echo $row['total_leave']; ?></td>
                                    <td class="center"><strong><?php echo $total; ?></strong></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
