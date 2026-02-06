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
                
				<li><a href="#"><span class="nav_icon frames"></span> Admission</a>
				
				</li>
                
                <li><a href="#"><span class="nav_icon frames"></span> Student Detail</a>
				
				</li>
                
                <li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="category.html"><span class="list-icon">&nbsp;</span>Super Category</a></li>
					<li><a href="sub_category.html"><span class="list-icon">&nbsp;</span>Sub Category</a></li>
				</ul>
				</li>
                
                <li><a href="#"><span class="nav_icon frames"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem">
					<li><a href="category.html"><span class="list-icon">&nbsp;</span>Super Category</a></li>
					<li><a href="sub_category.html"><span class="list-icon">&nbsp;</span>Sub Category</a></li>
				</ul>
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
				<div class="widget_wrap">
					<h3 style="padding-left:20px; color:#1c75bc">Add New Sub Category</h3>
					<form action="#" method="post" class="form_container left_label">
							<ul>
                            
                            
                            <li>
								<div class="form_grid_12">
									<label class="field_title">Select Super Category</label>
									<div class="form_input">
										<select style=" width:300px" class="chzn-select" tabindex="13">
											<option value=""></option>
											
											<option>Dallas Cowboys</option>
											<option>New York Giants</option>
											<option>Philadelphia Eagles</option>
											<option>Washington Redskins</option>
										</select>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Sub Category Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="filed1" type="text"/>
											
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
