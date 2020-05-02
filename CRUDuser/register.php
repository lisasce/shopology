<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
if(isset($_SESSION['admin']) && isset($_SESSION['user']) && isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}

$error = false; //first time we open the page we will have no error
if ( isset($_POST['btn-signup']) ) {
    $first_name = $_POST["first_name"];
    $phone = $_POST["phone"];
    $last_name = $_POST["last_name"];
    $user_img = $_FILES["user_img"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $zip = $_POST["zip"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $coordx = $_POST["coordx"];
    $coordy = $_POST["coordy"];


    // basic name validation
    if (empty($first_name) ){
        $error = true ;
        $nameError = "Please enter your first name.";
    } else if (strlen($first_name) < 3) {
        $error = true;
        $nameError = "first name must have at least 3 characters.";
    } else if(!preg_match("/^[a-zA-Z0-9- ]+$/",$first_name)) {
        $error = true;
        $nameError = "first name must only contain alphabets and space.";
    }

    if (empty($last_name) ){
        $error = true ;
        $nameError = "Please enter your last name.";
    } else if (strlen($last_name) < 3) {
        $error = true;
        $nameError = "last name must have at least 3 characters.";
    } else if(!preg_match("/^[a-zA-Z0-9- ]+$/",$last_name)) {
        $error = true;
        $nameError = "last name must only contain alphabets and space.";
    }


    if (empty($phone) || empty($address) || empty($zip) || empty($city) || empty($country)){
        $error = true ;
        $inputError = "This cannot be empty.";
    } else if (strlen($phone) < 5 || strlen($address) < 5 ||strlen($city) < 3 ||strlen($country) < 3 ||strlen($zip) < 3) {
        $error = true;
        $inputError = "Please correct your entry, it seems to be too short";
    } else if(!preg_match("~[0-9]~",$phone)) {
        $error = true;
        $phoneError = "Please correct your phone number (e.g. change prefix '+43' into '0043)'";
    }

    // password format validation
    if (empty($password)){
        $error = true;
        $passwordError = "Please enter password.";
    } else if(strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must have at least 6 characters." ;
    }

    // password hashing for security
    $password = hash('sha256' , $password);

    // if there's no error, continue to signup
    if( !$error ) {
            $result = createUser( $first_name, $last_name,$email, $password,$phone, $user_img, $address, $zip, $city, $country, $coordx, $coordy);

            if ($result) {
                $errTyp = "success";
                $errMSG = "Successfully registered, you may <a href = '../index.php' >login
                </a> now ";
                unset($first_name);
                unset($last_name);
                unset($email);
                unset($password);
            } else {
                $errTyp = "danger";
                $errMSG = "Something went wrong, try again later...";
            }
        }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    include '../components/header.php';
    ?>
    <body>
    <div id="contentRegister">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 mb-5">
            <img src="../img/bag3.png" alt="logo" width="50" class="m-3">
            <a class="navbar-brand text-warning pacifico" href="../index.php">Welcome to Shopology!</a>        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </nav>

        <div class="container">

                <form class="mt-3" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" enctype="multipart/form-data">


                    <h2 class="pacifico text-warning text-center">Sign Up.</h2>
                    <hr />

                    <?php
                    if ( isset($errMSG) ) {
                        ?>
                        <div  class="alert alert-<?php echo $errTyp ?>" >
                            <?php echo  $errMSG; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <p>First Name:</p>
                    <input type ="text"  name="first_name"  class ="form-control m-1"  placeholder ="Enter your First name"  maxlength ="50"   value = "<?php echo $first_name ?>"  />
                    <span   class = "text-danger" > <?php   echo  $nameError; ?> </span >


                    <p class="mt-3">Last Name:</p>
                    <input type ="text"  name="last_name"  class ="form-control m-1"  placeholder ="Enter your Last name"  maxlength ="50"   value = "<?php echo $last_name ?>"  />
                    <span   class = "text-danger" > <?php   echo  $nameError; ?> </span >


                    <p class="mt-3">Email:</p>
                    <input   type = "email" id="email"  name = "email"   class = "form-control m-1"   placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>"  />
                    <span id="email_result"></span>


                    <p class="mt-3">Password:</p>
                    <input   type = "password" id="password"  name = "password"   class = "form-control m-1"   placeholder = "Enter Password"   maxlength = "15"  />
                    <span   class = "text-danger" > <?php   echo  $passwordError; ?> </span >


                    <p class="mt-3"> Repeat Password:</p>
                    <input   type = "password"   id="passVerif" name= "passVerif"   class = "form-control m-1"   placeholder = "Verify your Password"   maxlength = "15"  />
                    <span id="pw_result"></span>
                    <span   class = "text-danger" > <?php   echo  $passwordError; ?> </span >


                    <p class="mt-3">Phone:</p>
                    <input class ="form-control" type="text" name="phone" id="phone" placeholder ="Enter your phone number"  maxlength ="40" value="<?php echo $phone ?>" />
                    <span   class = "text-danger" > <?php   echo  $inputError; ?> <?php   echo  $phoneError; ?> </span >
                    <br>

                    <p>Avatar:</p>
                    <input class ="form-control" type="file" name="user_img" id="user_img" placeholder ="Upload here a your picture:" value="" maxlength ="500"  /><br>

                    <p>Address:</p>
                    <input class='form-control hobby' type='text' name='address'  placeholder='Enter your address' value="<?php echo $address ?>" maxlength='150'  />
                    <span   class = "text-danger" > <?php   echo  $inputError; ?> </span >
                    <br>

                    <p>Zip Code:</p>
                    <input class='form-control hobby' type='text' name='zip'  placeholder='Enter your zip code'  maxlength='50' value="<?php echo $zip ?>" />
                    <span   class = "text-danger" > <?php   echo  $inputError; ?> </span >
                    <br>

                    <p>City:</p>
                    <input class='form-control hobby' type='text' name='city'  placeholder='Enter your city'  maxlength='50' value="<?php echo $city ?>"  />
                    <span   class = "text-danger" > <?php   echo  $inputError; ?> </span >
                    <br>

                    <p>Country:</p>
                    <input class='form-control hobby' type='text' name='country'  placeholder='Enter your country' value="<?php echo $country ?>" maxlength='50'  />
                    <span   class = "text-danger" > <?php   echo  $inputError; ?> </span >
                    <br>

                    <h5 class='pacifico text-warning'>If you want to see your address on a map enter coordinates here (optional)</h5>
                    <span class='pacifico '>To check coordinates click here: <a href='https://www.latlong.net/'>coordinates finder</a></span>
                    <hr>

                    <p>Coordinate Latitude:</p>
                    <input class='form-control hobby' type='text' name='coordx'  placeholder='Enter Latitude e.g. 48.208176'  maxlength='50' value="<?php echo $coordx ?>" /><br>

                    <p>Coordinate Longitude:</p>
                    <input class='form-control hobby' type='text' name='coordy' placeholder='Enter Longitude e.g. 16.373819'  maxlength='50' value="<?php echo $coordy ?>" /><br>

                    <hr />
                    <div class="d-flex justify-content-center">
                        <button  id="submitBtn" type = "submit"   class = "btn btn-lg btn-warning"   name = "btn-signup" >Sign Up</button >
                    </div>
                    <hr  />

                    <a   href = "../index.php" >Sign in Here...</a>
                </form>

        </div>
    </div>

    <?php
    include '../components/footer.php';
    ?>
    </body>
    </html>
<?php ob_end_flush(); ?>
