<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';


$name =  isset($_GET['search']) ? $_GET["search"] : '';
    if(!preg_match("/^[a-zA-Z ]*/",$name)) {
        echo "No result";
    }else {
    $result= productSearchBar($name);




    foreach($result as $value){

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
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" onclick="delBtnClick()" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}

    } 
?>
<?php ob_end_flush(); ?>
