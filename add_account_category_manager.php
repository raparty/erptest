<?php
declare(strict_types=1);

/**
 * ID 2.10: Add Financial Category
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Form processing remains untouched
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Create Category</h3>
        <a href="account_category_manager.php" class="btn-outline-secondary">Back to List</a>
    </div>

    <div class="azure-card" style="max-width: 800px; margin: 0 auto;">
        <div class="widget_top">
            <h6 class="fluent-card-header">Category Details</h6>
        </div>
        <div class="widget_content" style="padding: 30px;">
            <form action="" method="post">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Category Name</label>
                        <input name="category_name" type="text" class="form-control fluent-input" placeholder="e.g. Maintenance Fees" required>
                    </div>
                    <div class="form_group">
                        <label style="font-weight: 600; display: block; margin-bottom: 8px;">Type</label>
                        <select name="category_type" class="form-control fluent-input" required>
                            <option value=""> - Select - </option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                </div>

                <div class="fluent-action-group" style="margin-top: 30px; border-top: 1px solid var(--app-border); padding-top: 20px;">
                    <button type="submit" name="submit" class="btn-fluent-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
