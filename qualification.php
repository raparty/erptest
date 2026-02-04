<?php include_once("includes/header.php"); ?>
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
				<div class="widget_wrap">
					<h3 style="padding-left:20px; color:#1c75bc">Add New Qualification</h3>
					<form action="#" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Qualification</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text"/>
											<span class=" label_intro"> New Qualification</span>
										</div>
									
										<span class="clear"></span>
									</div>

									
									<div class="form_input">

										<span class="clear"></span>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										
										<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
										
										<button type="submit" class="btn_small btn_orange"><span>Back</span></button>
										
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
