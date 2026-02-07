<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $conn = Database::connection();
    $student_id = (int)$_GET['student_id'];
    
    // Validate inputs
    $student_name = trim($_POST['student_name']);
    $admission_date = $_POST['admission_date'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blood_group = trim($_POST['blood_group']);
    $class_id = (int)$_POST['class_id'];
    $aadhaar_no = trim($_POST['aadhaar_no']);
    $guardian_name = trim($_POST['guardian_name'] ?? '');
    $guardian_phone = trim($_POST['guardian_phone'] ?? '');
    $past_school = trim($_POST['past_school_info']);
    
    // Validate Aadhaar number format (12 digits only)
    if (!empty($aadhaar_no) && !preg_match('/^\d{12}$/', $aadhaar_no)) {
        $error_msg = "Aadhaar number must be exactly 12 digits.";
    } else {
        // Get old photo path
        $old_photo = $_POST['old_photo'];
        $photo_path = $old_photo;
        
        // Handle new photo upload
        if (!empty($_FILES['student_pic']['name'])) {
            $upload_dir = "uploads/students/photos/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Validate file
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
            $max_size = 2 * 1024 * 1024; // 2MB
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES['student_pic']['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mime_type, $allowed_types)) {
                $error_msg = "Only JPG and PNG images are allowed.";
            } elseif ($_FILES['student_pic']['size'] > $max_size) {
                $error_msg = "Image file size must not exceed 2MB.";
            } else {
                $ext = pathinfo($_FILES['student_pic']['name'], PATHINFO_EXTENSION);
                $allowed_exts = ['jpg', 'jpeg', 'png'];
                if (!in_array(strtolower($ext), $allowed_exts)) {
                    $error_msg = "Invalid file extension.";
                } else {
                    $filename = "student_" . $student_id . "_" . time() . "." . $ext;
                    $target = $upload_dir . $filename;
                    if (move_uploaded_file($_FILES['student_pic']['tmp_name'], $target)) {
                        $photo_path = $target;
                        // Delete old photo if it exists and is within uploads directory
                        if ($old_photo && $old_photo !== 'assets/images/no-photo.png') {
                            $old_real = realpath($old_photo);
                            $uploads_real = realpath('uploads/students/');
                            if ($old_real && $uploads_real && strpos($old_real, $uploads_real) === 0 && file_exists($old_photo)) {
                                unlink($old_photo);
                            }
                        }
                    }
                }
            }
        }
        
        // Get old document path
        $old_doc = $_POST['old_aadhaar_doc'];
        $doc_path = $old_doc;
        
        // Handle new Aadhaar document upload
        if (empty($error_msg) && !empty($_FILES['aadhaar_doc']['name'])) {
            $upload_dir = "uploads/students/documents/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Validate PDF
            $max_size = 5 * 1024 * 1024; // 5MB
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES['aadhaar_doc']['tmp_name']);
            finfo_close($finfo);
            
            if ($mime_type !== 'application/pdf') {
                $error_msg = "Aadhaar document must be a PDF file.";
            } elseif ($_FILES['aadhaar_doc']['size'] > $max_size) {
                $error_msg = "PDF file size must not exceed 5MB.";
            } else {
                $ext = pathinfo($_FILES['aadhaar_doc']['name'], PATHINFO_EXTENSION);
                if (strtolower($ext) !== 'pdf') {
                    $error_msg = "Invalid file extension for document.";
                } else {
                    $filename = "student_" . $student_id . "_aadhaar_" . time() . "." . $ext;
                    $target = $upload_dir . $filename;
                    if (move_uploaded_file($_FILES['aadhaar_doc']['tmp_name'], $target)) {
                        $doc_path = $target;
                        // Delete old document if it exists and is within uploads directory
                        if ($old_doc) {
                            $old_real = realpath($old_doc);
                            $uploads_real = realpath('uploads/students/');
                            if ($old_real && $uploads_real && strpos($old_real, $uploads_real) === 0 && file_exists($old_doc)) {
                                unlink($old_doc);
                            }
                        }
                    }
                }
            }
        }
        
        // Update query using prepared statement
        if (empty($error_msg)) {
            $stmt = mysqli_prepare($conn, "UPDATE admissions SET 
                        student_name = ?,
                        student_pic = ?,
                        dob = ?,
                        gender = ?,
                        blood_group = ?,
                        class_id = ?,
                        admission_date = ?,
                        aadhaar_no = ?,
                        aadhaar_doc_path = ?,
                        guardian_name = ?,
                        guardian_phone = ?,
                        past_school_info = ?
                    WHERE id = ?");
            
            mysqli_stmt_bind_param($stmt, "sssssissssssi", 
                $student_name, $photo_path, $dob, $gender, $blood_group, 
                $class_id, $admission_date, $aadhaar_no, $doc_path, 
                $guardian_name, $guardian_phone, $past_school, $student_id);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                header("Location: view_student_detail.php?student_id=$student_id&msg=updated");
                exit;
            } else {
                error_log("Database error in edit_admission.php: " . mysqli_error($conn));
                $error_msg = "An error occurred while updating the student profile. Please try again.";
                mysqli_stmt_close($stmt);
            }
        }
    }
}

