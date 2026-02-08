<?php
declare(strict_types=1);
require_once("includes/header.php");
require_once("includes/sidebar.php");
?>

<div class="dashboard-header-container">
    <h2 class="enterprise-title">Institutional Dashboard</h2>
    <div class="dashboard-search-wrapper">
        <form action="searchby_name.php" method="get" class="fluent-search-form">
            <div class="input-group shadow-sm">
                <input name="q" type="text" class="form-control fluent-input" placeholder="Search for students, modules, or staff records..." aria-label="Search modules">
                <button type="submit" class="btn-azure-search">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="white">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    <span>Search</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="grid_container">
    <div class="module-grid">
        <?php
        /**
         * Enterprise Module List
         * Removed RTE Admissions and verified Student TC path.
         */
        $modules = [
            ['label' => 'School Settings', 'link' => 'school_setting.php', 'icon' => 'M12 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z'],
            ['label' => 'Admission', 'link' => 'admission.php', 'icon' => 'M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z'],
            ['label' => 'Student Details', 'link' => 'student_detail.php', 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'],
            ['label' => 'Fees Manager', 'link' => 'fees_setting.php', 'icon' => 'M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z'],
            ['label' => 'Accounts', 'link' => 'account_setting.php', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z'],
            ['label' => 'Examinations', 'link' => 'exam_setting.php', 'icon' => 'M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z'],
            ['label' => 'Transport', 'link' => 'transport_setting.php', 'icon' => 'M18 11V7c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h1c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h1c1.1 0 2-.9 2-2v-5c0-1.1-.9-2-2-2h-3zM8 19c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm10 0c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2-5h-3V8h3v6z'],
            ['label' => 'Staff Records', 'link' => 'staff_setting.php', 'icon' => 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z'],
            ['label' => 'Library', 'link' => 'library_setting.php', 'icon' => 'M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z'],
            ['label' => 'Student TC', 'link' => 'entry_student_tc.php', 'icon' => 'M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm-2 16l-4-4h8l-4 4zm0-12.5L13.5 9H10.5L12 5.5z']
        ];

        foreach ($modules as $mod): ?>
            <div class="fluent-card-wrapper">
                <a href="<?php echo $mod['link']; ?>" class="fluent-card">
                    <div class="fluent-icon-container">
                        <svg viewBox="0 0 24 24"><path d="<?php echo $mod['icon']; ?>"/></svg>
                    </div>
                    <span class="fluent-card-label"><?php echo $mod['label']; ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    /* 1. Centered Search & Header UI */
    .dashboard-header-container { text-align: center; padding: 50px 20px; border-bottom: 1px solid var(--app-border); margin-bottom: 40px; }
    .enterprise-title { font-weight: 300; font-size: 32px; color: var(--fluent-slate); margin-bottom: 25px; }
    .dashboard-search-wrapper { max-width: 600px; margin: 0 auto; }
    
    .fluent-search-form .input-group { border-radius: 4px; overflow: hidden; border: 1px solid var(--app-border); }
    .fluent-input { border: none !important; padding: 12px 20px !important; font-size: 15px !important; }
    .btn-azure-search { 
        background: var(--app-primary); color: white; border: none; padding: 0 25px; 
        display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 14px; transition: 0.2s;
    }
    .btn-azure-search:hover { background: var(--app-primary-dark); }

    /* 2. Unified Module Grid */
    .module-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 30px; padding: 0 40px 40px; }
    .fluent-card { 
        display: flex; flex-direction: column; align-items: center; justify-content: center; 
        padding: 40px 20px; background: #ffffff; border: 1px solid var(--app-border); 
        border-radius: 4px; text-decoration: none; transition: all 0.2s; box-shadow: var(--app-shadow); min-height: 200px;
    }
    .fluent-card:hover { transform: translateY(-5px); box-shadow: var(--app-shadow-lifted); border-color: var(--app-primary); }
    
    .fluent-icon-container { 
        width: 60px; height: 60px; background: var(--app-white-soft); border-radius: 8px; 
        display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: 0.2s;
    }
    .fluent-card:hover .fluent-icon-container { background: var(--app-primary); }
    .fluent-icon-container svg { width: 30px; height: 30px; fill: var(--app-primary); transition: 0.2s; }
    .fluent-card:hover .fluent-icon-container svg { fill: #fff; }
    .fluent-card-label { font-weight: 600; font-size: 13px; color: var(--fluent-slate); text-transform: uppercase; letter-spacing: 0.8px; }
</style>

<?php require_once("includes/footer.php"); ?>
