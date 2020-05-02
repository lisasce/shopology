<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessReviews.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();

if($_GET['id']){
    $product_id = $_GET['id'];
}

$reviewAllowance = reviewAllowance($product_id, $userID);

    if ($reviewAllowance == true){
echo ' <textarea class ="form-control" type="text" name="review_msg" id="review_msg" placeholder ="Enter your review:" value="" maxlength ="500" rows="5" cols="10"></textarea><button class="btn btn-dark text-info mb-3 mt-3" type="button" data-url_id="'.$product_id.'" id="reviewBtn" >Post Review</button>';
    }else{
        echo '';
    }
$reviewArray= getReviews($product_id);



foreach ( $reviewArray as $review)
{
    $buttonEditR = '';
    $buttonDelR = '';
    $userAllowedR = $review['fk_user_id'] == $userID;

    if(isset($_SESSION['admin']) || isset($_SESSION['superAdmin']) || $userAllowedR ) {
        $buttonDelR = "<a class='btn btn-dark text-danger' href='../CRUDquestions/deleteReview.php?id=".$review['reviews_id']."'>Delete</a>";
    } else {
        $buttonDelR = '';
    }

    if( $userAllowedR ) {
        $buttonEditR= "<button class='editBtn btn btn-dark text-warning mr-2' data-rev_id=".$review['reviews_id']."'>Edit</button>";
    } else {
        $buttonEditR = '';
    }


    echo "<div class='alert alert-success row d-flex justify-content-between' role='alert'><div> &#11088; ".$review['first_name'].': '.$review['review_msg'].'<br>'.$review['review_time'] ."</div><div>".  $buttonEditR . $buttonDelR . "</div>
    <div class='col-12 mt-2 hiddenForm emptyDivForUpdatingEntry ml-auto text-center'>
                    <textarea class=' form-control mx-auto w-75' name='editRev'  placeholder ='' maxlength ='150' rows='5'>".$review['review_msg']."</textarea><button class='updateRBtn btn btn-dark text-success mb-3 mt-3' type='button' data-rev_id='".$review['reviews_id']."' >Update</button>
                </div>
     </div>";
}

?>
<?php  ob_end_flush(); ?>
