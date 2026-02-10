<?php
declare(strict_types=1);

/**
 * ID 2.3: Add New Fee Package
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Form Processing Logic Preserved
if(isset($_POST['submit'])) {
    $package_name = db_escape(trim((string)($_POST['package_name'] ?? '')));
    $package_fees = (float)($_POST['package_fees'] ?? 0);
    
    $check = db_query("SELECT * FROM fees_package WHERE package_name='$package_name'");
    if(db_num_rows($check) == 0) {
        if(!empty($package_name) && $package_fees > 0) {
            db_query("INSERT INTO fees_package(package_name, total_amount) VALUES ('$package_name', '$package_fees')");
            header("Location: fees_package.php?msg=1");
            exit;
        }
    }
}
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Create Fee Package</h3>
        <a href="fees_package.php" class="btn-outline-secondary">Back to List</a>
    </div>

    <div class="azure-card" style="max-width: 800px; margin: 0 auto;">
        <div class="widget_top">
            <h6 class="fluent-card-header">Package Details</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="" method="post">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Package Name</label>
                        <input name="package_name" type="text" class="form-control fluent-input" placeholder="e.g. Annual Tuition" required>
                    </div>
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Package Fees (₹)</label>
                        <input name="package_fees" type="number" step="0.01" class="form-control fluent-input" placeholder="0.00" required>
                    </div>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 20px;">
                    <button type="submit" name="submit" class="btn-fluent-primary">Save Package</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
