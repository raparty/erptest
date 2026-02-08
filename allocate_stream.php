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
            <h3 style="padding:10px 0 0 20px; color:#0078D4">Class-Stream Link Detail</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6 style="display:inline-block">Linked Streams</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="add_allocate_stream.php" class="btn_small btn_blue"><span>+ Allocate Stream</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Class Name</th>
                                    <th>Stream Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sql = "SELECT acs.id, c.class_name, s.stream_name 
                                        FROM allocate_class_stream acs
                                        JOIN classes c ON acs.class_id = c.id
                                        JOIN streams s ON acs.stream_id = s.id
                                        ORDER BY c.class_name ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['class_name']); ?></strong></td>
                                    <td class="center"><?php echo htmlspecialchars($row['stream_name']); ?></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_allocate_stream.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_allocate_stream.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Remove this stream allocation?')">Delete</a></span>
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
