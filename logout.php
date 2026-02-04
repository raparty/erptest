<?php
declare(strict_types=1); 
require_once("config/config.inc.php");

session_destroy();
header('location:index.php');
exit;

?>
