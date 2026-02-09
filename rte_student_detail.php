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
                    
                    
               
               	<form action="rte_student_search_result.php" method="post" class="form_container left_label">
                                    

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
						
						<h6>RTE Student Detail</h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" >
						<thead>
						<tr>
							
							<th>
								S.No.
							</th>
							<th>
								 Student Name 
							</th>
                              
                            <th>
								 Student Type 
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
					   
					 //  $mytablename="rte_student_info";
						   $sql10="SELECT * FROM student_info where student_type='1' and session='".$_SESSION['session']."'";
						//include("student_detail_pagination.php");
						$result_res=db_query($sql10);
						 $num=db_num_rows($result_res);
						
						while($row_value=db_fetch_array($result_res))
						{
							$sql1="SELECT * FROM class where class_id='".$row_value['class']."'";
					$class=db_fetch_array(db_query($sql1));
						
						$student_type_detail=db_fetch_array(db_query("select * from student_type where student_type_id='".$row_value['student_type']."'"));
						
						?>
						<tr>
							
							<td class="center">
								<a href="#"><?php echo $i;?></a>
							</td>
                            
						<td class="center">
								<?php echo $row_value['name'];?>
							</td>
                            <td class="center">
							<?php echo $student_type_detail['student_type'];?>
                            
                            </td>
                            <td class="center">
								<?php echo $class['class_name'];?>
							</td>
							
							<td class="center">
								<?php echo $row_value['s_email'];?>
							</td>
							
							
							<td class="center">
							<a class="action-icons c-add" href="rte_view_student_detail.php?student_id=<?php echo $row_value[0];?>" original-title="View Profile">View Profile</a>	<span><a class="action-icons c-edit" href="rte_edit_admission.php?student_id=<?php echo $row_value[0];?>" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="rte_delete_admission.php?sid=<?php echo $row_value[0];?>" title="delete" onClick="return checkform1()">Delete</a></span>
							</td>
						</tr>
                        
						<?php $i++;} ?>
						
                       
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