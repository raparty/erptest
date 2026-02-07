<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div class="page_title">
    <span class="title_icon"><span class="computer_imac"></span></span>
    <h3>Student Admissions</h3>
</div>

<div class="switch_bar">
    <ul>
        <li>
            <a href="add_admission.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24" style="width:32px; fill:#0078D4;"><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                <span class="label">New Admission</span>
            </a>
        </li>
        <li>
            <a href="student_detail.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24" style="width:32px; fill:#605E5C;"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                <span class="label">Student List</span>
            </a>
        </li>
    </ul>
</div>

<div id="container">
    <div id="content">
        <div class="grid_container">
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_top">
                        <span class="h_icon user"></span>
                        <h6>Recent Admissions</h6>
                    </div>
                    <div class="widget_content">
                        <table class="display data_tbl">
                            <thead>
                                <tr>
                                    <th>Reg. No</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Fetching from the modernized 'admissions' table
                                $sql = "SELECT a.id, a.reg_no, a.student_name, c.class_name, a.admission_date 
                                        FROM admissions a 
                                        JOIN classes c ON a.class_id = c.id 
                                        ORDER BY a.id DESC LIMIT 10";
                                $res = db_query($sql);
                                while($row = db_fetch_array($res)) { ?>		
                                <tr>
                                    <td class="center"><?php echo $row['reg_no']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row['student_name']); ?></strong></td>
                                    <td class="center"><?php echo htmlspecialchars($row['class_name']); ?></td>
                                    <td class="center"><?php echo $row['admission_date']; ?></td>
                                    <td class="center"><span class="badge_green">Confirmed</span></td>
                                    <td class="center">
                                        <a href="view_admission.php?id=<?php echo $row['id']; ?>" class="action-icons c-edit">View</a>
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
