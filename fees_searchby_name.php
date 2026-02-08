<?php
declare(strict_types=1);

/**
 * ID 2.2: Student Selector for Fee Collection
 * Group 2: Fees & Accounts
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

// Handle Search Query
$search_query = db_escape($_POST['student_name'] ?? '');
?>

<div class="dashboard-header-container">
    <h2 class="enterprise-title">Fee Collection: Student Search</h2>
    <div class="dashboard-search-wrapper">
        <form action="" method="post" class="fluent-search-form">
            <div class="input-group shadow-sm">
                <input name="student_name" type="text" class="form-control fluent-input" 
                       placeholder="Type student name or registration number..." 
                       value="<?php echo htmlspecialchars($search_query); ?>" autofocus>
                <button type="submit" class="btn-azure-search">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="white"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <span>Search Student</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="grid_container">
    <?php include_once("includes/fees_setting_sidebar.php"); ?>

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Search Results</h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Photo</th>
                        <th>Reg. No</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($search_query)) {
                        $sql = "SELECT a.*, c.class_name 
                                FROM admissions a 
                                LEFT JOIN classes c ON a.class_id = c.id 
                                WHERE a.student_name LIKE '%$search_query%' 
                                OR a.reg_no LIKE '%$search_query%'
                                ORDER BY a.student_name ASC";
                        $res = db_query($sql);
                        
                        if (db_num_rows($res) > 0) {
                            while($row = db_fetch_array($res)) { 
                                $photo = !empty($row['student_pic']) ? $row['student_pic'] : 'assets/images/no-photo.png';
                    ?>
                    <tr>
                        <td class="center">
                            <img src="<?php echo $photo; ?>" alt="Student" class="fluent-table-avatar">
                        </td>
                        <td class="center"><strong><?php echo $row['reg_no']; ?></strong></td>
                        <td style="font-weight: 600;"><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td class="center"><?php echo htmlspecialchars($row['class_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['s_email'] ?? 'N/A'); ?></td>
                        <td class="center">
                            <a href="add_student_fees.php?registration_no=<?php echo urlencode($row['reg_no']); ?>" 
                               class="btn-fluent-primary" style="padding: 5px 15px; font-size: 12px;">
                               Select Student
                            </a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' class='center' style='padding: 40px; color: #6b7280;'>No students found matching '$search_query'.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='center' style='padding: 40px; color: #6b7280;'>Please enter a name above to start fee collection.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .title_icon { display: none !important; }
    .fluent-table-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 1px solid var(--app-border); }
</style>

<?php require_once("includes/footer.php"); ?>
