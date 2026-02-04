<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from school_detail where id='".$sid."'";
	mysql_query($delete_detail);
	header("Location:school_detail.php?msg=2");
	
	}
?>
