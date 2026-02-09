<?php
declare(strict_types=1);

// Enable error reporting to diagnose database issues
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
                        <h6>Fine Detail</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="library_add_fine.php" class="btn_small btn_blue">
                                <span>+ Add Fine Detail</span>
                            </a>
                        </div>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">S.No.</th>
                                    <th>Fine Rate</th>
                                    <th>Number Of Days</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $current_session = mysqli_real_escape_string($conn, (string)($_SESSION['session'] ?? ''));
                                
                                // Updated to pluralized table name if applicable
                                $sql = "SELECT * FROM library_fine_managers WHERE session = '$current_session' ORDER BY fine_id ASC";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) { ?>		
                                    <tr>
                                        <td class="center"><?php echo $i; ?></td>
                                        <td class="center"><strong><?php echo htmlspecialchars((string)$row['fine_rate']); ?></strong></td>
                                        <td class="center"><?php echo htmlspecialchars((string)$row['no_of_days']); ?></td>
                                        <td class="center">
                                            <span><a class="action-icons c-edit" href="library_edit_fine.php?sid=<?php echo $row['fine_id']; ?>" title="Edit">Edit</a></span>
                                            <span><a class="action-icons c-delete" href="library_delete_fine.php?sid=<?php echo $row['fine_id']; ?>" title="Delete" onClick="return confirm('Delete this fine record?')">Delete</a></span>
                                        </td>
                                    </tr>
                                    <?php $i++; } 
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="center" style="padding: 40px; color: #999;">No fine records found for the current session.</td>
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
