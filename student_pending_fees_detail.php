<?php
declare(strict_types=1);
include_once("includes/header.php");
include_once("includes/sidebar.php");
?>

<div class="page_title">
<span class="title_icon"><span class="money_dollar"></span></span>
<h3>Student Pending Fees Detail</h3>
</div>

<div id="container">
<div id="content">
tainer">
class="widget_wrap enterprise-card">
Criteria</h6>
tent p-4">
="student_pending_fees_detail.php" method="post">
g-3 mb-3">
class="form-label fw-bold">Fees Term</label>
ame="fees_term" class="form-control" required>
 value="">- Select fees term -</option>
FROM fees_term ";
l);
"<option value='{$row['fees_term_id']}'>{$row['term_name']}</option>";
class="form-label fw-bold">Class Name</label>
ame="class" class="form-control" required onChange="getForm('ajax_stream_code.php?class_id='+this.value)">
 value="">- Select Class -</option>
FROM class ";
l);
"<option value='{$row['class_id']}'>{$row['class_name']}</option>";
class="form-label fw-bold">Search By Name <span class="text-muted small">(optional)</span></label>
put name="name" type="text" class="form-control" placeholder="Enter student name" />
class="mt-3">
 type="submit" name="submit" class="btn-fluent-primary">
height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
>
class="widget_wrap enterprise-card">
t Pending Fees Detail</h6>
tent">
 data_tbl">
o.</th>
t Name</th>
t Fees</th>
ding Fees</th>
</th>

ame="student_info";
clude_once("student_pending_fees_pagination.php");
um=db_num_rows($student_info11);
um!=0)
t_info11))
FROM student_info where registration_no='".$row[1]."' ";
t_info=db_fetch_array(db_query($sql));
 
ding="select sum(fees_amount) from student_fees_detail where registration_no='".$student_info['registration_no']."'  and session='".$_SESSION['session']."'";
t=db_fetch_array(db_query($sql_pending));
 
FROM fees_package where package_id='".$row['admission_fee']."' ";
l);
l1="SELECT * FROM class where class_id='".$student_info['class']."'";
uery($sql1));
FROM fees_term where fees_term_id='".$_POST['fees_term']."' ";
uery($sql1));
ter"><?php echo $i;?></td>
ter"><?php echo $student_info['name']; ?></td>
ter"><?php echo $class['class_name']; ?></td>
ter"><?php echo $fees_term['term_name']; ?></td>
ter"><?php echo $row3['package_fees']; ?></td>
ter"><?php echo $pending_amount=$row3['package_fees']-$deposit_amount[0];?></td>
ter"><?php echo $row['session']; ?></td>

colspan="7" class="center text-danger">No result found.......</td></tr>

include_once("includes/footer.php");?>
