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
            
            <div class="grid_12" style="margin-bottom: 20px;">
                <div style="background: #fff; padding: 15px 20px; border-radius: 8px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <div>
                        <h3 style="margin: 0; color: #1e293b; font-size: 18px;">Staff Departments</h3>
                        <p style="margin: 0; color: #64748b; font-size: 12px;">Manage academic and administrative divisions</p>
                    </div>
                    <div>
                        <a href="add_staff_department.php" class="btn_small btn_blue" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px;">
                            <span style="font-size: 18px; font-weight: bold;">+</span>
                            <span>Add New Department</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Department Inventory</h6>
                    </div>
                   
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th style="width:50px;">S.No.</th>
                                    <th>Department Name</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sql = "SELECT * FROM staff_department ORDER BY staff_department ASC";
                                $res = mysqli_query($conn, $sql);
                                
                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        
                                        /* FIX: We check for multiple possible ID column names to ensure 
                                           the URL is never empty
                                        */
                                        $did = $row['id'] ?? $row['staff_department_id'] ?? $row['staff_dept_id'] ?? 0;
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i++; ?></td>
                                    <td><strong><?php echo htmlspecialchars((string)$row['staff_department']); ?></strong></td>
                                    <td class="center">
                                        <span>
                                            <a class="action-icons c-edit" 
                                               href="edit_staff_department.php?id=<?php echo (int)$did; ?>" 
                                               title="Edit">Edit</a>
                                        </span> 
                                        <span>
                                            <a class="action-icons c-delete" 
                                               href="delete_staff_department.php?id=<?php echo (int)$did; ?>" 
                                               title="Delete" 
                                               onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                                        </span>
                                    </td>
                                </tr>
                                <?php 
                                    } 
                                } else { ?>
                                    <tr>
                                        <td colspan="3" class="center" style="padding:20px; color:#64748b;">No departments found.</td>
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
