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
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
                if($_GET['id'])
                {
                    $product_id = $_GET['id'];
                    $productArray = (productDetails($product_id)); 
                    $productInfo = $productArray[0];
                    
                
                    if($_POST){
                        $product_name = $_POST["name"];
                        $category = $_POST["category"];
                        $product_price = $_POST["product_price"];
                        $description = $_POST["description"];
                        $product_img = $_FILES["product_img"];
                        $available_amount= $_POST["available_amount"];
                        $sales_discount = $_POST["sales_discount"];
                        $display = $_POST["display"];

                        $result = updateProduct($product_id, $product_name, $category, $product_price, $description, $product_img, $available_amount, $sales_discount, $display);
                        
                        if($result == TRUE)
                        {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <a class=' btn btn-light'   href='../homes/userHome.php'>Back to Products</a>
                            <span class='pl-3'><strong>Thank you for updating our Product</strong></span>    
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <br>";
                        }else{
                            echo "error";
                        }  
                    }
                }
            ?>
                <form action="update.php?id=<?= $product_id?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <h2 class=" pacifico text-center text-warning">Update Product here:</h2>
                    <hr />

                    <div class="input-group mb-4 pt-5">

                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupCategory">Product Name: </label>
                        </div>
                        <select id="pdtSelect" name="pdtSelect" class="custom-select" ><option name='type' value='' >Choose product:  </option>
                            <?php
                            $products = selectPdt();
                            foreach ($products as $product){
                                $selectedFlag = $product['product_id'] == $_GET['id'] ? 'selected' : '';
                                echo "<option name='type' value='".$product['product_id']."' ".$selectedFlag.">".$product['product_name']." </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-4 ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupCategory">Product Category: </label>
                        </div>
                        <select name="category" value="<?php echo $productInfo['product_category']?>" class="custom-select" id="inputGroupCategory">
                            <option name="category" value="electronics" <?php if($productInfo['category'] == 'electronics') echo "selected='selected'"?>>Electronics</option>
                            <option name="category" value="household" <?php if($productInfo['category'] == 'household') echo "selected='selected'"?>>Household</option>
                            <option name="category" value="clothes" <?php if($productInfo['category'] == 'clothes') echo "selected='selected'"?>>Clothes</option>
                            <option name="category" value="food" <?php if($productInfo['category'] == 'food') echo "selected='selected'"?>>Food</option>
                            <option name="category" value="medicine" <?php if($productInfo['category'] == 'medicine') echo "selected='selected'"?>>Medicine</option>
                            <option name="category" value="pets_kids" <?php if($productInfo['category'] == 'pets_kids') echo "selected='selected'"?>>Pets & Kids</option>
                        </select>

                    </div>

                    Name:
                    <input class ="form-control" type="text" name="name" id="name" placeholder ="Enter product name" value="<?php echo $productInfo['product_name']?>" maxlength ="30"  /><br>

                    Price:
                    <input class ="form-control" type="number" name="product_price" id="price" step="0.01" placeholder ="Enter product price" value="<?php echo $productInfo['product_price']?>" maxlength ="30"  /><br>

                    Description:
                    <textarea class ="form-control" type="text" name="description" id="description" placeholder ="Enter product description" value="" maxlength ="200" rows="5" cols="10"><?php echo $productInfo['description']?></textarea>
                    
                    Product Image:
                    <input class ="form-control" type="file" name="product_img" id="product_img" placeholder ="Upload product picture here:" value="" maxlength ="500"  /><br>

                    Available Amount:
                    <input class ="form-control" type="number" name="available_amount" id="available_amount" placeholder ="Enter available amount" value="<?php echo $productInfo['available_amount']?>" maxlength ="30"  /><br>
                    
                    Sales Discount:
                    <input class ="form-control" type="text" name="sales_discount" id="sales_discount" placeholder ="Enter sale price" value="<?php echo $productInfo['sales_discount']?>" min="1" max="100"/><br>
                    
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupDisplay">Display Product : </label>
                        </div>
                        <select name="display" class="custom-select" id="inputGroupDisplay">
                            <option name="display" value="yes" <?php if($productInfo['display'] == 'yes') echo "selected='selected'"?>>Yes</option>
                            <option name="display" value="no" <?php if($productInfo['display'] == 'no') echo "selected='selected'"?>>No</option>
                        </select>
                    </div>
                    <hr />

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning mr-2 mb-4 text-center" type="submit" name="submit">Update Product</button>
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
