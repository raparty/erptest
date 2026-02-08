<?php
declare(strict_types=1);

/**
 * ID 2.6: Transport Arrears (Pending) Report
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Transport Arrears List</h3>
        <button onclick="window.print()" class="btn-outline-secondary">Print List</button>
    </div>

    <div class="azure-card" style="margin-bottom: 30px; padding: 20px;">
        <form action="" method="post">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 120px; gap: 15px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Target Class</label>
                    <select name="class" class="form-control fluent-input" required>
                        </select>
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Fee Month/Term</label>
                    <select name="fees_term" class="form-control fluent-input" required>
                        </select>
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Student Name (Optional)</label>
                    <input name="name" type="text" class="form-control fluent-input" placeholder="Partial search...">
                </div>
                <button type="submit" class="btn-fluent-primary" style="height: 42px;">Filter</button>
            </div>
        </form>
    </div>

    <div class="widget_wrap azure-card">
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Unpaid Month</th>
                        <th>Package Amt</th>
                        <th class="center" style="color: #ef4444;">Pending Bal</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
