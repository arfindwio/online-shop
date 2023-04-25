<?php
require "./session.php";
require "../connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "./navbar.php"; ?>
    <div class="container" style="margin-top: 10vh;">
        <div class="my-5 col-12 col-md-6">
            <h3 class="mb-3">Add Category</h3>
            <?php
            if (isset($_POST['btn-category'])) {
                $category = htmlspecialchars($_POST['category']);
                $queryExist = mysqli_query($con, "SELECT nama FROM category WHERE nama='$category'");
                $jumlahNewCategoryData = mysqli_num_rows($queryExist);

                if ($jumlahNewCategoryData > 0) {
            ?>
                    <div class="alert alert-warning mb-3" role="alert">
                        Category sudah ada
                    </div>
                    <?php
                } else {
                    $querySave = mysqli_query($con, "INSERT INTO category (nama) VALUES ('$category')");

                    if ($querySave) {
                    ?>
                        <div class="alert alert-success mb-3" role="alert">
                            Category berhasil disimpan
                        </div>
                        <meta http-equiv="refresh" content="2; url=./category.php?page=1" />
            <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <div>
                    <label for="category" class="mb-2">Category</label>
                    <input type="text" id="category" name="category" placeholder="Masukan Nama Category" class="form-control" autocomplete="off">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="btn-category">Save</button>
                </div>
            </form>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>