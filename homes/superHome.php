<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessUser.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['superAdmin'])) {
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



    <div id="userRoleContent" class="container d-flex justify-content-around row mt-sm-5 mx-auto mt-5">

        <?php
        if($_POST){
            $id =  $_POST["userSelect"];

            $role =  $_POST["role"];

            $active =  $_POST["active"];

            $result= updateUserStatus($id,$active, $role);

            if($result == TRUE){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <a class=' btn btn-light'   href='superHome.php'>back to homepage</a>
                          <span class='pl-3'><strong>Thank you for UPDATING!</strong></span>    
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <br> ";
            }else{
                echo "error";
            }
        }
        ?>
<div>
        <h2 class="pacifico text-warning">Here you can update the selected user's info:</h2>
        <hr/>
        <br></div>
        <form class="col-10 mx-auto" method="post"  action="superHome.php"  autocomplete="off" >

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">User:</label>
                </div>
                <select id="userSelect" name="userSelect" value="" class="custom-select" ><option name='type' value='' >Choose user:  </option>
                    <?php
                    $users = selectUser();
                    foreach ($users as $user){
                        echo "<option name='type' value='".$user['user_id']."'>".$user['last_name']." </option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="role">Role:</label>
                </div>
                <select name="role" value="" class="custom-select" id="role">
                    <option name="role" value="user" >user</option>
                    <option name="role" value="admin" >admin</option>
                    <option name="role" value="superAdmin" >superadmin</option>
                </select>
            </div>

            Account activated:
            <br>
            <input class ="" type="radio" name="active" id="activated" value="yes" />
            <label for="activated">yes</label>
            <input class ="" type="radio" name="active" id="disabled" value="no" />
            <label for="disabled">no</label>
            <input class ="" type="radio" name="active" id="disabled2" value="banned" />
            <label for="disabled">banned</label>
            <br>
            <hr />
            <div class="d-flex justify-content-center">
                <button   type = "submit"   class = "btn btn-warning"   name = "updatebtn" >Update user's info</button >
            </div>
            <hr />

        </form>

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
</body>
</html>
<?php ob_end_flush(); ?>
