<?php
require "./connection.php";
$queryProduct = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM product LIMIT 6")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require "./navbar.php"; ?>

    <!-- banner Section Start -->
    <div class="container-fluid d-flex align-items-center" style="height: 80vh; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('./image/banner.svg'); background-size: cover; margin-top: 50px;">
        <div class="container text-white text-center">
            <h1>Online Clothing Store</h1>
            <div class="col-md-8 offset-md-2">
                <form action="product.php" method="GET">
                    <div class="input-group input-group-banner my-4">
                        <input type="text" class="form-control" placeholder="Search Product" aria-label="Search Product" aria-describedby="basic-addon2" name="keyword" autocomplete="off">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Higlight Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3 class="fw-bold">Category Recommendations</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <a class="text-decoration-none" href="./product.php?category=shirt">
                        <div class="d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('./image/Category-Shirt.svg'); background-size: cover; background-position: center;">
                            <h4 class="text-white">Shirt</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a class="text-decoration-none" href="./product.php?category=hat">
                        <div class="d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('./image/Category-Hat.svg'); background-size: cover; background-position: center;">
                            <h4 class="text-white">Hat</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a class="text-decoration-none" href="./product.php?category=shoes">
                        <div class="d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('./image/Category-shoes.svg'); background-size: cover; background-position: center;">
                            <h4 class="text-white">Shoes</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Abous Us -->
    <div class="container-fluid py-5" style="background-color: #494848;">
        <div class="container text-center">
            <h3 class="text-light fw-bold">About Us</h3>
            <p class="text-about-us text-white-50 mt-3">We are a customer-centric online clothing store offering a diverse range of high-quality clothing for men and women. Our user-friendly platform ensures convenient shopping anytime, anywhere. Express yourself and boost your self-esteem with our trendy casual styles and elegant formal wear from renowned brands and talented designers</p>

        </div>
    </div>

    <!-- Product -->
    <div class="container-fluid py-5">
        <div class="container">
            <h3 class="text-center fw-bold">Product</h3>

            <div class="row mt-5">
                <?php foreach ($queryProduct as $dataProduct) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card shadow">
                            <img src="./image/<?php echo $dataProduct['foto'] ?>" class="card-img-top card-img-product" alt="Product Photo" style="height: 15rem; object-fit: cover;">
                            <div class="card-body">
                                <h4 class="card-title fw-semibold"><?php echo $dataProduct['nama'] ?></h4>
                                <div class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;margin-top: -15px; opacity: 70%;">
                                    <p><?php echo htmlspecialchars_decode($dataProduct['detail']); ?></p>
                                </div>
                                <p class="card-text fs-4 fw-bolder text-center">Rp. <?php echo $dataProduct['harga'] ?></p>
                                <a href="./product-detail.php?nama=<?php echo $dataProduct['nama'] ?>" class="btn btn-primary d-flex justify-content-center"">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class=" d-flex justify-content-center">
                                    <a href="./product.php" class="btn btn-outline-primary mt-3 text-center">See More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Section Start -->
                    <?php require "./footer.php"; ?>
                    <!-- Footer Section End -->

                    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
                    <script src="./fontawesome/js/all.min.js"></script>
                    <script src="./js/script.js"></script>
</body>

</html>