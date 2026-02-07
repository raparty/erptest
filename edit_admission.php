<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $conn = Database::connection();
    $student_id = (int)$_GET['student_id'];
    
    // Sanitize inputs
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $admission_date = mysqli_real_escape_string($conn, $_POST['admission_date']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $class_id = (int)$_POST['class_id'];
    $aadhaar_no = mysqli_real_escape_string($conn, $_POST['aadhaar_no']);
    $guardian_name = mysqli_real_escape_string($conn, $_POST['guardian_name'] ?? '');
    $guardian_phone = mysqli_real_escape_string($conn, $_POST['guardian_phone'] ?? '');
    $past_school = mysqli_real_escape_string($conn, $_POST['past_school_info']);
    
    // Get old photo path
    $old_photo = mysqli_real_escape_string($conn, $_POST['old_photo']);
    $photo_path = $old_photo;
    
    // Handle new photo upload
    if (!empty($_FILES['student_pic']['name'])) {
        $upload_dir = "uploads/students/photos/";
        $ext = pathinfo($_FILES['student_pic']['name'], PATHINFO_EXTENSION);
        $filename = "student_" . $student_id . "_" . time() . "." . $ext;
        $target = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['student_pic']['tmp_name'], $target)) {
            $photo_path = $target;
            // Delete old photo if it exists and is not the default
            if ($old_photo && $old_photo !== 'assets/images/no-photo.png' && file_exists($old_photo)) {
                unlink($old_photo);
            }
        }
    }
    
    // Get old document path
    $old_doc = mysqli_real_escape_string($conn, $_POST['old_aadhaar_doc']);
    $doc_path = $old_doc;
    
    // Handle new Aadhaar document upload
    if (!empty($_FILES['aadhaar_doc']['name'])) {
        $upload_dir = "uploads/students/documents/";
        $ext = pathinfo($_FILES['aadhaar_doc']['name'], PATHINFO_EXTENSION);
        $filename = "student_" . $student_id . "_aadhaar_" . time() . "." . $ext;
        $target = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['aadhaar_doc']['tmp_name'], $target)) {
            $doc_path = $target;
            // Delete old document if it exists
            if ($old_doc && file_exists($old_doc)) {
                unlink($old_doc);
            }
        }
    }
    
    // Update query
    $sql = "UPDATE admissions SET 
                student_name = '$student_name',
                student_pic = '$photo_path',
                dob = '$dob',
                gender = '$gender',
                blood_group = '$blood_group',
                class_id = $class_id,
                admission_date = '$admission_date',
                aadhaar_no = '$aadhaar_no',
                aadhaar_doc_path = '$doc_path',
                guardian_name = '$guardian_name',
                guardian_phone = '$guardian_phone',
                past_school_info = '$past_school'
            WHERE id = $student_id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: view_student_detail.php?student_id=$student_id&msg=updated");
        exit;
    } else {
        $error_msg = "Database Error: " . mysqli_error($conn);
    }
}

// Fetch student data
$student_id = (int)($_GET['student_id'] ?? 0);
if ($student_id === 0) {
    header("Location: student_detail.php");
    exit;
}

$sql = "SELECT a.*, c.class_name 
        FROM admissions a 
        LEFT JOIN classes c ON a.class_id = c.id 
        WHERE a.id = '$student_id'";
$row_value = db_fetch_array(db_query($sql));

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
                                        <img src="<?php echo $current_photo; ?>" alt="Student Photo" 
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
                                            <input name="admission_date" type="date" class="form-control" value="<?php echo $row_value['admission_date']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Date of Birth</label>
                                            <input name="dob" type="date" class="form-control" value="<?php echo $row_value['dob']; ?>" required>
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
                                        $classes = db_query("SELECT id, class_name FROM classes ORDER BY id ASC");
                                        while($c = db_fetch_array($classes)) {
                                            $selected = ($c['id'] == $row_value['class_id']) ? 'selected' : '';
                                            echo "<option value='".$c['id']."' $selected>".$c['class_name']."</option>";
                                        }
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
                                        <small class="text-muted">Current: <a href="<?php echo $row_value['aadhaar_doc_path']; ?>" target="_blank">View Document</a></small>
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
