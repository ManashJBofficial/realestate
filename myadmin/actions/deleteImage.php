<?php
include '../includes/autoloader.inc.php';

$delidz = $_POST["delimgid"];
$delidu = $_POST['deluuid'];


$obj = new deleteImage();
$obj->delete_img($delidz,$delidu);
?>