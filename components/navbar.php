<?php
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
require_once '../DBandFunc/DBaccessCart.php';
ob_start();
session_start();
$userID = getUserIDfromSession();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <img src="../img/bag3.png" alt="logo" width="50" class="mr-3">

        <a class="navbar-brand text-warning pacifico" href="../index.php">Shopology</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active  mt-2 ml-2" style="width: 5%;">
                    <img src=" <?php echo getUserInfo($userID)['user_img']; ?> " alt="" style="width: 100%; border-radius: 45px;">
                </li>
                <li class="nav-item active mt-2 ml-2">

                    <span class="nav-link" >Hi <?php echo getUserInfo($userID)['first_name']; ?> !</span>
                </li>

                <li class="nav-item ml-2 mt-2">
                    <a class="nav-link active" href="../components/wishlist.php"><i class="fa fa-heart-o text-warning" aria-hidden="true"></i> Wishlist</a>
                </li>
                <?php
                if(isset($_SESSION['admin']) || isset($_SESSION['user']) || isset($_SESSION['superAdmin'])) {
               echo '
                <li class="nav-item active ml-2 mt-2">
                    <a class="nav-link" id="add" href="../homes/userHome.php">Home</a>
                </li>
                ';}
                ?>
                <?php
                if(isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])) {
               echo '
                <li class="nav-item active ml-2 mt-2">
                    <a class="nav-link" id="add" href="../CRUDproduct/create.php">Manage Products</a>
                </li>
                <li class="nav-item active ml-2 mt-2">
                    <a class="nav-link" id="add" href="../CRUDdiscount_code/discountDetails.php">Manage Discounts</a>
                </li>

                 ';}
                ?>
                <?php
                if(isset($_SESSION['superAdmin'])) {
                    echo '
                <li class="nav-item active ml-2 mt-2">
                    <a class="nav-link" id="add" href="../homes/superHome.php">Manage users</a>
                </li>
                  ';}
                   ?>
                <li class="nav-item ml-2 mt-2">
                    <a class="nav-link" href="../CRUDuser/userDetails.php">Account setting</a>
                </li>
                <li class="nav-item ml-2 mt-2">
                    <a class="nav-link" href="../CRUDuser/logout.php?logout">Sign Out</a>
                </li>
            </ul>

        </div>

    </nav>
<div class=" col-12 bg-dark m-0 pt-1 pb-1 row justify-content-between" >
    <form id="form" class="form-inline active-cyan active-cyan-2  col-10 " autocomplete= "off">
        <i class="fas fa-search text-warning" aria-hidden="true"></i>
        <input id="input" class="form-control form-control-sm ml-3 col-10 col-md-6  pl-1" width="50rem" type="text" name= "search" placeholder="Search for: product"
               aria-label="Search">
    </form>
    <div id="cart" class="">
    <a href="../components/shoppingCart.php"><img src="../img/caddie2.png" alt="logo" width="45" class="mb-2"></a>
    <?php 
        $products = (cartItems());
        foreach ($products as $value){
    if (isset($_SESSION['user']))
    echo '<span  id="cartCounter" class="badge badge-warning">'.$value["NumberOfProducts"].'</span>';
    if (isset($_SESSION['admin']) && (isset($_SESSION['super'])))
    echo '<span  id="cartCounter" class="badge badge-warning"></span>';}
    ?>
    </div>
</div>
<?php  ob_end_flush(); ?>
