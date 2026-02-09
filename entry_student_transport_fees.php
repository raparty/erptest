<?php
declare(strict_types=1);
require_once("includes/bootstrap.php");
include_once("includes/header.php");
include_once("includes/sidebar.php");

$msg = "";
if(isset($_POST['submit']))
{
	if($_POST['pending_amount']>=$_POST['fees_amount'])
	{
		$sql1="SELECT * FROM student_fees_detail where registration_no='".$_POST['registration_no']."' and fees_term='".$_POST['fees_term']."' and session='".$_SESSION['session']."'";
		$res1=db_query($sql1) or die("Error : " . db_error());
		$num=db_num_rows($res1);
		if($num==0)
		{
			if($_POST['registration_no']!=""&&$_POST['fees_term']!=""&&$_POST['fees_amount']!="")
			{
				$sql3="INSERT INTO student_fees_detail(registration_no,fees_term,fees_amount,session) VALUES ('".$_POST['registration_no']."','".$_POST['fees_term']."','".$_POST['fees_amount']."','".$_SESSION['session']."')";
				$res3=db_query($sql3) or die("Error : " . db_error());
				header("Location:fees_manager.php?msg=1");
			}
			else
			{
				header("location:add_student_fees.php?error=2");
			}
		}
		else
		{
			header("location:add_student_fees.php?error=1");
		}
	}
	else
	{
		header("location:add_student_fees.php?error=3");
	}
}
else
{
	if($_GET['msg']==1)
	{
		$msg = "<div class='alert alert-success'>Student Fees Detail Added Successfully</div>";
	}
	if($_GET['msg']==2)
	{
		$msg = "<div class='alert alert-success'>Student Fees Detail Deleted Successfully</div>";
	}
	if($_GET['msg']==3)
	{
		$msg = "<div class='alert alert-success'>Student Fees Detail Updated Successfully</div>";
	}
	else if($_GET['error']==1)
	{
		$msg = "<div class='alert alert-danger'>Student Fees Detail Already Exists</div>";
	}
	else if($_GET['error']==2)
	{
		$msg = "<div class='alert alert-danger'>Please fill all detail</div>";
	}
	else if($_GET['error']==3)
	{
		$msg = "<div class='alert alert-danger'>Deposit fees amount is greater than pending amount.</div>";
	}
}
?>

<div class="page_title">
	<span class="title_icon"><span class="money_dollar"></span></span>
	<h3>Add Student Transport Fees</h3>
</div>

<div id="container">
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap enterprise-card">
					<div class="widget_top">
						<h6>Add Student Bus Fees</h6>
					</div>
					<div class="widget_content">
						<?php if($msg!=""){echo $msg; } ?>
						<form action="add_student_transport_fees.php" method="post" class="p-4" enctype="multipart/form-data">
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
									<a href="transport_fees_searchby_name.php" class="btn-fluent-secondary w-100">
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
								<button type="submit" name="submit1" class="btn-fluent-primary">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
										<path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor"/>
									</svg>
									Save
								</button>
								<a href="fees_manager.php" class="btn-fluent-secondary">
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
<?php include_once("includes/footer.php");?>
