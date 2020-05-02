<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessDiscount.php';

if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin']))
{
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
    <div id="content">
        <?php
        include '../components/navbar.php';
        ?>
            <div class="container mt-sm-5 col-8 pt-5">
            <?php
                    if($_POST){

                        $codemsg = $_POST["codemsg"];
                        $discountname = $_POST["discountname"];
                        $activated = $_POST["activated"];
                        $discount_amount = $_POST["discount_amount"];
                        
                        $result = createDiscount($codemsg, $discountname, $activated, $discount_amount);
                        
                        if($result == TRUE)
                        {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <a class=' btn btn-light'   href='../CRUDdiscount_code/discountDetails.php'>Back to Discounts</a>
                            <span class='pl-3'><strong>Thank you for updating our Discounts</strong></span>    
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <br>";
                        }else{
                            echo "error";
                        }  
                    }
                ?>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off">
                    <h2 class=" pacifico text-center text-warning">Add new Discount here:</h2>
                    <hr class="pb-5"/>
                    
                    Code:
                    <input class ="form-control" type="text" name="codemsg" placeholder ="Enter discount code"  maxlength ="10" /><br>
                    
                    Details:
                    <input class ="form-control" type="text" name="discountname" placeholder ="Enter discount details"  maxlength ="20" /><br>
                
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupActivated">Activate Discount: </label>
                        </div>
                        <select name="activated" class="custom-select" id="inputGroupActivated">
                            <option name="activated" value="yes" selected>Choose...</option>
                            <option name="activated" value="yes">Yes</option>
                            <option name="activated" value="no">No</option>   
                        </select>

                    </div>

                    Discount %:
                    <input class ="form-control" type="number" name="discount_amount" placeholder ="Enter discount %"  min="1" max="100" /><br>
                
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning mr-2 mb-4 text-center" type="submit" name="submit">Create Discount</button>
                    </div>
                </div>

    </div>
    <?php
        include '../components/footer.php';
    ?>
    <script src="../js/discount.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>