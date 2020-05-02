<?php
require_once '../DBandFunc/DBconnect.php';
require_once '../DBandFunc/DBaccessDiscount.php';

$result = discountDetails();
$final = json_encode($result);
echo $final;
?>