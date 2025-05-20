<?php
session_start();

// Clear the cart from session
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Your order has been successfully cancelled.";
} else {
    $_SESSION['error'] = "No active order to cancel.";
}

// Redirect back to view order page
header("Location: view_order.php");
exit();
?>