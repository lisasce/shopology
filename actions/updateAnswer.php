<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessQuestion.php';
require_once '../DBandFunc/functions.php';

$userID = getUserIDfromSession();

$answer_msg = $_POST["answer_msg"];
$answers_id = $_GET['id'];

echo updateAnswer($userID, $answers_id, $answer_msg);
?>
<?php  ob_end_flush(); ?>
