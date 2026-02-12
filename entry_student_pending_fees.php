<?php include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
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
<?php include_once("includes/fees_setting_sidebar.php");?>

<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">
<h3 style="padding-left:20px; color:#0078D4">Student Pending Fees Detail</h3>

          <div class="grid_12">

 
<form action="student_pending_fees_detail.php" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
          
           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Search</h4>     </li>
               
               
               
                                
							  
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Fees term </label>
									<div class="form_input">
										<select style=" width:300px" name="fees_term" class="chzn-select" tabindex="13" data-action="load-form" data-url="ajax_stream_code.php" data-param="class_id">
											<option value="" selected="selected"> - Select fees term - </option>
							<?php
							 $sql="SELECT * FROM fees_term ";
	                           $res=db_query($sql);
								while($row=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['term_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Class Name </label>
									<div class="form_input">
										<select style=" width:300px" name="class" class="chzn-select" tabindex="13" data-action="load-form" data-url="ajax_stream_code.php" data-param="class_id">
											<option value="" selected="selected"> - Select Class - </option>
							<?php
							 $sql="SELECT * FROM class ";
	                           $res=db_query($sql);
								while($row=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
								</li>
                                <li id="stream_code">
								
								</li>
                                
                                
                                
                                <li>
								<div class="form_grid_12">
									<div class="form_input">
										
										<button type="submit" name="submit" class="btn_small btn_blue"><span>Search</span></button>
										
										
										
									</div>
								</div>
								</li>
                                
</ul>
                </form>
           
                            
                            
                            
          </div>
			
			
			
			<span class="clear"></span>
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include_once("includes/footer.php");?>