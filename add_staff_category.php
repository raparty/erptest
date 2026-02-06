<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
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

<?php include_once("includes/staff_setting_sidebar.php");?>
<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">

          
			<div class="grid_12">
				<div class="widget_wrap">
               
					<h3 style="padding-left:20px; color:#1c75bc"> Staff Category</h3> <?php
                include_once('config/config.inc.php');
				?>
                <?php
				if(isset($_POST['submit']))
				{
					 $insert_check="select * from staff_category  where staff_category='".$_POST['staff_category']."'"; 
	 $num=db_fetch_array(db_query($insert_check));
			if($num==0)
			{   
                $sql="insert into staff_category(staff_category) values('".$_POST['staff_category']."')";
				$res=db_query($sql);
				$msg = "<span style='color:#009900;'><h4> Staff Category Detail Added Successfully </h4></span>";
				}
				else
				{ 
					$msg = "<span style='color:#FF0000;'><h4> Staff Category Detail already exist </h4></span>";
				
				}}
				
				
				?>
                
                <?php if($msg!=""){echo $msg; } ?>
					<form action="#" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Staff Category Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="staff_category" type="text" required="required"/>
											<span class=" label_intro">Staff Category</span>
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
										
										<button type="submit" class="btn_small btn_blue"  name="submit"><span>Save</span></button>
										
										<a href="view_staff_category.php"><button type="button" class="btn_small btn_orange"><span>Back</span></button></a>
										
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
