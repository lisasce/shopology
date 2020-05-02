<?php
require_once 'functions.php';
require_once 'DBconnect.php';
//To get the name in the navbar

//---------------user queries--------------------
function getUserInfo($userID){
    $conn = connect();
    $res=mysqli_query($conn, "SELECT * FROM project.user WHERE user_id=".$userID);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $conn->close();
    return $userRow;
}

function getUserByEmail($userMail){
    $conn = connect();
    $res=mysqli_query($conn, "SELECT * FROM project.user WHERE email='$userMail'");
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res);
    $conn->close();
    return [$userRow, $count];
}

function selectUser(){
    $conn = connect();
    $sql = "SELECT  user_id, last_name FROM project.user";
    $users=mysqli_query($conn, $sql);
    $resultUsers = $users->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $resultUsers;
}

function updateUserStatus( $id,$active, $role){
    $conn = connect();
    $active = clearString($active);
    $role = clearString($role);

    $sql = "UPDATE project.user SET  `active` = '$active', `role` = '$role' WHERE user_id = $id  ";
    $resUser = mysqli_query($conn, $sql);
    $conn->close();
    return $resUser;
}

function userDetail($userID){
    $conn = connect();
    $sql = "SELECT  * FROM project.user
    LEFT JOIN address ON fk_user_id = user_id 
    where user_id= $userID";
    $user=mysqli_query($conn, $sql);
    $result = $user->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}

function deleteUser($userID){
    $conn = connect();
    $sql = "DELETE FROM project.user WHERE user_id = $userID";
    $res= mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}

function createUser($first_name,$last_name,$email, $password,$phone, $u_img, $address,$zip,$city,$country, $coordx, $coordy){
    $conn = connect();
    $first_name = clearString($first_name);
    $last_name = clearString($last_name);
    $email = clearString($email);
    $password = clearString($password);
    $phone = clearString($phone);
    $img = clearString($u_img['name']);
    $address = clearString($address);
    $zip = clearString($zip);
    $city = clearString($city);
    $country = clearString($country);
    $coordx = clearString($coordx);
    $coordy= clearString($coordy);

    $user_img = $img == ""  ?  "../img/face.jpg"  :  "../img/".basename($img);
// if img is empty then insert standard img else the path
    copy($_FILES['user_img']['tmp_name'], $user_img);

    $sqlSearch = "SELECT * FROM project.user WHERE email = '$email' ";
    $res = mysqli_query($conn, $sqlSearch);
    if($res->num_rows == 0){

        $sql1 = "INSERT INTO project.user(`first_name`, `last_name`, `email` , `password`, `phone_number`, `user_img`) VALUES ('$first_name', '$last_name','$email','$password','$phone','$user_img' )";
        $res1 = mysqli_query($conn, $sql1);
        $last_idUser =  mysqli_insert_id($conn);
    }else {
        $result = $res->fetch_assoc();
        $last_idUser = $result["user_id"];

    }

        $sql2 = "INSERT INTO project.address(`street`, `zip`,`city`,`country`,`coordx`,`coordy`,`fk_user_id`) VALUES ('$address', '$zip', '$city' , '$country', '$coordx', '$coordy','$last_idUser')";
        $res2 =mysqli_query($conn, $sql2);

        if($res == true && $res2 == true){
            $conn->close();
            return true;
        }else {
            $conn->close();
            return false;
        }
}
//,$u_img
function updateUser( $id,$first_name, $last_name,$email,$phone, $password, $u_img){
    $conn = connect();
    $first_name = clearString($first_name);
    $last_name = clearString($last_name);
    $email = clearString($email);
    $phone = clearString($phone);
    $password = clearString($password);
    $img = clearString($u_img['name']);
    $info= getUserInfo($id);
    $oldImage= $info['user_img'];

    $user_img = $img == ""  ?  $oldImage  :  "../img/".basename($img);
    if($img != "") {
        copy($_FILES['user_img']['tmp_name'], $user_img);
    }

    if($password == null){
        $sql = "UPDATE project.user SET  `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email' , `phone_number` = '$phone', `user_img` = '$user_img' WHERE user_id = $id  ";
    } else {
        $sql = "UPDATE project.user SET  `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email' ,  `phone_number` = '$phone' , `password` = '$password', `user_img` = '$user_img' WHERE user_id = $id  ";
    }



    $resUser = mysqli_query($conn, $sql);
    $conn->close();

    return $resUser;
}

//---------------address queries--------------------

function updateAddress($id,$address,$zip,$city,$country, $coordx, $coordy){
    $conn = connect();
    $address = clearString($address);
    $zip = clearString($zip);
    $city = clearString($city);
    $country = clearString($country);
    $coordx = clearString($coordx);
    $coordy = clearString($coordy);

    $sql = "UPDATE project.address SET `street` = '$address', `zip` = '$zip', `city` = '$city', `country` = '$country', `coordx`='$coordx', `coordy`='$coordy' WHERE address_id = $id  ";

    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}
function createAddress($userID, $address,$zip,$city,$country, $coordx, $coordy){
    $conn = connect();
    $address = clearString($address);
    $zip = clearString($zip);
    $city = clearString($city);
    $country = clearString($country);
    $coordx = clearString($coordx);
    $coordy = clearString($coordy);

    $sql = "INSERT INTO project.address ( `fk_user_id`,`street`, `zip` , `city`, `country`, `coordx`, `coordy`) VALUES('$userID', '$address','$zip','$city','$country', '$coordx', '$coordy')";

    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}

function deleteAddress($address_id,$userID){
    $conn = connect();
    $sql = "DELETE FROM project.address WHERE address_id = $address_id AND fk_user_id = $userID";
    $res = mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}


//---------------verifications queries--------------------

function passwordCheck(){
    $pass = $_POST["pass"];
    $passVerif= $_POST["passVerif"];

    if($pass == $passVerif){
        echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span> Passwords match</label>';
    }else {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Passwords not match</label>';
    }
}

function is_email_available($email,$userIDfromSession){
    $conn = connect();
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if($query->num_rows == 0) {
        return true;
    } else {
        $userInfo = mysqli_fetch_assoc($query);
        $userIDfromDB = $userInfo['user_id'];
        if ($userIDfromDB == $userIDfromSession){
            return true;
        }else{
        return false;
        }
    }
}

function check_email_availability($userIDfromSession){
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';
    } elseif(is_email_available($_POST["email"],$userIDfromSession)) {
        echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
    }else {
        echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already registered</label>';
    }
}



?>
