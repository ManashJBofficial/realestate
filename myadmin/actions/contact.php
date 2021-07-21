<?php
include_once '../includes/autoloader.inc.php';

$post_token = $_POST['csrf_token'];
$name =$_POST['c_name'];
$mobile = $_POST['c_mobile'];
$email = $_POST['c_email'];
$subject = $_POST['c_subject'];
$msg = $_POST['c_msg'];

$obj = new contactForm;
$obj->contact_form($post_token,$name,$mobile,$email,$subject,$msg); 
?>