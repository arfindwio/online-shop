<?php
require "./session.php";
require "../connection.php";

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM product a JOIN category b ON a.kategori_id=b.id");
$queryCategory = mysqli_query($con, "SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "./navbar.php"; ?>
    <div class="container" style="margin-top: 10vh;">
        <div class="my-5 col-12 col-md-6">
            <h3 class="mb-3">Add Product</h3>
            <?php
            if (isset($_POST['btn-save-product'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $category = htmlspecialchars($_POST['category']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $namaFile = $_FILES['foto']['name'];
                $ukuranFile = $_FILES['foto']['size'];
                $error = $_FILES['foto']['error'];
                $tmpName = $_FILES['foto']['tmp_name'];
                $ekstensiGambar = explode('.', $namaFile);
                $ekstensiGambar = strtolower(end($ekstensiGambar));
                $namaFileBaru = uniqid();
                $namaFileBaru .= '.' . $ekstensiGambar;

                if ($error === 4) {
            ?>
                    <div class="alert alert-warning mb-3" role="alert">
                        pilih gambar terlebih dahulu!
                    </div>
                <?php
                } else if ($ekstensiGambar !== 'jpg' && $ekstensiGambar !== 'jpeg' && $ekstensiGambar !== 'png' && $ekstensiGambar !== 'jfif') {
                ?>
                    <div class="alert alert-warning mb-3" role="alert">
                        File yang anda upload bukan foto
                    </div>
                <?php
                } else if ($ukuranFile > 10000000) {
                ?>
                    <div class="alert alert-warning mb-3" role="alert">
                        Ukuran foto tidak boleh lebih dari 10Mb
                    </div>
                <?php
                } else if ($nama === '' || $category === '' || $harga === '' || $harga < 0) {
                ?>
                    <div class="alert alert-warning mb-3" role="alert">
                        Name, Category, dan Price harus diisi
                    </div>
                    <?php
                } else {
                    move_uploaded_file($tmpName, '../image/' . $namaFileBaru);

                    // query insert to product table
                    $queryTambah = mysqli_query($con, "INSERT INTO product (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$category', '$nama', '$harga', '$namaFileBaru', '$detail', '$ketersediaan_stok')");

                    if ($queryTambah) {
                    ?>
                        <div class="alert alert-success mb-3" role="alert">
                            Product Berhasil Disimpan
                        </div>
                        <meta http-equiv="refresh" content="2; url=./product.php" />
            <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="nama" class="form-control" autocomplete="off" required>
                </div>
                <div class="mb-2">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control" required>
                        <option>Choose Category</option>
                        <?php
                        foreach ($queryCategory as $dataCategory) {
                        ?>
                            <option value="<?php echo $dataCategory['id']; ?>"><?php echo $dataCategory['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="harga" min="0" step="500" required>
                </div>
                <div class="mb-2">
                    <label for="photo">Photo</label>
                    <input type="file" name="foto" id="photo" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" maxlength="500" class="form-control"></textarea>
                </div>
                <div class="mb-2">
                    <label for="stock">Stock Availability</label>
                    <select name="ketersediaan_stok" id="stock" class="form-control">
                        <option value="Available">Available</option>
                        <option value="Sold Out">Sold Out</option>
                    </select>
                </div>
                <div class="d-flex">
                    <a href="./product.php" class="btn btn-light border border-dark bg-body-secondary">Cancel</a>
                    <div class="ms-auto">
                        <button type="submit" class="btn btn-primary" name="btn-save-product">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>