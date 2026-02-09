<?php
declare(strict_types=1);

// Enable error reporting to catch database mismatches
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
$sid = isset($_GET['sid']) ? mysqli_real_escape_string($conn, (string)$_GET['sid']) : '';
$msg = "";

// Process Update Logic
if (isset($_POST['submit'])) {
    $category_name = mysqli_real_escape_string($conn, trim((string)$_POST['category_name']));

    // Check for duplicates (excluding the current record)
    $sql_check = "SELECT * FROM library_categories WHERE category_name = '$category_name' AND category_id != '$sid'";
    $res_check = mysqli_query($conn, $sql_check);
    
    if ($res_check && mysqli_num_rows($res_check) == 0) {
        $sql_update = "UPDATE library_categories SET `category_name` = '$category_name' WHERE category_id = '$sid'";
        
        if (mysqli_query($conn, $sql_update)) {
            // JS redirect prevents the blank page "headers already sent" issue
            echo "<script>window.location.href='library_book_category.php?msg=3';</script>";
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Update Error: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Category name already exists.</div>";
    }
}

// Fetch existing data
if (empty($sid)) {
    echo "<script>window.location.href='library_book_category.php';</script>";
    exit;
}

$sql_fetch = "SELECT * FROM library_categories WHERE category_id = '$sid'";
$res_fetch = mysqli_query($conn, $sql_fetch);
$row = mysqli_fetch_array($res_fetch);

if (!$row) {
    echo "<script>window.location.href='library_book_category.php?error=notfound';</script>";
    exit;
}
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Edit Category Detail</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_edit_book_category.php?sid=<?php echo htmlspecialchars($sid); ?>" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Category Name <span style="color:red;">*</span></label>
                                    <input name="category_name" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row['category_name']); ?>" required />
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                                <button type="submit" name="submit" class="btn_small btn_blue">
                                    <span>Update Category</span>
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
