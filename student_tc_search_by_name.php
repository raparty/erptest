<?php
declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php");?>
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
<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">

          
			<div class="grid_12">
				
					<h3 style="padding-left:20px; color:#0078D4; border-bottom:1px solid #e2e2e2;">Student Detail</h3>
                    
                    
               
               	<form action="" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
          
           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Search</h4>     </li>
               
               
               <li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="name" type="text" />
											
										</div>
									
										<span class="clear"></span>
									</div>

									
									
								</div>
								</li>
                                
							  
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Class Name </label>
									<div class="form_input">
										<select style=" width:300px" name="class" class="chzn-select" tabindex="13"  onChange="getForm('ajax_stream_code.php?class_id='+this.value)">
											<option value="" selected="selected"> - Select Class - </option>
							<?php
							 $sql="SELECT * FROM class";
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
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Stream</label>
									<div class="form_input">
										<select style=" width:300px" name="stream" class="chzn-select" tabindex="13">
										<option value="">---select stream---</option>
                                        	<?php
							 $sql="SELECT * FROM stream";
	                           $res=db_query($sql);
								while($row=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row['stream_id']; ?>"><?php echo $row['stream_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
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
            
            <div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						
						<h6>Student Detail</h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" >
						<thead>
						<tr>
							
							<th>
								S.No.
							</th>
							<th>
								 S R Number
							</th>
                            <th>
								 Student Name 
							</th>
                            <th>
								Class
							</th>
                             <th>
								Email
							</th>
							
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
                        <?php 
						$i=1;
						
						// Sanitize all POST inputs to prevent SQL injection
						$safe_name = isset($_POST['name']) ? db_escape($_POST['name']) : '';
						$safe_class = isset($_POST['class']) ? db_escape($_POST['class']) : '';
						$safe_stream = isset($_POST['stream']) ? db_escape($_POST['stream']) : '';
						$safe_session = db_escape($_SESSION['session'] ?? '');
						
						if($safe_name != "" && $safe_class == "" && $safe_stream == "")
						{
							 $sql10="SELECT * FROM student_info where name like '%$safe_name%' and session='$safe_session'";
							                                                                         
						}
						else if($safe_name == "" && $safe_class != "" && $safe_stream == "")
						{
							$sql10="SELECT * FROM student_info where class ='$safe_class' and session='$safe_session'";
							                                                                         
						}
						
						else if($safe_name == "" && $safe_class == "" && $safe_stream != "")
						{
								$sql10="SELECT * FROM student_info where stream ='$safe_stream' and session='$safe_session'";
							                                                                         
						}
						else if($safe_name != "" && $safe_class != "" && $safe_stream == "")
						{
							$sql10="SELECT * FROM student_info where name like '%$safe_name%' and  class ='$safe_class' and session='$safe_session'";
							                                                                         
						}
						else if($safe_name == "" && $safe_class != "" && $safe_stream != "")
						{
								$sql10="SELECT * FROM student_info where stream ='$safe_stream'  and  class ='$safe_class' and session='$safe_session'";
							                                                                         
						}
						
						else if($safe_name != "" && $safe_class == "" && $safe_stream != "")
						{
							$sql10="SELECT * FROM student_info where name like '%$safe_name%' and  stream ='$safe_stream' and session='$safe_session'";
							                                                                         
						}
						
						else if($safe_name != "" && $safe_class != "" && $safe_stream != "")
						{
							
							     $sql10="SELECT * FROM student_info where name like '%$safe_name%' and  stream ='$safe_stream' and  class ='$safe_class' and session='$safe_session'";                                                                    
						}
						else
						{
							$sql10="SELECT * FROM student_info where session='$safe_session'";
						}
						
						$res=db_query($sql10);
						$num=db_num_rows($res);
						if($num!=0)
						{
						while($row_value=db_fetch_array($res))
						{
							$safe_class_id = db_escape($row_value['class']);
							$sql1="SELECT * FROM class where class_id='$safe_class_id'";
					$class=db_fetch_array(db_query($sql1));
						
						?>
						<tr>
							
							<td class="center">
								<a href="#"><?php echo $i;?></a>
							</td>
                            <td class="center">
								<?php echo $row_value['registration_no'];?>
							</td>
						<td class="center">
								<?php echo $row_value['name'];?>
							</td>
                            <td class="center">
								<?php echo $class['class_name'];?>
							</td>
							
							<td class="center">
								<?php echo $row_value['s_email'];?>
							</td>
							
							
							<td class="center">
							<a class="action-icons c-add" href="student_tc.php?registration_no=<?php echo $row_value['registration_no'];?>" original-title="select">Go</a>	
							</td>
						</tr>
                        
						<?php $i++;} } else{?>
                        <tr>
							
							<td class="center" colspan="5" style="color:#F00;">Result not found
								
							</td>
						
						</tr>
                        <?php } ?>
						
						</tbody>
						
						</table>
                        
                        <script type="text/javascript" language="javascript">
									frm2=document.del;
									function checkform1()
									{
										if(confirm("Are you sure you want to delete"))
										{
											return true;
										}else
										{
											return false;
											
											}
									}
								</script>
                        
					</div>
				</div>
			</div>
			
			
			<span class="clear"></span>
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include_once("includes/footer.php");?>
