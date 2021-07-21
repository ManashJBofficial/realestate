<?php
include '../includes/autoloader.inc.php';

$delidz = $_POST['delid'];

$del = new deleteApartment();
$del->delete_apt($delidz);

?>