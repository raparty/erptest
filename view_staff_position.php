<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/staff_setting_sidebar.php");

$conn = Database::connection();
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding-left:20px; color:#0078D4">Staff Position List</h3>
            
            <div class="grid_12">
                <div class="btn_30_blue float-right">
                    <a href="add_staff_position.php"><span style="width:140px">Add Position </span></a>
                </div>
            </div>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Employee Designations</h6>
                    </div>
                   
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width:50px;">S.No.</th>
                                    <th>Staff Position Name</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // Querying the verified table 'staff_position'
                                $sql = "SELECT * FROM staff_position ORDER BY staff_position ASC";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center">
                                        <strong><?php echo htmlspecialchars((string)$row['staff_position']); ?></strong>
                                    </td>
                                    <td class="center">
                                        <span>
                                            <a class="action-icons c-edit" href="edit_staff_position.php?id=<?php echo $row['id']; ?>" title="Edit">Edit</a>
                                        </span> 
                                        <span>
                                            <a class="action-icons c-delete" href="delete_staff_position.php?id=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Delete this staff position?')">Delete</a>
                                        </span>
                                    </td>
                                </tr>
                                <?php 
                                        $i++; 
                                    } 
                                } else { ?>
                                    <tr>
                                        <td colspan="3" class="center" style="padding:30px; color:#888;">No staff positions found.</td>
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
