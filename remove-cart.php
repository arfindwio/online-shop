<?php
session_start();

if (isset($_GET['nama'])) {
    $productName = $_GET['nama'];

    if (isset($_SESSION['cart'])) {
        // Search for the item in the cart and remove it
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['nama'] == $productName) {
                unset($_SESSION['cart'][$key]);
                break; // Exit the loop once the item is removed
            }
        }
    }
}

// Redirect back to the shopping cart page
header("Location: shopping-cart.php");
exit();
