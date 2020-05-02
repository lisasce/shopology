<?php
ob_start();
session_start();
require_once 'DBandFunc/DBaccessUser.php';
require_once 'DBandFunc/functions.php';
$conn = connect();

if ( isset($_SESSION['user' ])!="") {
    header("Location: homes/userHome.php");
    exit;
}
if(isset($_SESSION['admin']) != ''){
    header('Location: homes/userHome.php');
    exit;
}
if(isset($_SESSION['superAdmin']) != ''){
    header('Location: homes/superHome.php');
    exit;
}
$error = false;

if( isset($_POST['btn-login']) ) {
    $email = clearString($_POST["email"]);
    $pass = clearString($_POST["pass"]);

    if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)){
        $error = true;
        $passError = "Please enter your password." ;
    }

    if (!$error) {

        $pass = hash( 'sha256', $pass); // password hashing
        $resArray = getUserByEmail($email);
        $row = $resArray[0];
        $count = $resArray[1]; // if name/pass is correct it returns must be 1 row

        if( $count == 1 && $row['password' ]==$pass ) {
            if ($row['active'] == 'banned'){
                $errMSG = "Seems you have been banned, contact superadmin if you are unhappy." ;
            }elseif($row['role'] == 'user'){
                $_SESSION['user'] = $row['user_id'];
                header( "Location: homes/userHome.php");
            }elseif ($row['role'] == 'admin') {
                $_SESSION['admin'] = $row['user_id'];
                header("Location: homes/userHome.php");
            }else {
                $_SESSION['superAdmin'] = $row['user_id'];
                header("Location: homes/superHome.php");
            }
            //echo $row['user_id'];
        } else {
            $errMSG = "Incorrect Credentials, Try again..." ;
        }

    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Shopology!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Icon library -->
    <script src="https://kit.fontawesome.com/d94fa60402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div id="contentIndex">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-sm-5 mb-5">
        <img src="img/bag3.png" alt="logo" width="50" class="m-3">
        <a class="pacifico navbar-brand text-warning " href="index.php">Welcome to Shopology!</a>        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
            <div id="indexBox" class="col-md-3  col-6 text-right mx-auto" style="min-height: 55%">

                <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                    <h2 class="pacifico text-warning text-center" >Sign In.</h2 >
                    <hr />
                        <?php
                        if ( isset($errMSG) ) {
                            echo  '<span class="text-danger">' . $errMSG .'</span>';
                        ?>
                        <?php } ?>
                    <input  type="email" id="loginEmail" name="email"  class="form-control m-1" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40" />
                    <span class="text-danger"><?php  echo $emailError; ?></span >
                    <input  type="password" id="loginPw" name="pass"  class="form-control m-1" placeholder ="Your Password" maxlength="25"  />
                    <span  class="text-danger"><?php  echo $passError; ?></span>
                    <hr />
                    <div class="d-flex justify-content-center">
                        <button class = "btn btn-lg btn-dark text-warning" type="submit" name= "btn-login">Sign In</button>
                    </div>
                        <hr />

                    <a  href="CRUDuser/register.php">Sign Up Here...</a>

                </form>
            </div>
</div>
<?php
include 'components/footer.php';
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script src="js/main.js"></script>-->

</body>
</html>
<?php  ob_end_flush(); ?>
