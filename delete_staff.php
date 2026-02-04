<?php
declare(strict_types=1);

require_once("config/config.inc.php");

$staff = (int)($_GET['staff_id'] ?? 0);
if ($staff <= 0) {
    header('location:view_staff.php');
    exit;
}
$sql="delete  from staff_employee where staff_id='".$staff."'";
$res=mysql_query($sql);
header('location:view_staff.php');
die();



?>
