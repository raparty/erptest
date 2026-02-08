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
                        <h6 style="display:inline-block">Subject Management</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="add_subject.php" class="btn_small btn_blue"><span>+ Add New Subject</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Subject Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sql = "SELECT * FROM subjects ORDER BY id ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['subject_name']); ?></strong></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_subject.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_subject.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Delete this subject?')">Delete</a></span>
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
