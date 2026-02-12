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
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Institutional Identity</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6 style="display:inline-block; margin-left: 10px;">School Profile</h6>
                        <div class="float-end">
                            <a href="add_school_detail.php" class="btn_small btn_blue"><span>+ Update School Info</span></a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Logo</th>
                                    <th>School Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sql = "SELECT * FROM school_details ORDER BY id ASC";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center">
                                        <img src="school_logo/<?php echo htmlspecialchars($row['school_logo']); ?>" width="60" height="60" style="border-radius: 4px; border: 1px solid #ddd;" />
                                    </td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['school_name']); ?></strong></td>
                                    <td class="center">
                                        <span><a class="action-icons c-edit" href="edit_school_detail.php?sid=<?php echo $row['id']; ?>" title="Edit">Edit</a></span>
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
