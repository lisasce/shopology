<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
$userID= getUserIDfromSession();
$address = $_POST["address"];
$zip = $_POST["zip"];
$city = $_POST["city"];
$country = $_POST["country"];
$coordx = $_POST["coordx"];
$coordy = $_POST["coordy"];
echo json_encode(createAddress($userID, $address,$zip,$city,$country, $coordx, $coordy));
?>
<?php ob_end_flush(); ?>
