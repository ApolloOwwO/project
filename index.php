<?php
    include "connection.php";

    // Handle adding to order
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_order'])) {
        session_start();
        
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Add item to cart
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product_name,
                'price' => $product_price,
                'quantity' => 1
            ];
        }
        
        // Redirect back to prevent form resubmission
        header("Location: index.php");
        exit();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment in WebApp</title>
    <link rel="stylesheet" href="style.css">   
</head>
<body>
    <div class="maincontainer">
        <div class="hd">               
            <h1>Coffee</h1>                
            <div class="search">
                <form method="GET">
                    <input type="text" name="search" placeholder="Search by name..." style="padding: 5px">
                    <button type="submit" style="padding: 5px; background-color: #28a745; color: white; border-radius: 5px;">Search</button>
                </form>
            </div>
        </div>
        
        <div class="container">
        <?php
            $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : "";

            $sql = "SELECT * FROM coffee_menu WHERE coffee_name LIKE '%$search%'";
            $result = mysqli_query($connection, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($coffee_name = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='card'>
                        <img src='./images/{$coffee_name['coffee_image']}' alt='{$coffee_name['coffee_image']}' width='200px' height='150px'>
                        <h1>{$coffee_name['coffee_name']}</h1>
                        <br>
                        <p><b>Description:</b> {$coffee_name['coffee_description']}</p>
                        <p class='price'><b>Price:</b> ₱" . number_format($coffee_name['Price'], 2) . "</p>
                        <form method='post' action='index.php'>
                            <input type='hidden' name='product_id' value='{$coffee_name['ID']}'>
                            <input type='hidden' name='product_name' value='{$coffee_name['coffee_name']}'>
                            <input type='hidden' name='product_price' value='{$coffee_name['Price']}'>
                            <button type='submit' name='add_to_order' class='add-to-order'>Add to Order</button>
                        </form>
                    </div>
                    ";
                }
            } else {
                echo "<h3>No results found.</h3>";
            }
            ?>
        </div>
        
        <!-- View My Order Button -->
        <a href="view_order.php" class="view-order-btn">View My Order</a>
    </div>
</body>
</html>