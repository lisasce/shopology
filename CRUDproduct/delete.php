<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';

if(!isset($_SESSION['admin']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}elseif(isset($_SESSION['user']))
{
    header("Location: ../homes/userHome.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include '../components/header.php';
    ?>
<body>
    <div id="content">
        <?php
            include '../components/navbar.php';
        ?>
    </div>
    <div id="deletePage" class="container mt-sm-5 ">

        <?php
        if($_GET['id'])
        {
            $id = $_GET['id'];
    
            if(deleteProduct($id))
            {
                echo "<div id='deleteBox' class='pt-5 text-center'><h5>Product successfully deleted </h5><br> <a class='btn btn-secondary' href='../homes/userHome.php'>Back to Products</a></div>";
            }else{
                echo "error";
            }
        }
        ?>

    </div>
    <?php
        include '../components/footer.php';
    ?>
</body>
</html>
<?php  ob_end_flush(); ?>