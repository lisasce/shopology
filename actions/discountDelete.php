<?php
require_once '../DBandFunc/DBconnect.php';
require_once '../DBandFunc/DBaccessDiscount.php';
$data = $_POST['array'];

$discount_id = $data['row_id'];
$conn = connect();
$sql = "DELETE FROM discount_code WHERE discount_id = {$discount_id}";
$res = mysqli_query($conn, $sql);
if($res){
    echo "delete success";
}
?>
