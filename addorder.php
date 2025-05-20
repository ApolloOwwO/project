<?php
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = 'Cart is empty. Cannot process payment.';
    header("Location: process_payment.php");
    exit();
}

$cart = $_SESSION['cart'];
$date = date('Y-m-d H:i:s'); // Current date and time

foreach ($cart as $item) {
    $product_name = mysqli_real_escape_string($connection, $item['name']);
    $price = (float) $item['price'];
    $quantity = (int) $item['quantity'];
    $subtotal = $price * $quantity;

    $query = "INSERT INTO orderhistory (product_name, price, quantity, subtotal, order_date)
              VALUES ('$product_name', $price, $quantity, $subtotal, '$date')";
    mysqli_query($connection, $query);
}

// Clear the cart
unset($_SESSION['cart']);
$_SESSION['message'] = 'Payment confirmed and order has been placed.';

?>