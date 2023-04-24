<?php
require "./session.php";
require "../connection.php";

$queryCategory = mysqli_query($con, "SELECT * FROM category");
$jumlahCategory = mysqli_num_rows($queryCategory);
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
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahCategory === 0) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data category tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $number = 1;
                            foreach ($queryCategory as $dataCatagory) {
                            ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $dataCatagory['nama']; ?></td>
                                    <td>
                                        <a href="./category-detail.php?id=<?php echo $dataCatagory['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
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

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>