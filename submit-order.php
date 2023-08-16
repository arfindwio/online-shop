<?php
require "./connection.php"; // Make sure you have the database connection included

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-pay'])) {
    // Get customer data from the form
    $namaPelanggan = $_POST['namaPelanggan'];
    $teleponPelanggan = $_POST['teleponPelanggan'];
    $alamatPelanggan = $_POST['alamatPelanggan'];
    $totalAmount = $_POST['totalAmountInput'];
    $itemNames = $_POST['itemNamesInput'];
    $itemQuantities = $_POST['itemQuantitiesInput'];
    // Handle the uploaded proof of payment file
    $buktiPelanggan = $_FILES['buktiPelanggan']['name'];
    $buktiPelangganTmp = $_FILES['buktiPelanggan']['tmp_name'];
    $buktiPelangganPath = "./uploads/" . $namaPelanggan . "_" . basename($buktiPelanggan); // Using customer's name as part of the filename
    $buktiPelangganImg = $namaPelanggan . "_" . basename($buktiPelanggan);

    // Move the uploaded file to the uploads folder
    if (move_uploaded_file($buktiPelangganTmp, $buktiPelangganPath)) {
        // Insert customer data into the database
        $insertCustomerQuery = "INSERT INTO customer (namaPelanggan, teleponPelanggan, alamatPelanggan, buktiPelanggan, jumlahBarang, itemNames, itemQuantities) 
                                VALUES ('$namaPelanggan', '$teleponPelanggan', '$alamatPelanggan', '$buktiPelangganImg', '$totalAmount', '$itemNames', '$itemQuantities')";
        $insertCustomerResult = mysqli_query($con, $insertCustomerQuery);

        if ($insertCustomerResult) {
            // Get the last inserted order ID
            $orderID = mysqli_insert_id($con);

            // Redirect to home page after successful order placement
            header('Location: shopping-cart.php');
            exit();
        } else {
            echo "Error placing order: " . mysqli_error($con);
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request";
}
