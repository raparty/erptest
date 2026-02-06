# School ERP System

![School ERP Login Screenshot](https://github.com/user-attachments/assets/63f6dab6-043d-4777-920d-620b7b713a35)

## Introduction

School ERP System is a comprehensive database system for managing your school's day-to-day operations. It allows users to store and manage almost all school information including:
- **Student Management**: Admissions, records, fees, transport, library
- **Staff Management**: Employee records, departments, positions, qualifications
- **Academic Management**: Classes, subjects, streams, sections, exam management
- **Financial Management**: Fee collection, income, expenses, accounting
- **Library Management**: Books, categories, issue/return tracking, fines
- **Transport Management**: Routes, vehicles, student transport fees

School ERP System makes your school staff's life easier than ever. Using this system, finding student information is just seconds away, printing statements becomes a few minutes job, and all school information can be easily shared with authorized users.

## Prerequisites

Before installing School ERP System, ensure your server meets the following requirements:

### Required Software Versions

#### PHP 8.4 or Higher
- **Minimum Version**: PHP 8.4.0
- The application will not run on older PHP versions due to strict type requirements
- Check your PHP version: `php -v`

**Required PHP Extensions**:
- `mysqli` - For MySQL database operations
- `session` - For user session management
- `mbstring` - For multi-byte string handling
- `json` - For JSON data processing
- `openssl` - Recommended for secure connections
- `curl` - Recommended for external integrations
- `gd` or `imagick` - Recommended for image processing

**How to Install PHP 8.4** (varies by OS):
```bash
# Ubuntu/Debian
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.4 php8.4-mysqli php8.4-mbstring php8.4-json php8.4-session

# CentOS/RHEL
sudo dnf install php84 php84-php-mysqli php84-php-mbstring php84-php-json

# macOS (Homebrew)
brew install php@8.4

# Windows
# Download from https://windows.php.net/download/
```

#### MySQL 8.4 or Higher
- **Minimum Version**: MySQL 8.4.0 (or MariaDB 11.0+)
- UTF-8 (utf8mb4) character set support required
- InnoDB storage engine required
- Check your MySQL version: `mysql --version`

**How to Install MySQL 8.4**:
```bash
# Ubuntu/Debian
wget https://dev.mysql.com/get/mysql-apt-config_0.8.29-1_all.deb
sudo dpkg -i mysql-apt-config_0.8.29-1_all.deb
sudo apt update
sudo apt install mysql-server

# CentOS/RHEL
sudo dnf install mysql-server

# macOS (Homebrew)
brew install mysql

# Windows
# Download installer from https://dev.mysql.com/downloads/mysql/
```

#### Web Server
Choose one of the following:

**Apache 2.4+**
- `mod_rewrite` module enabled
- `.htaccess` support enabled

**Nginx 1.20+**
- PHP-FPM configured
- Proper PHP handling rules

**How to Install Apache**:
```bash
# Ubuntu/Debian
sudo apt install apache2 libapache2-mod-php8.4
sudo a2enmod rewrite
sudo systemctl restart apache2

# CentOS/RHEL
sudo dnf install httpd
sudo systemctl enable httpd
sudo systemctl start httpd
```

### System Requirements
- **RAM**: Minimum 512MB, Recommended 2GB+
- **Storage**: Minimum 100MB for application, Additional space for database growth
- **OS**: Linux (Ubuntu 20.04+, CentOS 8+), Windows Server 2016+, macOS 10.15+

### Network Requirements
- Port 80 (HTTP) or 443 (HTTPS) accessible
- MySQL port 3306 accessible (can be localhost only)
- Internet access for CDN resources (Bootstrap 5.3.3, fonts)

## Installation

Follow these step-by-step instructions to install School ERP System:

### Step 1: Install PHP 8.4+

Ensure PHP 8.4 or higher is installed with all required extensions (see Prerequisites above).

Verify installation:
```bash
php -v
php -m | grep -E 'mysqli|mbstring|json|session'
```

### Step 2: Install MySQL 8.4+

Install MySQL 8.4+ or compatible database server (see Prerequisites above).

Start MySQL service:
```bash
# Linux
sudo systemctl start mysql
sudo systemctl enable mysql

# macOS
brew services start mysql

# Windows - Start MySQL service from Services panel
```

### Step 3: Create Database

Log into MySQL:
```bash
mysql -u root -p
```

Create the database with proper character set:
```sql
CREATE DATABASE school_erp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'erp_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON school_erp.* TO 'erp_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Import the database schema:
```bash
mysql -u erp_user -p school_erp < db/schema.sql
```

### Step 4: Configure Web Server

#### For Apache:

1. Set document root to the application directory
2. Enable mod_rewrite:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

3. Configure virtual host (example):
```apache
<VirtualHost *:80>
    ServerName schoolerp.local
    DocumentRoot /var/www/school-erp
    
    <Directory /var/www/school-erp>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/school-erp-error.log
    CustomLog ${APACHE_LOG_DIR}/school-erp-access.log combined
</VirtualHost>
```

#### For Nginx:

Configure Nginx (example):
```nginx
server {
    listen 80;
    server_name schoolerp.local;
    root /var/www/school-erp;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Step 5: Download and Deploy Application

```bash
# Clone or download the repository
git clone https://github.com/raparty/erptest.git /var/www/school-erp

# Set proper permissions
cd /var/www/school-erp
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
```

### Step 6: Configure Database Connection

#### Option A: Using Environment Variables (Recommended for Production)

Create a `.env` file or set environment variables:
```bash
export ERP_DB_HOST=127.0.0.1
export ERP_DB_PORT=3306
export ERP_DB_NAME=school_erp
export ERP_DB_USER=erp_user
export ERP_DB_PASS=your_secure_password
export APP_TIMEZONE=America/New_York
export ERP_SESSION_SECURE=true  # Set to true if using HTTPS
```

#### Option B: Direct Configuration (For Development)

The application will use defaults from `includes/config.php`:
- Host: `127.0.0.1`
- Port: `3306`
- Database: `school_erp`
- User: `root`
- Password: (empty)

You can modify `includes/config.php` directly if needed, but environment variables are preferred.

### Step 7: Access the Application

1. Open your web browser
2. Navigate to: `http://schoolerp.local` or `http://localhost`
3. You should see the login page
4. Default credentials are typically:
   - Username: `admin`
   - Password: `admin`
   - **⚠️ Change these immediately after first login!**

### Step 8: Post-Installation Security

1. **Change Default Credentials**: Log in and change the admin password
2. **Enable HTTPS**: Configure SSL/TLS certificate for production
3. **Set Environment Variables**: Use environment variables instead of hardcoded database credentials
4. **Restrict Database Access**: Ensure MySQL only accepts connections from localhost
5. **Configure Firewall**: Only allow necessary ports (80/443)
6. **Regular Backups**: Set up automated database backups

## Configuration

### Environment Variables

The application supports the following environment variables:

| Variable | Default | Description |
|----------|---------|-------------|
| `ERP_DB_HOST` | `127.0.0.1` | Database host address |
| `ERP_DB_PORT` | `3306` | Database port number |
| `ERP_DB_NAME` | `school_erp` | Database name |
| `ERP_DB_USER` | `root` | Database username |
| `ERP_DB_PASS` | (empty) | Database password |
| `APP_TIMEZONE` | `UTC` | Application timezone |
| `APP_ENV` | `production` | Environment (production/development) |
| `ERP_SESSION_NAME` | `school_erp_session` | Session cookie name |
| `ERP_SESSION_LIFETIME` | `0` | Session lifetime in seconds (0 = until browser closes) |
| `ERP_SESSION_SAMESITE` | `Lax` | Session cookie SameSite attribute |
| `ERP_SESSION_SECURE` | `false` | Use secure cookies (requires HTTPS) |

## Technology Stack

### Backend Technologies
- **PHP 8.4+**: Modern PHP with strict type declarations
  - Strict types enabled in all files with `declare(strict_types=1);`
  - Type-safe function parameters and returns
  - Modern error handling and reporting
  - Null coalescing operators for safe defaults

- **MySQL 8.4+**: Enterprise-grade database
  - UTF-8 (utf8mb4) character set for full Unicode support (including emojis)
  - InnoDB storage engine with referential integrity
  - Optimized queries and indexes
  - Native mysqli for all database operations
  - Helper functions (db_query, db_escape, db_fetch_array, etc.) for consistency

### Frontend Technologies
- **HTML5**: Modern semantic markup
  - Viewport meta tags for responsive design
  - ARIA attributes for accessibility
  - Semantic elements for better structure

- **CSS3**: Modern styling with advanced features
  - CSS Custom Properties (CSS Variables) for theming
  - Dark mode support with `@media (prefers-color-scheme: dark)`
  - Flexbox and Grid layouts
  - Responsive design patterns
  - Accessibility features (focus-visible, prefers-reduced-motion)

- **Bootstrap 5.3.3**: Latest stable version
  - Modern component library
  - Responsive grid system
  - Mobile-first approach
  - No jQuery dependency

- **JavaScript**: Modern ES6+ features
  - Async/await for asynchronous operations
  - Arrow functions
  - Template literals
  - Module imports

### Security Features
- **Session Security**:
  - HTTPOnly cookies to prevent XSS attacks
  - Secure cookies for HTTPS connections
  - SameSite attribute to prevent CSRF
  - Configurable session lifetime

- **Database Security**:
  - Prepared statements via mysqli
  - Input sanitization with `Database::escape()`
  - Type-safe queries
  - No deprecated mysql_* functions

- **HTTP Security Headers**:
  - `X-Frame-Options: SAMEORIGIN` (Clickjacking protection)
  - `X-Content-Type-Options: nosniff` (MIME type sniffing protection)
  - `Referrer-Policy: strict-origin-when-cross-origin`

- **Input Validation**:
  - Server-side validation for all inputs
  - HTML entity encoding for output
  - CSRF token implementation recommended

## Modules Overview

The School ERP System includes the following major modules:

1. **Dashboard**: Overview of school statistics and quick access
2. **Student Management**: Registration, records, search, reports
3. **Fee Management**: Fee packages, collection, receipts, pending fees
4. **Staff Management**: Employee records, departments, positions, qualifications
5. **Academic Management**: Classes, sections, streams, subjects, allocation
6. **Exam Management**: Exam schedules, marks entry, marksheets, results
7. **Library Management**: Books, categories, issue/return, fines
8. **Transport Management**: Routes, vehicles, student transport, fees
9. **Accounts**: Income, expenses, categories, reports
10. **RTE Students**: Right to Education (RTE) quota student management

## Troubleshooting

### Common Issues

#### "School ERP requires PHP 8.4 or newer" Error
**Problem**: Your PHP version is too old.
**Solution**: Upgrade PHP to 8.4 or higher (see Prerequisites section).

#### Database Connection Failed
**Problem**: Cannot connect to MySQL database.
**Solutions**:
- Verify MySQL is running: `sudo systemctl status mysql`
- Check database credentials in environment variables or `includes/config.php`
- Ensure database exists: `mysql -u root -p -e "SHOW DATABASES;"`
- Check MySQL port is accessible: `netstat -tlnp | grep 3306`

#### White/Blank Page
**Problem**: PHP errors are hidden.
**Solutions**:
- Check PHP error logs: `/var/log/apache2/error.log` or `/var/log/nginx/error.log`
- Enable error display (development only):
  ```php
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  ```

#### Session Issues / Constant Login Prompts
**Problem**: Sessions not persisting.
**Solutions**:
- Check session directory permissions: `ls -la /var/lib/php/sessions`
- Verify session configuration in `includes/bootstrap.php`
- Clear browser cookies
- Check that `session.save_path` is writable

#### Missing mysqli Extension
**Problem**: PHP cannot connect to MySQL.
**Solution**:
```bash
# Ubuntu/Debian
sudo apt install php8.4-mysqli
sudo systemctl restart apache2

# Verify installation
php -m | grep mysqli
```

#### Bootstrap CSS/JS Not Loading
**Problem**: CDN resources blocked or internet unavailable.
**Solutions**:
- Check internet connectivity
- Download Bootstrap locally if needed
- Verify firewall is not blocking CDN domains

## Maintenance

### Regular Backups
Set up automated database backups:
```bash
# Create backup script
cat > /usr/local/bin/backup-school-erp.sh << 'EOF'
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u erp_user -p school_erp > /backups/school_erp_$DATE.sql
gzip /backups/school_erp_$DATE.sql
# Keep only last 30 days
find /backups -name "school_erp_*.sql.gz" -mtime +30 -delete
EOF

chmod +x /usr/local/bin/backup-school-erp.sh

# Schedule daily backups with cron
crontab -e
# Add: 0 2 * * * /usr/local/bin/backup-school-erp.sh
```

### Updates and Upgrades
1. Always backup database before updates
2. Test updates on staging environment first
3. Check PHP compatibility when upgrading
4. Review changelog for breaking changes

### Performance Optimization
- Enable PHP OPcache for better performance
- Use MySQL query caching where appropriate
- Optimize database indexes
- Consider CDN for static assets in production
- Enable gzip compression on web server

## Support and Documentation

### Getting Help
- **Issues**: Report bugs via GitHub Issues
- **Documentation**: Check the `/docs` folder for detailed documentation
- **Community**: Join discussions for support and feature requests

### Contributing
Contributions are welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Make your changes with proper testing
4. Submit a pull request with detailed description

### License
Please refer to the LICENSE file for licensing information.

## Summary

School ERP System is a comprehensive, modern web application that makes school administration efficient and hassle-free. Built with the latest PHP 8.4+ and MySQL 8.4+ technologies, it provides:

- **Fast Access**: Find any student, staff, or record in seconds
- **Automated Reports**: Generate statements, marksheets, and reports instantly
- **Centralized Data**: All school information in one secure, organized system
- **Role-based Access**: Secure access control for different user types
- **Mobile-Ready**: Responsive design works on all devices
- **Modern Stack**: Built with latest technologies for security and performance

Whether you're managing students, staff, finances, library, transport, or exams, School ERP System streamlines every aspect of school administration, saving hours of manual work and eliminating paperwork chaos.

---

**Latest Update**: January 2026 - Upgraded to PHP 8.4+ and MySQL 8.4+ with modern security and performance enhancements.
