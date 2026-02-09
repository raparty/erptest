<?php
declare(strict_types=1);
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="page_title">
    <h3>Institutional Dashboard</h3>
    <div class="top_search">
        <form action="#" method="post">
            <ul id="search_box">
                <li><input name="search" type="text" class="search_input" placeholder="Search modules..."></li>
                <li><input name="submit" type="submit" value="Search" class="search_btn"></li>
            </ul>
        </form>
    </div>
</div>

<div class="grid_container">
    <div class="widget_wrap">
        <div class="widget_content">
            <div class="switch_bar">
                <ul>
                    <?php
                    // Adjusted Module List: Removed RTE Admission, kept Student TC
                    $modules = [
                        ['label' => 'School Setting', 'link' => 'school_setting.php', 'icon' => 'M12 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z'],
                        ['label' => 'Admission', 'link' => 'admission.php', 'icon' => 'M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z'],
                        ['label' => 'Student Details', 'link' => 'student_detail.php', 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'],
                        ['label' => 'Fees', 'link' => 'fees_setting.php', 'icon' => 'M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z'],
                        ['label' => 'Account', 'link' => 'account_setting.php', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z'],
                        ['label' => 'Examination', 'link' => 'exam_setting.php', 'icon' => 'M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z'],
                        ['label' => 'Transport', 'link' => 'transport_setting.php', 'icon' => 'M18 11V7c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h1c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h1c1.1 0 2-.9 2-2v-5c0-1.1-.9-2-2-2h-3zM8 19c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm10 0c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2-5h-3V8h3v6z'],
                        ['label' => 'Staff', 'link' => 'staff_setting.php', 'icon' => 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z'],
                        ['label' => 'Library', 'link' => 'library_setting.php', 'icon' => 'M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z'],
                        ['label' => 'Student TC', 'link' => 'entry_student_tc.php', 'icon' => 'M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm-2 16l-4-4h8l-4 4zm0-12.5L13.5 9H10.5L12 5.5z']
                    ];

                    foreach ($modules as $mod): ?>
                        <li>
                            <a href="<?php echo $mod['link']; ?>">
                                <div class="azure-icon-box">
                                    <svg viewBox="0 0 24 24" style="width:24px; height:24px; fill:var(--app-primary);"><path d="<?php echo $mod['icon']; ?>"/></svg>
                                </div>
                                <span class="label"><?php echo $mod['label']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
