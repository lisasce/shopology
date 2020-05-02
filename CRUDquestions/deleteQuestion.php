<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessQuestion.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();

if($_GET['id']){
    $id = $_GET['id'];
    if(deleteQuestion($id, $userID)){
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }else{
        echo "error del quest";
    }
}

?>
<?php  ob_end_flush(); ?>
