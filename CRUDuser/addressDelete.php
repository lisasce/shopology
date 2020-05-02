<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();
?>

<!DOCTYPE html>
<html lang="en">
<?php
include '../components/header.php';
?>
<body>
<div id="content">

    <?php
    if($_GET['id']){
    $id = $_GET['id'];
        if(deleteAddress($id, $userID)){
            header("Location: userDetails.php");
            exit;
        }else{
            echo "error";
        }
    }

    ?>


</body>
</html>
<?php ob_end_flush(); ?>
