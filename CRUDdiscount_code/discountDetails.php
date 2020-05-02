<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessDiscount.php';

if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: index.php");
    exit;
}
if( isset($_SESSION['user']))
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
<div id="content" class="discountContainer">
    <?php
    include '../components/navbar.php';
    ?>
    <div class="container mt-sm-5 col-12 pt-5">
        <h2 class="pacifico text-center text-warning">Manage Discounts </h2>
        
        <div>
        <div class="d-flex justify-content-center mt-5">
            <a href="create.php" class="btn btn-md bg-warning mr-2">Create New</a>
        </div>
        <hr />
        </div>
    
        <div class="tableDiscount container pt-5">
            <?php
                $discounts = discountDetails();
            ?>
        </div>
    </div>


</div>

<script>
    var discounts = <?= json_encode($discounts) ?>;
</script>
<?php
include '../components/footer.php';
?>
<script>
    // var discounts2 = discountVal();
</script>
<script src="../js/discount.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>