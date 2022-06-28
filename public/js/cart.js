// Cart
const updateElements = document.querySelectorAll(".updateCart");
const totalAmountElements = document.querySelectorAll(".total-amount");
const totalPriceElements = document.querySelectorAll(".total-price");

function showCart() {
  const dropDownButton = document.querySelector("#dropdownMenuButton");
  const dropdown = document.querySelector(".dropdown-menu");

  if (dropdown.classList.contains("show") === false) dropDownButton.click();
}

async function cartTotals() {
  try {
    const response = await fetch(
      "/kunskapskontroll-2_e-commerce/public/API/queryCart.php"
    );

    const data = await response.json();
    const cartObject = {
      totalSum: data["totalSum"],
      totalAmount: data["totalItems"],
    };

    return cartObject;
  } catch (error) {
    console.log(error);
  }
}

// Add to cart

// Remove from cart

// Update quantity
updateElements.forEach((element) => {
  element.addEventListener("change", (event) => {
    event.preventDefault();

    const data = new FormData(element);
    const cartId = data.get("cartId");
    const quantity = data.get("quantity");
    const price = data.get("price");

    let totalAmountHeader = document.querySelector(".total-amount-header");
    let amountCartItem = document.querySelectorAll(`.total-amount-${cartId}`);
    let totalPriceCartItem = document.querySelectorAll(
      `.total-price-${cartId}`
    );

    try {
      fetch(
        `/kunskapskontroll-2_e-commerce/public/cart/update-cart-item.php?cartId=${cartId}&quantity=${quantity}`,
        {
          method: "POST",
        }
      );

      console.log(amountCartItem);
      console.log(quantity, price);

      amountCartItem.forEach((element) => (element.value = quantity));
      totalPriceCartItem.forEach(
        (element) => (element.innerHTML = `${quantity * price} kr`)
      );

      cartTotals().then((data) => {
        totalAmountHeader.innerHTML = ` (${data.totalAmount})`;
        totalAmountElements.forEach((element) => {
          element.innerHTML = `Antal: ${data.totalAmount}`;
        });
        totalPriceElements.forEach((element) => {
          element.innerHTML = `Totalpris: ${data.totalSum} kr`;
        });
      });
    } catch (error) {
      console.log(error);
    }
  });
});
