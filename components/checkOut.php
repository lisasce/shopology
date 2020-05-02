<?php
ob_start();
session_start();

require_once '../DBandFunc/functions.php';
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBaccessOrder.php';
require_once '../DBandFunc/DBconnect.php';
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
<div id="checkoutBox" class="container">
  <h2 class="text-center pacifico pb-3 text-warning">Complete Your order</h2>
	<form id="addressForm" action="../DBandFunc/DBaccessOrder.php" method="post">
	<select id="addressSelect" name="addressSelect" class="custom-select" form="addressForm"><option  value='' >Choose Adress:  </option>
                    <?php
                    $adress = selectAdress();
                    foreach ($adress as $adresses){
                    	$addressName =$adresses['street']." ".$adresses['zip']." ".$adresses['city']." ".$adresses['country'];
                        echo "<option value='".$addressName."'>".$addressName." </option>";
                    }
                    ?>
    </select>
	</form>
</div>

	<div class="container mx-auto mt-2">

  <table class="table table-hover table-light shootingBox">
    <thead class="shootingBox">
      <tr>
        <th scope="col">Product</th>
        <th scope="col " class="text-center">Qty</th>
        <th scope="col " class="text-right d-none d-md-table-cell">Price</th>
        <th scope="col " class="text-right d-none d-md-table-cell"></th>
      </tr>
    </thead>
    <tbody>
    	<?php			
      $products = displayOrder();
      if($products == "No results"){
        echo '<p class="pacifico text-warning">No Items in your Order cart</p>';
      }elseif(is_array($products)){
        foreach ($products as $value){
      	$sub = $value['order_qty'] * $value['product_price'];
      	if(isset($_SESSION['user'])){ 
        echo '    
        <tr>    
        <td>'.$value["product_name"].'</td>
        <td  class="text-center"> '.$value["order_qty"].'</td>
        <td class="text-right d-none d-md-table-cell"> '.$value["product_price"].'€</td>
        <td class="text-right d-none d-md-table-cell"> '.$sub.'  €</td> 
        </tr>';
    	}
        }
    	}
    	?>
    </tbody>
    <tfoot class="shootingBox">
    <tr class="text-center">
      <?php 
      if(isset($_SESSION['user'])){
        $items = orderSubTotal();
        foreach ($items as $value){
        $subT = round($value["SubTotal"],2);
            echo '<td colspan="7" class="text-right">Subtotal: '.$subT.'  €</td>';
          }
      }
			
			
      	?>
    </tr>
    <tr class="text-center">
      <?php
			  
        if(isset($_SESSION['user'])){
          $items = orderDiscount();
          $discount = discountInfo();
          foreach ($items as $value)
      {
          foreach ($discount as $disc){
      $subT = round($value["discount"],2);
      echo '<td colspan="7" class="text-right">Discount: '.$disc["discountname"].' '.$disc["discount_amount"].'% '.$subT.'  €</td>';
      }
      }
        }
				
			
			
      ?>
    </tr>
    <tr class="text-center">
      <?php

        if(isset($_SESSION['user'])){
          $items = orderTotal();
          foreach ($items as $value)
        {
          $subT = round($value["Total"],2);
        echo '<td colspan="7" class="text-right">Total: '.$subT.'  €</td>';
        }
        }
				

			
      ?>
    </tr>
    <tr class="text-center">
    	<?php
    	if (isset($_SESSION['user']))
    	{
		echo '<td colspan="7" class="text-right">Receipt comes with Order. <br> You have one month to complete the transaction.</td>';
		}
		?>
    </tr>
    </tfoot>
  </table>

	<div class="d-flex justify-content-center">
    <?php if(isset($_SESSION['user'])) 
    echo '
    <!--<form action="../components/checkOut.php" method="post">-->

      <button class="btn btn-success m-3" name="complete"  id="complete" form="addressForm">Complete Order</button>

    <!--</form>-->';
    ?>

	</div>


</div>
	<?php
    include '../components/footer.php';
    ?>

    <script>
        $(document).ready(function(){

            $("#complete").click(orderWindow);

        });
    </script>

</body>
</html>
<?php ob_end_flush(); ?>
