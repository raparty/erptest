<?php
declare(strict_types=1);

/**
 * RBAC (Role-Based Access Control) Class
 * 
 * Manages permissions and access control for different user roles
 * in the School ERP system.
 */
class RBAC
{
    /**
     * Cache for user permissions to avoid multiple DB queries
     */
    private static array $permissionsCache = [];
    
    /**
     * Check if current user has permission for a module and action
     * 
     * @param string $module Module name (e.g., 'admission', 'fees', 'exam')
     * @param string $action Action type (e.g., 'view', 'add', 'edit', 'delete')
     * @return bool True if user has permission, false otherwise
     */
    public static function hasPermission(string $module, string $action = 'view'): bool
    {
        // Check if user is logged in
        if (!isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
            return false;
        }
        
        $role = $_SESSION['role'];
        
        // Admin has all permissions
        if ($role === 'Admin') {
            return true;
        }
        
        // Check cache first
        $cacheKey = $role . '_' . $module . '_' . $action;
        if (isset(self::$permissionsCache[$cacheKey])) {
            return self::$permissionsCache[$cacheKey];
        }
        
        // Query database for permission
        $query = "SELECT COUNT(*) as has_permission 
                  FROM role_permissions rp 
                  INNER JOIN permissions p ON rp.permission_id = p.id 
                  WHERE rp.role = '" . db_escape($role) . "' 
                  AND p.module = '" . db_escape($module) . "' 
                  AND p.action = '" . db_escape($action) . "'";
        
        $result = db_query($query);
        $hasPermission = false;
        
        if ($result && db_num_rows($result) > 0) {
            $row = db_fetch_assoc($result);
            $hasPermission = ($row['has_permission'] > 0);
        }
        
        // Cache the result
        self::$permissionsCache[$cacheKey] = $hasPermission;
        
        return $hasPermission;
    }
    
    /**
     * Require permission or redirect to access denied page
     * 
     * @param string $module Module name
     * @param string $action Action type
     * @param string $redirectUrl Optional custom redirect URL
     */
    public static function requirePermission(string $module, string $action = 'view', string $redirectUrl = 'access_denied.php'): void
    {
        if (!self::hasPermission($module, $action)) {
            header('Location: ' . $redirectUrl);
            exit;
        }
    }
    
    /**
     * Get all permissions for current user's role
     * 
     * @return array Array of permissions with module and action
     */
    public static function getUserPermissions(): array
    {
        if (!isset($_SESSION['role'])) {
            return [];
        }
        
        $role = $_SESSION['role'];
        
        // Admin has all permissions
        if ($role === 'Admin') {
            $query = "SELECT module, action FROM permissions";
        } else {
            $query = "SELECT p.module, p.action 
                      FROM role_permissions rp 
                      INNER JOIN permissions p ON rp.permission_id = p.id 
                      WHERE rp.role = '" . db_escape($role) . "'";
        }
        
        $result = db_query($query);
        $permissions = [];
        
        if ($result) {
            while ($row = db_fetch_assoc($result)) {
                $module = $row['module'];
                $action = $row['action'];
                
                if (!isset($permissions[$module])) {
                    $permissions[$module] = [];
                }
                $permissions[$module][] = $action;
            }
        }
        
        return $permissions;
    }
    
    /**
     * Check if user can access a specific page based on its module
     * 
     * @param string $page Page filename (e.g., 'admission.php')
     * @return bool True if user can access, false otherwise
     */
    public static function canAccessPage(string $page): bool
    {
        // Map pages to modules and actions
        $pageMap = self::getPageModuleMap();
        
        if (!isset($pageMap[$page])) {
            // If page not in map, allow access (backward compatibility)
            return true;
        }
        
        $moduleInfo = $pageMap[$page];
        return self::hasPermission($moduleInfo['module'], $moduleInfo['action']);
    }
    
