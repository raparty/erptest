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
            <h3 style="padding:15px 20px; color:#0078D4;">Global Student Search (No Restrictions)</h3>
            <div class="grid_12">
                <div class="widget_wrap">
                    <div class="widget_content" style="padding: 20px;">
                        <form action="" method="post">
                            <input name="search_term" type="text" placeholder="Enter Name or Reg No..." style="width:300px; padding:8px;" />
                            <button type="submit" name="submit" class="btn_small btn_blue"><span>Search</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid_12">
                <table class="display data_tbl">
                    <thead>
                        <tr>
                            <th>S.R. Number</th>
                            <th>Student Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($_POST['search_term'])) {
                            $term = mysqli_real_escape_string($conn, trim($_POST['search_term']));
                            // POWER SEARCH: Checks admissions using TRIM and LIKE
                            $sql = "SELECT reg_no, student_name FROM admissions 
                                    WHERE TRIM(student_name) LIKE '%$term%' 
                                    OR TRIM(reg_no) LIKE '%$term%'";
                            $res = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><code><?php echo $row['reg_no']; ?></code></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><a href="library_add_student_books.php?registration_no=<?php echo $row['reg_no']; ?>" class="btn_small btn_orange">Select</a></td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>
