<?php
include_once '../includes/autoloader.inc.php';

$fav_id = $_POST['id'];

$del = new deleteFavApt();
$del->delete_fav_apt($fav_id);
?>