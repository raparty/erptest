<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

// Handle success messages from the process file
$msg = $_GET['msg'] ?? '';
$reg = $_GET['reg'] ?? '';
?>

<div id="container">
    <div class="page_title">
        <span class="title_icon"><span class="users_mm"></span></span>
        <h3>Student Directory</h3>
    </div>

    <?php if ($msg === 'success'): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px; background: #ecfdf5; color: #065f46; padding: 15px;">
            <strong>Success!</strong> Student admitted successfully. Registration Number: <strong><?php echo htmlspecialchars($reg); ?></strong>
        </div>
    <?php endif; ?>

    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Enrolled Students</h6>
                        <div class="widget_actions">
                            <a href="add_admission.php" class="btn_blue">+ New Admission</a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Reg. No</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                    <th>Admission Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Joining with the 'classes' table for a professional display
                                $sql = "SELECT a.*, c.class_name 
                                        FROM admissions a 
                                        LEFT JOIN classes c ON a.class_id = c.id 
                                        ORDER BY a.id DESC";
                                $res = db_query($sql);
                                
                                while($row = db_fetch_array($res)) { 
                                    // Use a placeholder if no photo exists
                                    $photo = !empty($row['student_pic']) ? $row['student_pic'] : 'assets/images/no-photo.png';
                                ?>		
                                <tr>
                                    <td class="center">
                                        <img src="<?php echo $photo; ?>" alt="Student" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                                    </td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['reg_no']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($row['class_name'] ?? 'N/A'); ?></td>
                                    <td class="center"><?php echo $row['gender']; ?></td>
                                    <td class="center"><?php echo date('d-M-Y', strtotime($row['admission_date'])); ?></td>
                                    <td class="center">
                                        <a href="view_student_detail.php?student_id=<?php echo $row['id']; ?>" class="action-icons c-edit" title="View Full Profile">Profile</a>
                                        <a href="delete_admission.php?sid=<?php echo $row['id']; ?>" class="action-icons c-delete" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
