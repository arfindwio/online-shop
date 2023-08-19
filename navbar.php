<nav class="navbar navbar-expand-lg bg-dark navbar-dark p-2 fixed-top">
    <div class="container">
        <a href="./" class="text-decoration-none text-light fw-bold fs-2"><i class="fa-solid fa-ghost me-3"></i>Arfin Store</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="./about-us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fs-5" href="./product.php">Product</a>
                </li>
                <li class="nav-item list-group-item d-flex justify-content-end align-items-start">
                    <a class="nav-link text-light fs-5 pe-2" href="./shopping-cart.php"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></a>
                    <span class="list-group-cart rounded-5 text-white bg-danger px-1 fw-bold position-absolute" style="font-size: 12px">
                        <script>
                            let cartDataProduct = JSON.parse(localStorage.getItem('cartData'));
                            document.write(cartDataProduct.length);
                        </script>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>