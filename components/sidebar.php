
<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBconnect.php';
require_once '../DBandFunc/DBaccessCart.php';
?>
<link rel="stylesheet" type="text/css" href="../css/slider.css">
	<div class="wrapper" id="sidebarWrapper">
        <!-- Sidebar  -->
        <nav class="bg-dark" id="sidebar">
            <div class="bg-dark pacifico" id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header bg-dark pacifico">
                <h3>Categories</h3>
            </div>
			<ul class="nav nav-tabs row" id="myTab" role="tablist">
  				<li class="nav-item col-12">
<a class="nav-link active col-12" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Products</a>
  				</li>
  				<li class="nav-item col-12">
<a class="nav-link col-12" id="nav-electronics-tab" data-toggle="tab" href="#nav-electronics" role="tab" aria-controls="nav-eletctronics" aria-selected="true">Electronics</a>

  				</li>
  				<li class="nav-item col-12">
					<a class="nav-item nav-link col-12" id="nav-household-tab" data-toggle="tab" href="#nav-household" role="tab" aria-controls="nav-household" aria-selected="false">Household</a>
  				</li>
  				<li class="nav-item col-12">
					<a class="nav-item nav-link col-12" id="nav-clothes-tab" data-toggle="tab" href="#nav-clothes" role="tab" aria-controls="nav-clothes" aria-selected="false">Clothes</a>
  				</li>
                <li class="nav-item col-12">
                    <a class="nav-item nav-link col-12" id="nav-food-tab" data-toggle="tab" href="#nav-food" role="tab" aria-controls="nav-food" aria-selected="false">Food</a>
                </li>
  				<li class="nav-item col-12">
					<a class="nav-item nav-link col-12" id="nav-medicine-tab" data-toggle="tab" href="#nav-medicine" role="tab" aria-controls="nav-medicine" aria-selected="false">Medicine</a>
  				</li>
  				<li class="nav-item col-12">
					<a class="nav-item nav-link col-12" id="nav-pets_kids-tab" data-toggle="tab" href="#nav-pets_kids" role="tab" aria-controls="nav-pets_kids" aria-selected="false">Pets/Kids</a>
  				</li>
				</ul>
			</nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark navigation">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-align-left"></i>
                        <span class="pacifico text-warning">Categories</span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="container">
        <div class="tab-pane fade show "  role="tabpanel" aria-labelledby="nav-all-tab">
            <div class="row m-4 justify-content-around" id="searchDiv">

            </div>
        </div>
    </div>

	<div id="standardPdtDisplay" class="container tab-content side">




			<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
				<div class="row m-4 justify-content-around" id="content7">
				<?php 
                $display = (productDetailsAll());
        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div class="alignBtn">
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                        echo'   
                                            
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'   
                                    </div>
                                </div>
                            </div>
                        </div>';}
	           ?>
	            </div>
	        </div>

			<div class="tab-pane fade show" id="nav-electronics" role="tabpanel" aria-labelledby="nav-electronics-tab">
				<div class="row m-4 justify-content-around" id="content8">
				<?php 
                $display = (productDetailsEle());
        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="btn-del btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}
                
            ?>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-household" role="tabpanel" aria-labelledby="nav-household-tab">
				<div class="row m-4 justify-content-around" id="content1">
				<?php 
            	{
                $display = (productDetailsHouse());
           		}

        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}    
                
            ?>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-clothes" role="tabpanel" aria-labelledby="nav-clothes-tab">
				<div class="row m-4 justify-content-around" id="content2">
				<?php 
            	{
                $display = (productDetailsClothes());
           		}

        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="btn delBtn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}     
                
            ?>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-food" role="tabpanel" aria-labelledby="nav-food-tab">
				<div class="row m-4 justify-content-around" id="content3">
				<?php 
            	{
                $display = (productDetailsFood());
           		}

        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="edit" id="delete" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';} 
                
            ?>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-medicine" role="tabpanel" aria-labelledby="nav-medicine-tab">
				<div class="row m-4 justify-content-around" id="content4">
				<?php 
            	{
                $display = (productDetailsMeds());
           		}

        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}
                
            ?>
				</div>
			</div>

			<div class="tab-pane fade" id="nav-pets_kids" role="tabpanel" aria-labelledby="nav-pets_kids-tab">
				<div class="row m-4 justify-content-around" id="content5">
				<?php 
            	{
                $display = (productDetailsKids());
           		}

        		foreach ($display as $value)
        		{
        		if ($value["display"] == 'yes'){
	             echo   '<div class="productBox col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img class="card-img-top poster  p-3" src="'.$value["product_img"].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center">'.$value["product_name"].'</h5>
                                    <p class="card-text"> <strong> Price : </strong>'.$value["product_price"].' &euro;</p>
                                    <div>
                                        <a id="details" href="../CRUDproduct/details.php?id='.$value["product_id"].'" class="btn btn-block bg-dark mt-2 text-white">Details</a>';}
                                        if (isset($_SESSION['user'])){
                                         echo'   
                                        
                                        <form action="../components/shoppingCart.php" method="post">
                                        <input type="hidden" name="add_product" value="'.$value["product_id"].'">
                                        <input id="addtoCart" class="btn btn-block bg-dark text-success mt-2" type="submit" value="Add To Cart">
                                        </form>
                                        ';}  if (isset($_SESSION['admin']) || isset($_SESSION['superAdmin'])){
                                        echo '<a id="edit" class="btn btn-block btn-dark text-warning mt-2" href="../CRUDproduct/update.php?id='.$value["product_id"].'">Edit</a>
                                        <button id="delete" class="delBtn btn btn-block btn-dark text-danger" data-href="../CRUDproduct/delete.php?id='.$value["product_id"].'">Delete</button>';}
                                        echo'
                                    </div>
                                </div>
                            </div>
                        </div>';}
                
            ?>
				</div>
			</div>
	   </div>
<?php ob_end_flush(); ?>

		
