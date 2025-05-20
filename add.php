<?php 
    include('connection.php');

    if (isset($_POST['submit'])){
        $coffee_image = $_POST['coffee_image'];
        $coffee_name = $_POST['coffee_name'];
        $coffee_description = $_POST['coffee_description'];
        $Quantity = $_POST['Quantity'];
        $Price = $_POST['Price'];

        if($coffee_image == "" || $coffee_name =="" || $coffee_description =="" || $Quantity =="" || $Price =="")
        {
            header( 'location:products.php?message=Required Missing Fields');
        }else{
            $query = mysqli_query($connection, "INSERT INTO coffee_menu(coffee_image, coffee_name, coffee_description, Quantity, Price)VALUES ('$coffee_image', '$coffee_name', '$coffee_description', '$Quantity', '$Price')");
            header('location:products.php?insert_msg=Item Has Been Added!');
        }
    }
?>
