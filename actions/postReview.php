<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessReviews.php';
require_once '../DBandFunc/functions.php';

$userID = getUserIDfromSession();

$review_msg = $_POST["review_msg"];
$product_id = $_GET['id'];

echo createReview($userID, $product_id,$review_msg);
?>
<?php  ob_end_flush(); ?>