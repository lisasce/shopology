<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );
function connect(){
    $DBHOST="localhost";
    $DBUSER = "root";
    $DBPASS= "";
    $DBNAME = "project";

    $conn = mysqli_connect($DBHOST,$DBUSER,$DBPASS,$DBNAME);
    if(!$conn) {
        echo "error";
    }
    return $conn;
}
?>
