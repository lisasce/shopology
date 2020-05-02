<?php
require_once '../DBandFunc/DBaccessUser.php';
echo json_encode(getUserInfo($_GET['user_id']));
?>
