<?php

declare(strict_types=1);
include_once("includes/header.php"); ?>
<?php include_once("includes/sidebar.php"); ?>
<main class="app-content">
<div id="header" class="blue_lin">
		<div class="header_left">
			<div class="logo">
				<img src="images/logo.png" width="300" height="49" alt="Ekra">
			</div>
			<div id="responsive_mnu">
				<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
				<div id="responsive_menu" class="hidden">
					<ul>
						
						<li><a href="#"><span class="nav_icon computer_imac"></span> Dashboard</a>
				
				</li>
                
				<li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="form-elements.html"><span class="list-icon">&nbsp;</span>All Forms Elements</a></li>
					<li><a href="left-label-form.html"><span class="list-icon">&nbsp;</span>Left Label Form</a></li>
					<li><a href="top-label-form.html"><span class="list-icon">&nbsp;</span>Top Label Form</a></li>
					<li><a href="form-xtras.html"><span class="list-icon">&nbsp;</span>Additional Forms (3)</a></li>
					<li><a href="form-validation.html"><span class="list-icon">&nbsp;</span>Form Validation</a></li>
					<li><a href="signup-form.html"><span class="list-icon">&nbsp;</span>Signup Form</a></li>
					<li><a href="content-post.html"><span class="list-icon">&nbsp;</span>Content Post Form</a></li>
					<li><a href="wizard.html"><span class="list-icon">&nbsp;</span>wizard</a></li>
				</ul>
				</li>
		
					</ul>
				</div>
			</div>
		</div>
		<div class="header_right">
			
			<div id="user_nav">
				<ul>
					<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></a></li>
					<li class="user_info"><span class="user_name">Administrator</span><span><a href="#">Profile</a> &#124; <a href="#">Settings</a> &#124; <a href="#">Help&#63;</a></span></li>
					<li class="logout"><a href="#"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
    <div class="page_title">
	<!--	
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
				
					<h3 style="padding-left:20px; color:#0078D4; border-bottom:1px solid #e2e2e2;">Staff Resistration</h3>
                    
                    
               
               	<form action="#" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
               
           <br>
<br>
    <div class="grid_12">

 <div class="btn_30_light float-right">
<a href="#">
<span class="icon find_co"></span>
<span class="btn_link">Advance Search</span>
</a>
</div>

<div class="btn_30_light float-right">
<a href="#">
<span class="icon database_co"></span>
<span class="btn_link">View All</span>
</a>
</div>

           
                            
                            
                            
                            </div><br><br>
<br>

           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">General Details</h4>     </li>
               
               
               <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Employee Number</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text" name="emp_num"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">First Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text" name="first"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Last Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text" name="last"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Email</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text" name="email"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Gender</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input  type="radio" name="gender"/>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input  type="radio" name="gender"/>Female
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Departmant</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="department">
											<option value=""></option>
											
											<option>Hindi </option>
											<option>English</option>
											<option>Physics</option>
											<option>Chemistry</option>

<option>Math</option>

<option>Civil</option>
<option>Mechanical</option>
<option>Electrical</option>
<option>Information Technology</option>
<option>Electronics & Communication</option>
<option>Instrumentation</option>
<option>Computer</option>
<option>Production</option>
<option>Economics</option>
<option>Mechanics</option>
<option>Administartor</option>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Category</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="Category">
											<option value=""></option>
											
											<option>Administartion</option>
											<option>Lab Staff</option>
											<option>Teaching Staff</option>
											<option>Non Teaching Staff</option>

<option>Other</option>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Position</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="position">
											<option value=""></option>
											
											<option>Head Of Department</option>
											<option>Proctor</option>
											<option>Account</option>
											<option>Teacher</option>
                                            <option>Peon</option>
                                            <option>Other</option>

<option>Other</option>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Qualification</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="position">
											<option value=""></option>
											
											<option>Phd.</option>
											<option>Master Degree</option>
											<option>Graduate</option>
											<option>InterMediate</option>
                                            <option>High School</option>
                                            <option>Diploma</option>

<option>Other</option>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Job Title</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="job_title" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Experiance</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="exp" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                
                                <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Personal Details</h4>     </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Marrital Status</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="position">
											<option value=""></option>
											
											<option>Single</option>
											<option>Married</option>
											<option>Unmarried</option>
											<option>Divorce</option>
                                           

<option>Other</option>
										</select>
									</div>
								</div>
								</li>
                               <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Father Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="father_name" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Mother Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="mother_name" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Blood Group</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="blod_group" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Nationality</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13" name="nationality">
											<option value=""></option>
											
											<option>India</option>
											<option>American</option>
											<option>China</option>
											<option>Japn</option>
                                           

<option>Other</option>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Address1</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="address1" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Address2</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="address2" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Employee Photo</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="Image" type="text"/>
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li> 
       
                                
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
										
										<button type="submit" class="btn_small btn_blue"><span>Submit</span></button>
										
										
										
									</div>
								</div>
								</li>
                                

                </form>  

					
			
			</div>
            
            
			
			
			<span class="clear"></span>
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
</main>
<?php include_once("includes/footer.php"); ?>
