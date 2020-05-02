<?php
session_start();
require_once '../DBandFunc/functions.php';
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBconnect.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";
	
if(isset($_POST['check-out']) && (isset($_SESSION['user']))){
	$conn = connect();
    $sql2 = "SELECT * FROM cart INNER JOIN product ON product_id = fk_product_id WHERE fk_user_id={$_SESSION['user']}";
    $sql3 = "SELECT * FROM discount_code WHERE activated = 'yes'";
    $res1 = mysqli_query($conn,$sql2);
    $res2 = mysqli_query($conn,$sql3);
    $rowing = $res2->fetch_assoc();
    $discount = $rowing['discount_id'];
    $discountStatus = $rowing['activated'];
    $rows = $res1->fetch_all(MYSQLI_ASSOC);
	$result = true;
	$deleteOldOrdersSQL = "DELETE FROM `order` WHERE fk_user_id = {$_SESSION['user']}";
	if ($discountStatus == 'yes'){
		foreach ($rows as $row) {
	    	$price = $row['product_price'];
	    	$qty = $row['cart_qty'];
	  		$product_id = $row['fk_product_id'];
	  		$sql1 = "INSERT INTO `order` (fk_user_id,fk_product_id, order_qty, order_price, fk_discount_id) VALUES ({$_SESSION['user']},{$product_id}, {$qty},{$price},{$discount} )";
	  		$result = $result && mysqli_query($conn,$sql1);
	    }
	}
	else{
		foreach ($rows as $row) {
	    	$price = $row['product_price'];
	    	$qty = $row['cart_qty'];
	  		$product_id = $row['fk_product_id'];
	  		$sql1 = "INSERT INTO `order` (fk_user_id,fk_product_id, order_qty, order_price) VALUES ({$_SESSION['user']},{$product_id}, {$qty},{$price})";
	  		$result = $result && mysqli_query($conn,$sql1);
	    }
	}
	header ("Location: ../components/checkOut.php");
	$conn->close();
	}

function displayOrder(){
	$conn = connect(); 
	$sql = "SELECT * FROM `order` INNER JOIN product ON product_id = fk_product_id WHERE fk_user_id={$_SESSION['user']}";
	$res = mysqli_query($conn,$sql);
	if($res->num_rows == 0){
		$products = "No results";
	}elseif($res->num_rows == 1){
	$products = $res->fetch_all(MYSQLI_ASSOC);
	}
	else{
	$products = $res->fetch_all(MYSQLI_ASSOC);
	}
	$conn->close();
    return $products;
}

function selectAdress()
	{
    $conn = connect();
    $sql = "SELECT address_id, street, zip, city, country FROM `address` WHERE fk_user_id={$_SESSION['user']}";
    $address=mysqli_query($conn, $sql);
    $resultAddress = $address->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $resultAddress;
	}
function orderTotal(){
	$conn = connect();
	$sql = "SELECT (discount_amount) FROM discount_code WHERE activated='yes'";
	$result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$discount = $row['discount_amount']; 
	$sql = "SELECT SUM((order_price * order_qty) - ((order_price * order_qty)/$discount))AS Total FROM `order`";
	$res = mysqli_query($conn,$sql);
	if($res->num_rows == 0){
		echo'';
	}
	else{
		$items = $res->fetch_all(MYSQLI_ASSOC);
		$conn->close();
    	return $items;
	}
	
}
function orderSubTotal(){
	$conn = connect(); 
	$sql = "SELECT SUM(order_price * order_qty) AS SubTotal FROM `order`";
	$res = mysqli_query($conn,$sql);
	$items = $res->fetch_all(MYSQLI_ASSOC);
	$conn->close();
    return $items;
}
function orderDiscount(){
	$conn = connect();
	$sql = "SELECT (discount_amount) FROM discount_code WHERE activated='yes'";
	$result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$discount = $row['discount_amount'];

	$sql = "SELECT SUM((order_price * order_qty)/$discount) AS discount FROM `order`";
	$res = mysqli_query($conn,$sql);
	$items = $res->fetch_all(MYSQLI_ASSOC);
	$conn->close();
    return $items;
}
if(isset($_POST['complete']) && (isset($_SESSION['user'])))
{
	$conn = connect();
	$sql = "SELECT * FROM `user` WHERE user_id={$_SESSION['user']}";
	$user =mysqli_query($conn,$sql);
	$users = $user->fetch_all(MYSQLI_ASSOC);
	$email = $users['email'];
	$adress = $_POST['addressSelect'];
	$first_name = $users['first_name'];
	$last_name = $users['last_name'];
	$sql1 = "DELETE FROM cart WHERE fk_user_id={$_SESSION['user']}";
	$res = mysqli_query($conn,$sql1);
	$sql2 = "SELECT * FROM `order` INNER JOIN product ON product_id = fk_product_id WHERE fk_user_id={$_SESSION['user']}";
	$res = mysqli_query($conn,$sql);
	$row = $res->fetch_all(MYSQLI_ASSOC);
	$to = $email;
	$subject = 'Order Details';
	$message_body = 
	'	Hello '.$first_name.' '.$last_name.'
		Thank you for choosing us!
		Your items will be delivered '.$address.'
		These are your order details: ';
	foreach (displayOrder() as $orderItem) {
		$message_body =$message_body .$orderItem['product_name'].  ' ' .$orderItem['product_price']. ' ' .$orderItem['orderqty'];
	}
		

	mail ($to, $subject, $message_body);
	header("Location: ../homes/userHome.php");
}

?>