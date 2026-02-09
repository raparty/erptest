<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
	<div class="page_title">
		
		<h3>Account Settings</h3>
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
     <?php include_once("includes/account_setting_sidebar.php");?>

	<div id="container">
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_content settings-dashboard">
						<h2>Account Settings Dashboard</h2>
						<p>Use the navigation above to manage account categories, income, expenses, and reports.</p>
					</div>
				</div>
			</div>
		</div>
       <h1>&nbsp;</h1>
		  <h6 align="center" >Copyright © 2013 </h6>
	</div>
    </div>
  <?php include_once("includes/footer.php");?>
