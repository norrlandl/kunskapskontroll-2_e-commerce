// Cart
const updateElements = document.querySelectorAll(".updateCart");
console.log(updateElements);

function showCart() {
  const dropDownButton = document.querySelector("#dropdownMenuButton");
  const dropdown = document.querySelector(".dropdown-menu");

  if (dropdown.classList.contains("show") === false) dropDownButton.click();
}

// Add to cart

// Remove from cart
let cartTotalItems = 0;
let cartTotalSum = 0;
// Update quantity
updateElements.forEach((element) => {
  element.addEventListener("change", (event) => {
    event.preventDefault();

    const data = new FormData(element);
    const cartId = data.get("cartId");
    const quantity = data.get("quantity");

    try {
      const response = fetch(
        `/kunskapskontroll-2_e-commerce/public/cart/update-cart-item.php?cartId=${cartId}&quantity=${quantity}`,
        {
          method: "POST",
        }
      );
      console.log(response);
    } catch (error) {
      console.log(error);
    }
  });
});
