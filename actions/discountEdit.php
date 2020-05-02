<?php
require_once '../DBandFunc/DBaccessDiscount.php';
$data = $_POST['array'];

$discount_id = $data['row_id'];
$codemsg = $data['codemsg'];
$discountname = $data['discountname'];
$activated = $data['activated'];
$discount_amount = $data['discount_amount'];

// echo "discountId: " . $discount_id . ", codemsg: " . $codemsg . ", discName: " . $discountname . 
// ", activated: " . $activated . ", discAmount: " . $discount_amount;

echo json_encode(discountEdit($discount_id, $codemsg, $discountname, $activated, $discount_amount));
?>
