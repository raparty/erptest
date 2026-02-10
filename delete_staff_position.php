<?php
declare(strict_types=1);

require_once('config/config.inc.php');

$staff = (int)($_GET['id'] ?? 0);
if ($staff <= 0) {
    header('location:view_staff_position.php');
    exit;
}
$sql="delete  from  staff_position where id='".$staff."'";
$res=db_query($sql);
header('location:view_staff_position.php');
die();



?>
