<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessReviews.php';


$userID = getUserIDfromSession();

$review_msg = $_POST["review_msg"];
$review_id = $_GET['id'];

echo updateReview($userID, $review_id, $review_msg);
?>
<?php  ob_end_flush(); ?>
