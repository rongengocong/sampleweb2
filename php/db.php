<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "php";

    $con = mysqli_connect($server, $username, $password, $db);

    if(!$con){
        die("connection failed");
    }

?>