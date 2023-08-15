<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require "./navbar.php"; ?>

    <div class="shopping-cart container py-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="col-6 rounded-4 shadow-lg mt-5 p-4 mx-auto">
                <h1 class="text-center mb-4">Fill Customer Data</h1>
                <div class="mb-3">
                    <label for="namaPelanggan" class="ms-1">Full Name</label>
                    <input type="text" id="namaPelanggan" name="namaPelanggan" class="secondary-placeholder col-12 border border-secondary-subtle border-2 rounded-3 ps-3 py-2" placeholder="Full Name" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="teleponPelanggan" class="ms-1">Phone Number</label>
                    <input type="tel" id="teleponPelanggan" name="teleponPelanggan" class="secondary-placeholder col-12 border border-secondary-subtle border-2 rounded-3 ps-3 py-2" placeholder="0123-4567-8910" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" required>
                </div>
                <div class="mb-3">
                    <label for="alamatPelanggan" class="ms-1">Address</label>
                    <input type="text" id="alamatPelanggan" name="alamatPelanggan" class="secondary-placeholder col-12 border border-secondary-subtle border-2 rounded-3 ps-3 py-2" placeholder="Address" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="buktiPelanggan" class="ms-1">Proof of Payment</label>
                    <input type="file" id="buktiPelanggan" name="buktiPelanggan" class="secondary-placeholder col-12 border border-secondary-subtle border-2 rounded-3 ps-3 py-2" placeholder="Address" autocomplete="off" required>
                </div>
            </div>
            <div class="row rounded-4 shadow-lg overflow-hidden mt-5" style="height: 47rem;">
                <div class="col-7 p-5">
                    <div class="d-flex align-items-center pb-5 border-3 border-bottom">
                        <h1 class="fw-bold">Shopping Cart</h1>
                        <p class="text-secondary fs-5 mt-3 ms-auto">3 items</p>
                    </div>
                    <div class="shopping-cart__items" style="overflow: scroll; height: 65%;">
                        <div class="d-flex align-items-center py-3 border-2 border-bottom">
                            <img src="./image/mCKEvSoWpltvimHTU6vz.jpg" alt="cart item image" class="rounded-3" style="width: 120px; height: 120px; object-fit: cover">
                            <p class="fs-2 fw-semibold mt-3 ms-3 me-auto">Shirt</p>
                            <p class="fw-bold fs-4 mt-3">Rp. 199000</p>
                            <div class="fs-5 ms-3"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></div>
                        </div>

                    </div>
                </div>
                <div class="col-5 bg-dark-subtle p-5">
                    <div class="d-flex align-items-center pb-5 border-3 border-bottom border-dark-subtle">
                        <h2 class="fw-bold mt-3">Summary</h2>
                    </div>
                    <p class="fw-semibold fs-3 mt-3">Price Detail</p>
                    <div class="d-flex">
                        <p class="fs-5 mt-1 mb-0">3 Items</p>
                        <p class="fs-5 mt-1 mb-0 ms-auto">Rp. </p>
                    </div>
                    <div class="d-flex border-bottom border-1 border-dark">
                        <p class="fs-5 mt-0">Tax</p>
                        <p class="fs-5 mt-0 ms-auto">Rp. </p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-bold fs-5 mb-0">Total</p>
                        <p class="fw-bold fs-5 mb-0 ms-auto">Rp. </p>
                    </div>
                    <button type="submit" class="col-12 rounded-3 text-white bg-dark fs-4 py-1 mt-5" name="btn-pay">Confirm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer Section Start -->
    <?php require "./footer.php"; ?>
    <!-- Footer Section End -->

    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>