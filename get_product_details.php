<?php
require "./connection.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $queryProduct = mysqli_query($con, "SELECT * FROM product WHERE id = '$productId'");
    $productDetails = mysqli_fetch_assoc($queryProduct);

    if ($productDetails) {
        // Return the product details as JSON
        header('Content-Type: application/json');
        echo json_encode($productDetails);
    } else {
        // Return an error message
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Product not found'));
    }
} else {
    // Return an error message
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Product ID parameter missing'));
}
?>
