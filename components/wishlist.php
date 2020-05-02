<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBconnect.php';
require_once '../DBandFunc/DBaccessMIX.php';

if( !isset($_SESSION['user'])){
    header("Location: ../homes/userHome.php");
    exit;
}

if(isset($_POST["remove-wish"]) && isset($_SESSION['user'])){
    removeProductFromWishlist($_POST["product_id"], $_SESSION['user']);
}
?>
<!DOCTYPE html>
<html>
<body>
<?php
include '../components/header.php';
?>
<body>
<div id="content">
    <?php
    include '../components/navbar.php';
    ?>
    <div>
        <h1 class="text-center text-warning pacifico mt-5">Wishlist</h1>
    </div>
	<div class="row m-4 justify-content-around wishlistBox" id="content7">
	<?php			
    $products = wishDisplay();
    if($products == "No results"){
    echo '<p class="pacifico text-warning">No Items in your wishlist</p>';
    }elseif(is_array($products))
    {
      foreach ($products as $value)
    {
    	echo   '<div class="productBox col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        <form action="" method="post">
                                        <input type="hidden" name="product_id" value="'.$value["product_id"].'">
                                        <button id="delete" type="button" onclick="removeWishlistItem()" class="btn btn-block bg-dark text-danger mt-2" name="remove-wish">Remove Wish</button>
                                        </form>

                                        ';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}
}
        ?>
    </div>


</div>
	<?php
   	include '../components/footer.php';
    ?>
</body>
</html>
<?php ob_end_flush(); ?>