    /**
     * Get mapping of pages to modules and actions
     * 
     * @return array Mapping array
     */
    private static function getPageModuleMap(): array
    {
        return [
            // Dashboard
            'dashboard.php' => ['module' => 'dashboard', 'action' => 'view'],
            
            // Admission
            'admission.php' => ['module' => 'admission', 'action' => 'view'],
            'add_admission.php' => ['module' => 'admission', 'action' => 'add'],
            'edit_admission.php' => ['module' => 'admission', 'action' => 'edit'],
            'delete_admission.php' => ['module' => 'admission', 'action' => 'delete'],
            
            // Student
            'student_detail.php' => ['module' => 'student', 'action' => 'view'],
            'student_detail_2.php' => ['module' => 'student', 'action' => 'view'],
            'view_student_detail.php' => ['module' => 'student', 'action' => 'view'],
            'student_tc.php' => ['module' => 'student', 'action' => 'tc'],
            'entry_student_tc.php' => ['module' => 'student', 'action' => 'tc'],
            
            // School Settings
            'school_setting.php' => ['module' => 'school_setting', 'action' => 'view'],
            'school_detail.php' => ['module' => 'school_setting', 'action' => 'view'],
            'add_school_detail.php' => ['module' => 'school_setting', 'action' => 'edit'],
            'edit_school_detail.php' => ['module' => 'school_setting', 'action' => 'edit'],
            
            // Classes, Sections, Streams, Subjects
            'class.php' => ['module' => 'class', 'action' => 'view'],
            'add_class.php' => ['module' => 'class', 'action' => 'add'],
            'edit_class.php' => ['module' => 'class', 'action' => 'edit'],
            'delete_class.php' => ['module' => 'class', 'action' => 'delete'],
            
            'section.php' => ['module' => 'section', 'action' => 'view'],
            'add_section.php' => ['module' => 'section', 'action' => 'add'],
            'edit_section.php' => ['module' => 'section', 'action' => 'edit'],
            'delete_section.php' => ['module' => 'section', 'action' => 'delete'],
            
            'stream.php' => ['module' => 'stream', 'action' => 'view'],
            'add_stream.php' => ['module' => 'stream', 'action' => 'add'],
            'edit_stream.php' => ['module' => 'stream', 'action' => 'edit'],
            'delete_stream.php' => ['module' => 'stream', 'action' => 'delete'],
            
            'subject.php' => ['module' => 'subject', 'action' => 'view'],
            'add_subject.php' => ['module' => 'subject', 'action' => 'add'],
            'edit_subject.php' => ['module' => 'subject', 'action' => 'edit'],
            'delete_subject.php' => ['module' => 'subject', 'action' => 'delete'],
            
            'allocate_section.php' => ['module' => 'allocation', 'action' => 'view'],
            'allocate_stream.php' => ['module' => 'allocation', 'action' => 'view'],
            'allocate_subject.php' => ['module' => 'allocation', 'action' => 'view'],
            
            // Fees
            'fees_setting.php' => ['module' => 'fees', 'action' => 'view'],
            'fees_manager.php' => ['module' => 'fees', 'action' => 'view'],
            'add_student_fees.php' => ['module' => 'fees', 'action' => 'add'],
            'edit_student_fees.php' => ['module' => 'fees', 'action' => 'edit'],
            'delete_student_fees.php' => ['module' => 'fees', 'action' => 'delete'],
            'fees_reciept.php' => ['module' => 'fees', 'action' => 'receipt'],
            'entry_fees_reciept.php' => ['module' => 'fees', 'action' => 'receipt'],
            
            // Accounts
            'account_setting.php' => ['module' => 'account', 'action' => 'view'],
            'account_report.php' => ['module' => 'account', 'action' => 'view'],
            'add_income.php' => ['module' => 'account', 'action' => 'add'],
            'add_expense.php' => ['module' => 'account', 'action' => 'add'],
            
            // Exams
            'exam_setting.php' => ['module' => 'exam', 'action' => 'view'],
            'exam_result.php' => ['module' => 'exam', 'action' => 'result'],
            'entry_exam_add_student_marks.php' => ['module' => 'exam', 'action' => 'add'],
            'exam_final_marksheet.php' => ['module' => 'exam', 'action' => 'result'],
            
            // Transport
            'transport_setting.php' => ['module' => 'transport', 'action' => 'view'],
            'transport_add_route.php' => ['module' => 'transport', 'action' => 'add'],
            'transport_add_vechile.php' => ['module' => 'transport', 'action' => 'add'],
            
            // Library
            'library_setting.php' => ['module' => 'library', 'action' => 'view'],
            'library_add_book.php' => ['module' => 'library', 'action' => 'add'],
            'library_entry_add_student_books.php' => ['module' => 'library', 'action' => 'add'],
            'library_student_return_books.php' => ['module' => 'library', 'action' => 'return'],
            
            // Staff
            'staff_setting.php' => ['module' => 'staff', 'action' => 'view'],
            'add_new_staff_detail.php' => ['module' => 'staff', 'action' => 'add'],
            'view_staff.php' => ['module' => 'staff', 'action' => 'view'],
            
            // Attendance
            'Attendance.php' => ['module' => 'attendance', 'action' => 'view'],
        ];
    }
    
    /**
     * Get user's role name
     * 
     * @return string Role name or 'Guest' if not logged in
     */
    public static function getUserRole(): string
    {
        return $_SESSION['role'] ?? 'Guest';
    }
    
    /**
     * Get role badge color for UI display
     * 
     * @param string $role Role name
     * @return string CSS color class
     */
    public static function getRoleBadgeColor(string $role): string
    {
        return match($role) {
            'Admin' => 'badge-danger',
            'Teacher' => 'badge-primary',
            'Student' => 'badge-success',
            default => 'badge-secondary',
        };
    }
    
    /**
     * Clear permissions cache (useful after permission changes)
     */
    public static function clearCache(): void
    {
        self::$permissionsCache = [];
    }
    
    /**
     * Get list of modules user has access to
     * 
     * @return array Array of module names
     */
    public static function getAccessibleModules(): array
    {
        $permissions = self::getUserPermissions();
        return array_keys($permissions);
    }
}
