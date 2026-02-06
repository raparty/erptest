<?php
declare(strict_types=1);

require_once("config/config.inc.php");
ob_start();

$class_id = (int)($_GET['class_id'] ?? 0);
$class_id_safe = db_escape((string)$class_id);
$sql2="SELECT * FROM class where class_id='".$class_id_safe."' and stream_status='1'";
					$class=db_fetch_array(db_query($sql2));
if($class['class_name']!="")
{
?>


<div class="form_grid_12">
									<label class="field_title">Stream</label>
									<div class="form_input">
										<select style=" width:300px" name="stream" class="chzn-select" tabindex="13">
										<option value="">---select stream---</option>
                                        	 <?php 
						$i=1;
					$sql="SELECT * FROM allocate_class_stream where class_id='".$class_id."' ";
					$res=db_query($sql);
				
							while($row=db_fetch_array($res))
							{
								
								
						$sql2="SELECT * FROM stream where stream_id='".$row['stream_id']."'";
					$stream=db_fetch_array(db_query($sql2));
					?>			<option value="<?php echo $row['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option>
									<?php
								}
							?>
										</select>
									</div>
								</div>
                                <?php } ?>
