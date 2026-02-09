<?php
declare(strict_types=1);

// Enable error reporting to diagnose database mismatches immediately
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
    $book_number = mysqli_real_escape_string($conn, trim((string)$_POST['book_number']));
    $book_category_id = (int)$_POST['book_category_id'];
    $book_name = mysqli_real_escape_string($conn, trim((string)$_POST['book_name']));
    $book_description = mysqli_real_escape_string($conn, trim((string)$_POST['book_description']));
    $book_author = mysqli_real_escape_string($conn, trim((string)$_POST['book_author']));

    // Check for existing book number excluding current record - using pluralized 'book_managers'
    $sql_check = "SELECT * FROM book_managers WHERE book_number = '$book_number' AND book_id != '$sid'";
    $res_check = mysqli_query($conn, $sql_check);

    if ($res_check && mysqli_num_rows($res_check) == 0) {
        $sql_update = "UPDATE book_managers SET 
                       `book_number` = '$book_number', 
                       `book_category_id` = '$book_category_id', 
                       `book_name` = '$book_name', 
                       `book_description` = '$book_description', 
                       `book_author` = '$book_author' 
                       WHERE `book_id` = '$sid'";
        
        if (mysqli_query($conn, $sql_update)) {
            // JS redirect prevents blank page issues from header conflicts
            echo "<script>window.location.href='library_book_manager.php?msg=3';</script>";
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Update Error: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Book Number '$book_number' already exists.</div>";
    }
}

// Fetch existing data
if (empty($sid)) {
    echo "<script>window.location.href='library_book_manager.php';</script>";
    exit;
}

$sql_fetch = "SELECT * FROM book_managers WHERE `book_id` = '$sid'";
$res_fetch = mysqli_query($conn, $sql_fetch);
$row2 = mysqli_fetch_assoc($res_fetch);

if (!$row2) {
    echo "<script>window.location.href='library_book_manager.php?error=notfound';</script>";
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
                        <h6>Edit Book Detail</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <?php if ($msg != "") echo $msg; ?>
                        
                        <form action="library_edit_book.php?sid=<?php echo htmlspecialchars($sid); ?>" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Category <span style="color:red;">*</span></label>
                                    <select name="book_category_id" style="width:100%;" required>
                                        <option value="">-- Select Category --</option>
                                        <?php
                                        // Fetching from your modernized 'library_categories' table
                                        $sql_cat = "SELECT * FROM library_categories ORDER BY category_name ASC";
                                        $res_cat = mysqli_query($conn, $sql_cat);
                                        while ($row_cat = mysqli_fetch_assoc($res_cat)) {
                                            $selected = ($row2['book_category_id'] == $row_cat['category_id']) ? 'selected' : '';
                                            echo '<option value="' . $row_cat['category_id'] . '" ' . $selected . '>' . htmlspecialchars($row_cat['category_name']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Book Number <span style="color:red;">*</span></label>
                                    <input name="book_number" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row2['book_number']); ?>" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Book Name <span style="color:red;">*</span></label>
                                    <input name="book_name" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row2['book_name']); ?>" required />
                                </div>
                                <div class="col-md-6">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Author Name</label>
                                    <input name="book_author" type="text" style="width:100%;" value="<?php echo htmlspecialchars((string)$row2['book_author']); ?>" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label style="display:block; margin-bottom:5px; font-weight:bold;">Description</label>
                                    <textarea name="book_description" rows="4" style="width:100%;"><?php echo htmlspecialchars((string)$row2['book_description']); ?></textarea>
                                </div>
                            </div>

                            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                                <button type="submit" name="submit" class="btn_small btn_blue">
                                    <span>Update Book</span>
                                </button>
                                <a href="library_book_manager.php" class="btn_small btn_orange" style="margin-left:10px;">
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
