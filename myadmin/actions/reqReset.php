<?php
include '../includes/autoloader.inc.php';

$emailTo=$_POST["email"];

$obj = new reqReset();
$obj->req_reset($emailTo);

?>