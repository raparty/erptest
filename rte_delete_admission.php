<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from rte_student_info where student_id='".$sid."'";
	mysql_query($delete_detail);
	header("Location:rte_student_detail.php?msg=2");
	
	}
?>
