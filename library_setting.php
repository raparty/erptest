<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Library Management</h3>
            
            <?php include_once("includes/library_setting_sidebar.php"); ?>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Library Settings Dashboard</h6>
                    </div>
                    <div class="widget_content settings-dashboard" style="padding: 30px; text-align: center;">
                        <h2 style="margin-bottom: 15px;">Welcome to Library Settings</h2>
                        <p style="color: #666; font-size: 14px;">
                            Use the navigation sidebar to manage library books, categories, fines, and student book records.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
