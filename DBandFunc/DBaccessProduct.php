<?php

require_once 'DBconnect.php';
require_once 'functions.php';

function selectPdt(){
    $conn = connect();
    $sql = "SELECT  product_id, product_name FROM project.product";
    $products=mysqli_query($conn, $sql);
    $resultProducts = $products->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $resultProducts;
}

function productSearchBar($name)
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE `product_name` LIKE '%$name%'";

    $products = mysqli_query($conn, $sql);
    $resultSearch = $products->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $resultSearch;
}

function productDetails($product_id)
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE product_id = $product_id";
    $product = mysqli_query($conn, $sql);
    $result = $product->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}

function deleteProduct($id)
{
    $conn = connect();
    $sql = "DELETE FROM `product` WHERE product_id = $id";

    $res= mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}

function createProduct($product_name, $category, $product_price, $description, $product_img, $available_amount, $sales_discount, $display)
{
    $conn = connect();
    $product_name = clearString($product_name);
    $category = clearString($category);
    $product_price = clearString($product_price);
    $description = clearString($description);
    $img = clearString($product_img['name']);
    $available_amount = clearString($available_amount);
    $sales_discount = clearString($sales_discount);
    $display = clearString($display);

    $prod_img = $img == ""  ?  "../img/bag3.png"  :  "../img/".basename($img);
    if($img !== "") {
        copy($_FILES['product_img']['tmp_name'], $prod_img);
    }

    $sqlSearchProduct = "SELECT * FROM product WHERE product_name= $product_name AND category = $category AND description = $description";
    $resProduct = mysqli_query($conn, $sqlSearchProduct);

    if($resProduct->num_rows == 0)
    {
        $sql = "INSERT INTO `product`(`product_name`, `category`, `product_price`, `description`, `product_img`, `available_amount`, `sales_discount`, `display`) VALUES ('$product_name', '$category', '$product_price', '$description', '$prod_img', '$available_amount', '$sales_discount', '$display')";
        mysqli_query($conn, $sql);

        $lastProductId = mysqli_insert_id($conn);
        return true;

    }else
    {
        $result = $resProduct->fetch_assoc();
        $lastProductId = $result["product_id"];
        $conn->close();
    }
}

function updateProduct($product_id, $product_name, $category, $product_price, $description, $product_img, $available_amount, $sales_discount, $display)
{
    $conn = connect();
    $product_name = clearString($product_name);
    $category = clearString($category);
    $product_price = clearString($product_price);
    $description = clearString($description);
    $img = clearString($product_img['name']);
    $available_amount = clearString($available_amount);
    $sales_discount = clearString($sales_discount);
    $display = clearString($display);

    $info=  productDetails($product_id);
    $oldImage= $info[0]['product_img'];
    $prod_img = $img == ""  ?  $oldImage  :  "../img/".basename($img);
    if($img != "") {
        copy($_FILES['product_img']['tmp_name'], $prod_img);
    }

    if ($sales_discount == ''){
        $sales_discount = null;
    }

    $sql = "UPDATE `product` SET `product_name`='$product_name',`category`='$category',`product_price`='$product_price',`description`='$description',`product_img`='$prod_img',`available_amount`='$available_amount',`sales_discount`='$sales_discount',`display`='$display' WHERE product_id = $product_id ";
    
    $resProduct = mysqli_query($conn, $sql);

    if( $resProduct == TRUE)
    {
        $conn->close();
        return true;
    }else
    {
        $conn->close();
        return "error";
    }
}

function productDetailsAll()
{
    $conn = connect();
    $sql = "SELECT * FROM `product`";

    $products = mysqli_query($conn, $sql);
    $result1 = $products->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result1;
}
function productDetailsEle()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='electronics'";

    $electronic = mysqli_query($conn, $sql);
    $result2 = $electronic->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result2;
}
function productDetailsHouse()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='household'";

    $house = mysqli_query($conn, $sql);
    $result3 = $house->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result3;
}
function productDetailsClothes()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='clothes'";

    $clothes = mysqli_query($conn, $sql);
    $result4 = $clothes->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result4;
}
function productDetailsFood()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='food'";

    $food = mysqli_query($conn, $sql);
    $result5 = $food->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result5;
}
function productDetailsMeds()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='medicine'";

    $med = mysqli_query($conn, $sql);
    $result6 = $med->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result6;
}
function productDetailsKids()
{
    $conn = connect();
    $sql = "SELECT * FROM `product` WHERE category='pets_kids'";

    $kids = mysqli_query($conn, $sql);
    $result7 = $kids->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result7;
}
?>
