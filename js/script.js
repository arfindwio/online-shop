// Dropdown
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

// Popover Bootstrao
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map((popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl));

// cart
function addToCart(productId) {
  // Check if local storage is supported
  if (typeof Storage !== "undefined") {
    // Get existing cart data from local storage or initialize if not present
    var cartData = JSON.parse(localStorage.getItem("cartData")) || [];

    // Fetch product details from the server using the product ID
    fetch("get_product_details.php?id=" + encodeURIComponent(productId))
      .then((response) => response.json())
      .then((productDetails) => {
        // Add the product to cartData
        cartData.push(productDetails);

        // Store updated cartData in local storage
        localStorage.setItem("cartData", JSON.stringify(cartData));
        location.reload();
      })
      .catch((error) => {
        console.error("Error fetching product details:", error);
      });
  } else {
    alert("Local storage is not supported in your browser.");
  }
}
