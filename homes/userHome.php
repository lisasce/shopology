<?php
ob_start();
session_start();
require_once '../DBandFunc/functions.php';
require_once '../DBandFunc/DBaccessMIX.php';
require_once '../DBandFunc/DBaccessCart.php';

// if ( isset($_SESSION['user' ])!="") {
//     header("Location: homes/userHome.php");
//     exit;
// }
// if(isset($_SESSION['admin']) != ''){
//     header('Location: homes/adminHome.php');
//     exit;
// }
// if(isset($_SESSION['superAdmin']) != ''){
//     header('Location: homes/superHome.php');
//     exit;
// }


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

    

    <div class="jumbotron jumbotron-fluid">
         
        <div class="container">
            <?php       
            $discount = discountInfo();
            foreach ($discount as $value) 
            {
            if ($value['activated'] == 'yes'){
            echo '<h1 class="display-4"> '.$value["codemsg"].'</h1>
            <p class="lead">This discount will automatically be added to your cart.</p>';
            }
                }
            ?>
            
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 mb-5 d-flex justify-content-between">
            <?php
            include '../components/slider.php';
            ?>
        </div>
    </div> 

    <div class="container">
        <div class="row">
            <?php
            include '../components/sidebar.php';
            ?>
        </div>
    </div>
    
    <?php
    include '../components/footer.php';
    ?>
</div>
<script>
    $(document).ready(function(){

        $(".delBtn").click(function () {
            let link = $(this).data('href');
            confirmWindow(function (result) {
                if(result){
                    location.assign(link);
                }
                // result depends on the button you click and returns true or false. if true you are redirected to the page with the action.
            });
        });
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>
