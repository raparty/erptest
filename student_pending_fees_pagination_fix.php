<?php
declare(strict_types=1);
require_once("config/config.inc.php");

$tbl_name=$mytablename;
$adjacents = 3;

// Sanitize POST inputs to prevent SQL injection
$safe_fees_term = db_escape($_POST['fees_term'] ?? '');
$safe_class = db_escape($_POST['class'] ?? '');
$safe_stream = db_escape($_POST['stream'] ?? '');
$safe_name = db_escape($_POST['name'] ?? '');
$safe_session = db_escape($_SESSION['session'] ?? '');

 $query = "SELECT COUNT(*) as num FROM $tbl_name  where (registration_no not in (SELECT registration_no FROM student_fees_detail where session='$safe_session' and fees_term='$safe_fees_term') and class='$safe_class' )";
         if($safe_stream != "")
uery.=" and stream='$safe_stream'";
ame != "")
uery.=" and name like '%$safe_name%'";
uery.="and session='$safe_session'";
                    
$total_pages = db_fetch_array(db_query($query));
$total_pages = $total_pages['num'];

$targetpage = $_SERVER['PHP_SELF'];
$limit =5;
$page = (int)($_GET['page'] ?? 0);
if($page) 
($page - 1) * $limit;
else
0;
o=$start;

      $sql10 = "SELECT * FROM $tbl_name where (registration_no not in (SELECT registration_no FROM student_fees_detail where session='$safe_session' and fees_term='$safe_fees_term') and class='$safe_class' )";
 if($safe_stream != "")
d stream='$safe_stream'";
ame != "")
d name like '%$safe_name%'";
d session='$safe_session' LIMIT $start, $limit";
