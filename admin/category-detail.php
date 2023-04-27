<?php
require "./session.php";
require "../connection.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM category WHERE id='$id'");
$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Detail Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "./navbar.php" ?>

    <div class="container" style="margin-top: 10vh;">
        <div class="col-12 col-md-6">
            <h2 class="mb-3">Category Detail</h2>
            <?php
            if (isset($_POST['btn-delete-category'])) {
                $queryCheck = mysqli_query($con, "SELECT * FROM product WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);

                if ($dataCount > 0) {
            ?>
                    <div class="alert alert-warning mb-3 text-center" role="alert">
                        Category tidak dapat dihapus karena sudah digunakan pada product
                    </div>
                <?php
                }

                $queryDelete = mysqli_query($con, "DELETE FROM category WHERE id='$id'");
                if ($queryDelete) {
                ?>
                    <div class="alert alert-danger mb-3 text-center" role="alert">
                        Category berhasil dihapus
                    </div>
                    <meta http-equiv="refresh" content="2; url=./category.php" />
            <?php
                }
            }
            ?>
            <?php
            if (isset($_POST['btn-edit-category'])) {
                $category = htmlspecialchars($_POST['category']);

                if ($data['nama'] === $category) {
            ?>
                    <meta http-equiv="refresh" content="0; url=./category.php" />
                    <?php
                } else {
                    $query = mysqli_query($con, "SELECT * FROM category WHERE nama='$category'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mb-3" role="alert">
                            Category sudah ada
                        </div>
                        <?php
                    } else {
                        $querySave = mysqli_query($con, "UPDATE category SET nama='$category' WHERE id='$id'");

                        if ($querySave) {
                        ?>
                            <div class="alert alert-success mb-3" role="alert">
                                Category berhasil diupdate
                            </div>
                            <meta http-equiv="refresh" content="2; url=./category.php" />
            <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
            }
            ?>
        </div>
        <div class="col-12 col-md-6">
            <form action="" method="POST">
                <div>
                    <label for="category" class="mb-2 fs-5">Category</label>
                    <input class="form-control" type="text" name="category" id="category" value="<?php echo $data['nama']; ?>" required>
                </div>

                <div class="mt-3 d-flex">
                    <a href="./category.php" class="btn btn-light border border-dark bg-body-secondary">Cancel</a>
                    <div class="ms-auto">
                        <button type="submit" class="btn btn-primary" name="btn-edit-category">Edit</button>
                        <button type="submit" class="btn btn-danger" name="btn-delete-category" onclick="return confirm('Anda Yakin Menghapus Category ini')">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>