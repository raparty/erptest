<?php

declare(strict_types=1);
include_once("includes/header.php");?>
<?php include_once("includes/sidebar.php"); ?>
<?php
if(isset($_POST['category_type']) && $_POST['category_type']!="")
{
	$_SESSION['category_type']=$_POST['category_type'];
	$_SESSION['date_from']=$_POST['date_from'] ?? '';
	$_SESSION['date_to']=$_POST['date_to'] ?? '';
	
	}
?>
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

<?php include_once("includes/account_setting_sidebar.php");?>

<div id="container">
	
	
	
	<div id="content">
		<div class="grid_container">

          
			<div class="grid_12">
			  <h3 style="padding-left:20px; color:#0078D4; border-bottom:1px solid #e2e2e2;">Account report  Detail</h3>
                    
                    
               
               	<form action="" method="post" class="form_container left_label">
                                    

              <ul>
               
               
               
          
           
               <li style=" border-bottom:1px solid #F7630C;"><h4 style=" color:#F7630C; ">Search</h4>     </li>
               
               
               
                                
							  
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title"> Select Category </label>
									<div class="form_input">
										<select style=" width:300px" name="account_category_id" class="chzn-select" tabindex="13">
											<option value="" selected="selected"> - Select Category - </option>
							<?php
							 $sql="SELECT * FROM account_category where category_type='".$_SESSION['category_type']."' ";
	                           $res=db_query($sql);
								while($row=db_fetch_array($res))
								{
									
									if($_POST['account_category_id']==$row[0])
									{$sel='selected="selected"';}else{
										$sel='';
										}
									?>
									<option <?php echo $sel;?> value="<?php echo $row['account_category_id']; ?>"><?php echo $row['category_name']; ?></option>
								
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
            <div class="btn_30_blue float-right">
								<!--<a href="add_income.php"><span style="width:140px">Add Income</span></a>-->
							</div>
            <div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						
						<h6>Account Report Detail</h6>
					</div>
					<div class="widget_content">
						
						<table class="display data_tbl" >
						<thead style="background-color: #605E5C; color: white;">
						<tr>
							
							<th>
								S.No.
							</th>
							<th>
								 Title 
							</th>
                            <th>
								Description
							</th>
                             <th>
								Amount
							</th>
                             <th>
								Date
							</th>
                             <th>
							Category 
							</th>
                            
							
							
						</tr>
						</thead>
						<tbody>
                       <?php 
					   $i=1;
					    $mytablename="account_exp_income_detail";
						$category_type=$_SESSION['category_type'];
					   if(isset($_POST['account_category_id'])&&$_POST['account_category_id']!="")
					   {
						   $sql10="SELECT * FROM ".$mytablename." where account_category_id='".$_POST['account_category_id']."' and session='".$_SESSION['session']."' and  category_type='".$category_type."' ";
						  // $result_res=db_query($sql10);
						  // $total_pages=1;
						  }
						  
						  if(isset($_SESSION['category_type'])&&$_SESSION['category_type']!=""&&$_POST['account_category_id']=="")
					   {
						   $sql10="SELECT * FROM ".$mytablename." where  session='".$_SESSION['session']."' and  category_type='".$category_type."' ";
						  
						  // $total_pages=1;
						  }
						  
						   if($_SESSION['date_from']!=""&&$_SESSION['date_to']!="")
					   {
						    $sql10.=" and date_of_txn between '".$_SESSION['date_from']."' and '".$_SESSION['date_to']."' ";
						   
						   }
						 //$res=db_query($sql10);
						  $result_res=db_query($sql10);
						 $num=db_num_rows($result_res);
						if($num!=0)
						{
						while($row_value=db_fetch_array($result_res))
						{
							$sql1="SELECT * FROM account_category where 	account_category_id='".$row_value['account_category_id']."'";
					$account_category=db_fetch_array(db_query($sql1));
						
						?>
						<tr>
							
							<td class="center">
								<a href="#"><?php echo $i;?></a>
							</td>
						<td class="center">
						  <?php echo $row_value['title'];?>
						  </td>
                            <td class="center">
								<?php echo $row_value['description'];?>
							</td>
							
							<td class="center">
							  <?php echo $row_value['amount'];?>
							</td>
							
							<td class="center">
							  <?php echo $row_value['date_of_txn'];?>
							</td><td class="center">
								<?php echo $account_category['category_name'];?>
							</td>
							
						</tr>
                        
						<?php $i++;} } else{?>
                        <tr>
							
						  <td class="center" colspan="7" style="color:#F00;">Result not found
								
							</td>
						
						</tr>
                        <?php } ?>
						
                        <?php if($pagination!=""){?>
						
						<tr>
							
						  <td class="center" colspan="7" style="color:#F00;"><?php echo $pagination;?>
								
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
