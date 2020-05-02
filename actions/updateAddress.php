<?php
require_once '../DBandFunc/DBaccessUser.php';
$id =  $_POST["address_id"];
$address = $_POST["address"];
$zip = $_POST["zip"];
$city = $_POST["city"];
$country = $_POST["country"];
$coordx = $_POST["coordx"];
$coordy = $_POST["coordy"];
echo json_encode(updateAddress($id,$address,$zip,$city,$country, $coordx, $coordy));
?>
