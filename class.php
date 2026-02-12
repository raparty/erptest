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
                        
                        <h6 style="display:inline-block">Class Management</h6>
                        <div class="float-end">
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
                                        <span><a href="section.php?class_id=<?php echo $row['id']; ?>" class="action-icons c-add" title="Manage Sections"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>Sections</a></span>
                                        <span><a class="action-icons c-edit" href="edit_class.php?sid=<?php echo $row['id']; ?>" title="Edit"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_class.php?sid=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Delete this class?')"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>Delete</a></span>
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
