<?php 
$localhost ="localhost";
$user ="root";
$pass="";
$db_name="library_crud_login";

try {
    $conn = mysqli_connect($localhost,$user,$pass,$db_name);
    // echo "connected";
} catch (Exception $e) {
echo "failed to connect:" .mysqli_connect_error();
}

function var_dump_pretty($var) {
    echo "<pre>";
    var_dump($var);
    echo "<pre>";
}


?>