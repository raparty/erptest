<?php
declare(strict_types=1);

/**
 * ID 2.13: Account Reporting Hub
 * Updated Date Picker: MM/DD/YYYY Format
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Default to current month range in MM/DD/YYYY for the display
$date_from = $_SESSION['report_date_from'] ?? date('m/01/Y'); 
$date_to = $_SESSION['report_date_to'] ?? date('m/d/Y');      
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Financial Operations Report</h3>
        <button onclick="window.print()" class="btn-outline-secondary">Print PDF</button>
    </div>

    <div class="azure-card" style="margin-bottom: 30px; padding: 25px;">
        <form action="" method="post" class="fluent-search-form">
            <div style="display: grid; grid-template-columns: 1fr 1fr 150px; gap: 20px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 8px;">From (MM/DD/YYYY)</label>
                    <div class="input-with-icon">
                        <input type="text" name="date_from" id="date_from" class="form-control fluent-input datepicker" 
                               value="<?php echo htmlspecialchars($date_from); ?>" readonly required>
                        <svg class="input-icon" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                    </div>
                </div>
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 8px;">To (MM/DD/YYYY)</label>
                    <div class="input-with-icon">
                        <input type="text" name="date_to" id="date_to" class="form-control fluent-input datepicker" 
                               value="<?php echo htmlspecialchars($date_to); ?>" readonly required>
                        <svg class="input-icon" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                    </div>
                </div>
                <button type="submit" name="entry_submit" class="btn-fluent-primary" style="height: 42px;">Generate</button>
            </div>
        </form>
    </div>

    <div class="widget_wrap azure-card">
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 120px;">Date</th>
                        <th>Transaction Title</th>
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

<style>
    .input-with-icon { position: relative; }
    .input-with-icon .input-icon { 
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%); 
        width: 18px; height: 18px; fill: var(--app-muted); pointer-events: none;
    }
    .datepicker { cursor: pointer; background-color: #fff !important; }
</style>

<script type="text/javascript">
$(document).ready(function() {
    $(".datepicker").datepicker({
        dateFormat: 'mm/dd/yy', // This sets the UI display to MM/DD/YYYY
        changeMonth: true,
        changeYear: true,
        showAnim: "slideDown"
    });
});
</script>

<?php require_once("includes/footer.php"); ?>
