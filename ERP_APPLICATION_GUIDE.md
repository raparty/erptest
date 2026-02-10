# School ERP Application - Simple User Guide

## Overview
This is a **School Management System** (ERP) that helps schools manage everything from student admissions to fees, exams, library, transport, and staff records.

---

## 🔐 How to Login (Entry Point)

### **Main Entry Point: `index.php`**
This is the **first page** you see when you visit the application.

### **Login Flow (Simple Steps)**

```
Step 1: Open the website → You see index.php (Login Page)
         ↓
Step 2: Enter your username and password
         ↓
Step 3: Click "Sign In" → Your credentials are sent to login_process.php
         ↓
Step 4: login_process.php checks if username/password are correct
         ↓
         → If WRONG: You go back to index.php with error message
         → If CORRECT: You continue to Step 5
         ↓
Step 5: You're taken to session.php (Select School Session like "2023-2024")
         ↓
Step 6: After selecting session → You reach dashboard.php (Main Dashboard)
         ↓
Step 7: From dashboard, you can access any module!
```

### **Files Involved in Login:**
- `index.php` - The login screen (entry point)
- `login_process.php` - Verifies your username and password
- `session.php` - Lets you select which school year/session to work with
- `dashboard.php` - Main control panel after successful login
- `logout.php` - Sign out and return to login page

### **Authentication Guardian:**
The file `includes/header.php` acts as a security guard. If you try to access any page without logging in first, it automatically sends you back to `index.php`.

---

## 📊 Main Dashboard (`dashboard.php`)

After login, you see the **dashboard** which shows 10 main modules:

1. **School Settings** → school_setting.php
2. **Admission** → admission.php
3. **Student Details** → student_detail.php
4. **Fees Manager** → fees_setting.php
5. **Accounts** → account_setting.php
6. **Examinations** → exam_setting.php
7. **Transport** → transport_setting.php
8. **Staff Records** → staff_setting.php
9. **Library** → library_setting.php
10. **Student TC** (Transfer Certificate) → entry_student_tc.php

Each module acts as a mini-application within the ERP system.

---

## 📁 Main Modules (Detailed)

### 1️⃣ **ADMISSIONS MODULE**
**Entry Point:** `admission.php`

**What it does:** Manages new student admissions and existing student records.

**Navigation Flow:**
```
admission.php (Main Page)
    ├── add_admission.php (Add new student)
    │       └── admission_process.php (Saves student data)
    ├── edit_admission.php (Edit student info)
    │       └── process_edit_admission.php (Updates student data)
    ├── delete_admission.php (Remove admission record)
    └── student_detail.php (View all students)
            ├── view_student_detail.php (See one student's full info)
            └── searchby_name.php (Search for students)
```

**Key Operations:**
- Adding new students
- Editing student information
- Viewing student lists
- Searching for students by name

---

### 2️⃣ **FEES MANAGEMENT MODULE**
**Entry Point:** `fees_setting.php`

**What it does:** Handles all fee-related activities - packages, payments, receipts, pending fees.

**Navigation Flow:**
```
fees_setting.php (Fees Dashboard)
    │
    ├── SIDEBAR MENU:
    │   ├── fees_package.php (Define fee packages like "Grade 1 - ₹50,000/year")
    │   │       ├── add_fees_package.php
    │   │       ├── edit_fees_package.php
    │   │       └── delete_fees_package.php
    │   │
    │   ├── term_manager.php (Manage terms like "Q1, Q2, Annual")
    │   │       ├── add_term.php
    │   │       ├── edit_term.php
    │   │       └── delete_term.php
    │   │
    │   ├── fees_manager.php (Main fee collection screen)
    │   │       ├── add_student_fees.php (Collect payment from student)
    │   │       ├── edit_student_fees.php (Modify fee record)
    │   │       ├── entry_fees_reciept.php (Enter fee receipt)
    │   │       ├── fees_reciept.php (Print receipt)
    │   │       ├── fees_reciept_byterm.php (Receipt by term)
    │   │       └── fees_searchby_name.php (Find student to collect fees)
    │   │
    │   ├── student_pending_fees_detail.php (See who hasn't paid)
    │   │       └── student_pending_fees_pagination.php (Browse pages of pending fees)
    │   │
    │   └── student_transport_fees.php (Bus/Transport fees)
    │           ├── add_student_transport_fees.php
    │           ├── edit_student_transport_fees.php
    │           └── transport_fees_reciept.php
    │
    └── REPORTS:
            ├── student_fees_reports.php (Fee collection reports)
            └── fees_search_result.php (Search results page)
```

