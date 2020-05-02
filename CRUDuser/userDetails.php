<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();
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
    <?php
    $userArray = (userDetail($userID));
    ?>

    <div id="userBox" class='container row thumbnail mx-auto'>
        <div class='col-12 row mx-auto mt-5 mb-2'>

            <div class='caption my-auto col-12 '>
                <h2 class="pacifico text-warning text-center">Welcome to your account details <?=$userArray[0]['first_name']?>!</h2>
                <hr>
                <div class='d-md-flex justify-content-around'>
                    <div id="avatarDetail" class="" >
                        <img class=''  src='<?=$userArray[0]['user_img']?>' alt="face" style='width:20%'>
                    </div>

                    <div>
                        <p>First Name:  <strong><?=$userArray[0]['first_name']?></strong> </p>
                        <p>Last Name:  <strong><?=$userArray[0]['last_name']?></strong> </p>
                        <p>E-mail:  <strong><?=$userArray[0]['email']?></strong> </p>
                        <p>Phone Number:  <strong><?=$userArray[0]['phone_number']?></strong> </p>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-around">
                    <div><a class="btn btn-dark text-warning" href="userUpdate.php">Edit Profile</a></div>
                    <div><button id="addAddBtn" class="btn btn-dark text-info" type="button">Add Address</button></div>
                    <div><button class="delBtn btn btn-dark text-danger" data-href="userDelete.php">Delete Profile</button></div>
                </div>

                <form id="hiddenForm" class='hiddenForm'>
                    <hr>
                   <p>Address:</p>
                    <input class='form-control hobby' type='text' name='address'  placeholder='Enter your address' value='' maxlength='150'  /><br>

                    <p>Zip Code:</p>
                    <input class='form-control hobby' type='text' name='zip'  placeholder='Enter your zip code'  maxlength='50' value='' /><br>

                    <p>City:</p>
                    <input class='form-control hobby' type='text' name='city'  placeholder='Enter your city'  maxlength='50' value=''  /><br>

                    <p>Country:</p>
                    <input class='form-control hobby' type='text' name='country'  placeholder='Enter your country' value='' maxlength='50'  /><br>

                    <h5 class='pacifico text-warning'>If you want to see your address on a map enter coordinates here (optional)</h5>
                    <span class='pacifico '>To check coordinates click here: <a href='https://www.latlong.net/'>coordinates finder</a></span>
                    <hr>

                    <p>Coordinate Latitude:</p>
                    <input class='form-control hobby' type='text' name='coordx'  placeholder='Enter Latitude e.g. 48.208176'  maxlength='50' value='' /><br>

                    <p>Coordinate Longitude:</p>
                    <input class='form-control hobby' type='text' name='coordy' placeholder='Enter Longitude e.g. 16.373819'  maxlength='50' value='' /><br>
                    <button id="createAdBtn" class='updateSave btn btn-warning text-dark' type="button"'>Save Address</button>
                </form>
                <hr>
                <h2 class="pacifico text-warning ">My Addresses:</h2>
                <hr>
                <?php
                $counter = 1;
                foreach ($userArray as $userInfo){
                    echo "
                    <div class='d-md-flex justify-content-around'>
                        <div>
                            <p><u>My Address ".$counter++.":</u></p>
                              <strong><p>".$userInfo['street'].",<br> ".$userInfo['zip'].", ".$userInfo['city']."</p>
                            <p>".$userInfo['country']."</p></strong><br>
                            <a class='editBtnAddress btn btn-dark text-warning' >Edit</a>
                             <button class='delBtn btn btn-dark text-danger' data-href='addressDelete.php?id=".$userInfo['address_id']."'>Delete</button>
                        </div>
                        <br>
                        <div class='hiddenForm2'>
                             <p>Address:</p>
                            <input class='form-control hobby' type='text' name='address' id='address".$userInfo['address_id']."' placeholder='Enter your address' value='".$userInfo['street']."' maxlength='150'  /><br>
            
                            <p>Zip Code:</p>
                            <input class='form-control hobby' type='text' name='zip' id='zip".$userInfo['address_id']."' placeholder='Enter your zip code'  maxlength='50' value='".$userInfo['zip']."' /><br>
            
                            <p>City:</p>
                            <input class='form-control hobby' type='text' name='userCity' id='userCity".$userInfo['address_id']."' placeholder='Enter your city'  maxlength='50' value='".$userInfo['city']."'  /><br>
            
                            <p>Country:</p>
                            <input class='form-control hobby' type='text' name='county' id='country".$userInfo['address_id']."' placeholder='Enter your country' value='".$userInfo['country']."' maxlength='50'  /><br>
            
                            <h5 class='pacifico text-warning'>If you want to see your address on a map enter coordinates here (optional)</h5>
                            <span class='pacifico '>To check coordinates click here: <a href='https://www.latlong.net/'>coordinates finder</a></span>
                            <hr>
            
                            <p>Coordinate Latitude:</p>
                            <input class='form-control hobby' type='text' name='coordx' id='coordx".$userInfo['address_id']."' placeholder='Enter Latitude e.g. 48.208176'  maxlength='50' value='".$userInfo['coordx']."' /><br>
            
                            <p>Coordinate Longitude:</p>
                            <input class='form-control hobby' type='text' name='coordy' id='coordy".$userInfo['address_id']."' placeholder='Enter Longitude e.g. 16.373819'  maxlength='50' value='".$userInfo['coordy']."' /><br>
                            <button type='button' class='updateSave btn btn-warning text-dark' value='".$userInfo['address_id']."'>Save Address</button>
                        </div>
                    
                    </div>
                <br>
                <hr>
                <div  data-X='".$userInfo['coordx']."' data-Y='".$userInfo['coordy']."' class='w-80 map'></div>
                <br>
                ";
                }
                ?>


            </div>

        </div>
    </div>


</div>

<?php
include '../components/footer.php';
?>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap" async defer></script>
</body>
</html>
<?php ob_end_flush(); ?>
