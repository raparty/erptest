<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <h3 style="padding:20px 0 10px 20px; color:#0078D4; border-bottom:1px solid #e2e8f0;">Attendance Management System</h3>
            </div>

            <div class="grid_6">
                <div class="widget_wrap azure-card" style="text-align: center; padding: 30px;">
                    <div class="icon_block violet_block" style="margin: 0 auto 20px auto; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <span class="item_icon"><span class="finished_work_sl"></span></span>
                    </div>
                    <h3 style="margin-bottom: 15px;">Attendance Register</h3>
                    <p style="color: #64748b; margin-bottom: 20px;">Mark daily attendance for students or staff members.</p>
                    <a href="attendance_register.php" class="btn_small btn_blue" style="text-decoration: none;">Take Attendance</a>
                </div>
            </div>

            <div class="grid_6">
                <div class="widget_wrap azure-card" style="text-align: center; padding: 30px;">
                    <div class="icon_block gray_block" style="margin: 0 auto 20px auto; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <span class="item_icon"><span class="lightbulb_sl"></span></span>
                    </div>
                    <h3 style="margin-bottom: 15px;">Attendance Reports</h3>
                    <p style="color: #64748b; margin-bottom: 20px;">View monthly summaries and generate percentage reports.</p>
                    <a href="attendance_report.php" class="btn_small btn_orange" style="text-decoration: none;">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
