<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
require_once("includes/pagination_helper.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();

// Pagination settings
$items_per_page = 20;
$current_page = (int)($_GET['page'] ?? 1);
$current_page = max(1, $current_page);
$offset = ($current_page - 1) * $items_per_page;

// Get total count
$count_sql = "SELECT COUNT(*) as total FROM library_categories";
$count_res = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_res);
$total_items = (int)$count_row['total'];
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            
            <?php include_once("includes/library_setting_sidebar.php"); ?>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Book Category Detail</h6>
                        <div class="float-end" style=" padding: 5px;">
                            <a href="library_add_book_category.php" class="btn_small btn_blue">
                                <span>+ Add Category</span>
                            </a>
                        </div>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">S.No.</th>
                                    <th>Category Name</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Query with pagination
                                $sql = "SELECT * FROM library_categories ORDER BY category_name ASC LIMIT $offset, $items_per_page";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    $i = $offset + 1;
                                    while($row = mysqli_fetch_assoc($res)) { ?>		
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="center"><strong><?php echo htmlspecialchars((string)$row['category_name']); ?></strong></td>
                                        <td class="center">
                                            <div style="display: flex; gap: 5px; justify-content: center;">
                                                <a class="action-icons c-edit" href="library_edit_book_category.php?sid=<?php echo $row['category_id']; ?>" title="Edit">Edit</a>
                                                <a class="action-icons c-delete" href="library_delete_book_category.php?sid=<?php echo $row['category_id']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; } 
                                } else { ?>
                                    <tr>
                                        <td colspan="3" class="center" style="padding: 30px; color: #888;">No categories found. Click "Add Category" to get started.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                        <?php 
                        // Display pagination
                        echo generate_pagination($current_page, $total_items, $items_per_page, 'library_book_category.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
