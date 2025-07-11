<?php 
    include_once("./php/db.php");

    if(!isset($_GET['id'])){
        header("location: /php_prog/home.php");
    }

    $getID = !empty($_GET['id']) ? $_GET['id'] : '';

    $deleteData = mysqli_query($con, "DELETE FROM tbl_users WHERE id = $getID");

    if($deleteData){
        header("location: /php_prog/home.php");
        exit();
    }else{
        echo "Delete failed";
    }
?>