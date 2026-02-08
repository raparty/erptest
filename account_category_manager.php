<?php
declare(strict_types=1);

/**
 * ID 2.11: Account Type Manager
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Financial Accounts</h3>
        <a href="add_account_category_manager.php" class="btn-fluent-primary">+ New Account Type</a>
    </div>

    <?php include_once("includes/account_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Income & Expense Types</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">S.No.</th>
                        <th>Account Title</th>
                        <th class="center">Category Type</th>
                        <th class="center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $res = db_query("SELECT * FROM account_category ORDER BY category_name ASC");
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['category_name']); ?></td>
                        <td class="center">
                            <span class="fluent-badge-outline" style="<?php echo ($row['category_type']=="Income") ? 'background:#ecfdf5;color:#065f46;border-color:#10b981;' : 'background:#fff1f2;color:#9f1239;border-color:#f43f5e;'; ?>">
                                <?php echo $row['category_type']; ?>
                            </span>
                        </td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="edit_account_category_manager.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon" title="Edit">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="delete_account_category_manager.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Deleting this account type may break financial reports. Proceed?')" title="Delete">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
