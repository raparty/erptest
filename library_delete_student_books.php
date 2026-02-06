<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
		$delete_detail="delete from student_books_detail where issue_id='".$sid."'";
		db_query($delete_detail);
		header("Location:library_student_books_manager.php?msg=2");
	
}
?>
