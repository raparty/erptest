<?php
declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php");?>
	<div class="page_title">
		<span class="title_icon"><span class="computer_imac"></span></span>
		<h3>Admission</h3>
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

	<div id="container">
	
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
                    <div class="switch_bar">
		<ul>
			<li><a href="student_detail.php"><span class="stats_icon user_sl"></span><span class="label">Student Details</span></a></li>
			<li><a href="rte_admission.php"><span class="stats_icon current_work_sl"></span><span class="label">RTE Admission</span></a></li>
			<li><a href="rte_student_detail.php"><span class="stats_icon finished_work_sl"></span><span class="label">RTE Students</span></a></li>
			<li><a href="entry_student_tc.php"><span class="stats_icon finished_work_sl"></span><span class="label">Student TC</span></a></li>
		</ul>
	</div>
						
					</div>
				</div>
			</div>
		</div>
       <h1>&nbsp;</h1>
		  <h6 align="center" >Copyright © 2013 </h6>
	</div>
    </div>
  <?php include_once("includes/footer.php");?>
