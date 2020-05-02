<?php
require_once 'DBconnect.php';
require_once 'functions.php';

function discountDetails()
{
    $conn = connect();
    $sql = "SELECT * FROM `discount_code`";

    $discounts = mysqli_query($conn, $sql);
    $result = $discounts->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}

function discountEdit($discount_id, $codemsg, $discountname, $activated, $discount_amount)
{
    $conn = connect();
    $sql = "UPDATE `discount_code` SET `codemsg`= '$codemsg',`discountname`= '$discountname',`activated`= '$activated',`discount_amount`= '$discount_amount' WHERE discount_id = '$discount_id' ";

    $discounts = mysqli_query($conn, $sql);
    $conn->close();
    
    if( $discounts == TRUE)
    {
        return true;
    }else
    {
        // return $sql;
        return "error";
    }
}

function deleteDiscount($discount_id)
{
    $conn = connect();
    $sql = "DELETE FROM `product` WHERE product_id = $discount_id";

    $res= mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}
function createDiscount($codemsg, $discountname, $activated, $discount_amount)
{
    $conn = connect();

    $sql = "INSERT INTO `discount_code`(`codemsg`, `discountname`, `activated`, `discount_amount`) VALUES ('$codemsg', '$discountname', '$activated', $discount_amount)";

    // var_dump($sql); die;
    
    $res = mysqli_query($conn, $sql);
    $conn->close();

    if( $res == TRUE)
    {
        return true;
    }else
    {
        // return $sql;
        return "error";
    }
    
}   
?>