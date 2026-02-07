<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div id="container">
    <div class="page_title">
        <span class="title_icon"><span class="user_business_st"></span></span>
        <h3>New Student Admission</h3>
    </div>

    <?php include_once("includes/admission_sidebar.php"); ?>

    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Student Personal Profile</h6>
                    </div>
                    <div class="widget_content">
                        <form action="admission_process.php" method="post" enctype="multipart/form-data" class="form_container left_label">
                            <div class="row">
                                <div class="col-md-4 text-center border-end">
                                    <div style="margin-bottom: 15px;">
                                        <div style="width: 150px; height: 150px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                            <span>Photo Preview</span>
                                        </div>
                                    </div>
                                    <input type="file" name="student_pic" class="form-control form-control-sm" accept="image/*">
                                    <small class="text-muted">Max size: 2MB (JPG/PNG)</small>
                                </div>

                                <div class="col-md-8">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Full Name</label>
                                            <input name="student_name" type="text" class="form-control" placeholder="Enter Full Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Admission Date</label>
                                            <input name="admission_date" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Date of Birth</label>
                                            <input name="dob" type="date" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Gender</label>
                                            <select name="gender" class="form-select">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Blood Group</label>
                                            <input name="blood_group" type="text" class="form-control" placeholder="O+">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Class for Admission</label>
                                    <select name="class_id" class="form-select" required>
                                        <option value="">Select Class</option>
                                        <?php 
                                        $classes = db_query("SELECT id, class_name FROM classes ORDER BY id ASC");
                                        while($c = db_fetch_array($classes)) {
                                            echo "<option value='".$c['id']."'>".$c['class_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Aadhaar Number</label>
                                    <input name="aadhaar_no" type="text" class="form-control" maxlength="12" placeholder="12 Digit Number">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Aadhaar Document (PDF)</label>
                                    <input type="file" name="aadhaar_doc" class="form-control" accept=".pdf">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Past School Information</label>
                                <textarea name="past_school_info" class="form-control" rows="2" placeholder="School Name, Location, Last Grade Completed"></textarea>
                            </div>

                            <div class="form_grid_12">
                                <div class="form_input" style="text-align: right; padding-top: 20px;">
                                    <button type="submit" class="btn_blue">Confirm & Save Admission</button>
                                    <a href="student_detail.php" class="btn btn-light ms-2">Cancel</a>
                                    <button type="reset" class="btn btn-light ms-2">Clear Form</button>
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
