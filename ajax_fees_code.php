<?php
declare(strict_types=1);

require_once("config/config.inc.php");
ob_start(); 
$registration_no = trim((string)($_GET['registration_no'] ?? ''));
$fees_term = trim((string)($_GET['fees_term'] ?? ''));
$registration_no = db_escape($registration_no);
$fees_term = db_escape($fees_term);
 $studentinfo="select * from student_info where student_admission_no='".$registration_no."' and session='".$_SESSION['session']."'";
$row=db_fetch_array(db_query($studentinfo));


	      $sql_pending="select sum(fees_amount) from student_fees_detail where registration_no='".$registration_no."'  and session='".$_SESSION['session']."'";
	$deposit_amount=db_fetch_array(db_query($sql_pending));
	
	


//$student_fees_detail="select ";
?>
<?php if($_GET['registration_no']!=""&&$row[0]!=""){?>
<li>
								<div class="form_grid_12 multiline">
									<label class="field_title">Student Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<input name="name" type="text" value="<?php echo $row['name'];?>"/>
											<span class=" label_intro">student name</span>
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
									<label class="field_title"> Class Name </label>
									<div class="form_input">
										<select style=" width:300px" name="class" class="chzn-select" tabindex="13">
											
							<?php
							 $sql="SELECT * FROM class  where class_id='".$row['class']."'";
	                           $res=db_query($sql);
								while($row1=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row1['class_id']; ?>"><?php echo $row1['class_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
								</li>
                                <?php if($row['stream']!=0){?>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Stream</label>
									<div class="form_input">
										<select style=" width:300px" name="stream" class="chzn-select" tabindex="13">
										
                                        	<?php
							 $sql="SELECT * FROM stream where stream_id='".$row['stream']."' ";
	                           $res=db_query($sql);
								while($row2=db_fetch_array($res))
								{
									?>
									<option value="<?php echo $row2['stream_id']; ?>"><?php echo $row2['stream_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
								</li>
								
								<?php } ?>
								<li>
								<div class="form_grid_12 multiline">
									<label class="field_title">  Fees Amount</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
                                        <?php
							 $sql="SELECT * FROM fees_package where id='".$row['admission_fee']."' ";
	                           $res=db_query($sql);
								$row3=db_fetch_array($res);?>
											<input name="fees_amount" type="text"/>
											<span class=" label_intro" style="color:#F00;">pending fees amount is:<?php echo $pending_amount=$row3['total_amount']-$deposit_amount[0];?> <input name="pending_amount" type="hidden" value="<?php echo $pending_amount=$row3['total_amount']-$deposit_amount[0];?>"/></span>
										</div>
									
										<span class="clear"></span>
									</div>

									
									<div class="form_input">

										<span class="clear"></span>
									</div>
								</div>
								</li>
                                
                                <?php }else{?>
								
								<li ><div style="color:#F00; margin-left:330px;">Student registration number is invalid</div></li>
								
								<?php }?>