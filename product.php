<?php
require "./connection.php";

$queryCategory = mysqli_query($con, "SELECT * FROM category");

$data = mysqli_query($con, "SELECT * FROM product");
$countData = mysqli_num_rows($data);

// pagination
$jumlahDataPerHalaman = 9;
$jumlahHalaman = ceil($countData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

if (isset($_GET['keyword'])) {
    $queryProduct = mysqli_query($con, "SELECT * FROM product WHERE nama LIKE '%$_GET[keyword]%'");
    $queryProductNew = mysqli_query($con, "SELECT * FROM product WHERE nama LIKE '%$_GET[keyword]%' LIMIT $awalData, $jumlahDataPerHalaman");
} else if (isset($_GET['category'])) {
    $queryGetCategoryById = mysqli_query($con, "SELECT id FROM category WHERE nama='$_GET[category]' LIMIT $awalData, $jumlahDataPerHalaman");
    $dataCategoryId = mysqli_fetch_array($queryGetCategoryById);
    $queryProduct = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$dataCategoryId[id]'");
    $queryProductNew = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$dataCategoryId[id]' LIMIT $awalData, $jumlahDataPerHalaman");
} else if (isset($_GET['sort'])) {
    if ($_GET['sort'] === "Cheapest") {
        $queryProduct = mysqli_query($con, "SELECT * FROM product ORDER BY harga ASC");
        $queryProductNew = mysqli_query($con, "SELECT * FROM product ORDER BY harga ASC LIMIT $awalData, $jumlahDataPerHalaman");
    } else if ($_GET['sort'] === "Expensive") {
        $queryProduct = mysqli_query($con, "SELECT * FROM product ORDER BY harga DESC");
        $queryProductNew = mysqli_query($con, "SELECT * FROM product ORDER BY harga DESC LIMIT $awalData, $jumlahDataPerHalaman");
    }
} else {
    $queryProduct = mysqli_query($con, "SELECT * FROM product");
    $queryProductNew = mysqli_query($con, "SELECT * FROM product LIMIT $awalData, $jumlahDataPerHalaman");
}

$countDataNew = mysqli_num_rows($queryProduct);
$jumlahHalamanNew = ceil($countDataNew / $jumlahDataPerHalaman);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require "./navbar.php"; ?>

    <!-- Banner Product Section Start -->
    <div class="container-fluid d-flex align-items-center" style="height: 40vh; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('./image/banner-product.jpg'); background-size: cover; background-position: center; margin-top: 70px;">
        <div class="container text-white text-center">
            <h1>Product</h1>
        </div>
    </div>
    <!-- Banner Product Section End -->

    <!-- Body Section Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4 mt-lg-4">
                <div class="card card-body shadow">
                    <h3 class="mb-3 fw-bold">Category</h3>
                    <div style="height: 26vh; overflow: auto;">
                        <div class="list-group">
                            <?php foreach ($queryCategory as $dataCategory) { ?>
                                <a href="./product.php?category=<?php echo $dataCategory['nama']; ?>" class="text-decoration-none list-group-item list-group-item-action border-0">
                                    <?php echo $dataCategory['nama']; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3 fw-bold">Product</h3>

                <div class="dropdown">
                    <div class="float-end d-flex align-items-center">
                        <p class="fw-bolder me-3 fs-5">Urutkan</p>
                        <?php if (isset($_GET['sort'])) { ?>
                            <button onclick="myFunction()" class="dropbtn shadow-lg mb-2 text-dark" style="padding: 5px 15px; border: 1px solid; border-radius: 5px; background-color: white;">
                                <?php echo $_GET['sort']; ?><i class="fa-solid fa-chevron-down ms-3"></i>
                            </button>
                        <?php } else { ?>
                            <button onclick="myFunction()" class="dropbtn shadow-lg mb-2" style="padding: 5px 15px; border: 1px solid rgba(0, 0, 0, 0.4); border-radius: 5px; background-color: white; opacity: 40%;">
                                Choose<i class="fa-solid fa-chevron-down ms-3"></i>
                            </button>
                        <?php } ?>
                    </div>
                    <div id="myDropdown" class="dropdown-content shadow-lg">
                        <a href="./product.php?sort=Cheapest">Cheapest</a>
                        <a href="./product.php?sort=Expensive">Expensive</a>
                    </div>
                </div>
                <div class="row float-end">
                    <?php
                    if ($countDataNew < 1) {
                    ?>
                        <h4 class="mt-5" style="margin-right: 10vh;">Product yang anda cari tidak ada</h4>
                    <?php
                    }
                    ?>
                    <?php foreach ($queryProduct as $dataProduct) { ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="./image/<?php echo $dataProduct['foto']; ?>" class="card-img-top" alt="Product Photo" style="height: 15rem; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $dataProduct['nama']; ?></h5>
                                    <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo $dataProduct['detail']; ?>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni reiciendis officiis quam quisquam quos dolore laborum, repellat aliquid velit debitis dolor, aspernatur temporibus voluptatum minus facere quas totam amet obcaecati!</p>
                                    <p class="card-text fs-4 fw-bolder">Rp. <?php echo $dataProduct['harga']; ?></p>
                                    <a href="./product-detail.php?nama=<?php echo $dataProduct['nama']; ?>" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Body Section ENd -->

    <!-- Pagination Section Start -->
    <div class="text-center mb-4" <?php if ($countDataNew < 1) : ?>Hidden<?php endif; ?>>
        <?php if (isset($_GET['keyword'])) { ?>
            <?php if ($halamanAktif > 1) : ?>
                <a href="./product.php?keyword=<?php echo $_GET['keyword']; ?>&page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalamanNew; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <a href="./product.php?keyword=<?php echo $_GET['keyword']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
                <?php else : ?>
                    <a href="./product.php?keyword=<?php echo $_GET['keyword']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalamanNew) : ?>
                <a href="./product.php?keyword=<?php echo $_GET['keyword']; ?>&page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
            <?php endif; ?>
        <?php } else if (isset($_GET['category'])) { ?>
            <?php if ($halamanAktif > 1) : ?>
                <a href="./product.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalamanNew; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <a href="./product.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
                <?php else : ?>
                    <a href="./product.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalamanNew) : ?>
                <a href="./product.php?category=<?php echo $_GET['category']; ?>&page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
            <?php endif; ?>
        <?php } else if (isset($_GET['sort'])) { ?>
            <?php if ($halamanAktif > 1) : ?>
                <a href="./product.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalamanNew; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <a href="./product.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
                <?php else : ?>
                    <a href="./product.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalamanNew) : ?>
                <a href="./product.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
            <?php endif; ?>
        <?php } else { ?>
            <?php if ($halamanAktif > 1) : ?>
                <a href="./product.php?page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalamanNew; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <a href="./product.php?page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
                <?php else : ?>
                    <a href="./product.php?page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalamanNew) : ?>
                <a href="./product.php?page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
            <?php endif; ?>
        <?php } ?>
    </div>
    <!-- Pagination Section End -->

    <!-- Footer Section Start -->
    <?php require "./footer.php"; ?>
    <!-- Footer Section End -->

    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>