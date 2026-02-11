-- ============================================================================
-- RBAC (Role-Based Access Control) Schema for School ERP
-- ============================================================================
-- This migration creates tables for managing role-based permissions

-- Create permissions table
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL COMMENT 'Module name (e.g., admission, fees, exam)',
  `action` varchar(50) NOT NULL COMMENT 'Action type (view, add, edit, delete)',
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_permission` (`module`, `action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create role_permissions mapping table
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('Admin','Teacher','Student') NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_role_permission` (`role`, `permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- Default Permissions Setup
-- ============================================================================

-- Admission Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('admission', 'view', 'View admission records'),
('admission', 'add', 'Add new admission'),
('admission', 'edit', 'Edit admission records'),
('admission', 'delete', 'Delete admission records');

-- Student Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('student', 'view', 'View student details'),
('student', 'edit', 'Edit student details'),
('student', 'delete', 'Delete student records'),
('student', 'tc', 'Manage transfer certificates');

-- Academic Settings Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('school_setting', 'view', 'View school settings'),
('school_setting', 'edit', 'Edit school settings'),
('class', 'view', 'View classes'),
('class', 'add', 'Add new class'),
('class', 'edit', 'Edit class details'),
('class', 'delete', 'Delete class'),
('section', 'view', 'View sections'),
('section', 'add', 'Add new section'),
('section', 'edit', 'Edit section details'),
('section', 'delete', 'Delete section'),
('stream', 'view', 'View streams'),
('stream', 'add', 'Add new stream'),
('stream', 'edit', 'Edit stream details'),
('stream', 'delete', 'Delete stream'),
('subject', 'view', 'View subjects'),
('subject', 'add', 'Add new subject'),
('subject', 'edit', 'Edit subject details'),
('subject', 'delete', 'Delete subject'),
('allocation', 'view', 'View allocations'),
('allocation', 'add', 'Add allocations'),
('allocation', 'edit', 'Edit allocations'),
('allocation', 'delete', 'Delete allocations');

-- Fees Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('fees', 'view', 'View fees records'),
('fees', 'add', 'Add fees entry'),
('fees', 'edit', 'Edit fees records'),
('fees', 'delete', 'Delete fees records'),
('fees', 'receipt', 'Generate fees receipt');

-- Account Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('account', 'view', 'View account reports'),
('account', 'add', 'Add income/expense'),
('account', 'edit', 'Edit account records'),
('account', 'delete', 'Delete account records');

-- Exam Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('exam', 'view', 'View exam settings and results'),
('exam', 'add', 'Add exam marks'),
('exam', 'edit', 'Edit exam marks and settings'),
('exam', 'delete', 'Delete exam records'),
('exam', 'result', 'View and generate results');

-- Transport Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('transport', 'view', 'View transport records'),
('transport', 'add', 'Add transport details'),
('transport', 'edit', 'Edit transport records'),
('transport', 'delete', 'Delete transport records');

-- Library Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('library', 'view', 'View library records'),
('library', 'add', 'Add books and issue books'),
('library', 'edit', 'Edit library records'),
('library', 'delete', 'Delete library records'),
('library', 'return', 'Return books');

-- Staff Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('staff', 'view', 'View staff records'),
('staff', 'add', 'Add new staff'),
('staff', 'edit', 'Edit staff records'),
('staff', 'delete', 'Delete staff records');

-- Attendance Module Permissions
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('attendance', 'view', 'View attendance records'),
('attendance', 'add', 'Mark attendance'),
('attendance', 'edit', 'Edit attendance records');

-- Dashboard Permission
INSERT INTO `permissions` (`module`, `action`, `description`) VALUES
('dashboard', 'view', 'Access dashboard');

-- ============================================================================
-- Default Role Permissions Assignment
-- ============================================================================

-- Admin gets ALL permissions
INSERT INTO `role_permissions` (`role`, `permission_id`)
SELECT 'Admin', id FROM permissions;

-- Teacher permissions (limited access)
INSERT INTO `role_permissions` (`role`, `permission_id`)
SELECT 'Teacher', id FROM permissions WHERE 
  -- View most things
  (module IN ('student', 'class', 'section', 'stream', 'subject', 'exam', 'library', 'attendance', 'dashboard') AND action = 'view')
  OR 
  -- Can add/edit specific items
  (module IN ('exam', 'library', 'attendance') AND action IN ('add', 'edit'))
  OR
  (module = 'library' AND action = 'return')
  OR
  (module = 'exam' AND action = 'result');

-- Student permissions (very limited - mostly view only)
INSERT INTO `role_permissions` (`role`, `permission_id`)
SELECT 'Student', id FROM permissions WHERE 
  (module IN ('dashboard', 'exam', 'library', 'fees') AND action = 'view')
  OR
  (module = 'exam' AND action = 'result');

-- ============================================================================
-- RBAC System Information
-- ============================================================================
-- 
-- Permission Structure:
-- - module: Identifies the feature area (admission, fees, exam, etc.)
-- - action: Defines what can be done (view, add, edit, delete, etc.)
-- 
-- Role Hierarchy (default setup):
-- 
-- ADMIN:
--   - Full access to all modules and actions
--   - Can manage users, roles, and permissions
--   - Complete control over school settings
-- 
-- TEACHER:
--   - View: Students, Classes, Sections, Streams, Subjects, Exams, Library, Attendance
--   - Add/Edit: Exam marks, Attendance, Library book issues/returns
--   - Generate exam results
--   - Limited to academic operations
-- 
-- STUDENT:
--   - View: Dashboard, Own exam results, Library records, Fee records
--   - Very restricted access - personal records only
-- 
-- ============================================================================
