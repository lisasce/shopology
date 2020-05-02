<?php
require_once 'functions.php';
require_once 'DBconnect.php';

function getReviews($pdtID){
    $conn = connect();
    $sql=mysqli_query($conn, "SELECT * FROM project.reviews INNER JOIN project.user ON reviews.fk_user_id = user_id WHERE fk_product_id=".$pdtID);
    $reviews = $sql ->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $reviews;
}

function reviewAllowance($pdtID, $userID){
    $conn = connect();
    $sql = "SELECT * FROM project.order WHERE fk_product_id=".$pdtID ." AND fk_user_id=".$userID;
    $reviewAllowance=mysqli_query($conn, $sql);

    if($reviewAllowance->num_rows == 0){

        $conn->close();
        return false;
    }else{

        $conn->close();
        return true;
    }

}

function deleteReview($review_id,$userID){
    $conn = connect();
    $sql = "DELETE FROM reviews WHERE reviews_id = $review_id";
    $res = mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}

function createReview($userID, $product_id,$review_msg){
    $conn = connect();
    $review_msg = clearString($review_msg);

    $sql = "INSERT INTO project.reviews ( `fk_user_id`,`fk_product_id`, `review_msg`) VALUES('$userID', '$product_id','$review_msg')";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}

function updateReview($userID, $review_id, $review_msg){
    $conn = connect();
    $review_msg = clearString($review_msg);

    $sql = "Update project.reviews SET `review_msg`='$review_msg'  WHERE `reviews_id`=$review_id AND `fk_user_id`=$userID";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}








?>