**Key Operations:**
- Creating fee packages (e.g., Tuition, Lab, Sports fees)
- Collecting fees from students
- Printing receipts
- Tracking pending/unpaid fees
- Managing transport/bus fees separately

---

### 3️⃣ **EXAMINATIONS MODULE**
**Entry Point:** `exam_setting.php`

**What it does:** Manages exam schedules, marks entry, report cards, and results.

**Navigation Flow:**
```
exam_setting.php (Exam Dashboard)
    │
    ├── SIDEBAR MENU:
    │   ├── exam_show_maximum_marks.php (Set max marks for each subject)
    │   │       ├── exam_add_maximum_marks.php (Add max marks)
    │   │       └── exam_edit_maximum_marks.php (Edit max marks)
    │   │
    │   ├── exam_time_table_detail.php (View exam schedule/timetable)
    │   │       └── exam_edit_time_table.php (Edit timetable)
    │   │
    │   ├── exam_show_student_marks.php (Enter marks for students)
    │   │       ├── exam_marks_add_student.php (Add student to exam)
    │   │       └── entry_exam_add_student_marks.php (Enter marks)
    │   │
    │   └── entry_exam_marksheet.php (Generate marksheets/report cards)
    │           ├── exam_marksheet_student_selector.php (Select student)
    │           └── exam_final_marksheet.php (Print final marksheet)
    │
    └── RESULTS & SEARCH:
            ├── exam_result.php (View results)
            ├── exam_searchby_name.php (Search student for marks)
            └── exam_select_exam_term.php (Choose exam term)
```

**Key Operations:**
- Setting up exam timetables
- Defining maximum marks for subjects
- Entering student marks
- Generating report cards/marksheets
- Publishing results

---

### 4️⃣ **LIBRARY MODULE**
**Entry Point:** `library_setting.php`

**What it does:** Manages library books, book issues/returns, and fines.

**Navigation Flow:**
```
library_setting.php (Library Dashboard)
    │
    ├── SIDEBAR MENU:
    │   ├── library_book_category.php (Book categories like Fiction, Science, etc.)
    │   │       ├── library_add_book_category.php
    │   │       ├── library_edit_book_category.php
    │   │       └── library_delete_book_category.php
    │   │
    │   ├── library_book_manager.php (All books in library)
    │   │       ├── library_add_book.php (Add new book)
    │   │       ├── library_edit_book.php (Edit book details)
    │   │       └── library_delete_book.php (Remove book)
    │   │
    │   ├── library_student_books_manager.php (Track which student has which book)
    │   │       ├── library_add_student_books.php (Issue book to student)
    │   │       │       └── library_entry_add_student_books.php (Entry form)
    │   │       ├── library_edit_student_books.php (Edit issue record)
    │   │       └── library_delete_student_books.php (Delete record)
    │   │
    │   ├── library_entry_student_return_books.php (Return books)
    │   │       ├── library_return_student_books_page.php (Return page)
    │   │       └── library_process_return.php (Process the return)
    │   │
    │   └── library_fine_manager.php (Manage fines for late returns)
    │           ├── library_add_fine.php
    │           ├── library_edit_fine.php
    │           └── student_fine_detail.php (View student's fine details)
    │
    └── SEARCH:
            ├── library_student_searchby_name.php (Search student for book issue)
            └── library_student_returnbook_searchby_name.php (Search for returns)
```

**Key Operations:**
- Adding books to library
- Issuing books to students
- Recording book returns
- Calculating and collecting fines for late returns
- Managing book categories

---

### 5️⃣ **TRANSPORT MODULE**
**Entry Point:** `transport_setting.php`

**What it does:** Manages school buses, routes, and transport fees.

