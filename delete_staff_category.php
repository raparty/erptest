<?php
declare(strict_types=1);

require_once('config/config.inc.php');

$staff = (int)($_GET['staff_category_id'] ?? 0);
if ($staff <= 0) {
    header('location:view_staff_category.php');
    exit;
}
$sql="delete  from  staff_category where staff_cat_id='".$staff."'";
$res=mysql_query($sql);
header('location:view_staff_category.php');
die();



?>
