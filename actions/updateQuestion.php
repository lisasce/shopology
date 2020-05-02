<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessQuestion.php';
require_once '../DBandFunc/functions.php';

$userID = getUserIDfromSession();

$question_msg = $_POST["question_msg"];
$question_id = $_GET['id'];

echo updateQuestion($userID, $question_id, $question_msg);
?>
<?php  ob_end_flush(); ?>
