<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
$oldPass= $_POST['pwValue'];

$userID = getUserIDfromSession();
$userArray = (userDetail($userID));

$oldPass = hash('sha256' , $oldPass);

$dbpassword = $userArray[0]['password'];
//echo $dbpassword . ' ' .  $oldPass;
echo ($dbpassword == $oldPass);

ob_end_flush();
?>
