<?php
session_start();

// Retrieve cart from session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate total cost
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Initialize message variables
$message = '';
$error = '';

// Check if messages exist in session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link rel="stylesheet" href="view_order.css"> 
</head>
<body>

<h1>Order Summary</h1>

<?php if (!empty($message)): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (empty($cart)): ?>
    <p>Your order is empty.</p>
<?php else: ?>
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

    <h3 class="total">Total: ₱<?= number_format($total, 2) ?></h3>
    
    <div class="button-container">
        <form action="cancel_order.php" method="post">
            <button type="submit" class="cancel-btn">Cancel Order</button>
        </form>
        <form action="process_payment.php" method="post">
    <button type="submit" class="pay-btn">Confirm Payment</button>
</form>

    </div>
<?php endif; ?>

<a href="index.php" class="back-link">Back to Menu</a>

</body>
</html>