// Fetch student data
$student_id = (int)($_GET['student_id'] ?? 0);
if ($student_id === 0) {
    header("Location: student_detail.php");
    exit;
}

$conn = Database::connection();
$stmt = mysqli_prepare($conn, "SELECT a.*, c.class_name 
        FROM admissions a 
        LEFT JOIN classes c ON a.class_id = c.id 
        WHERE a.id = ?");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row_value = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row_value) {
    header("Location: student_detail.php");
    exit;
}

include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div id="container">
    <div class="page_title">
        <span class="title_icon"><span class="user_business_st"></span></span>
        <h3>Edit Student Profile</h3>
    </div>

    <?php if (isset($error_msg)): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fef2f2; color: #991b1b; padding: 15px;">
            <strong>Error!</strong> <?php echo htmlspecialchars($error_msg); ?>
        </div>
    <?php endif; ?>

    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Update Student Information</h6>
                        <div class="widget_actions">
                            <a href="student_detail.php" class="btn btn-fluent-secondary">Back to Directory</a>
                        </div>
                    </div>
                    <div class="widget_content">
                        <form action="edit_admission.php?student_id=<?php echo $student_id; ?>" method="post" enctype="multipart/form-data" class="form_container left_label">
                            <input type="hidden" name="old_photo" value="<?php echo htmlspecialchars($row_value['student_pic']); ?>">
                            <input type="hidden" name="old_aadhaar_doc" value="<?php echo htmlspecialchars($row_value['aadhaar_doc_path']); ?>">
                            
                            <div class="row">
                                <div class="col-md-4 text-center border-end">
                                    <div style="margin-bottom: 15px;">
                                        <?php 
                                        $current_photo = !empty($row_value['student_pic']) ? $row_value['student_pic'] : 'assets/images/no-photo.png';
                                        ?>
                                        <img src="<?php echo htmlspecialchars($current_photo); ?>" alt="Student Photo" 
                                             style="width: 150px; height: 150px; border: 2px solid #e2e8f0; border-radius: 12px; object-fit: cover; margin-bottom: 10px;">
                                    </div>
                                    <input type="file" name="student_pic" class="form-control form-control-sm" accept="image/*">
                                    <small class="text-muted">Max size: 2MB (JPG/PNG)</small>
                                </div>

                                <div class="col-md-8">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Full Name</label>
                                            <input name="student_name" type="text" class="form-control" value="<?php echo htmlspecialchars($row_value['student_name']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Admission Date</label>
                                            <input name="admission_date" type="date" class="form-control" value="<?php echo htmlspecialchars($row_value['admission_date']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Date of Birth</label>
                                            <input name="dob" type="date" class="form-control" value="<?php echo htmlspecialchars($row_value['dob']); ?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Gender</label>
                                            <select name="gender" class="form-select">
                                                <option value="Male" <?php echo ($row_value['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo ($row_value['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                                                <option value="Other" <?php echo ($row_value['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Blood Group</label>
                                            <input name="blood_group" type="text" class="form-control" value="<?php echo htmlspecialchars($row_value['blood_group']); ?>" placeholder="O+">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Class</label>
                                    <select name="class_id" class="form-select" required>
                                        <option value="">Select Class</option>
                                        <?php 
                                        $stmt_classes = mysqli_prepare($conn, "SELECT id, class_name FROM classes ORDER BY id ASC");
                                        mysqli_stmt_execute($stmt_classes);
                                        $classes_result = mysqli_stmt_get_result($stmt_classes);
                                        while($c = mysqli_fetch_assoc($classes_result)) {
                                            $is_selected = ($c['id'] == $row_value['class_id']);
                                            $selected_attr = $is_selected ? ' selected' : '';
                                            echo "<option value='".htmlspecialchars((string)$c['id'])."'".$selected_attr.">".htmlspecialchars($c['class_name'])."</option>";
                                        }
                                        mysqli_stmt_close($stmt_classes);
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Guardian Name</label>
                                    <input name="guardian_name" type="text" class="form-control" value="<?php echo htmlspecialchars($row_value['guardian_name']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Guardian Phone</label>
                                    <input name="guardian_phone" type="text" class="form-control" value="<?php echo htmlspecialchars($row_value['guardian_phone']); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Aadhaar Number</label>
                                    <input name="aadhaar_no" type="text" class="form-control" maxlength="12" value="<?php echo htmlspecialchars($row_value['aadhaar_no']); ?>" placeholder="12 Digit Number">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Aadhaar Document (PDF)</label>
                                    <input type="file" name="aadhaar_doc" class="form-control" accept=".pdf">
                                    <?php if (!empty($row_value['aadhaar_doc_path'])): ?>
                                        <small class="text-muted">Current: <a href="<?php echo htmlspecialchars($row_value['aadhaar_doc_path']); ?>" target="_blank">View Document</a></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Past School Information</label>
                                <textarea name="past_school_info" class="form-control" rows="2" placeholder="School Name, Location, Last Grade Completed"><?php echo htmlspecialchars($row_value['past_school_info']); ?></textarea>
                            </div>

                            <div class="form_grid_12">
                                <div class="form_input" style="text-align: right; padding-top: 20px;">
                                    <button type="submit" name="submit" class="btn_blue">Update Student Profile</button>
                                    <a href="student_detail.php" class="btn btn-light ms-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
