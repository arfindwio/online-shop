<?php
require "./connection.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduct = mysqli_query($con, "SELECT * FROM product WHERE nama='$nama'");
$dataProduct = mysqli_fetch_array($queryProduct);

$queryProductTerkait = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$dataProduct[kategori_id]' AND id != '$dataProduct[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
</head>

<body>
    <!-- Navbar Section Start -->
    <?php require "./navbar.php"; ?>
    <!-- Navbar Section End -->

    <!-- Detail Product Section Start-->
    <div class="container-fluid pb-5" style="margin-top: 12vh;">
        <div class="container">
            <div class="row">
                <h2 class="fw-bold mb-4">Detail Product</h2>
                <div class="col-lg-5 mb-5">
                    <img src="./image/<?php echo $dataProduct['foto']; ?>" alt="image product" style="width: 60vh; height: 45vh; object-fit: cover;">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1 class="fw-semibold"><?php echo $dataProduct['nama']; ?></h1>
                    <p class="fs-3 fw-bolder">Rp. <?php echo $dataProduct['harga']; ?></p>
                    <p class="fs-5"><?php echo htmlspecialchars_decode($dataProduct['detail']); ?></p>
                    <p class="fs-5">Stock Availability : <span class="fw-bolder"><?php echo $dataProduct['ketersediaan_stok']; ?></span></p>
                </div>
            </div>
        </div>

    </div>
    <!-- Detail Product Section End -->

    <!-- Product Terkait Section Start-->
    <div class="container-fluid py-5 bg-dark-subtle">
        <div class="container">
            <h2 class="text-center text-dark mb-5">Product Terkait</h2>

            <div class="row d-flex justify-content-center">
                <?php while ($data = mysqli_fetch_array($queryProductTerkait)) { ?>
                    <div class="col-md-4 col-lg-2 mb-3">
                        <a href="./product-detail.php?nama=<?php echo $data['nama']; ?>">
                            <img src="./image/<?php echo $data['foto']; ?>" alt="Foto Product Terkait" class="rounded-2" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Product Terkait Section End -->



    <!-- Footer Section Start -->
    <?php require "./footer.php"; ?>
    <!-- Footer Section End -->

    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>