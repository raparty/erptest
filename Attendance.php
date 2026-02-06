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

<div id="left_bar">
	
	
	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">
				<li><a href="#"><span class="nav_icon computer_imac"></span> Dashboard</a>
				
				</li>
                
				<li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="category.html"><span class="list-icon">&nbsp;</span>Super Category</a></li>
					<li><a href="sub_category.html"><span class="list-icon">&nbsp;</span>Sub Category</a></li>
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
		  <li style=" border-bottom:1px solid #f2420a; list-style:none">
					<h3 style=" color:#1c75bc">Attendance</h3></li>
                   
<br>
<br>
<br>
<br>
<br>

                    
					<div class="item_widget" style="width:701px;">
				
				
				
				
				<div class="item_block" style="margin-left:330px;">
					<div class="icon_block violet_block">
						<span class="item_icon">
						<span class="finished_work_sl"><a href="#">Articles</a></span>
						</span>
					</div>
					<h3><a href="#">Attendance register</a></h3>
					
				</div>
				
				
                <div class="item_block" >
					<div class="icon_block gray_block">
						<span class="item_icon">
						<span class="lightbulb_sl"><a href="#">Support Ticket</a></span>
						</span>
					</div>
					<h3><a href="#">Attendance Report</a></h3>
					
				</div>
			</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

				
		  </div>
			
			
			<span class="clear"></span>
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
</main>
<?php include_once("includes/footer.php"); ?>
