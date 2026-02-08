<?php
declare(strict_types=1);

/**
 * ID 2.13: Daily Financial Summary
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Daily Operations Report</h3>
        <button onclick="window.print()" class="btn-outline-secondary">Download PDF</button>
    </div>

    <div class="azure-card" style="margin-bottom: 30px; padding: 20px;">
        <form action="" method="post">
            <div style="display: grid; grid-template-columns: 1fr 1fr 150px; gap: 20px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Statement From</label>
                    <input type="date" name="date_from" class="form-control fluent-input" required>
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Statement To</label>
                    <input type="date" name="date_to" class="form-control fluent-input" required>
                </div>
                <button type="submit" name="entry_submit" class="btn-fluent-primary" style="height: 42px;">Generate</button>
            </div>
        </form>
    </div>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Consolidated Financial Statement</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Reference</th>
                        <th class="center">Inflow</th>
                        <th class="center">Outflow</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
