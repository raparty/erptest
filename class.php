<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/school_setting_sidebar.php");
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon list_images"></span>
                        <h6 style="display:inline-block">Class Management</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="add_class.php" class="btn_small btn_blue"><span>+ Add New Class</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Class Name</th>
                                    <th>Stream Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sql = "SELECT * FROM classes ORDER BY id ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['class_name']); ?></strong></td>
                                    <td class="center"><?php echo ($row['stream_status'] == 1) ? "Yes" : "No"; ?></td>
                                    <td class="center">
                                        <a href="section.php?class_id=<?php echo $row['id']; ?>" class="action-icons c-add" title="Manage Sections">Sections</a> | 
                                        <a href="edit_class.php?sid=<?php echo $row['id']; ?>">Edit</a> | 
                                        <a href="delete_class.php?sid=<?php echo $row['id']; ?>" onclick="return confirm('Delete this class?')">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
