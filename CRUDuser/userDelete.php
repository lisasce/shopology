<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();
?>

<!DOCTYPE html>
<html lang="en">
<?php
include '../components/header.php';
?>
<body>
<div id="content">

    <?php
        if(deleteUser($userID)){
            unset($_SESSION['admin']);
            unset($_SESSION['superAdmin']);
            unset($_SESSION['user']);
            session_unset();
            session_destroy();
            ob_end_flush();
            header("Location: ../index.php");
            exit;
        }else{
            echo "error";
        }

    ?>


<?php
include '../components/footer.php';
?>

</body>
</html>

