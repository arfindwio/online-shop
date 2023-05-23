<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require "./navbar.php"; ?>

    <!-- Banner Product Section Start -->
    <div class="container-fluid d-flex align-items-center" style="height: 40vh; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('./image/about-us.jpg'); background-size: cover; background-position: center; margin-top: 50px;">
        <div class="container text-white text-center">
            <h1>About Us</h1>
        </div>
    </div>
    <!-- Banner Product Section End -->

    <!-- Main Section Start -->
    <div class="container-fluid pb-3" style="margin-top: 80px">
        <div class="container fs-5">
            <div class="row ">
                <div class="bg-secondary-subtle rounded-2" style="position: absolute; height: 36rem; width: 63rem; z-index: -1;"></div>
                <div class="col-6 offset-1" style="margin-top: 80px; margin-bottom: 100px;">
                    <h5 class="text-light-emphasis" style="font-size: 20px;">OUR STORE</h5>
                    <h1 class="mb-3">About Arfin Store</h1>
                    <p style="line-height: 32px; font-size: 17px;">We are an online clothing store committed to providing our customers with a convenient and enjoyable shopping experience. At this store, we believe that clothing is an effective way to express yourself and boost your self-esteem. We offer a wide range of clothing for men and women, from trendy casual styles to elegant formal wear. We sell well-known clothing brands and talented designers to ensure that every product we offer meets the highest quality standards. Customer convenience is our top priority. Therefore, we provide an easy-to-use online shopping platform, so you can browse our collections conveniently from anywhere and at any time. We also provide clear descriptions and measurements for each product, as well as high-quality photos that show detailed product details.</p>
                </div>
                <div class="col-5 d-flex align-items-center justify-content-center">
                    <img src="./image/about-us_image.jpg" alt="image about us" style="width: 30rem; height: 25rem; border-radius: 3%;">
                </div>
            </div>
        </div>
    </div>
    <!-- Main Section End -->

    <!-- Maps Offline Store Section Start -->
    <div class="container-fluid pb-5">
        <div class="container">
            <h1 class="text-center mb-4">Offline Store</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20998.70551817406!2d2.2964323274868033!3d48.86129586525888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc4e8f40001%3A0xe6981dfe4eb6a677!2sBALENCIAGA!5e0!3m2!1sid!2sid!4v1684238548114!5m2!1sid!2sid" style="border:0; width: 100%; height: 70vh;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- Maps Offline Store Section End -->

    <!-- Footer Section Start -->
    <?php require "./footer.php"; ?>
    <!-- Footer Section End -->



    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>