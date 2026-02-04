<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
	$delete_detail="delete from book_manager where book_id='".$sid."'";
	mysql_query($delete_detail);
	header("Location:library_book_manager.php?msg=2");
	
	}
?>
