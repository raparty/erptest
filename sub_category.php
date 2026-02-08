<?php
declare(strict_types=1);

/**
 * ID 2.10: Sub Category Manager
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3>Sub Categories</h3>
        <a href="add_sub_category.php" class="btn-fluent-primary">+ New Sub Category</a>
    </div>

    <?php include_once("includes/account_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Secondary Classifications</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">S.No.</th>
                        <th>Super Category</th>
                        <th>Sub Category Name</th>
                        <th class="center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    $sql = "SELECT sub.*, sup.category_name as super_name 
                            FROM sub_category sub 
                            LEFT JOIN super_category sup ON sub.super_cat_id = sup.id 
                            ORDER BY sub.sub_category_name ASC";
                    $res = db_query($sql);
                    while($row = db_fetch_array($res)) { ?>
                    <tr>
                        <td class="center"><?php echo $i; ?></td>
                        <td><span class="fluent-badge-outline"><?php echo htmlspecialchars($row['super_name']); ?></span></td>
                        <td style="font-weight: 600; color: var(--app-primary);"><?php echo htmlspecialchars($row['sub_category_name']); ?></td>
                        <td class="center">
                            <div class="fluent-action-group">
                                <a href="edit_sub_category.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon" title="Edit">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                </a>
                                <a href="delete_sub_category.php?sid=<?php echo $row[0]; ?>" class="fluent-btn-icon icon-delete" onclick="return confirm('Delete this sub category?')" title="Delete">
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
