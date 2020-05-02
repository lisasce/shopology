<?php
$id = isset($_GET['id']) ? $_GET['id'] : "";

	if (isset($_POST['wish']) && (isset($_SESSION['user']))) {
    $wishlist_id =$id;
    $conn = connect();
    $sql = "SELECT * FROM wishlist WHERE fk_product_id={$wishlist_id} and fk_user_id = {$_SESSION['user']}";
    $res = mysqli_query($conn,$sql);
	if ($res->num_rows == 0 ){
	$sql = "INSERT INTO wishlist (fk_product_id,fk_user_id) VALUES ({$wishlist_id},{$_SESSION['user']})";
		$result1 = mysqli_query($conn,$sql);
		header("Location: ../components/wishlist.php");
    	exit;
	}
	elseif ($res->num_rows >= 1){
		$msg ='<h5 class="pacifico text-warning">Item already in your Wishlist</h5>';
	}
	}

	function removeProductFromWishlist($productID, $userID){
	    $conn = connect();
        $sql = "DELETE FROM wishlist WHERE fk_product_id={$productID} and fk_user_id = {$userID}";
        return mysqli_query($conn, $sql);
    }

function wishDisplay(){
	$conn = connect(); 
	$sql = "SELECT * FROM wishlist INNER JOIN product ON product_id = fk_product_id WHERE fk_user_id={$_SESSION['user']}";
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




?>
