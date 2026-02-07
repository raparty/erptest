<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
<div class="page_title">
	<span class="title_icon"><span class="computer_imac"></span></span>
	<h3>Fees Manager</h3>
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
<h3 style="padding-left:20px; color:#0078D4">Student Fees Detail</h3>

          <div class="grid_12">

 
<form action="fees_search_result.php" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
          
           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Search</h4>     </li>
               
               
               
                                
							  
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Fees term </label>
									<div class="form_input">
										<select style=" width:300px" name="fees_term" class="chzn-select" tabindex="13" onChange="getForm('ajax_stream_code.php?class_id='+this.value)">
											<option value="" selected="selected"> - Select fees term - </option>
							<?php
							 $sql="SELECT * FROM fees_term ";
	                           $res=db_query($sql);
								while($row=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row['fees_term_id']; ?>"><?php echo $row['term_name']; ?></option>
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
           <div class="btn_30_blue float-right">
								<a href="entry_fees_reciept.php"><span style="width:140px"> Student Fees Reciept </span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="entry_student_fees.php"><span style="width:140px">Add Student Fees  </span></a>
			</div>
                            
                            
                            
          </div>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_images"></span>
						<h6>Student Fees Detail</h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" >
						<thead>
						<tr>
							
							<th>
								S.No.
							</th>
							<th>
								Student   Name
							</th>
                          <th>
								Class
							</th>
                          <th>
								 Fees Term
							</th>
                               
                          <th>
								Student   Fees
							</th>
                            <th>
								Deposit date
							</th>
                            <th>
								Session  
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
                        <?php 
					
					/*$sql="SELECT * FROM student_fees_detail where session='".$_SESSION['session']."'";
					$res=db_query($sql);*/
					      $mytablename="student_fees_detail";
				          include_once("fees_manager_pagination.php");
						  	$i=1;
							if($_GET['page']=="")
							{
								$_GET['page']=1;
								
								}
								
								$i=($_GET['page']-1)*$limit+1;
							while($row=db_fetch_array($result_res))
							{
								
								$sql="SELECT * FROM student_info where registration_no='".$row[1]."' ";
	                           $student_info=db_fetch_array(db_query($sql));
							   
							   $sql1="SELECT * FROM class where class_id='".$student_info['class']."'";
					$class=db_fetch_array(db_query($sql1));
							   $sql1="SELECT * FROM fees_term where fees_term_id='".$row['fees_term']."' ";
	                           $fees_term=db_fetch_array(db_query($sql1));
								
								
								?>
						<tr>
							
							<td class="center">
								<a href="#"><?php echo $i;?></a>
							</td>
						
                            <td class="center">
								<?php echo $student_info['name']; ?>
							</td>
                             <td class="center">
								<?php echo $class['class_name']; ?>
							</td>
							<td class="center">
								<?php echo $fees_term['term_name']; ?>
							</td>
                            <td class="center">
								<?php echo $row['fees_amount']; ?>
							</td>
							
                            <td class="center">
								<?php echo date('d-m-Y',strtotime($row['deposit_date'])); ?>
							</td>
							
                            <td class="center">
								<?php echo $row['session']; ?>
							</td>
							
							
							<td class="center">
						<span><a class="action-icons c-add" href="fees_reciept.php?registration_no=<?php echo $student_info['registration_no'];?>&fees_term=<?php echo $row['fees_term']; ?>" original-title="View Receipt"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>Receipt</a></span>		
						<span><a class="action-icons c-add" href="entry_fees_reciept.php?registration_no=<?php echo $student_info['registration_no'];?>" original-title="Collect Fee"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/></svg>Collect Fee</a></span>
						<span><a class="action-icons c-edit" href="edit_student_fees.php?fee_id=<?php echo $row[0]; ?>" title="Edit"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>Edit</a></span>
						<span><a class="action-icons c-delete" href="delete_student_fees.php?sid=<?php echo $row[0]; ?>" title="delete" onClick="return checkform1()"><svg style="width:16px; height:16px; fill:currentColor; vertical-align:middle; margin-right:4px;" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>Delete</a></span>
							</td>
						</tr>
						
						<?php $i++;} ?>
                        <?php if($pagination!=""){?>
                        <tr>
                        <td colspan="8"><?php echo $pagination;?></td>
                        
                        
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