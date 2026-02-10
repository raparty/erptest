<?php
declare(strict_types=1);

/**
 * ID 2.1: Fees Package Settings
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="page_title" style="background: transparent; box-shadow: none; border-bottom: 1px solid var(--app-border); border-radius: 0; margin-bottom: 30px;">
    <h3 style="font-weight: 400; color: var(--fluent-slate); font-size: 24px;">Fee Package Configuration</h3>
</div>

<?php include_once("includes/fees_setting_sidebar.php");?>

<div class="grid_container">
    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Available Fee Packages</h6>
            <div class="widget_actions">
                <a href="add_fees_package.php" class="btn-fluent-primary">+ Create New Package</a>
            </div>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Package Name</th>
                        <th>Total Amount</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $sql="SELECT * FROM fees_package";
                    $res=db_query($sql);
                    while($row=db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i;?></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td class="center">₹<?php echo number_format((float)$row['total_amount'], 2); ?></td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="edit_fees_package.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon" title="Edit Package">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="delete_fees_package.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Delete this package permanently?')" title="Delete">
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
