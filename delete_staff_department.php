<?php
declare(strict_types=1);

require_once('config/config.inc.php');

$staff = (int)($_GET['staff_department_id'] ?? 0);
if ($staff <= 0) {
    header('location:view_staff_department.php');
    exit;
}
$sql="delete  from  staff_department where staff_department_id='".$staff."'";
$res=mysql_query($sql);
header('location:view_staff_department.php');
die();



?>
