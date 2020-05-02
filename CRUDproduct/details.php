<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBaccessMIX.php';

if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include '../components/header.php';
    ?>
<body>
    <div id="content">
        <?php
        include '../components/navbar.php';
        ?>
    </div>
    <div class="container m-4" id="wishmsg">
        <?php echo $msg ?>
    </div>
        
        <?php 
            if($_GET['id'])
            {
                $product_id = $_GET['id'];
                $productArray = (productDetails($product_id));
                $productInfo = $productArray[0];
            }
        ?>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 p-5">
                <img class="w-100" src="<?= $productInfo['product_img'] ?>" alt="Product Image">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 p-5">
                <div class="pacifico h1 pb-5 text-center text-warning"> <?= $productInfo['product_name'] ?> </div>
                <div class="h5 p-2">Category : <?= $productInfo['category'] ?> </div>
                <div class="h5 p-2">Description : <?= $productInfo['description'] ?> </div>
                <div class="h5 p-2">In Stock : <?= $productInfo['available_amount'] ?> </div>
                <div class="h5 p-2">Price : <?= $productInfo['product_price'] ?> &euro; </div>
                
                <div class="d-flex justify-content-center">
                    <?php
                        if (isset($_SESSION['user'])){
                            echo'
                        
                            <form action="../components/shoppingCart.php" method="post">
                                <input type="hidden" name="add_product" value="'.$productInfo["product_id"].'">
                                <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                            </form>
                            <form action="details.php?id='.$productInfo["product_id"].'" method="post">
                                <input type="hidden" name="wishlist_id" value="'.$productInfo["product_id"].'">
                                <button id="addtoWishlist" class="btn btn-block bg-dark text-warning mt-2 ml-2" name="wish"><i class="fa fa-heart-o text-warning" aria-hidden="true"></i> Wishlist</button>
                                
                            </form>
                       ';}
                         if ( isset($_SESSION['admin']) || isset($_SESSION['superAdmin']) ) {
                            echo '<a id="edit" class="btn btn-dark text-warning mr-2" href="update.php?id='.$productInfo["product_id"].'">Edit</a>
                              <button id="delete" class="btn btn-dark text-danger delBtn" data-href="delete.php?id='.$productInfo["product_id"].'">Delete</button>';
                        }
                    ?> 
                </div>
            </div>
        </div>
        <div class="pacifico h4 mb-3 text-warning"> You have a question? write it here: </div>

        <div id="questionDiv" class="container">
            <?php
                include '../CRUDquestions/displayQuestionsAnswers.php';
            ?>
        </div>

        <div class="pacifico h4 mt-5 mb-3 text-warning">Product Reviews : </div>
        <div id="reviewsDiv" class="container">
            <?php
                include '../CRUDquestions/reviews.php';
            ?>
        </div>
        
    </div>
    <?php
        include '../components/footer.php';
    ?>
    <script>
    $(document).ready(function(){
        $("#reviewBtn").click(function () {
        let value = $(this).data('url_id');
        let objectData= $('#review_msg').val();
        if(value != '')
        {
            $.post("../actions/postReview.php?id="+value,{review_msg: objectData},
                function(response){
                    console.log(response);
                    location.reload();
                });
        }
      });


            $(".delBtn").click(function () {
                let link = $(this).data('href');
                confirmWindow(function (result) {
                    if(result){
                        location.assign(link);
                    }
                    // result depends on the button you click and returns true or false. if true you are redirected to the page with the action.
                });
            });
        });
    </script>
</body>
</html>
<?php  ob_end_flush(); ?>
