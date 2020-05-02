<?php
require_once '../DBandFunc/functions.php';
require_once '../DBandFunc/DBaccessProduct.php';
require_once '../DBandFunc/DBconnect.php';
 

$id = isset($_GET['id']) ? $_GET['id'] : "";

	if (isset($_POST['add_product']) && (isset($_SESSION['user']))) {
    $product_id = $_POST['add_product'];
    $conn = connect();
    $sql = "SELECT * FROM cart WHERE fk_product_id={$product_id}";
    
    $res = mysqli_query($conn,$sql);

	if ($res->num_rows == 0 ){
	$sql = "INSERT INTO cart (fk_product_id,fk_user_id, cart_qty) VALUES ({$product_id},{$_SESSION['user']}, 1)";
	$result1 = mysqli_query($conn,$sql);
	}
	else {

		$row = $res->fetch_assoc();
		$qty = $row['cart_qty'] +1;
		$sql = "UPDATE cart SET cart_qty=$qty WHERE fk_product_id=$product_id";
		$res = mysqli_query($conn,$sql);
	}
	if ( isset($_SESSION['user' ])!="") {
    header("Location: ../homes/userHome.php");
    exit;
	}
	}
	
	if (isset($_POST['remove'])) 

	{

    $product_id = $_POST['cart_id'];
    $conn = connect();
    $sql = "DELETE FROM cart WHERE fk_product_id={$product_id}";
    $res = mysqli_query($conn,$sql);

    header("Location: ../components/shoppingCart.php");
	}
if (isset($_POST['decrease'])){ 
	$product_id = $_POST['cart_id'];
    $conn = connect();
    $sql = "SELECT * FROM cart WHERE fk_product_id={$product_id}";
    $res = mysqli_query($conn,$sql);
    $row = $res->fetch_assoc();
    if($row['cart_qty'] <= 1){
    $sql1 = "DELETE FROM cart WHERE fk_product_id={$product_id}";
    $res1 = mysqli_query($conn,$sql1);	
    }
    else{
	$qty = $row['cart_qty'] -1;
	$sql2 = "UPDATE cart SET cart_qty=$qty WHERE fk_product_id=$product_id";
	$res3 = mysqli_query($conn,$sql2);
	

	header("Location: ../components/shoppingCart.php");

	}
	}
	if (isset($_POST['increase'])){ 
	$product_id = $_POST['cart_id'];
    $conn = connect();
    $sql = "SELECT * FROM cart WHERE fk_product_id={$product_id}";
    $res = mysqli_query($conn,$sql);
    $row = $res->fetch_assoc();
	$qty = $row['cart_qty'] +1;
	$sql2 = "UPDATE cart SET cart_qty=$qty WHERE fk_product_id=$product_id";
	$res3 = mysqli_query($conn,$sql2);
	

	header("Location: ../components/shoppingCart.php");

	}
	if (isset($_POST['erase'])){
		$conn = connect();
		$sql = "DELETE FROM cart WHERE fk_user_id={$_SESSION['user']}";
		$res = mysqli_query($conn,$sql);

		header("Location: ../components/shoppingCart.php");
	}

function cartItems()
{
    $conn = connect(); 
    $sql = "SELECT SUM(cart_qty) AS NumberOfProducts FROM cart";
    $res = mysqli_query($conn,$sql);
    $products = $res->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $products;
}
function discountInfo()
{
    $conn = connect(); 
    $sql = "SELECT * FROM discount_code";
    $res = mysqli_query($conn,$sql);
    $discount = $res->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $discount;
}
function cartDisplay(){
	$conn = connect(); 
	$sql = "SELECT * FROM cart INNER JOIN product ON product_id = fk_product_id WHERE fk_user_id={$_SESSION['user']}";
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
function discount(){
	$conn = connect();
	$sql = "SELECT (discount_amount) FROM discount_code WHERE activated='yes'";
	$result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$discount = $row['discount_amount'];
	if($result->num_rows == 0){
		$items = "No Discounts active"; 
	}
	else{
		$sql = "SELECT SUM((product_price * cart_qty)/$discount) AS discount FROM cart INNER JOIN product ON product_id=fk_product_id WHERE fk_user_id={$_SESSION['user']}";
		$res = mysqli_query($conn,$sql);
		$items = $res->fetch_all(MYSQLI_ASSOC);
	}
	$conn->close();
    return $items;
}
function Total(){
	$conn = connect();
	$sql = "SELECT (discount_amount) FROM discount_code WHERE activated='yes'";
	$result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$discount = $row['discount_amount'];
	if($result->num_rows == 0){
		$sql1 = "SELECT SUM(product_price * cart_qty) AS Total FROM cart INNER JOIN product ON product_id=fk_product_id WHERE fk_user_id={$_SESSION['user']}";
		$res1 = mysqli_query($conn, $sql1);
		$items = $res1->fetch_all(MYSQLI_ASSOC); 
	}
	elseif ($result->num_rows >= 1){
		$sql2 = "SELECT SUM((product_price * cart_qty) - ((product_price * cart_qty))/$discount)AS Total FROM cart INNER JOIN product ON product_id=fk_product_id WHERE fk_user_id={$_SESSION['user']}";
		$res2 = mysqli_query($conn,$sql2);
		$items = $res2->fetch_all(MYSQLI_ASSOC);
	} 
	$conn->close();
	return $items;
    }
function subTotal(){
	$conn = connect(); 
	$sql = "SELECT SUM(product_price * cart_qty) AS SubTotal FROM cart INNER JOIN product ON product_id=fk_product_id WHERE fk_user_id={$_SESSION['user']}";
	$res = mysqli_query($conn,$sql);
	$items = $res->fetch_all(MYSQLI_ASSOC);
	$conn->close();
    return $items;
}


?>
