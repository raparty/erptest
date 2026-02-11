<?php
declare(strict_types=1);
require_once("includes/header.php");

// Only admins can access this page
RBAC::requirePermission('dashboard', 'view'); // Basic check
if (RBAC::getUserRole() !== 'Admin') {
    header('Location: access_denied.php');
    exit;
}

require_once("includes/sidebar.php");

// Get all permissions
$permissionsQuery = "SELECT * FROM permissions ORDER BY module, action";
$permissionsResult = db_query($permissionsQuery);
$permissions = [];
while ($row = db_fetch_assoc($permissionsResult)) {
    $permissions[] = $row;
}

// Get role permissions
$roles = ['Admin', 'Teacher', 'Student'];
$rolePermissions = [];
foreach ($roles as $role) {
    $query = "SELECT permission_id FROM role_permissions WHERE role = '" . db_escape($role) . "'";
    $result = db_query($query);
    $rolePermissions[$role] = [];
    while ($row = db_fetch_assoc($result)) {
        $rolePermissions[$role][] = $row['permission_id'];
    }
}

// Group permissions by module
$groupedPermissions = [];
foreach ($permissions as $perm) {
    $module = $perm['module'];
    if (!isset($groupedPermissions[$module])) {
        $groupedPermissions[$module] = [];
    }
    $groupedPermissions[$module][] = $perm;
}
?>

<div class="page_title">
    <h3>RBAC Management</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon enterprise-card-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                        </span>
                        <h4 class="heading">Role-Based Access Control (RBAC)</h4>
                    </div>
                    <div class="widget_content">
                        
                        <div style="padding: 30px;">
                            <!-- Role Overview Cards -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
                                <?php foreach ($roles as $role): ?>
                                <div class="enterprise-card" style="padding: 25px; background: white; border: 1px solid var(--app-border); border-radius: 4px; box-shadow: var(--app-shadow);">
                                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background: <?php 
                                            echo match($role) {
                                                'Admin' => '#FF6B6B',
                                                'Teacher' => '#0078D4',
                                                'Student' => '#4CAF50',
                                                default => '#8A8886'
                                            };
                                        ?>; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 20px;">
                                            <?php echo substr($role, 0, 1); ?>
                                        </div>
                                        <div>
                                            <h3 style="margin: 0; font-size: 20px; color: var(--fluent-slate);"><?php echo $role; ?></h3>
                                            <p style="margin: 5px 0 0; color: var(--fluent-slate-light); font-size: 14px;">
                                                <?php echo count($rolePermissions[$role]); ?> permissions
                                            </p>
                                        </div>
                                    </div>
                                    <p style="color: var(--fluent-slate-light); font-size: 14px; line-height: 1.5; margin: 0;">
                                        <?php 
                                        echo match($role) {
                                            'Admin' => 'Full system access with all permissions. Can manage users, roles, and system settings.',
                                            'Teacher' => 'Academic operations access. Can manage exams, attendance, library, and view student records.',
                                            'Student' => 'Limited view access. Can view personal records, exam results, and library status.',
                                            default => ''
                                        };
                                        ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Permissions Matrix -->
                            <h3 style="margin: 40px 0 20px; color: var(--fluent-slate); font-size: 24px; font-weight: 400;">
                                Permissions Matrix
                            </h3>
                            
                            <div style="overflow-x: auto;">
                                <table class="table table-striped" style="width: 100%; border-collapse: collapse;">
                                    <thead style="background: var(--fluent-white-softer);">
                                        <tr>
                                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid var(--app-border); font-weight: 600; color: var(--fluent-slate);">Module</th>
                                            <th style="padding: 15px; text-align: left; border-bottom: 2px solid var(--app-border); font-weight: 600; color: var(--fluent-slate);">Action</th>
                                            <th style="padding: 15px; text-align: center; border-bottom: 2px solid var(--app-border); font-weight: 600; color: var(--fluent-slate);">Admin</th>
                                            <th style="padding: 15px; text-align: center; border-bottom: 2px solid var(--app-border); font-weight: 600; color: var(--fluent-slate);">Teacher</th>
                                            <th style="padding: 15px; text-align: center; border-bottom: 2px solid var(--app-border); font-weight: 600; color: var(--fluent-slate);">Student</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($groupedPermissions as $module => $perms): ?>
                                            <?php foreach ($perms as $index => $perm): ?>
                                            <tr style="border-bottom: 1px solid var(--app-border);">
                                                <?php if ($index === 0): ?>
                                                <td rowspan="<?php echo count($perms); ?>" style="padding: 15px; vertical-align: top; font-weight: 600; color: var(--fluent-azure); text-transform: capitalize;">
                                                    <?php echo htmlspecialchars(str_replace('_', ' ', $module)); ?>
                                                </td>
                                                <?php endif; ?>
                                                <td style="padding: 15px; color: var(--fluent-slate);">
                                                    <span style="display: inline-block; padding: 4px 12px; background: var(--fluent-white-softer); border-radius: 12px; font-size: 13px;">
                                                        <?php echo htmlspecialchars($perm['action']); ?>
                                                    </span>
                                                </td>
                                                <?php foreach ($roles as $role): ?>
                                                <td style="padding: 15px; text-align: center;">
                                                    <?php if (in_array($perm['id'], $rolePermissions[$role])): ?>
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#4CAF50">
                                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                                        </svg>
                                                    <?php else: ?>
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#E0E0E0">
                                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                        </svg>
                                                    <?php endif; ?>
                                                </td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Legend -->
                            <div style="margin-top: 30px; padding: 20px; background: var(--fluent-white-softer); border-radius: 4px;">
                                <h4 style="margin: 0 0 15px; color: var(--fluent-slate); font-size: 16px; font-weight: 600;">Legend</h4>
                                <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#4CAF50">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                        </svg>
                                        <span style="color: var(--fluent-slate); font-size: 14px;">Has Permission</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#E0E0E0">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                        </svg>
                                        <span style="color: var(--fluent-slate); font-size: 14px;">No Permission</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Back Button -->
                            <div style="margin-top: 30px; display: flex; justify-content: flex-start;">
                                <a href="dashboard.php" class="btn-fluent-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 6px;">
                                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                                    </svg>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.enterprise-card-icon {
    color: #0078D4;
}
</style>

<?php require_once("includes/footer.php"); ?>
