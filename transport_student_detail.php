<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
<div class="page_title">
	
	<h3>Transport Students</h3>
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
<?php include_once("includes/transport_setting_sidebar.php");
if($_GET['sid']!='')
{
db_query("delete from transport_student_detail where transport_id='".$_GET['sid']."'");	
}

?>
<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">
        <h3 style="padding-left:20px; color:#0078D4">Student Bus   Detail</h3>

        <div class="grid_12">
				
					
                    
               
               	<form action="transport_student_result.php" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
          
           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Search</h4>     </li>
               
               
               
                                
							  
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Class Name </label>
									<div class="form_input">
										<select style=" width:300px" name="class" class="chzn-select" tabindex="13" onChange="getForm('ajax_stream_code.php?class_id='+this.value)">
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
									<label class="field_title">Select Route</label>
									<div class="form_input">
										<select name="route_id" style=" width:300px; height:30px;"  class="chzn-select" tabindex="13">
											<option value=""></option>
											<?php 
											$sql="select * from transport_add_route";
											$ro=db_query($sql);
											while($row=db_fetch_array($ro)){
											
											?>
                                            											<option value="<?php echo $row['route_id'];?>"><?php echo $row['route_name'];?></option><?php }?>
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

 

           <div style="float:right; margin-top:10px;">
								<a href="entry_transport_add_student.php" class="btn-fluent-primary"><span style="padding: 8px 16px; display: inline-block;">+ Add Student Bus</span></a>
							</div>
                            
                            
                            
                            </div>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						
						<h6>Transport Student  Managment</h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" >
						<thead>
						<tr>
							<th>
								S.No.
							</th>
                              <th>
							Roll Number
							</th>
                            <th>
							Student Name
							</th>
                            <th>
							Class
							</th>
                            
							<th>
							Vehile Number 
							</th>
                           <th>
							Destination 
							</th>
                            
                             <th>
							Bus fees
							</th>
                            
                           <th>
								 Action
							</th>
						
                        </tr>
						</thead>
						<tbody>
						<?php 
						//$arr=array("ram","shyam","kamlesh","joshi");
						//echo $strng=implode(",",$arr);
						$i=0;
						$safe_session = db_escape($_SESSION['session'] ?? '');
						$sql="select * from transport_student_detail where session='$safe_session'";
						$sql_value=db_query($sql);
						while($sql_row=db_fetch_array($sql_value)){
						$i++;
						$safe_reg_no = db_escape($sql_row['registration_no']);
                       $qq="select * from student_info where registration_no='$safe_reg_no'  and session='$safe_session'";
						$student_info=db_fetch_array(db_query($qq));
						
						$safe_route_id = db_escape($sql_row['route_id']);
						$sql_route="select * from transport_add_route where route_id='$safe_route_id'";
						$sql_value_route=db_query($sql_route);
						$sql_transport_row=db_fetch_array($sql_value_route);
						
						$sql_vechile_id="select * from transport_add_vechile where vechile_id='".$sql_row['vechile_id']."'";
						$sql_value_vechile_id=db_query($sql_vechile_id);
						$sql_vechile_id_row=db_fetch_array($sql_value_vechile_id);
						
								$sql1="SELECT * FROM class where class_id='".$sql_row['class_id']."'";
					$class=db_fetch_array(db_query($sql1));
						$sql2="SELECT * FROM stream where stream_id='".$sql_row['stream_id']."'";
					$stream=db_fetch_array(db_query($sql2));
						
						?>
                        <tr>
                        
                        <td class="center">
								<?php echo $i;?>						</td>
								<td class="center">
								<?php echo $sql_row[1];?>						</td>
                                
                                <td class="center">
								<?php echo $student_info['name'];?>						</td>
							
                            
                            <td class="center">
								<?php echo $class['class_name'];?>						</td>
						
                                 <td class="center">
								<?php echo $sql_vechile_id_row[1];?>
							</td>
                            
							<td class="center">
                            
								<?php echo $sql_transport_row['route_name'];?>
							</td>
                           
                            <td class="center">
                            
								<?php echo $sql_transport_row['cost'];?>
							</td>
                            
							<td class="center">
								<span><a class="action-icons c-edit" href="transport_edit_student.php?sid=<?php echo $sql_row[0]; ?>" title="Edit"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>Edit</a></span>
                                <span><a class="action-icons c-delete" href="transport_student_detail.php?sid=<?php echo $sql_row[0]; ?>" title="delete" onClick="return checkform1()"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>Delete</a></span>
	
							</td>
						</tr>
						<?php }?>
						
						
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
<?php include_once("includes/footer.php"); ?>