**Navigation Flow:**
```
transport_setting.php (Transport Dashboard)
    │
    ├── SIDEBAR MENU:
    │   ├── transport_route_detail.php (Bus routes)
    │   │       ├── transport_add_route.php (Add new route)
    │   │       └── transport_route_edit.php (Edit route)
    │   │
    │   ├── transport_vechile_detail.php (All school buses/vehicles)
    │   │       ├── transport_add_vechile.php (Add new bus)
    │   │       └── transport_edit_vehicle.php (Edit bus details)
    │   │
    │   └── transport_student_detail.php (Students using transport)
    │           ├── transport_add_student.php (Assign student to bus)
    │           ├── transport_entry_add_student.php (Entry form)
    │           └── transport_edit_student.php (Edit assignment)
    │
    └── FEES MANAGEMENT:
            ├── entry_add_student_transport_fees.php (Add transport fees)
            ├── entry_transport_fees_reciept.php (Generate receipt)
            ├── transport_fees_reciept.php (Print receipt)
            ├── transport_fees_reciept_byterm.php (Receipt by term)
            ├── transport_searchby_name.php (Search student)
            └── transport_student_fee_detail.php (View fee details)
```

**Key Operations:**
- Adding/editing bus routes
- Managing vehicle information
- Assigning students to buses
- Collecting transport fees
- Printing transport fee receipts

---

### 6️⃣ **STAFF RECORDS MODULE**
**Entry Point:** `staff_setting.php`

**What it does:** Manages all school staff/employee information.

**Navigation Flow:**
```
staff_setting.php (Staff Dashboard)
    │
    ├── SIDEBAR MENU:
    │   ├── view_staff_department.php (Departments: Admin, Teaching, etc.)
    │   │       ├── add_staff_department.php
    │   │       ├── edit_staff_department.php
    │   │       └── delete_staff_department.php
    │   │
    │   ├── view_staff_category.php (Categories: Principal, Teacher, etc.)
    │   │       ├── add_staff_category.php
    │   │       ├── edit_staff_category.php
    │   │       └── delete_staff_category.php
    │   │
    │   ├── view_staff_qualification.php (Education: B.Ed, M.A., etc.)
    │   │       ├── add_staff_qualification.php
    │   │       ├── edit_staff_qualification.php
    │   │       └── delete_staff_qualification.php
    │   │
    │   ├── view_staff_position.php (Positions: HOD, Coordinator, etc.)
    │   │       ├── add_staff_position.php
    │   │       ├── edit_staff_position.php
    │   │       └── delete_staff_position.php
    │   │
    │   └── view_staff.php (All staff members)
    │           ├── add_new_staff_detail.php (Add new employee)
    │           ├── edit_staf_employee_detail.php (Edit employee info)
    │           ├── view_staff_employee.php (View employee profile)
    │           └── delete_staff.php (Remove employee)
    │
    └── PROFILE:
            └── employee_profile.php (View detailed employee profile)
```

**Key Operations:**
- Adding new staff members
- Managing staff departments and categories
- Recording qualifications and positions
- Editing/viewing staff profiles

---

### 7️⃣ **ACCOUNTS MODULE**
**Entry Point:** `account_setting.php`

**What it does:** Tracks school income and expenses.

**Navigation Flow:**
```
account_setting.php (Accounts Dashboard)
    │
    ├── income_manager.php (All income entries)
    │       ├── add_income.php (Record income)
    │       ├── edit_income.php (Edit income entry)
    │       └── delete_income.php (Delete entry)
    │
    ├── expense_manager.php (All expense entries)
    │       ├── add_expense.php (Record expense)
    │       ├── edit_expense.php (Edit expense entry)
    │       └── delete_expense.php (Delete entry)
    │
    ├── account_category_manager.php (Categories: Salary, Utilities, etc.)
    │       ├── add_account_category_manager.php
    │       ├── edit_account_category_manager.php
    │       └── delete_account_category_manager.php
    │
    └── REPORTS:
            ├── account_report.php (View financial reports)
            ├── entry_account_report.php (Generate report)
            └── daily_report.php (Daily income/expense summary)
```

**Key Operations:**
- Recording income (fees collected, donations)
- Recording expenses (salaries, utilities, supplies)
- Categorizing transactions
- Generating financial reports

---

### 8️⃣ **SCHOOL SETTINGS MODULE**
**Entry Point:** `school_setting.php`

**What it does:** Basic school configuration - classes, sections, subjects, streams.

