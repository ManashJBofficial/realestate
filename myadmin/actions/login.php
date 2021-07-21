<?php 

include '../includes/autoloader.inc.php';

    $uname= $_POST['uname'];
    $pass= $_POST['pass'];
    $role= $_POST['role'];

   $alogin = new adminLogin();
   $alogin->login($uname,$pass,$role);

?>