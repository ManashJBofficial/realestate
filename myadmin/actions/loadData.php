<?php
include_once '../includes/autoloader.inc.php';
$limit=$_POST['limit'];
$start=$_POST['start'];

$obj = new loadData();
$obj->load_data($limit,$start); 
?>