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

// WYSIWYG Ckeditor
ClassicEditor.create(document.querySelector("#detail")).catch((error) => {
  console.error(error);
});

// cart

$("#success").hide();
$("#close-alert").on("click", () => {
  $("#success").hide();
});
// ajax add to cart
function addToCart(productId, qty, user_id) {
  $.ajax({
    url: "add-to-cart.php",
    method: "post",
    data: {
      product_id: productId,
      user_id: user_id,
      qty: qty,
    },
    cache: false,
    success: function (res) {
      let result = JSON.parse(res);
      console.log(result);
      if (result.statusCode === 200) {
        window.location.href = "./my-cart";
      } else {
        $("#success").hide();
      }
    },
  });
}
