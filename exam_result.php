<?php
declare(strict_types=1);

/**
 * ID 4.9: Exam Result Search Hub
 * Restoration: Global Sidebar and Admissions Table Fix
 */
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php"); // Restoring full global navigation

// Capture Search Inputs
$reg_no = db_escape($_POST['registration_no'] ?? $_GET['id'] ?? '');
?>

<div class="grid_container">
    <div class="page_title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 style="font-weight: 400; color: var(--fluent-slate); font-size: 24px;">Exam Performance Search</h3>
    </div>

    <?php include_once("includes/exam_setting_sidebar.php"); ?>

    <div class="azure-card" style="margin-bottom: 30px; padding: 25px;">
        <h4 style="color: var(--app-primary); margin-bottom: 15px; font-weight: 500;">Search Student Performance</h4>
        <form action="" method="post" class="fluent-search-form">
            <div style="display: grid; grid-template-columns: 1fr 150px; gap: 15px; align-items: end;">
                <div class="form_group">
                    <label style="font-size: 12px; font-weight: 600;">Student Registration Number</label>
                    <select name="registration_no" class="chzn-select fluent-input" required>
                        <option value=""> - Select Registration No - </option>
                        <?php
                        // Correcting table to 'admissions' as per ERP schema
                        $sql = "SELECT reg_no, student_name FROM admissions WHERE session='".$_SESSION['session']."' ORDER BY reg_no ASC";
                        $res = db_query($sql);
                        while($row = db_fetch_array($res)) {
                            $sel = ($reg_no == $row['reg_no']) ? 'selected' : '';
                            echo "<option value='{$row['reg_no']}' $sel>{$row['reg_no']} - {$row['student_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit_number" class="btn-fluent-primary" style="height: 42px;">Search Results</button>
            </div>
        </form>
    </div>

    

    <div class="widget_wrap azure-card">
        <div class="widget_top">
            <h6 class="fluent-card-header">Academic Records <?php echo $reg_no ? "for $reg_no" : ""; ?></h6>
        </div>
        <div class="widget_content">
            <table class="display data_tbl fluent-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Subject</th>
                        <th>Exam Term</th>
                        <th class="center">Marks Obtained</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($reg_no)) {
                        $i = 1;
                        $sql_results = "SELECT m.*, s.subject_name, t.term_name 
                                        FROM exam_subject_marks m
                                        JOIN subjects s ON m.subject_id = s.subject_id
                                        JOIN exam_nuber_of_term t ON m.term_id = t.term_id
                                        WHERE m.registration_no = '$reg_no' AND m.session = '".$_SESSION['session']."'
                                        ORDER BY t.term_id ASC";
                        
                        $res_results = db_query($sql_results);
                        if (db_num_rows($res_results) > 0) {
                            while($row = db_fetch_array($res_results)) { ?>
                            <tr>
                                <td class="center"><?php echo $i++; ?></td>
                                <td style="font-weight: 600;"><?php echo htmlspecialchars($row['subject_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['term_name']); ?></td>
                                <td class="center" style="color: #059669; font-weight: 700;"><?php echo $row['marks']; ?></td>
                                <td class="center">
                                    <a href="exam_final_marksheet.php?registration_no=<?php echo $reg_no; ?>&term_id=<?php echo $row['term_id']; ?>" class="btn-fluent-primary" style="padding: 5px 15px; font-size: 11px;">View Marksheet</a>
                                </td>
                            </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='5' class='center' style='padding: 30px;'>No marks recorded for this student yet.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='center' style='padding: 30px;'>Please select a registration number above to view results.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .title_icon { display: none !important; }
    .chzn-container { width: 100% !important; }
</style>

<?php require_once("includes/footer.php"); ?>
