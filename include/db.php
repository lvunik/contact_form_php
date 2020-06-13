<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "contact_form";

    $conn = mysqli_connect($host,$user,$password,$dbname);

    if(!$conn){
        die("Connection Error " . mysqli_connect_error());
    }
?>