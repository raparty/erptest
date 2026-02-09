<?php
declare(strict_types=1);
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div class="page_title">
    
    <h3>Student Pending Fees Detail</h3>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Search Criteria</h6>
                    </div>
                    <div class="widget_content p-4">
                        <form action="student_pending_fees_detail.php" method="post">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Fees Term</label>
                                    <select name="fees_term" class="form-control" required>
                                        <option value="">- Select fees term -</option>
                                        <?php
                                        $sql = "SELECT * FROM fees_term";
                                        $res = db_query($sql);
                                        while ($row = db_fetch_array($res)) {
                                            echo "<option value='{$row['fees_term_id']}'>{$row['term_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Class Name</label>
                                    <select name="class" class="form-control" required onChange="getForm('ajax_stream_code.php?class_id='+this.value)">
                                        <option value="">- Select Class -</option>
                                        <?php
                                        $sql = "SELECT * FROM class";
                                        $res = db_query($sql);
                                        while ($row = db_fetch_array($res)) {
                                            echo "<option value='{$row['class_id']}'>{$row['class_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Search By Name <span class="text-muted small">(optional)</span></label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter student name" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="submit" class="btn-fluent-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if (isset($_POST['submit'])): ?>
            <div class="grid_12">
                <div class="widget_wrap enterprise-card">
                    <div class="widget_top">
                        <h6>Student Pending Fees Detail</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Term</th>
                                    <th>Total Fees</th>
                                    <th>Pending Fees</th>
                                    <th>Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $table_name = "student_info";
                                include_once("student_pending_fees_pagination.php");
                                $num = db_num_rows($student_info11);
                                if ($num != 0) {
                                    $i = 1;
                                    while ($row = db_fetch_array($student_info11)) {
                                        // Sanitize and escape values
                                        $registration_no = db_escape_string($row[1]);
                                        $sql = "SELECT * FROM student_info where registration_no='" . $registration_no . "'";
                                        $student_info = db_fetch_array(db_query($sql));
                                        
                                        $session = db_escape_string($_SESSION['session']);
                                        $sql_pending = "select COALESCE(sum(fees_amount), 0) from student_fees_detail where registration_no='" . db_escape_string($student_info['registration_no']) . "' and session='" . $session . "'";
                                        $deposit_amount = db_fetch_array(db_query($sql_pending));
                                        
                                        $admission_fee = db_escape_string($row['admission_fee']);
                                        $sql_package = "SELECT * FROM fees_package where package_id='" . $admission_fee . "'";
                                        $row3 = db_fetch_array(db_query($sql_package));
                                        
                                        $class_id = db_escape_string($student_info['class']);
                                        $sql_class = "SELECT * FROM class where class_id='" . $class_id . "'";
                                        $class = db_fetch_array(db_query($sql_class));
                                        
                                        $fees_term_id = db_escape_string($_POST['fees_term']);
                                        $sql_fees_term = "SELECT * FROM fees_term where fees_term_id='" . $fees_term_id . "'";
                                        $fees_term = db_fetch_array(db_query($sql_fees_term));
                                        
                                        // Calculate pending amount safely
                                        $total_fees = floatval($row3['package_fees'] ?? 0);
                                        $deposited = floatval($deposit_amount[0] ?? 0);
                                        $pending_amount = $total_fees - $deposited;
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><?php echo htmlspecialchars($student_info['name']); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($class['class_name']); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($fees_term['term_name']); ?></td>
                                    <td class="center">₹<?php echo number_format($total_fees, 2); ?></td>
                                    <td class="center">₹<?php echo number_format($pending_amount, 2); ?></td>
                                    <td class="center"><?php echo htmlspecialchars($row['session']); ?></td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="center text-danger">No result found.......</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php"); ?>
