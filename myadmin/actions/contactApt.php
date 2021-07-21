<?php
include_once '../includes/autoloader.inc.php';

$post_token = $_POST['csrf_token'];
$apt_name =$_POST['apt_name'];
$name = $_POST['s_name'];
$email = $_POST['s_email'];
$mobile = $_POST['s_mobile'];
$description = $_POST['s_desc'];

$obj = new contactApt;
$obj->contact_apt_form($post_token,$apt_name,$name,$email,$mobile,$description); 
?>