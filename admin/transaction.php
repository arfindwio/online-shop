<?php
require "./session.php";
require "../connection.php";

$queryCustomer = mysqli_query($con, "SELECT * FROM customer");
$countCustomer = mysqli_num_rows($queryCustomer);

// pagination
$jumlahDataPerHalaman = 10;
$jumlahHalaman = ceil($countCustomer / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$queryCustomerNew = mysqli_query($con, "SELECT * FROM customer LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    Transaction
                </li>
            </ol>
        </nav>



        <div class="mt-3">
            <h2>Transaction List</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-secondary">
                        <tr>
                            <th class="align-middle text-center">No.</th>
                            <th class="align-middle text-center">Bukti Pembayaran</th>
                            <th class="align-middle text-center">Nama</th>
                            <th class="align-middle text-center">Telepon</th>
                            <th class="align-middle text-center">Alamat</th>
                            <th class="align-middle text-center">Total Harga</th>
                            <th class="align-middle text-center">Produk</th>
                            <th class="align-middle text-center">Jumlah Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($countCustomer < 1) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data transaction tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $number = 1;
                            foreach ($queryCustomerNew as $dataCustomer) {
                            ?>
                                <tr>
                                    <td class="align-middle text-center">
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
                                    <td class="align-middle text-center">
                                        <a href="#" class="bukti-pembayaran" data-image="../uploads/<?php echo $dataCustomer['buktiPelanggan']; ?>">
                                            <img src="../uploads/<?php echo $dataCustomer['buktiPelanggan']; ?>" alt="Bukti Pembayaran" style="width: 120px; height: 120px; object-fit: cover">
                                        </a>
                                    </td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['namaPelanggan']; ?></td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['teleponPelanggan']; ?></td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['alamatPelanggan']; ?></td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['totalHarga']; ?></td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['namaBarang']; ?></td>
                                    <td class="align-middle text-center"><?php echo $dataCustomer['jumlahBarang']; ?></td>
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
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination Section Start -->
    <div class="text-center mb-4" <?php if ($countCustomer < 1) : ?>Hidden<?php endif; ?>>
        <?php if ($halamanAktif > 1) : ?>
            <a href="./transaction.php?page=<?php echo $halamanAktif - 1; ?>" class="text-decoration-none text-dark fs-2">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a href="./transaction.php?page=<?php echo $i; ?>" class="text-decoration-none text-light fw-bolder fs-5" style="padding: 3px 10px; background-color: blue; border: 1px solid black;"><?php echo $i; ?></a>
            <?php else : ?>
                <a href="./transaction.php?page=<?php echo $i; ?>" class="text-decoration-none text-dark fw-bolder fs-5" style="padding: 3px 10px; background-color: white; border: 1px solid black;"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="./transaction.php?page=<?php echo $halamanAktif + 1; ?>" class="text-decoration-none text-dark fs-2">&raquo;</a>
        <?php endif; ?>
    </div>
    <!-- Pagination Section End -->

    <script>
        $(document).ready(function() {
            $('.bukti-pembayaran').on('click', function() {
                let imageUrl = $(this).data('image');
                $('#modalImage').attr('src', imageUrl);
                $('#imageModal').modal('show');
            });
        });
    </script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>