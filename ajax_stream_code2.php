<?php
declare(strict_types=1);

require_once("config/config.inc.php");
ob_start();

$class_id = (int)($_GET['class_id'] ?? 0);
$stream_id = (int)($_GET['stream_id'] ?? 0);
$class_id_safe = db_escape((string)$class_id);
$stream_id_safe = db_escape((string)$stream_id);
 $sql2="SELECT * FROM class where class_id='".$class_id_safe."'";
					$class=db_fetch_array(db_query($sql2));
					if($class['class_name']!=""&&$stream_id=="")
					{
if($class['class_name']!=""&&$stream_id==""&&$class['stream_status']==1)
{
?>

<li>
<div class="form_grid_12">
									<label class="field_title">Stream</label>
									<div class="form_input">
										<select name="stream" onChange="getForm('ajax_stream_code2.php?class_id=<?php echo $class['class_id'];?>&&stream_id='+this.value)" class="chzn-select" tabindex="13">
										<option value="">---select stream---</option>
                                        	 <?php 
						$i=1;
					$sql="SELECT * FROM allocate_class_stream where class_id='".$class_id_safe."' ";
					$res=db_query($sql);
				
							while($row=db_fetch_array($res))
							{
								if($stream_id==$row['stream_id'])
								{
									$stream_sel='selected="selected"';
									}else
									{
										$stream_sel="";
										}
								
						$sql2="SELECT * FROM stream where stream_id='".$row['stream_id']."'";
					$stream=db_fetch_array(db_query($sql2));
					?>			<option <?php echo $stream_sel;?> value="<?php echo $row['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option>
									<?php
								}
							?>
										</select>
                                        <span class=" label_intro">Stream name</span>
									</div>
								</div></li>
                                <li>
                                
                                    <?php
							 $sql="SELECT * FROM allocate_class_subject where class_id='".$class_id_safe."'";
					       $res=db_query($sql);?>
								<div class="form_grid_12 multiline">
									<label class="field_title"> Subject  Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<select name="subject_id" >
								<option value="" selected="selected"> - Select Subject - </option>
							<?php 
				
							while($row=db_fetch_array($res))
							{
								
								$sql3="SELECT * FROM subject where subject_id='".$row['subject_id']."'";
					$subject=db_fetch_array(db_query($sql3));
									?>
									<option value="<?php echo $row['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
									<?php
								}
							?>
							</select>
											<span class=" label_intro">Subject name</span>
										</div>
									
										<span class="clear"></span>
									</div>

									
									<div class="form_input">

										<span class="clear"></span>
									</div>
								</div>
							
                                
                                </li>
                                <?php }else{ ?>  <li>
                                
                                    <?php
							 $sql="SELECT * FROM allocate_class_subject where class_id='".$class_id_safe."'";
					       $res=db_query($sql);?>
								<div class="form_grid_12 multiline">
									<label class="field_title"> Subject  Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<select name="subject_id" >
								<option value="" selected="selected"> - Select Subject - </option>
							<?php 
				
							while($row=db_fetch_array($res))
							{
								
								$sql3="SELECT * FROM subject where subject_id='".$row['subject_id']."'";
					$subject=db_fetch_array(db_query($sql3));
									?>
									<option value="<?php echo $row['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
									<?php
								}
							?>
							</select>
											<span class=" label_intro">Subject name</span>
										</div>
									
										<span class="clear"></span>
									</div>

									
									<div class="form_input">

										<span class="clear"></span>
									</div>
								</div>
							
                                
                                </li> <?php  } } ?>
								
                                
                                
                             <?php    if($class['class_id']!=""&&$stream_id_safe!="")
{
?>


<li>
<div class="form_grid_12">
									<label class="field_title">Stream</label>
									<div class="form_input">
										<select name="stream" onChange="getForm('ajax_stream_code2.php?class_id=<?php echo $class['class_id'];?>&&stream_id='+this.value)" class="chzn-select" tabindex="13">
										<option value="">---select stream---</option>
                                        	 <?php 
						$i=1;
					$sql="SELECT * FROM allocate_class_stream where class_id='".$class_id_safe."' ";
					$res=db_query($sql);
				
							while($row=db_fetch_array($res))
							{
								if($stream_id==$row['stream_id'])
								{
									$stream_sel='selected="selected"';
									}else
									{
										$stream_sel="";
										}
								
						$sql2="SELECT * FROM stream where stream_id='".$row['stream_id']."'";
					$stream=db_fetch_array(db_query($sql2));
					?>			<option <?php echo $stream_sel;?> value="<?php echo $row['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option>
									<?php
								}
							?>
										</select>
                                        <span class=" label_intro">Stream name</span>
									</div>
								</div></li>
                 
                 <?php
							 $sql="SELECT * FROM allocate_class_subject where class_id='".$class_id_safe."' and stream_id='".$stream_id_safe."' ";
					       $res=db_query($sql);?>
							<li>	<div class="form_grid_12 multiline">
									<label class="field_title"> Subject  Name</label>
                                    <div class="form_input">
										<div class="form_grid_5 alpha">
											<select name="subject_id" >
								<option value="" selected="selected"> - Select Subject - </option>
							<?php 
				
							while($row=db_fetch_array($res))
							{
								
								$sql3="SELECT * FROM subject where subject_id='".$row['subject_id']."'";
					$subject=db_fetch_array(db_query($sql3));
									?>
									<option value="<?php echo $row['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
									<?php
								}
							?>
							</select>
											<span class=" label_intro">Subject name</span>
										</div>
									
										<span class="clear"></span>
									</div>

									
									<div class="form_input">

										<span class="clear"></span>
									</div>
								</div></li>
							
                               <?php } ?>
