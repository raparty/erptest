<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
<?php 
if(isset($_POST['submit']))
{
	// $package_name = $_POST['package_name'];
	 //$class_id = $_POST['class_id'];
	//$school_logo = $_POST['school_logo'];
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
		}else
		{    header("location:add_student_fees.php?error=2");
			
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
		$msg = "<span style='color:#009900;'><h4> Student Fees  Detail Added Successfully </h4></span>";
	}
	if($_GET['msg']==2)
	{
		$msg = "<span style='color:#009900;'><h4>Student Fees Detail Deleted Successfully </h4></span>";
	}
	if($_GET['msg']==3)
	{
		$msg = "<span style='color:#009900;'><h4> Student Fees Detail Updated Successfully </h4></span>";
	}
	else if($_GET['error']==1)
	{
		$msg = "<span style='color:#FF0000;'><h4>Student Fees Detail Already Exists </h4></span>";
	}
	else if($_GET['error']==2)
	{
		$msg = "<span style='color:#FF0000;'><h4> Please fill all detail </h4></span>";
	}
	else if($_GET['error']==3)
	{
		$msg = "<span style='color:#FF0000;'><h4> Deposit fees amount is greater than  pending amount.</h4></span>";
	}
}


?>
<div class="page_title">
	<!--	<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Dashboard</h3>-->
		<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="Search" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>
<?php include_once("includes/fees_setting_sidebar.php");?>

<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">

          
			<div class="grid_12">
				<div class="widget_wrap">
					<h3 style="padding-left:20px; color:#0078D4">Add student bus  fees </h3>
                    
                    <?php if($msg!=""){echo $msg; } ?>
					<form action="add_student_transport_fees.php" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
								
                                
                               
                                
                                
                                
                                
                                
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title" style="width:15%"> S R Number<span style="color:#F00"> *</span>
</label>
                                    <div class="form_input" >
										
                                        <div class="form_grid_4 alpha"  >
											<input name="registration_no"   onBlur="getCheckreg('checkregno.php?registration_no='+this.value)" type="text" style=" margin-left:-192px;" />										
										</div>
                                        
                                        <label class="field_title" style=" margin-left:110px; width:16%">
OR <span style="color:#F00"> *</span>
</label>
                                        <div class="form_grid_4" style="margin-left:-25px;">
											<a href="transport_fees_searchby_name.php" class="btn-fluent-secondary" style="text-decoration:none;">
												<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
													<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"/>
												</svg>
												Search by Name
											</a>
								</div>
									
										<span class="clear"></span>
									</div>
                                    
                                    
                                    

									
									
								</div>
								</li>
                                
                                
                                
								<li>
								<div class="form_grid_12">
									<div class="form_input d-flex gap-2">
										
										<button type="submit" class="btn-fluent-primary" name="submit1">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
												<path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor"/>
											</svg>
											<span>Save</span>
										</button>
										
										<a href="fees_manager.php" class="btn-fluent-secondary">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:6px;">
												<path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/>
											</svg>
											<span>Back</span>
										</a>
										
									</div>
								</div>
								</li>
                                
                                 
							</ul>
						</form>
				</div>
			</div>
			
			
			<span class="clear"></span>
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include_once("includes/footer.php");?>