<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
$msg = "";
$current_date = date('Y-m-d');

// 1. Handle Attendance Submission
if (isset($_POST['save_attendance'])) {
    $date = mysqli_real_escape_string($conn, $_POST['att_date']);
    $attendance_data = $_POST['status']; // Array of staff_id => status

    foreach ($attendance_data as $staff_id => $status) {
        $staff_id = (int)$staff_id;
        $status = mysqli_real_escape_string($conn, $status);
        
        // Check if attendance for this person on this date already exists
        $check = mysqli_query($conn, "SELECT id FROM staff_attendance WHERE staff_id = $staff_id AND att_date = '$date'");
        
        if (mysqli_num_rows($check) > 0) {
            $sql = "UPDATE staff_attendance SET status = '$status' WHERE staff_id = $staff_id AND att_date = '$date'";
        } else {
            $sql = "INSERT INTO staff_attendance (staff_id, att_date, status) VALUES ($staff_id, '$date', '$status')";
        }
        mysqli_query($conn, $sql);
    }
    $msg = "<div class='alert alert-success'><h4>Attendance for $date saved successfully!</h4></div>";
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <h3 style="padding:20px 0 10px 20px; color:#0078D4; border-bottom:1px solid #e2e8f0;">Daily Staff Attendance Register</h3>
                <?php echo $msg; ?>
            </div>

            <div class="grid_12">
                <form action="#" method="post" class="form_container">
                    <div class="widget_wrap">
                        <div class="widget_top" style="display:flex; justify-content: space-between; align-items:center; padding: 0 20px;">
                            <h6>Staff List</h6>
                            <div style="color:#fff;">
                                Date: <input type="date" name="att_date" value="<?php echo $current_date; ?>" style="padding:5px; border-radius:4px; border:none;">
                            </div>
                        </div>
                        <div class="widget_content">
                            <table class="display data_tbl">
                                <thead>
                                    <tr>
                                        <th>Emp ID</th>
                                        <th>Staff Name</th>
                                        <th>Department</th>
                                        <th style="text-align:center;">Status (Present / Absent / Leave)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Join with staff_employee table we fixed yesterday
                                    $sql = "SELECT e.staff_id, e.emp_id, e.first, e.last, d.staff_department 
                                            FROM staff_employee e 
                                            LEFT JOIN staff_department d ON e.staff_department_id = d.staff_department_id 
                                            ORDER BY e.first ASC";
                                    $res = mysqli_query($conn, $sql);
                                    
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['emp_id']); ?></td>
                                        <td><strong><?php echo htmlspecialchars($row['first'] . " " . $row['last']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($row['staff_department'] ?? 'N/A'); ?></td>
                                        <td class="center">
                                            <input type="radio" name="status[<?php echo $row['staff_id']; ?>]" value="Present" checked> P &nbsp;
                                            <input type="radio" name="status[<?php echo $row['staff_id']; ?>]" value="Absent"> A &nbsp;
                                            <input type="radio" name="status[<?php echo $row['staff_id']; ?>]" value="Leave"> L
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div style="padding: 20px; border-top: 1px solid #eee; text-align:right;">
                                <button type="submit" name="save_attendance" class="btn_small btn_blue"><span>Submit Attendance</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
