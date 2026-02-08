<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
require_once("includes/header.php");
require_once("includes/sidebar.php");

$q = db_escape($_POST['student_name'] ?? '');
?>
<div class="grid_container">
    <div class="page_title"><h3>Select Student for Marksheet</h3></div>
    <div class="azure-card" style="padding:20px;">
        <form method="post"><input type="text" name="student_name" class="fluent-input" placeholder="Enter name..." value="<?php echo $q; ?>"><button class="btn-fluent-primary">Search</button></form>
        <table class="fluent-table mt-4" style="width:100%;">
            <thead><tr><th>Reg No</th><th>Name</th><th>Action</th></tr></thead>
            <tbody>
                <?php 
                if($q) {
                    $res = db_query("SELECT reg_no, student_name FROM admissions WHERE student_name LIKE '%$q%' OR reg_no LIKE '%$q%'");
                    while($r = db_fetch_array($res)) { ?>
                        <tr>
                            <td><?php echo $r['reg_no']; ?></td>
                            <td><?php echo $r['student_name']; ?></td>
                            <td><a href="entry_exam_marksheet.php?registration_no=<?php echo $r['reg_no']; ?>" class="btn-fluent-primary">Select</a></td>
                        </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once("includes/footer.php"); ?>