**Navigation Flow:**
```
school_setting.php (School Settings Dashboard)
    │
    ├── school_detail.php (Basic school info: name, address, logo)
    │       ├── add_school_detail.php
    │       ├── edit_school_detail.php
    │       └── delete_school_detail.php
    │
    ├── class.php (Classes: Grade 1, Grade 2, etc.)
    │       ├── add_class.php
    │       ├── edit_class.php
    │       └── delete_class.php
    │
    ├── section.php (Sections: A, B, C within a class)
    │       ├── add_section.php
    │       ├── edit_section.php
    │       └── delete_section.php
    │
    ├── stream.php (Streams: Science, Commerce, Arts)
    │       ├── add_stream.php
    │       ├── edit_stream.php
    │       └── delete_stream.php
    │
    ├── subject.php (Subjects: Math, English, Science)
    │       ├── add_subject.php
    │       ├── edit_subject.php
    │       └── delete_subject.php
    │
    └── ALLOCATION (Assign sections/streams/subjects to classes):
            ├── allocate_section.php → add_allocate_section.php
            ├── allocate_stream.php → add_allocate_stream.php
            └── allocate_subject.php → add_allocate_subject.php
```

**Key Operations:**
- Setting up school information
- Creating classes and sections
- Adding subjects and streams
- Allocating subjects to classes

---

### 9️⃣ **STUDENT DETAILS MODULE**
**Entry Point:** `student_detail.php`

**What it does:** Central place to view and search for student information.

**Navigation Flow:**
```
student_detail.php (Main student list)
    ├── student_detail_2.php (Alternative view)
    ├── view_student_detail.php (Detailed student profile)
    ├── searchby_name.php (Search students)
    └── student_search_result.php (Search results)
```

**Related Features:**
- `student_fees_reports.php` - Fee payment history
- `student_pending_fees_detail.php` - Outstanding fees
- `student_transport_fees_reports.php` - Transport fee records
- `student_tc.php` - Transfer certificate management

---

### 🔟 **STUDENT TC (Transfer Certificate) MODULE**
**Entry Point:** `entry_student_tc.php`

**What it does:** Generates transfer certificates when students leave school.

**Navigation Flow:**
```
entry_student_tc.php (TC Entry Form)
    ├── student_tc.php (View all TCs)
    ├── student_tc_show.php (Display TC)
    ├── student_tc_search_by_name.php (Find student for TC)
    └── student_tc_backup.php (Backup records)
```

---

## 🔗 File-to-File Redirects & Links

### Common Redirect Pattern:

Most forms follow this flow:
```
add_*.php (Form Page) → Submission → Database Update → header("Location: manager_page.php?msg=1")
                                                              ↓
                                                    Returns to listing page with success message
```

### Example: Adding a Student Fee
```
1. fees_manager.php (Click "Add Fees")
   ↓
2. add_student_fees.php (Fill form, click Submit)
   ↓
3. Form submits to itself (add_student_fees.php processes POST)
   ↓
4. Redirects to: fees_manager.php?msg=1 (Success message shown)
```

### Example: Editing Transport Route
```
1. transport_route_detail.php (Click "Edit" on a route)
   ↓
2. transport_route_edit.php?id=123 (Edit form)
   ↓
3. Form submits to itself, processes changes
   ↓
4. Redirects to: transport_route_detail.php?msg=3 (Updated successfully)
```

### Delete Operations:
```
manager_page.php → Click Delete → delete_*.php?id=123 → Deletes record → Redirects back to manager_page.php?msg=2
```

---

## 🎯 Complete Navigation Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                        ENTRY POINT                               │
│                       index.php                                  │
│                     (Login Page)                                 │
└───────────────────────────┬─────────────────────────────────────┘
                            │
                            ↓ [Submit username/password]
┌───────────────────────────────────────────────────────────────────┐
│                    login_process.php                              │
│              (Verify credentials & create session)                │
└───────────────────────────┬───────────────────────────────────────┘
                            │
                            ↓ [If authentication successful]
┌───────────────────────────────────────────────────────────────────┐
│                       session.php                                 │
│              (Select School Year/Session)                         │
└───────────────────────────┬───────────────────────────────────────┘
                            │
                            ↓ [After session selection]
