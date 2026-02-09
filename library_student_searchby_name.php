<?php
declare(strict_types=1);

require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
include_once("includes/library_setting_sidebar.php");

$conn = Database::connection();
?>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <h3 style="padding:10px 0 0 20px; color:#1c75bc">Find Student for Library Issue</h3>
            
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Search Database</h6>
                    </div>
                    <div class="widget_content" style="padding: 20px;">
                        <form action="" method="post" class="form_container left_label">
                            <ul>
                                <li>
                                    <div class="form_grid_12">
                                        <label class="field_title">Student Name</label>
                                        <div class="form_input">
                                            <input name="name" type="text" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" placeholder="Try searching 'Actual'..." />
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form_input">
                                        <button type="submit" name="submit" class="btn_small btn_blue"><span>Run Global Search</span></button>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <h6>Results found in Admissions</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>S.R. Number</th>
                                    <th>Student Name</th>
                                    <th>Current Session</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $search_name = mysqli_real_escape_string($conn, trim((string)($_POST['name'] ?? '')));
                                
                                // We REMOVE the session check here to find the student regardless of their year
                                $sql = "SELECT reg_no, student_name, created_at FROM admissions";
                                if (!empty($search_name)) {
                                    $sql .= " WHERE student_name LIKE '%$search_name%' OR reg_no LIKE '%$search_name%'";
                                }
                                $sql .= " ORDER BY student_name ASC";
                                
                                $res = mysqli_query($conn, $sql);

                                if ($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i++; ?></td>
                                    <td class="center"><code><?php echo htmlspecialchars($row['reg_no']); ?></code></td>
                                    <td class="center"><strong><?php echo htmlspecialchars($row['student_name']); ?></strong></td>
                                    <td class="center"><?php echo date('Y', strtotime($row['created_at'])); ?></td>
                                    <td class="center">
                                        <a href="library_add_student_books.php?registration_no=<?php echo urlencode($row['reg_no']); ?>" class="btn_small btn_blue">
                                            <span>Select Student</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="5" class="center" style="padding:40px;">
                                            <span style="color:red;">No student found.</span><br>
                                            <small>Try searching by Registration No (ADM-2026-002) directly.</small>
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
