<?php

declare(strict_types=1);
include_once("includes/header.php"); ?>
<?php include_once("includes/sidebar.php"); ?>
<main class="app-content">
<div id="header" class="blue_lin">
		<div class="header_left">
			<div class="logo">
				<img src="file://///RAM-PC/school-erp/schoolerp/images/logo.png" width="300" height="49" alt="Ekra">
			</div>
			<div id="responsive_mnu">
				<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
				<div id="responsive_menu" class="hidden">
					<ul>
						
						<li><a href="#"><span class="nav_icon computer_imac"></span> Dashboard</a>
				
				</li>
                
				<li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="file://///RAM-PC/school-erp/schoolerp/form-elements.html"><span class="list-icon">&nbsp;</span>All Forms Elements</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/left-label-form.html"><span class="list-icon">&nbsp;</span>Left Label Form</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/top-label-form.html"><span class="list-icon">&nbsp;</span>Top Label Form</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/form-xtras.html"><span class="list-icon">&nbsp;</span>Additional Forms (3)</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/form-validation.html"><span class="list-icon">&nbsp;</span>Form Validation</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/signup-form.html"><span class="list-icon">&nbsp;</span>Signup Form</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/content-post.html"><span class="list-icon">&nbsp;</span>Content Post Form</a></li>
					<li><a href="file://///RAM-PC/school-erp/schoolerp/wizard.html"><span class="list-icon">&nbsp;</span>wizard</a></li>
				</ul>
				</li>
		
					</ul>
				</div>
			</div>
		</div>
		<div class="header_right">
			
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="file://///RAM-PC/school-erp/schoolerp/images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">Administrator</span><span><a href="#">Profile</a> &#124; <a href="#">Settings</a> &#124; <a href="#">Help&#63;</a></span></li>
					<li class="logout"><a href="#"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
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
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>
	</div>

<div id="left_bar">
	
	
	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">
				<li><a href="#"><span class="nav_icon computer_imac"></span> Dashboard</a>
				
				</li>
                
				<li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="category.php"><span class="list-icon">&nbsp;</span>Super Category</a></li>
					<li><a href="sub_category.html"><span class="list-icon">&nbsp;</span>Sub Category</a></li>
				</ul>
				</li>
                <li><a href="#"><span class="nav_icon frames"></span>Staff<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="resister.html"><span class="list-icon">&nbsp;</span>Add Staff</a></li>
					<li><a href="qualification.html"><span class="list-icon">&nbsp;</span>Add Qualification</a></li>
                    <li><a href="staff_department.html"><span class="list-icon">&nbsp;</span>Department</a></li>
                    <li><a href="staff_category.html"><span class="list-icon">&nbsp;</span>Add Category</a></li>
                    <li><a href="staff_position.html"><span class="list-icon">&nbsp;</span>Add Position</a></li>
				</ul>
				</li>
                
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</ul>
		</div>
	</div>
</div>
<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">

          
			<div class="grid_12">
				<div class="widget_wrap" style="height:1000px">
					<h3 style="padding-left:20px; color:#1c75bc">Add New Qualification</h3>
					<form action="#" method="post" class="form_container left_label">
							<ul style="height:auto">
								<li>
								<div style="width:150px; height:auto; margin-left:20px; border:2px solid #dfdfdf; float:left; margin-top:27px">
            
              <div style="width:150px; height:150px; ">
             <a href="change_piture.php?menu=6"> <img src="images/photo_60x60.jpg" width="150" height="150"></a>
              
              </div>
              
                <div style="width:150px; height:30px; margin-top:-10px;background:#CCC">
                <h3 align="center" style=" padding-top:1px;"><a href="change_piture.php?menu=6" style="text-decoration:none;color:#0059AC">Change Picture</a></h3>
                </div>
            
  
            </div>
            
            
             <div style="width:640px; height:auto; float:left; margin-left:10px;">
             <div style="width:540px; height:30px;  float:left; ">

  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Emp No.</h3>
</div>
  
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Employee</h3>
</div>
  </div>
  
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>First Name</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; First Name</h3>
</div>
  
  </div>
  
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Last Name</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Last Name<?php echo $row_value['country'];?></h3>
</div>
  
  </div>
  
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Email</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;xyz@mail.com<?php echo $row_value['city'];?></h3>
</div>
  
  </div>
  
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Gender </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Male<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Department</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; I.T<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Category</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Information Technology<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Position </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; Web Developer<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Qualification </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; B-Tech<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Job Title </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Experience </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; 3 years<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Marritial Status </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Unmarried<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Father Name</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Father Name<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Mother Name</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Mother Name<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Blood Group</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;B+</h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Nationality</h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Indian<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Address1 </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp;Sectro12<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  <div style="width:540px; height:30px;  float:left; margin-left:160px;">
  <div style="width:180px; height:30px;  float:left;">
<h3>Address2 </h3>
</div>
  
  <div style="width:250px; height:30px;  float:left; margin-left:50px">
<h3 style="color:#333">:&nbsp;&nbsp; xyz, Jaipur<?php echo $row_value['phone'];?></h3>
</div>
  
  </div>
  
  
  
    
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
</main>
<?php include_once("includes/footer.php"); ?>
