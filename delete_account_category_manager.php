<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from account_category where account_category_id='".$sid."'";
	db_query($delete_detail);
	header("Location:account_category_manager.php?msg=2");
	
	}
?>
