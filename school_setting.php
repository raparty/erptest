<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div class="page_title">
    
    <h3>Administrative Settings</h3>
    <div class="top_search">
        <form action="#" method="post">
            <ul id="search_box">
                <li><input name="search" type="text" class="search_input" id="suggest1" placeholder="Search modules..."></li>
                <li><input type="submit" value="Search" class="search_btn"></li>
            </ul>
        </form>
    </div>
</div>

<?php include_once("includes/school_setting_sidebar.php"); ?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12 full_block">
                <div class="widget_wrap">
                    <div class="widget_content settings-dashboard" style="text-align: center; padding: 40px 20px;">
                        <h2 style="color: #0078D4; font-size: 24px; margin-bottom: 10px;">School Settings Dashboard</h2>
                        <p style="color: #666; font-size: 14px; max-width: 600px; margin: 0 auto;">
                            Welcome to the configuration hub. Use the navigation cards above to manage institutional details, 
                            define your academic structure (Classes & Sections), or link Subjects and Streams to your grade levels.
                        </p>
                        
                        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px;">
                            <div style="background: #f0f7ff; padding: 15px 25px; border-radius: 8px; border: 1px solid #d0e3ff;">
                                <span style="display:block; font-size: 18px; font-weight: bold; color: #0078D4;">
                                    <?php echo db_num_rows(db_query("SELECT id FROM classes")); ?>
                                </span>
                                <span style="font-size: 12px; color: #555; text-transform: uppercase;">Active Classes</span>
                            </div>
                            <div style="background: #f0f7ff; padding: 15px 25px; border-radius: 8px; border: 1px solid #d0e3ff;">
                                <span style="display:block; font-size: 18px; font-weight: bold; color: #0078D4;">
                                    <?php echo db_num_rows(db_query("SELECT id FROM subjects")); ?>
                                </span>
                                <span style="font-size: 12px; color: #555; text-transform: uppercase;">Total Subjects</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; padding: 20px; color: #999; font-size: 11px;">
            Copyright © <?php echo date("Y"); ?> School ERP Management System
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
