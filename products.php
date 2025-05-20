<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Productphp</title>
    <link rel="stylesheet" type="text/css" href="products.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">☕ Coffee Shop</div>
        <div class="menu_wrapper">
            <button onclick="window.location.href='index.php'" class="sidebar-button"><i class="fa-regular fa-clipboard"></i> Menu</button>
            <button onclick="window.location.href='products.php'" class="sidebar-button"><i class="fa-solid fa-plus"></i> Add Product</button>
            <button onclick="confirmLogout()" class="sidebar-button exit-button"><i class="fa-solid fa-xmark"></i> Exit</button>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Product List</h1>            
            <div class="input">
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="coffee_image" required>            
                    <input type="text" name="coffee_name" placeholder="Coffee name" required>
                    <input type="text" name="coffee_description" placeholder="Description" required>
                    <input type="number" name="Quantity" placeholder="Quantity" required>
                    <input type="number" name="Price" placeholder="Price" required>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
        <hr>
        
        <div class="table-container">
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
                        <td><img src="./images/<?php echo htmlspecialchars($coffee_image); ?>" alt="<?php echo htmlspecialchars($coffee_name); ?>" width="100" height="75"></td>
                        <td><?php echo htmlspecialchars($coffee_name); ?></td>
                        <td><?php echo htmlspecialchars($coffee_description); ?></td>
                        <td><?php echo $Quantity; ?></td>
                        <td><?php echo $Price; ?></td>  
                        <td>
                            <a href="edit.php?ID=<?php echo $row['ID']; ?>">EDIT</a> | 
                            <a href="delete.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">DELETE</a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, log me out!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                }
            });
        }
    </script>
</body>
</html>
