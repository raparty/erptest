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
            <h3 style="padding-left:20px; color:#0078D4; padding-top:10px;">Stream Management</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        
                        <h6 style="display:inline-block">Existing Streams</h6>
                        <div class="float-end">
                            <a href="add_stream.php" class="btn_small btn_blue"><span>+ Add New Stream</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Stream Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // Updated to match your 'streams' table
                                $sql = "SELECT * FROM streams ORDER BY id ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['stream_name']); ?></strong></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_stream.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_stream.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Delete this stream?')">Delete</a></span>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <span class="clear"></span>
        </div>
        <span class="clear"></span>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