┌───────────────────────────────────────────────────────────────────┐
│                      dashboard.php                                │
│                   (MAIN CONTROL PANEL)                            │
│  ┌────────────────────────────────────────────────────────┐      │
│  │  10 Module Cards:                                      │      │
│  │  1. School Settings    2. Admission                    │      │
│  │  3. Student Details    4. Fees Manager                 │      │
│  │  5. Accounts          6. Examinations                  │      │
│  │  7. Transport         8. Staff Records                 │      │
│  │  9. Library           10. Student TC                   │      │
│  └────────────────────────────────────────────────────────┘      │
└───────┬───┬───┬───┬───┬───┬───┬───┬───┬──────────────────────────┘
        │   │   │   │   │   │   │   │   │
        ↓   ↓   ↓   ↓   ↓   ↓   ↓   ↓   ↓
        │   │   │   │   │   │   │   │   └─→ entry_student_tc.php
        │   │   │   │   │   │   │   │         (Transfer Certificate)
        │   │   │   │   │   │   │   │
        │   │   │   │   │   │   │   └─────→ library_setting.php
        │   │   │   │   │   │   │             (Library Management)
        │   │   │   │   │   │   │               ├─→ Book Manager
        │   │   │   │   │   │   │               ├─→ Issue/Return Books
        │   │   │   │   │   │   │               └─→ Fine Manager
        │   │   │   │   │   │   │
        │   │   │   │   │   │   └───────────→ staff_setting.php
        │   │   │   │   │   │                   (Staff Management)
        │   │   │   │   │   │                     ├─→ Add/Edit Staff
        │   │   │   │   │   │                     ├─→ Departments
        │   │   │   │   │   │                     └─→ Qualifications
        │   │   │   │   │   │
        │   │   │   │   │   └─────────────────→ transport_setting.php
        │   │   │   │   │                         (Transport Management)
        │   │   │   │   │                           ├─→ Routes
        │   │   │   │   │                           ├─→ Vehicles/Buses
        │   │   │   │   │                           ├─→ Student Assignment
        │   │   │   │   │                           └─→ Transport Fees
        │   │   │   │   │
        │   │   │   │   └───────────────────────→ exam_setting.php
        │   │   │   │                               (Exam Management)
        │   │   │   │                                 ├─→ Exam Schedule
        │   │   │   │                                 ├─→ Enter Marks
        │   │   │   │                                 ├─→ Generate Marksheet
        │   │   │   │                                 └─→ View Results
        │   │   │   │
        │   │   │   └─────────────────────────────→ account_setting.php
        │   │   │                                     (Accounts)
        │   │   │                                       ├─→ Income Manager
        │   │   │                                       ├─→ Expense Manager
        │   │   │                                       └─→ Financial Reports
        │   │   │
        │   │   └───────────────────────────────────→ fees_setting.php
        │   │                                           (Fees Management)
        │   │                                             ├─→ Fee Packages
        │   │                                             ├─→ Fee Collection
        │   │                                             ├─→ Receipts
        │   │                                             └─→ Pending Fees
        │   │
        │   └─────────────────────────────────────────→ student_detail.php
        │                                                 (Student Records)
        │                                                   ├─→ View Students
        │                                                   ├─→ Search Students
        │                                                   └─→ Fee Reports
        │
        └───────────────────────────────────────────────→ admission.php
                                                            (Admissions)
                                                              ├─→ New Admission
                                                              ├─→ Edit Student
                                                              └─→ Student List

┌───────────────────────────────────────────────────────────────────┐
│                          LOGOUT                                   │
│                       logout.php                                  │
│            (Destroy session and return to login)                  │
└───────────────────────────────────────────────────────────────────┘
```

---

## 🧩 Supporting Files & Includes

### **includes/** Directory (Shared Components)

| File | Purpose |
|------|---------|
| `bootstrap.php` | Initializes application (session, database, security headers) |
| `header.php` | Top navigation bar & authentication check |
| `sidebar.php` | Main sidebar menu (used on dashboard) |
| `footer.php` | Page footer |
| `database.php` | Database connection handler |
| `config.php` | Configuration settings |
| `*_setting_sidebar.php` | Module-specific sidebars (fees, exam, library, etc.) |

### **Page Structure Pattern**

Every page follows this structure:
```php
<?php
// 1. Include bootstrap (session + database)
require_once("includes/bootstrap.php");

