<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from student_transport_fees_detail where student_fees_id='".$sid."'";
	mysql_query($delete_detail);
	header("Location:student_transport_fees.php?msg=2");
	
	}
?>
