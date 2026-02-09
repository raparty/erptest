<?php
declare(strict_types=1);

// Enable error reporting to catch database connectivity issues
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$msg = "";

if (isset($_POST['submit'])) {
    $category_name = mysqli_real_escape_string($conn, trim((string)$_POST['category_name']));

    if (!empty($category_name)) {
        // Updated to pluralized table name 'library_categories'
        $sql_check = "SELECT * FROM library_categories WHERE category_name = '$category_name'";
        $res_check = mysqli_query($conn, $sql_check);

        if ($res_check && mysqli_num_rows($res_check) == 0) {
            $sql_ins = "INSERT INTO library_categories (category_name) VALUES ('$category_name')";
            if (mysqli_query($conn, $sql_ins)) {
                // JS redirect prevents blank pages from header conflicts
                echo "<script>window.location.href='library_book_category.php?msg=1';</script>";
                exit;
            } else {
                $msg = "<div class='alert alert-danger'>Database Error: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Category '$category_name' already exists.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Please enter a Category Name.</div>";
    }
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Add Book Category</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_add_book_category.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Category Name <span style="color:red;">*</span></label>
                                    <input name="category_name" type="text" style="width:100%;" placeholder="e.g. Reference, Fiction, Science" required />
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                                <button type="submit" name="submit" class="btn_small btn_blue">
                                    <span>Save Category</span>
                                </button>
                                <a href="library_book_category.php" class="btn_small btn_orange" style="margin-left:10px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
