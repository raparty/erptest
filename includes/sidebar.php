<?php
/**
 * Dynamic Sidebar with RBAC Support
 * Only shows menu items that the current user has permission to access
 */

// Define sidebar structure with permissions
$sidebarItems = [
    [
        'section' => null,
        'items' => [
            ['label' => 'Dashboard', 'url' => 'dashboard.php', 'module' => 'dashboard', 'action' => 'view']
        ]
    ],
    [
        'section' => 'Admissions',
        'items' => [
            ['label' => 'Admission', 'url' => 'admission.php', 'module' => 'admission', 'action' => 'view'],
            ['label' => 'Student Details', 'url' => 'student_detail.php', 'module' => 'student', 'action' => 'view'],
            ['label' => 'Transfer Certificates', 'url' => 'student_tc.php', 'module' => 'student', 'action' => 'tc']
        ]
    ],
    [
        'section' => 'Academics',
        'items' => [
            ['label' => 'School Settings', 'url' => 'school_setting.php', 'module' => 'school_setting', 'action' => 'view'],
            ['label' => 'School Details', 'url' => 'school_detail.php', 'module' => 'school_setting', 'action' => 'view'],
            ['label' => 'Classes', 'url' => 'class.php', 'module' => 'class', 'action' => 'view'],
            ['label' => 'Sections', 'url' => 'section.php', 'module' => 'section', 'action' => 'view'],
            ['label' => 'Streams', 'url' => 'stream.php', 'module' => 'stream', 'action' => 'view'],
            ['label' => 'Subjects', 'url' => 'subject.php', 'module' => 'subject', 'action' => 'view'],
            ['label' => 'Allocate Sections', 'url' => 'allocate_section.php', 'module' => 'allocation', 'action' => 'view'],
            ['label' => 'Allocate Streams', 'url' => 'allocate_stream.php', 'module' => 'allocation', 'action' => 'view'],
            ['label' => 'Allocate Subjects', 'url' => 'allocate_subject.php', 'module' => 'allocation', 'action' => 'view']
        ]
    ],
    [
        'section' => 'Fees & Accounts',
        'items' => [
            ['label' => 'Fees Settings', 'url' => 'fees_setting.php', 'module' => 'fees', 'action' => 'view'],
            ['label' => 'Fees Manager', 'url' => 'fees_manager.php', 'module' => 'fees', 'action' => 'view'],
            ['label' => 'Account Settings', 'url' => 'account_setting.php', 'module' => 'account', 'action' => 'view'],
            ['label' => 'Account Reports', 'url' => 'account_report.php', 'module' => 'account', 'action' => 'view']
        ]
    ],
    [
        'section' => 'Examinations',
        'items' => [
            ['label' => 'Exam Settings', 'url' => 'exam_setting.php', 'module' => 'exam', 'action' => 'view'],
            ['label' => 'Results', 'url' => 'exam_result.php', 'module' => 'exam', 'action' => 'result']
        ]
    ],
    [
        'section' => 'Operations',
        'items' => [
            ['label' => 'Transport', 'url' => 'transport_setting.php', 'module' => 'transport', 'action' => 'view'],
            ['label' => 'Library', 'url' => 'library_setting.php', 'module' => 'library', 'action' => 'view'],
            ['label' => 'Staff', 'url' => 'staff_setting.php', 'module' => 'staff', 'action' => 'view'],
            ['label' => 'Attendance', 'url' => 'Attendance.php', 'module' => 'attendance', 'action' => 'view']
        ]
    ]
];
?>
<aside class="app-sidebar">
    <nav class="nav flex-column gap-1">
        <?php foreach ($sidebarItems as $group): ?>
            <?php
            // Check if user has permission to any items in this section
            $hasAccessToSection = false;
            foreach ($group['items'] as $item) {
                if (RBAC::hasPermission($item['module'], $item['action'])) {
                    $hasAccessToSection = true;
                    break;
                }
            }
            
            // Skip section if no access
            if (!$hasAccessToSection) {
                continue;
            }
            
            // Display section header if exists
            if ($group['section'] !== null):
            ?>
                <div class="nav-section"><?php echo htmlspecialchars($group['section']); ?></div>
            <?php endif; ?>
            
            <?php foreach ($group['items'] as $item): ?>
                <?php if (RBAC::hasPermission($item['module'], $item['action'])): ?>
                    <a class="nav-link" href="<?php echo htmlspecialchars($item['url']); ?>">
                        <?php echo htmlspecialchars($item['label']); ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </nav>
</aside>
<div class="app-content">
