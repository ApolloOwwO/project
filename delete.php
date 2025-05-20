<?php
        require_once "connection.php";
        $ID = $_GET['ID'];
        $sql = "DELETE FROM coffee_menu WHERE ID = '$ID'";
        if(mysqli_query($connection,$sql)){
                header("location: products.php");
        }
        else{
                echo"Something went wrong";
        }
?>