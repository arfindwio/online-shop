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
        <form action="submit-order.php" method="POST" enctype="multipart/form-data">
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
                <!-- Add an input field for total amount -->
                <input type="hidden" id="totalAmountInput" name="totalAmountInput">

                <!-- Add a hidden input field to store the calculated total amount -->
                <input type="hidden" id="calculatedTotalAmount" name="calculatedTotalAmount" value="0">
                <!-- Add hidden input fields for item names and quantities -->
                <input type="hidden" id="itemNamesInput" name="itemNamesInput">
                <input type="hidden" id="itemQuantitiesInput" name="itemQuantitiesInput">
            </div>
            <div class="row rounded-4 shadow-lg overflow-hidden mt-5" style="height: 47rem;">
                <div class="col-7 p-5">
                    <div class="d-flex align-items-center pb-5 border-3 border-bottom">
                        <h1 class="fw-bold">Shopping Cart</h1>
                        <p class="text-secondary fs-5 mt-3 ms-auto">items</p>
                    </div>
                    <div class="shopping-cart__items" style="overflow: scroll; height: 65%;">


                    </div>
                </div>
                <!-- ... (previous HTML code) -->

                <div class="col-5 bg-dark-subtle p-5">
                    <div class="d-flex align-items-center border-3 border-bottom border-dark-subtle pb-5">
                        <h2 class="fw-bold me-auto">Summary</h2>
                        <img src="./image/nomorRekening.svg" alt="barcode" style="width: 65px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">
                    </div>
                    <p class="fw-semibold fs-3 mt-3">Price Detail</p>
                    <div class="d-flex">
                        <p class="fs-5 mt-1 mb-0" id="itemTotal">Items</p>
                        <p class="fs-5 mt-1 mb-0 ms-auto" id="totalItemsPrice">Rp. 0</p>
                    </div>
                    <div class="d-flex border-bottom border-1 border-dark">
                        <p class="fs-5 mt-0 ">Tax (10%)</p>
                        <p class="fs-5 mt-0 ms-auto" id="tax"></p>
                    </div>
                    <div class="d-flex">
                        <p class="fw-bold fs-5 mb-0">Total</p>
                        <p class="fw-bold fs-5 mb-0 ms-auto" id="totalAmount">Rp. 0</p>
                    </div>

                    <button type="submit" class="col-12 rounded-3 text-white bg-dark fs-4 py-1 mt-5" name="btn-pay">Confirm</button>
                </div>

            </div>
        </form>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center px-4">
                <p class="fw-bold fs-4 mb-0 pt-4">Scan This Barcode</p>
                <img src="./image/nomorRekening.svg">
                <p class="fw-bold fs-4 mb-0 pb-4">BCA bank account number</p>
            </div>
        </div>
    </div>
    <script>
        // Check if local storage is supported
        if (typeof(Storage) !== "undefined") {
            // Get cart data from local storage
            var cartData = JSON.parse(localStorage.getItem('cartData')) || [];

            // Get the element to display the cart items
            var cartItemsElement = document.querySelector('.shopping-cart__items');

            // Function to remove an item from the cart and update local storage
            function removeCartItem(index) {
                cartData.splice(index, 1);
                localStorage.setItem('cartData', JSON.stringify(cartData));
                displayCartItems();
                location.reload(); // Refresh the page
            }

            // Function to display cart items
            function displayCartItems() {
                cartItemsElement.innerHTML = ''; // Clear the existing items

                // Loop through the cart data and generate the HTML for each cart item
                for (var i = 0; i < cartData.length; i++) {
                    var cartItem = cartData[i];
                    var cartItemHtml = `
                    <div class="d-flex align-items-center py-3 border-2 border-bottom">
                        <img src="./image/${cartItem.foto}" alt="cart item image" class="rounded-3" style="width: 120px; height: 120px; object-fit: cover">
                        <p class="fs-2 fw-semibold mt-3 ms-3 me-auto">${cartItem.nama}</p>
                        <p class="fw-bold fs-4 mt-3">Rp. ${cartItem.harga}</p>
                        <div class="fs-5 ms-3">
                            <i class="fa-solid fa-trash" style="color: #ff0000; cursor: pointer;"
                               onclick="removeCartItem(${i})"></i>
                        </div>
                    </div>`;
                    cartItemsElement.innerHTML += cartItemHtml;
                }
            }

            displayCartItems(); // Display cart items on page load
        } else {
            alert("Local storage is not supported in your browser.");
        }

        function calculateTotalPrice() {
            var totalPrice = 0;
            for (var i = 0; i < cartData.length; i++) {
                totalPrice += parseFloat(cartData[i].harga);
            }
            return totalPrice;
        }

        // Display total price and cart items on page load
        displayCartItems();
        updateSummary();

        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }

        // Function to update the summary section
        function updateSummary() {

            var totalItems = cartData.length;
            var totalItemsPrice = calculateTotalPrice();
            var totalTax = totalItemsPrice * 0.1; // Assume 10% tax
            var totalAmount = totalItemsPrice + totalTax;

            document.querySelector('.fs-5.mt-3.ms-auto').textContent = `${totalItems} Items`;
            document.querySelector('#tax').textContent = formatCurrency(totalTax.toFixed(2));
            document.querySelector('#totalAmount').textContent = formatCurrency(totalAmount.toFixed(2));
            document.querySelector('#itemTotal').textContent = `${totalItems} Items`;
            document.querySelector('#totalItemsPrice').textContent = formatCurrency(totalItemsPrice.toFixed(2));

            // Update the input field value
            document.querySelector('#calculatedTotalAmount').value = totalAmount.toFixed(2);
            document.querySelector('#totalAmountInput').value = totalAmount.toFixed(2);

            var itemNames = cartData.map(item => item.nama);
            var itemQuantities = cartData.map(item => 1); // Assuming each item quantity is 1
            document.querySelector('#itemNamesInput').value = itemNames.join(', ');
            document.querySelector('#itemQuantitiesInput').value = itemQuantities.join(', ');

        }

        function removeCartItem(index) {
            cartData.splice(index, 1);
            localStorage.setItem('cartData', JSON.stringify(cartData));
            displayCartItems();
            updateSummary(); // Update summary after item removal
        }

        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function(event) {
            var image = event.relatedTarget; // Button that triggered the modal
            var imageSrc = image.getAttribute('src'); // Get the image source
            var modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc; // Set the source of the modal image
        });
    </script>


    <!-- Footer Section Start -->
    <?php require "./footer.php"; ?>
    <!-- Footer Section End -->

    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>