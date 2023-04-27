<?php
require "./session.php";
require "../connection.php";

$queryCategory = mysqli_query($con, "SELECT * FROM category");
$countCategory = mysqli_num_rows($queryCategory);

// pagination
$jumlahDataPerHalaman = 10;
$jumlahHalaman = ceil($countCategory / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$queryCategoryNew = mysqli_query($con, "SELECT * FROM category LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <?php require "./navbar.php"; ?>
    <div class="container" style="margin-top: 10vh;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../admin/" class="text-decoration-none text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Category
                </li>
            </ol>
        </nav>



        <div class="mt-3">
            <h2>Category List</h2>
            <a href="./add-category.php" class="btn btn-primary mt-3 mb-2">Add Category</a>
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead class="table-secondary">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($countCategory < 1) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data category tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $number = 1;
                            foreach ($queryCategoryNew as $dataCatagory) {
                            ?>
                                <tr>
                                    <td>
                                        <?php if (isset($_GET['page'])) { ?>
                                            <?php if ($_GET['page'] >= 2) : ?>
                                                <?php echo (($_GET['page'] - 1) * 10) + $number; ?>
                                            <?php else : ?>
                                                <?php echo $number; ?>
                                            <?php endif; ?>
                                        <?php } else { ?>
                                            <?php echo $number; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $dataCatagory['nama']; ?></td>
                                    <td>
                                        <a href="./category-detail.php?id=<?php echo $dataCatagory['id']; ?>" class="btn btn-info px-2"><i class="fa-solid fa-circle-info fa-xl"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $number++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination Section Start -->
    <div class="text-center mb-4" <?php if ($countCategory < 1) : ?>Hidden<?php endif; ?>>
        <?php if ($halamanAktif > 1) : ?>
            <a href="./category.php?page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a href="./category.php?page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
            <?php else : ?>
                <a href="./category.php?page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="./category.php?page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
        <?php endif; ?>
    </div>
    <!-- Pagination Section End -->

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>