<?php
require "./connection.php"; // Pastikan koneksi ke database telah di-include

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-pay'])) {
    // Get customer data from the form and use htmlspecialchars
    $namaPelanggan = htmlspecialchars($_POST['namaPelanggan']);
    $teleponPelanggan = htmlspecialchars($_POST['teleponPelanggan']);
    $alamatPelanggan = htmlspecialchars($_POST['alamatPelanggan']);
    $totalAmount = $_POST['totalAmountInput']; // This should be sanitized based on your use case
    $itemNames = htmlspecialchars($_POST['itemNamesInput']);
    $itemQuantities = htmlspecialchars($_POST['itemQuantitiesInput']);

    // Handle the uploaded proof of payment file
    $allowedExtensions = array("jpg", "jpeg", "jfif", "png");
    $buktiPelanggan = $_FILES['buktiPelanggan']['name'];
    $buktiPelangganTmp = $_FILES['buktiPelanggan']['tmp_name'];
    $buktiPelangganExtension = strtolower(pathinfo($buktiPelanggan, PATHINFO_EXTENSION));
    $buktiPelangganPath = "./uploads/" . $namaPelanggan . "_" . basename($buktiPelanggan); // Menggunakan nama pelanggan sebagai bagian dari nama file
    $buktiPelangganImg = $namaPelanggan . "_" . basename($buktiPelanggan);

    // Check if the uploaded file has a valid extension
    if (in_array($buktiPelangganExtension, $allowedExtensions)) {
        // Move the uploaded file to the uploads folder
        if (move_uploaded_file($buktiPelangganTmp, $buktiPelangganPath)) {
            // Insert customer data into the database
            $insertCustomerQuery = "INSERT INTO customer (namaPelanggan, teleponPelanggan, alamatPelanggan, buktiPelanggan, totalHarga, namaBarang, jumlahBarang) 
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
        echo "Invalid file format. Only JPG, JPEG, JFIF, and PNG files are allowed.";
    }
} else {
    echo "Invalid request";
}
