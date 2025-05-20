<?php
    include "connection.php";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Productphp</title>
    <link rel="stylesheet" type="text/css" href="products.css">
</head>
<body>
    <div class="container">
        <?php
        include "sidebar.php";
    ?>
 
    <div class="maincontainer">
        <div class="header">
            <h1>Product List</h1>            
                <div class="input">
                    <form action="add.php" method="post">
                        <input type="file" name="coffee_image" required>            
                        <input type="text" name="coffee_name" placeholder="Coffe name" required>
                        <input type="text" name="coffee_description" placeholder="Description" required>
                        <input type="number" name="Quantity" placeholder="Quantity" required>
                        <input type="number" name="Price" placeholder="Price" required>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
        </div>
        <hr>

        <div class="tablecontent">
            
                <table>
                    <thead>
                        <tr>            
                            <th>ID</th>
                            <th>Image</th>
                            <th>ProductName</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>                        
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
                    require_once "connection.php";
                        $sql_query = "SELECT * FROM coffee_menu";
                        if ($result = $connection->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $ID = $row['ID'];
                                $coffee_image = $row['coffee_image'];
                                $coffee_name = $row['coffee_name'];
                                $coffee_description = $row['coffee_description'];
                                $Quantity = $row['Quantity'];
                                $Price = $row['Price'];
            ?>
                <tr>
                    <td><?php echo $ID; ?></td>
                        <td>
                        <img src="./images/<?php echo htmlspecialchars($coffee_image); ?>" alt="<?php echo htmlspecialchars($coffee_name); ?>" width="100" height="75">
                        </td>
                            <td><?php echo htmlspecialchars($coffee_name); ?></td>
                            <td><?php echo htmlspecialchars($coffee_description); ?></td>
                            <td><?php echo $Quantity; ?></td>
                            <td><?php echo $Price; ?></td>  
                            <td>
                                <a href="edit.php?ID=<?php echo $row['ID']; ?>">EDIT</a> | 
                                <a href="delete.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">DELETE</a>
                </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
</body>
</html>