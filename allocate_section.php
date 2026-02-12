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
            <h3 style="padding-left:20px; color:#0078D4; padding-top:10px;">Class-Section Allocation</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6 style="display:inline-block">Allocated Sections</h6>
                        <div class="float-end">
                            <a href="add_allocate_section.php" class="btn-fluent-primary"><span style="padding: 8px 16px; display: inline-block;">+ Allocate Section</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                // Joining 'allocate_class_section' with 'classes' and 'sections'
                                $sql = "SELECT acs.id, c.class_name, s.section_name 
                                        FROM allocate_class_section acs
                                        JOIN classes c ON acs.class_id = c.id
                                        JOIN sections s ON acs.section_id = s.id
                                        ORDER BY c.class_name ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['class_name']); ?></strong></td>
                                    <td class="center"><?php echo htmlspecialchars($row['section_name']); ?></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_allocate_section.php?sid=<?php echo $row['id']; ?>" title="Edit"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>Edit</a></span>
                                        <span><a class="action-icons c-delete" href="delete_allocate_section.php?sid=<?php echo $row['id']; ?>" title="Delete" onClick="return confirm('Remove this allocation?')"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>Delete</a></span>
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
