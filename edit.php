<?php
include "connection.php";

// Fetch the product data based on the ID
if(isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql = "SELECT * FROM coffee_menu WHERE ID = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
}

// Handle form submission for updates
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $coffee_name = $_POST['coffee_name'];
    $coffee_description = $_POST['coffee_description'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];
    
    // Handle file upload if a new image is provided
    if(!empty($_FILES['coffee_image']['name'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["coffee_image"]["name"]);
        move_uploaded_file($_FILES["coffee_image"]["tmp_name"], $target_file);
        $coffee_image = basename($_FILES["coffee_image"]["name"]);
    } else {
        $coffee_image = $row['coffee_image'];
    }
    
    $sql = "UPDATE coffee_menu SET 
            coffee_image = '$coffee_image',
            coffee_name = '$coffee_name',
            coffee_description = '$coffee_description',
            Quantity = '$quantity',
            Price = '$price'
            WHERE ID = $id";
    
    if($connection->query($sql) === TRUE) {
        header("Location: products.php");
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>
<body>
    <div class="maincontainer">
        <div class="header">
            <h1>Edit Product</h1>
        </div>
        
        <div class="input">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                
                <label>Current Image:</label><br>
                <img src="./images/<?php echo htmlspecialchars($row['coffee_image']); ?>" width="100" height="75"><br>
                <input type="file" name="coffee_image">
                
                <label>Coffee Name:</label>
                <input type="text" name="coffee_name" value="<?php echo htmlspecialchars($row['coffee_name']); ?>" placeholder="Enter coffee name" required>
                
                <label>Description:</label>
                <input type="text" name="coffee_description" value="<?php echo htmlspecialchars($row['coffee_description']); ?>" placeholder="Enter description" required>
                
                <label>Quantity:</label>
                <input type="number" name="Quantity" value="<?php echo $row['Quantity']; ?>" placeholder="Enter quantity" min="0" required>
                
                <label>Price:</label>
                <input type="number" name="Price" value="<?php echo $row['Price']; ?>" placeholder="Enter price" min="0" step="0.01" required>
                
                <input type="submit" name="update" value="Update">
                <a href="products.php">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>