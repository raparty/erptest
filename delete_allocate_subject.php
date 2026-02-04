<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from allocate_class_subject where allocate_id='".$sid."'";
	mysql_query($delete_detail);
	header("Location:allocate_subject.php?msg=2");
	
	}
?>
