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
            <h3 style="padding-left:20px; color:#0078D4; padding-top:10px;">Subject Allocation List</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6 style="display:inline-block">Class-Subject Links</h6>
                        <div style="float:right; padding: 5px;">
                            <a href="add_allocate_subject.php" class="btn_small btn_blue"><span>+ Allocate Subject</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Class</th>
                                    <th>Stream</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // Joining 4 tables for a complete view
                                $sql = "SELECT asub.id, c.class_name, sub.subject_name, COALESCE(st.stream_name, 'General') as stream_name
                                        FROM allocate_class_subject asub
                                        JOIN classes c ON asub.class_id = c.id
                                        JOIN subjects sub ON asub.subject_id = sub.id
                                        LEFT JOIN streams st ON asub.stream_id = st.id
                                        ORDER BY c.class_name ASC, stream_name ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><?php echo htmlspecialchars($row['class_name']); ?></td>
                                    <td class="center"><em><?php echo htmlspecialchars($row['stream_name']); ?></em></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['subject_name']); ?></strong></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_allocate_subject.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_allocate_subject.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Remove this subject link?')">Delete</a></span>
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