// 2. Include header (authentication check + top bar)
include_once("includes/header.php");

// 3. Include sidebar (navigation menu)
include_once("includes/sidebar.php");

// 4. Page content goes here

// 5. Include footer
include_once("includes/footer.php");
?>
```

---

## 🔒 Security Features

1. **Authentication Guard:** `includes/header.php` checks if user is logged in
2. **Session Management:** Started in `includes/bootstrap.php`
3. **Password Verification:** Modern PHP `password_verify()` in `login_process.php`
4. **Database Escaping:** Functions like `db_escape()` prevent SQL injection
5. **Logout:** `logout.php` destroys session and redirects to login

---

## 📝 Summary for Non-Developers

Think of this ERP system like a **digital filing cabinet** for the entire school:

- **Entry Door:** `index.php` (Login)
- **Reception Desk:** `dashboard.php` (Choose which department to visit)
- **Departments:** Each module (Admissions, Fees, Exams, etc.)
- **Filing Clerks:** PHP files that add, edit, delete, or view records
- **Forms:** Files like `add_*.php` and `edit_*.php`
- **Database:** Where all information is permanently stored

### How It Works:
1. You **log in** at the entrance (`index.php`)
2. You're greeted by the **dashboard** (main menu)
3. You click on a **module** (e.g., "Fees Manager")
4. You perform an **action** (e.g., "Add Fee Payment")
5. The system **saves** your work to the database
6. You see a **confirmation message**
7. You can **navigate back** or go to another module

All modules are interconnected - for example:
- A student admitted in **Admissions** can be:
  - Assigned fees in **Fees Manager**
  - Given marks in **Examinations**
  - Issued books in **Library**
  - Assigned a bus in **Transport**

---

## 🎓 Quick Reference: Main Files

| Purpose | File Name |
|---------|-----------|
| **Login Page** | `index.php` |
| **Process Login** | `login_process.php` |
| **Select Session** | `session.php` |
| **Main Dashboard** | `dashboard.php` |
| **Logout** | `logout.php` |
| **Admissions** | `admission.php` |
| **Student Records** | `student_detail.php` |
| **Fees** | `fees_setting.php` |
| **Exams** | `exam_setting.php` |
| **Library** | `library_setting.php` |
| **Transport** | `transport_setting.php` |
| **Staff** | `staff_setting.php` |
| **Accounts** | `account_setting.php` |
| **School Settings** | `school_setting.php` |
| **Transfer Certificate** | `entry_student_tc.php` |

---

## 🚀 Typical User Journey Examples

### Example 1: Collecting Fee from a Student
```
dashboard.php → Click "Fees Manager"
    ↓
fees_setting.php → Click "Fees Manager" from sidebar
    ↓
fees_manager.php → Click "Search Student"
    ↓
fees_searchby_name.php → Type student name, submit
    ↓
fees_search_result.php → Click on student
    ↓
entry_fees_reciept.php → Enter amount, click Submit
    ↓
Saves to database → Redirects to fees_manager.php
    ↓
fees_reciept.php → Print receipt
```

### Example 2: Issuing a Library Book
```
dashboard.php → Click "Library"
    ↓
library_setting.php → Click "Student Books Manager"
    ↓
library_student_books_manager.php → Click "Issue New Book"
    ↓
library_add_student_books.php → Select student, select book, enter dates
    ↓
Saves to database → Redirects to library_student_books_manager.php
```

### Example 3: Adding Exam Marks
```
dashboard.php → Click "Examinations"
    ↓
exam_setting.php → Click "Student Marks Entry"
    ↓
exam_show_student_marks.php → Select exam term, class
    ↓
exam_marks_add_student.php → Select student
    ↓
entry_exam_add_student_marks.php → Enter marks for each subject, submit
    ↓
Saves to database → Can print marksheet from exam_final_marksheet.php
```

---

## 📚 Additional Resources

- **Database Schema:** Located in `db/school_erp_schema_audit.sql`
- **Assets:** CSS and images in `assets/` directory
- **Screenshots:** Example screenshots in `screenshots/` directory
- **Documentation:** Additional docs in `docs/` directory

---

**End of Guide** - This ERP system is designed to handle all aspects of school management in one unified platform!
