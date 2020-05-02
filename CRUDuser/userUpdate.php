<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
require_once '../Helper/StringHelper.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();
$userArray = (userDetail($userID));

if ($_POST) {
    $id =  $userID;
    $first_name = $_POST["first_name"];
    $phone = $_POST["phone"];
    $last_name = $_POST["last_name"];
    $user_img = $_FILES["user_img"];
    $email = $_POST["email"];
    $oldPassword= $_POST['oldPassword'];
    $password = IsNullOrEmptyString($_POST["password"]) ? null : $_POST["password"];

    $phone = $_POST["phone"];


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


    if (empty($phone)){
        $error = true ;
        $inputError = "This cannot be empty.";
    } else if (strlen($phone) < 5 ) {
        $error = true;
        $inputError = "Please correct your entry, it seems to be too short";
    } else if(!preg_match("~[0-9]~",$phone)) {
        $error = true;
        $phoneError = "Please correct your phone number (e.g. change prefix '+43' into '0043)'";
    }

    $dbpassword = $userArray[0]['password'];

    // password format validation
    if(IsNullOrEmptyString($password)){
        //Do nothing the password has sto stay null
        //The condition is here so it is not computed for each if potential statements
    }
    else if(hash('sha256' , $oldPassword) != $dbpassword){
        $error = true;
        $passwordError = "The Password are not matching." ;
    } else if(strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must have at least 6 characters." ;
    }

    // password hashing for security
    if($password !== null)
        $password = hash('sha256' , $password);

    if(!$error){
        $result= updateUser($userID,$first_name, $last_name,$email,$phone,$password, $user_img);
        $userArray = (userDetail($userID));
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <?php
    include '../components/header.php';
    ?>
    <body>
    <div id="contentUpdate">
        <?php
        include '../components/navbar.php';
        if($result == TRUE){

            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <a class=' btn btn-light'   href='../index.php'>back to homepage</a>
                          <span class='pl-3'><strong>Thank you for UPDATING!</strong></span>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <br> ";
        } else if($error){
            echo "<div class='alert alert-danger fade show' role='alert'>
                          <span class='pl-3'><strong>$passwordError</strong></span>
                    </div>
                        <br> ";
        }

        ?>


        <div>

            <form class="col-10 mx-auto mt-5" method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off"  enctype="multipart/form-data">


                <h2 class="pacifico text-warning text-center">Here you can update your profile:</h2>
                <hr />

                <p>First Name:</p>
                <input class ="form-control" type="text" name="first_name" id="first_name" value="<?=$userArray[0]['first_name']?>"placeholder ="Enter your first name"  maxlength ="50"  /><br>

                <p>Last Name:</p>
                <input class ="form-control" type="text" name="last_name" id="last_name" placeholder ="Enter your last name"  maxlength ="40" value="<?=$userArray[0]['last_name']?>" /><br>

                <p>Phone:</p>
                <input class ="form-control" type="text" name="phone" id="phone" placeholder ="Enter your phone number"  maxlength ="40" value="<?=$userArray[0]['phone_number']?>" /><br>

                <p>Email:</p>
                <input class ="form-control" type="text" name="email" id="email" placeholder =" "  maxlength ="40" value="<?=$userArray[0]['email']?>" /><br>
                <span id="email_result"></span>

                  <p>Password:</p>
                <button id="changePW" class="btn btn-dark text-info" type="button">Change  PW</button>
                <div id="checkOldPW" class="hiddenPW1">
                    <input  type = "password" id="oldPassword"  name = "oldPassword"   class = "form-control mt-2" data-oldpass="<?=$userArray[0]['password']?>"  placeholder = "Enter current Password"   maxlength = "15"  />
                    <button id="checkPWbtn" class="btn btn-dark text-warning mt-2" type="button">Check PW</button>
                    <span id="pw_msg" class = "text-danger"></span>

                </div>
                <div id="newPW" class="hiddenPW2">
                    <p class="mt-3">New Password:</p>
                    <input   type = "password" id="password"  name = "password"   class = "form-control m-1"   placeholder = "Enter Password"   maxlength = "15"  />
                    <span   class = "text-danger" > <?php   echo  $passwordError; ?> </span >

                    <p class="mt-3"> Repeat new Password:</p>
                    <input   type = "password"   id="passVerif" name= "passVerif"   class = "form-control m-1"   placeholder = "Verify your Password"   maxlength = "15"  />
                    <span id="pw_result"></span>
                    <span   class = "text-danger" > <?php echo  $passwordError; ?> </span >
                </div>

                <p>Avatar:</p>
                <button id="changeIMG" class="btn btn-dark text-info mb-3" type="button">Change avatar</button>
                <input class ="ml-2 form-contro hiddenForm" type="file" name="user_img" id="user_img" placeholder ="Upload here a your picture:" value="" maxlength ="500"  /><br>
                <hr  />
                <div class="d-flex justify-content-center">
                    <button   type = "submit"   class = "btn  btn-warning text-dark"   name = "updatebtn" >Update Profile</button >
                </div>
                <hr  />
             </form>
        </div>






    </div>

    <?php
    include '../components/footer.php';
    ?>
    </body>
    </html>
<?php  ob_end_flush(); ?>
