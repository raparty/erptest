<?php
declare(strict_types=1);

require_once("config/config.inc.php");

$registration_no = trim((string)($_GET['registration_no'] ?? ''));
$registration_no_safe = db_escape($registration_no);
 $sql1="SELECT * FROM student_info where registration_no='".$registration_no_safe."'";
	$res1=db_query($sql1) or die("Error : " . db_error());
	$num=db_num_rows($res1);
	if($num>0)
	{	?>
	<input name="registration_no"    type="text" style=" margin-left:-192px;"  required onBlur="getCheckreg('checkregno.php?registration_no='+this.value)"/><span style="color:#F00; font-size:14px;">S R Number Already Exists</span>	
	
	<?php	
	}else
	{
?><input name="registration_no"   onBlur="getCheckreg('checkregno.php?registration_no='+this.value)" type="text" style=" margin-left:-192px;"  required onBlur="getCheckreg('checkregno.php?registration_no='+this.value)" value="<?php echo $registration_no;?>"/>
<?php } ?>
