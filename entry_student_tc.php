<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div class="page_title">
    
    <h3>Student Transfer Certificate</h3>
</div>
<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Generate Transfer Certificate</h6>
                    </div>
                    <div class="widget_content">
                        <form action="student_tc.php" method="post" class="p-4">
                            <div class="row mb-4">
                                <div class="col-md-5">
                                    <label for="registration_no" class="form-label fw-bold">
                                        Student Registration Number <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        name="registration_no" 
                                        id="registration_no"
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Enter SR Number"
                                        onBlur="getCheckreg('checkregno.php?registration_no='+this.value)" 
                                        required
                                    />
                                </div>
                                <div class="col-md-2 d-flex align-items-end justify-content-center">
                                    <span class="text-muted fw-bold">OR</span>
                                </div>
                                <div class="col-md-5 d-flex align-items-end">
                                    <a href="student_tc_search_by_name.php" class="btn-fluent-secondary w-100">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                                        </svg>
                                        Search by Name
                                    </a>
                                </div>
                            </div>
                            
                            <div id="stream_code"></div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex gap-2">
                                <button type="submit" name="entry_submit" class="btn-fluent-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor"/>
                                    </svg>
                                    Submit
                                </button>
                                <a href="student_detail.php" class="btn-fluent-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/>
                                    </svg>
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
