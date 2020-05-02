<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessProduct.php';

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

                        $product_name = $_POST["name"];
                        $category = $_POST["category"];
                        $product_price = $_POST["product_price"];
                        $description = $_POST["description"];
                        $product_img = $_FILES["product_img"];
                        $available_amount= $_POST["available_amount"];
                        $sales_discount = $_POST["sales_discount"];
                        $display = $_POST["display"];
                        

                        $result = createProduct($product_name, $category, $product_price, $description, $product_img, $available_amount, $sales_discount, $display);
                        
                        if($result == TRUE)
                        {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <a class=' btn btn-light'   href='../homes/userHome.php'>Back to Products</a>
                            <span class='pl-3'><strong>Thank you for updating our Product List</strong></span>    
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
                <h2 class=" pacifico text-center text-warning pb-5">Update Product here:</h2>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-warning mr-2" href="update.php">Edit Product</a>
                </div>
                    <hr />

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <h2 class=" pacifico text-center text-warning pt-5">Add new Product here:</h2>
                    <hr class="pb-5"/>

                    Name:
                    <input class ="form-control" type="text" name="name" id="name" placeholder ="Enter product name"  maxlength ="30"  /><br>
                    
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupCategory">Product Category: </label>
                        </div>
                        <select name="category" class="custom-select" id="inputGroupCategory">
                            <option name="category" value="electronics" selected>Choose...</option>
                            <option name="category" value="electronics">Electronics</option>
                            <option name="category" value="household">Household</option>
                            <option name="category" value="clothes">Clothes</option>
                            <option name="category" value="food">Food</option>
                            <option name="category" value="medicine">Medicine</option>
                            <option name="category" value="pets_kids">Pets & Kids</option>
                        </select>

                    </div>

                    Price:
                    <input class ="form-control" type="number" name="product_price" id="price" step="0.01" placeholder ="Enter product price"  maxlength ="30"  /><br>

                    Description:
                    <input class ="form-control" type="text" name="description" id="description" placeholder ="Enter product description"  maxlength ="200"  /><br>

                    Product Image:
                    <input class ="form-control" type="file" name="product_img" id="product_img" placeholder ="Upload product picture here:" value="" maxlength ="500"  /><br>
                    
                    Available Amount:
                    <input class ="form-control" type="number" name="available_amount" id="available_amount" placeholder ="Enter available amount"  maxlength ="30"  /><br>
                    
                    Sales Discount:
                    <input class ="form-control" type="text" name="sales_discount" id="sales_discount" placeholder ="Enter sale price"  min="1" max="100"/><br>
                    
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupDisplay">Display Product : </label>
                        </div>
                        <select name="display" class="custom-select" id="inputGroupDisplay">
                            <option name="display" value="yes" selected>Choose...</option>
                            <option name="display" value="yes">Yes</option>
                            <option name="display" value="no">No</option>
                        </select>
                    </div>
                    <hr />

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning mr-2 mb-4 text-center" type="submit" name="submit">Create Product</button>
                    </div>

                </form> 
            </div>      
    </div>


    <?php
        include '../components/footer.php';
    ?>
</body>
</html>
<?php  ob_end_flush(); ?>

