<?php
include '../includes/autoloader.inc.php';

$delidc = $_POST['imgid'];
$delidu = $_POST['deluuid'];


$obj = new modifyImage();
$obj->modify_img($delidc,$delidu);
?>