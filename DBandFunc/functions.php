<?php
function clearString($param){
    $val = trim($param);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}
// sanitize user input to prevent sql injection
function getUserIDfromSession(){
    if (isset($_SESSION['user'])){
       return $_SESSION['user'];
    }
    elseif (isset($_SESSION['admin'])){
        return $_SESSION['admin'];
    }
    else{
        return $_SESSION['superAdmin'];
    }
}


?>
