<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>REGISTER</title>
</head>
<body>
    <div class="con">
        <h1>REGISTER</h1>
        <form action="" method="post">
            <input type="text" name="fname" placeholder="Full name">
            <input type="text" name="uname" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="cpass" placeholder="Re-enter Password">
            <input type="submit" name="regbtn" value="Submit">
        </form>
        <br>
        <p style="font-size: 10px;">Already have an account? <a href="login.php">Sign In</a></p>
    </div>
</body>
</html>

<?php
include "connection.php";
if(isset($_POST['regbtn'])){
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if($fname!="" && $uname!="" && $pass!="" && $cpass!="") {
        if($pass == $cpass){
            $sql = "INSERT INTO admins (`fname`, `uname`, `password`) VALUES ('$fname', '$uname', '$pass')";
            if(mysqli_query($connection, $sql)){
                echo "<script>
                        alert('Registered successfully. You may now log in to your account.');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
            }
        } else {
            echo "<script>alert('Your passwords should match');</script>";
        }
    } else {
        echo "<script>alert('Input fields should not be empty');</script>";
    }
}
?>