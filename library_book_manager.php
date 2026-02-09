<?php
declare(strict_types=1);

// Enable error reporting to identify any hidden SQL mismatches
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$conn = Database::connection();
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            
            <?php include_once("includes/library_setting_sidebar.php"); ?>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Books Detail</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="library_add_book.php" class="btn_small btn_blue">
                                <span>+ Add Book Detail</span>
                            </a>
                        </div>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">S.No.</th>
                                    <th>Book Name</th>
                                    <th>Author</th>
                                    <th>Book No.</th>
                                    <th>Category</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // Querying the modernized pluralized table
                                $sql = "SELECT * FROM book_managers ORDER BY book_name ASC";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        // FETCH CATEGORY: Updated to use 'category_id' instead of 'library_category_id'
                                        $cat_id = (int)$row['book_category_id'];
                                        $sql_cat = "SELECT category_name FROM library_categories WHERE category_id = '$cat_id'";
                                        $res_cat = mysqli_query($conn, $sql_cat);
                                        $cat_data = mysqli_fetch_assoc($res_cat);
                                        
                                        // Display the name or a fallback if the ID doesn't exist
                                        $category_display = $cat_data['category_name'] ?? "Uncategorized";
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars((string)$row['book_name']); ?></strong></td>
                                    <td class="center"><?php echo htmlspecialchars((string)$row['book_author']); ?></td>
                                    <td class="center"><?php echo htmlspecialchars((string)$row['book_number']); ?></td>
                                    <td class="center">
                                        <span class="badge" style="background:#e3f2fd; color:#1976d2; padding:2px 8px; border-radius:4px;">
                                            <?php echo htmlspecialchars($category_display); ?>
                                        </span>
                                    </td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="library_edit_book.php?sid=<?php echo $row['book_id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="library_delete_book.php?sid=<?php echo $row['book_id']; ?>" title="Delete" onClick="return confirm('Delete this book record?')">Delete</a></span>
                                    </td>
                                </tr>
                                <?php 
                                        $i++; 
                                    } 
                                } else { ?>
                                    <tr>
                                        <td colspan="6" class="center" style="padding: 40px; color: #999;">No books found.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
