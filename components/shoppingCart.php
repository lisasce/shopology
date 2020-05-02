<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBconnect.php';
require_once '../DBandFunc/DBaccessCart.php';
require_once '../DBandFunc/DBaccessOrder.php';

if( !isset($_SESSION['user'])){
  header("Location: ../homes/userHome.php");
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
<div id="cartBox" class="container mx-auto">

  <table class="table table-hover table-light shootingBox">
    <thead class="shootingBox">
      <tr>
        <th scope="col">Product</th>
        <th scope="col " class="text-center">Qty</th>
        <th scope="col " class="text-right d-none d-md-table-cell">Price</th>
        <th scope="col " class="text-right d-none d-md-table-cell"></th>
        <th scope="col " class="text-right"></th>
        <th scope="col " class="text-right"></th>
        <th scope="col " class="text-right d-none d-md-table-cell"></th>
      </tr>
    </thead>
    <tbody>
      	<!--<div class="row m-4" id="content7">-->
			<?php			
      $products = cartDisplay();
      if($products == "No results"){
        echo '<h5 class="pacifico text-warning">No Items in your shopping cart</h5>';
      }elseif(is_array($products)){
        foreach ($products as $value){
            $sub = $value['cart_qty'] * $value['product_price'];
            if(isset($_SESSION['admin']) || (isset($_SESSION['super']))){
              echo '';
            }elseif(isset($_SESSION['user'])){  
        echo '    
        <tr>    
        <td>'.$value["product_name"].'</td>
        <td  class="text-center"> '.$value["cart_qty"].'</td>
        <td class="text-right d-none d-md-table-cell"> '.$value["product_price"].'€</td>
        <form action="../components/shoppingCart.php" method="post">
        <input type="hidden" name="cart_id" value="'.$value["product_id"].'">
        <td class="text-right"><button class="btn btn-danger " name="remove">Remove</button></td>
        <td class="text-right"><button class="btn btn-success" name="increase"> + </button></td>
        <td class="text-left"><button class="btn btn-danger" name="decrease"> - </button></td>
        </form>
        <td class="text-right d-none d-md-table-cell"> '.$sub.'  €</td> 
        </tr>';
        }
      }}else {
        $sub = $products['cart_qty'] * $products['product_price'];
            if(isset($_SESSION['admin']) && (isset($_SESSION['super'])))
            echo '';
            if(isset($_SESSION['user'])) {
              echo '    
        <tr>    
        <td>'.$products["product_name"].'</td>
        <td  class="text-center"> '.$products["cart_qty"].'</td>
        <td class="text-right d-none d-md-table-cell"> '.$products["product_price"].'€</td>
        <td><form action="../components/shoppingCart.php" method="post"></td>
        <td><input type="hidden" name="cart_id" value="'.$products["product_id"].'"></td>
        <td class="text-right"><button class="btn btn-danger " name="remove">Remove</button></td>
        <td class="text-right"><button class="btn btn-success" name="increase"> + </button></td>
        <td class="text-left"><button class="btn btn-danger" name="decrease"> - </button></td>
        <td></form></td>
        <td class="text-right d-none d-md-table-cell"> '.$sub.'  €</td> 
        </tr>';
        }
        
        } 
        ?>
      
    </tbody>
    <tfoot class="shootingBox">
    <tr class="text-center">
    	<?php
      if(isset($_SESSION['admin']) || (isset($_SESSION['super'])))
        echo '<td colspan="7" class="text-right">Subtotal: €</td>';
      ?>
      <?php 
      if(isset($_SESSION['user'])){
        $items = subTotal();
        foreach ($items as $value){
        $subT = round($value["SubTotal"],2);
            echo '<td colspan="7" class="text-right">Subtotal: '.$subT.'  €</td>';
          }
      }
			
			
      	?>
    </tr>
    <tr class="text-center">
      <?php
      if(isset($_SESSION['admin']) && (isset($_SESSION['super']))){

        echo '<td colspan="7" class="text-right">Discount: €</td>';
      }
      ?>
      <?php
			  
        if(isset($_SESSION['user'])){
          $items = discount();
          if($items == "No Discounts active"){
            echo '<td colspan="7" class="text-right">No Discount active</td>';
          }else{
          $discount = discountInfo();
          foreach ($items as $value)
      {
          foreach ($discount as $disc){
      $subT = round($value["discount"],2);
      echo '<td colspan="7" class="text-right">Discount: '.$disc["discountname"].' '.$disc["discount_amount"].'% '.$subT.'  €</td>';
      }
      }
      }
    }
				
			
			
      ?>
    </tr>
    <tr class="text-center">
      <?php
      if(isset($_SESSION['admin']) || (isset($_SESSION['super'])))
        echo '<td colspan="7" class="text-right">Total: €</td>';
      ?>
      <?php

        if(isset($_SESSION['user'])){
          $items = Total();
          foreach ($items as $value)
        {
          $subT = round($value["Total"],2);
        echo '<td colspan="7" class="text-right">Total: '.$subT.'  €</td>';
        }
        }
				

			
      ?>
    </tr>
    </tfoot>
  </table>
  <div class="d-flex justify-content-center">
    <?php if(isset($_SESSION['user'])) 
    echo '
    <form action="../components/shoppingCart.php" method="post">
  
      <button class="btn btn-danger m-3" name="erase">Empty your Cart</button>
      <button class="btn btn-success m-3" name="check-out">Check out</button>

    </form>';
    ?>
    <?php if(isset($_SESSION['admin']) && (isset($_SESSION['super'])))
    echo '';
    ?>

	</div>
</div>
</div>
<?php
    include '../components/footer.php';
    ?>
</body>
</html>
<?php ob_end_flush(); ?>

