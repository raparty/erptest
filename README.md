# School ERP System

## Introduction

School ERP System is a large database system which can be used for managing your school's day to day business. It allows users to store almost all of their school's information including information on students, employees, teaching materials, accounts, library etc. School ERP System makes your school staff's life easier than ever. Using ERP information can be easily shared with authorized users, records can be easily searched, and reports can be easily generated.

## Requirements

The system now requires modern infrastructure for optimal performance and security:

### PHP Requirements
- **PHP 8.4+** is required
- All PHP files use `declare(strict_types=1);` for type safety
- Modern PHP 8.4 features and syntax throughout the codebase

### Database Requirements
- **MySQL 8.4+** or compatible database
- UTF-8 (utf8mb4) character set with unicode collation
- InnoDB storage engine for referential integrity

### Web Server
- Apache with mod_rewrite enabled, or
- Nginx with proper PHP-FPM configuration
- HTTPS recommended for production

## Installation

1. Install PHP 8.4+ with required extensions:
   - mysqli
   - session
   - mbstring
   - json

2. Install MySQL 8.4+ and create the database:
   ```sql
   CREATE DATABASE school_erp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. Configure environment variables (recommended) or update `includes/config.php`:
   - `ERP_DB_HOST` (default: 127.0.0.1)
   - `ERP_DB_PORT` (default: 3306)
   - `ERP_DB_NAME` (default: school_erp)
   - `ERP_DB_USER` (default: root)
   - `ERP_DB_PASS` (default: empty)
   - `APP_TIMEZONE` (default: UTC)
   - `ERP_SESSION_NAME` (default: school_erp_session)
   - `ERP_SESSION_LIFETIME` (default: 0)
   - `ERP_SESSION_SAMESITE` (default: Lax)
   - `ERP_SESSION_SECURE` (default: empty/false, set to true for HTTPS)

4. Upload files to your web server document root

5. Access the application via web browser

## Modern Features

### PHP 8.4 Compliance
- Strict type declarations in all PHP files
- Modern error handling and reporting
- Null coalescing operators for safe defaults
- Type-safe function parameters and returns

### MySQL 8.4 Optimization
- UTF-8 (utf8mb4) for full Unicode support including emojis
- Modern schema with foreign key constraints
- Optimized queries for better performance
- Native mysqli for all database operations
- Helper functions (db_query, db_escape, etc.) for consistency

### Modern Frontend
- HTML5 semantic markup
- CSS3 with custom properties (CSS variables)
- Modern ES6+ JavaScript
- Responsive design with Bootstrap 5.3.3
- Mobile-first approach

### Security
- Secure session handling with httponly and samesite attributes
- XSS protection headers
- CSRF protection patterns
- Input sanitization via Database::escape() using mysqli
- Native mysqli database operations throughout

## Summary

School ERP System makes your school staff's life easier than ever. Using School Management System, finding student information is just a few seconds away which might have cost hours, or even days, before. At the end of the semester, printing students' statements becomes just a few minutes job (the speed limitation determined by your printer), but it could be a nightmare without using School ERP System. It allows users to store almost all of their school's information electronically, including information on students, employees, properties, teaching materials etc. Most importantly, this information can be easily shared with authorized users, records can be easily searched, and reports can be easily generated.
