<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
$userID= getUserIDfromSession();
check_email_availability($userID);
?>
<?php ob_end_flush(); ?>
