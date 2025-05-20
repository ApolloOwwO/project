<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_order'])) {
    // Validate and sanitize input
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
    $product_price = filter_input(INPUT_POST, 'product_price', FILTER_VALIDATE_FLOAT);
    
    // Verify all required data is present
    if ($product_id && $product_name && $product_price) {
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Add item to cart or increment quantity if already exists
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product_name,
                'price' => $product_price,
                'quantity' => 1
            ];
        }
        
        // Set success message
        $_SESSION['message'] = "{$product_name} added to your order!";
    } else {
        // Set error message if validation fails
        $_SESSION['error'] = "Invalid product data. Please try again.";
    }
}

// Redirect back to products page
header("Location: index.php");
exit();
?>