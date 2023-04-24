<?php
require "./session.php";
require "../connection.php";

$queryCategory = mysqli_query($con, "SELECT * FROM category");
$jumlahCategory = mysqli_num_rows($queryCategory);

$queryProduct = mysqli_query($con, "SELECT * FROM product");
$jumlahProduct = mysqli_num_rows($queryProduct);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <?php require "./navbar.php"; ?>
    <div class="container" style="margin-top: 10vh;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i> Home
                </li>
            </ol>
        </nav>
        <h1>HALAMAN <?php echo $_SESSION['username']; ?></h1>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="pt-4 rounded-2" style="background-color: #0a6b4a;">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center ">
                                <i class="fas fa-align-justify fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Category</h3>
                                <p class="fs-4"><?php echo $jumlahCategory; ?> Category</p>
                                <p><a href="category.php" class="text-white text-decoration-none">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="pt-4 rounded-2" style="background-color: #0a516b;">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center ">
                                <i class="fas fa-box fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Product</h3>
                                <p class="fs-4"><?php echo $jumlahProduct; ?> Product</p>
                                <p><a href="category.php" class="text-white text-decoration-none">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>