<?php
session_start();
include "connection.php";

// Check if cart exists and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = "Your cart is empty. Cannot process payment.";
    header("Location: view_order.php");
    exit();
}

// Retrieve cart
$cart = $_SESSION['cart'];

// Calculate total cost
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Generate random 4-digit order number
$orderNumber = rand(1000, 9999);

include "addorder.php";
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="payment.css">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
</head>
<body>

    <div class="receipt-container">
        <h1>Payment Receipt</h1>
        <h3>Order Number: <?= htmlspecialchars($orderNumber) ?></h3>
        <p class="success-msg">Order Complete! Please Proceed to the Cashier.</p>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (each)</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>₱<?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Total Paid: ₱<?= number_format($total, 2) ?></div>

        <a href="index.php" class="back-link">Back to Menu</a>
    </div>

</body>
</html>
