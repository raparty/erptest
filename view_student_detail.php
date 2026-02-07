<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

// Fetching from the modernized 'admissions' table
$student_id = (int)($_GET['student_id'] ?? 0);
$sql = "SELECT a.*, c.class_name 
        FROM admissions a 
        LEFT JOIN classes c ON a.class_id = c.id 
        WHERE a.id = '$student_id'";
$row_value = db_fetch_array(db_query($sql));

if (!$row_value) {
    echo "<div class='alert alert-danger'>Student record not found.</div>";
    exit;
}

// File Path Logic (The "Drive" mapping)
$photo_path = !empty($row_value['student_pic']) ? $row_value['student_pic'] : 'assets/images/no-photo.png';
?>

<div id="container">
    <div class="page_title">
        <span class="title_icon"><span class="user_business_st"></span></span>
        <h3>Student Profile: <?php echo htmlspecialchars($row_value['student_name']); ?></h3>
    </div>

    <div id="content">
        <div class="grid_container">
            <div class="grid_4">
                <div class="widget_wrap enterprise-card text-center" style="padding: 30px 20px;">
                    <img src="<?php echo $photo_path; ?>" alt="Profile" 
                         style="width: 150px; height: 150px; border-radius: 15px; border: 4px solid #f1f5f9; object-fit: cover; margin-bottom: 20px;">
                    <h4 style="color: #0078D4; margin-bottom: 5px;"><?php echo htmlspecialchars($row_value['student_name']); ?></h4>
                    <span class="badge bg-primary mb-3"><?php echo htmlspecialchars($row_value['reg_no']); ?></span>
                    
                    <div style="margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                        <a href="edit_admission.php?id=<?php echo $student_id; ?>" class="btn_blue w-100 mb-2">Edit Profile</a>
                        <a href="print_id_card.php?student_id=<?php echo $student_id; ?>" class="btn btn-outline-secondary btn-sm w-100">Print ID Card</a>
                    </div>
                </div>
            </div>

            <div class="grid_8">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Academic & Personal Details</h6>
                    </div>
                    <div class="widget_content" style="padding: 25px;">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold">DATE OF BIRTH</label>
                                <p class="fw-medium"><?php echo date('d-M-Y', strtotime($row_value['dob'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold">ADMISSION DATE</label>
                                <p class="fw-medium"><?php echo date('d-M-Y', strtotime($row_value['admission_date'])); ?></p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold">CLASS / GRADE</label>
                                <p class="fw-medium text-primary"><?php echo htmlspecialchars($row_value['class_name'] ?? 'Not Assigned'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold">GENDER / BLOOD GROUP</label>
                                <p class="fw-medium"><?php echo $row_value['gender']; ?> (<?php echo $row_value['blood_group'] ?: 'N/A'; ?>)</p>
                            </div>
                        </div>

                        <div style="background: #f8fafc; border-radius: 10px; padding: 20px; border: 1px solid #eff6ff;">
                            <h6 style="color: #1e293b; margin-bottom: 15px; font-size: 12px; text-transform: uppercase;">Guardian & Identification</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-muted small fw-bold">GUARDIAN NAME</label>
                                    <p class="fw-medium mb-1"><?php echo htmlspecialchars($row_value['guardian_name'] ?: 'N/A'); ?></p>
                                    <p class="text-muted small"><?php echo htmlspecialchars($row_value['guardian_phone'] ?: ''); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small fw-bold">AADHAAR VERIFICATION</label>
                                    <p class="fw-medium mb-1"><?php echo $row_value['aadhaar_no'] ?: 'Not Provided'; ?></p>
                                    <?php if (!empty($row_value['aadhaar_doc_path'])): ?>
                                        <a href="<?php echo $row_value['aadhaar_doc_path']; ?>" target="_blank" class="text-primary small fw-bold">
                                            <svg style="width:14px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                                            View Aadhaar Document
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="text-muted small fw-bold">PAST SCHOOL INFORMATION</label>
                            <p class="text-muted" style="font-size: 13px; line-height: 1.6;">
                                <?php echo nl2br(htmlspecialchars($row_value['past_school_info'] ?: 'No previous school history recorded.')); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
