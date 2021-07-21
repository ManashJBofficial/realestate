<?php
include '../includes/autoloader.inc.php';

    $apartment_name = $_POST['apartment_name'];
    $addr_short = $_POST['addr_short'];
    $addr_full = $_POST['addr_full'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $size = $_POST['size'];
    $apt_status = $_POST['apt_status'];
    $sell_status = $_POST['sell_status'];
    $total_no_of_flat = $_POST['total_no_of_flat'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $nearest_school = $_POST['nearest_school'];
    $nearest_college = $_POST['nearest_college'];
    $nearest_hospital = $_POST['nearest_hospital'];
    $nearest_police_station = $_POST['nearest_police_station'];
    $nearest_park = $_POST['nearest_park'];
    $nearest_bus_stop = $_POST['nearest_bus_stop'];

$obj = new addApartment();
$obj->add_apt($apartment_name,$addr_short,$addr_full,$landmark,$pincode,$size,$apt_status,
$sell_status,$total_no_of_flat,$lat,$lng,$nearest_school,$nearest_college,$nearest_hospital,
$nearest_police_station,$nearest_park,$nearest_bus_stop);
?>