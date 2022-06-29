// Cart
const updateElements = document.querySelectorAll(".updateCart");
const totalAmountElements = document.querySelectorAll(".total-amount");
const totalPriceElements = document.querySelectorAll(".total-price");
const buyButtonElements = document.querySelectorAll(".buy-button");
const deleteButtonElements = document.querySelectorAll(".delete-button");
const totalAmountHeader = document.querySelector(".total-amount-header");
const totalAmountProducts = document.querySelector(".total-amount-products");

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
buyButtonElements.forEach((element) => {
  element.addEventListener("submit", (event) => {
    event.preventDefault();

    const data = new FormData(element);
    const productId = data.get("productId");
    const quantity = data.get("quantity");
    const img = data.get("img");
    const title = data.get("title");
    const price = data.get("price");
    const description = data.get("description");

    try {
      fetch(
        `/kunskapskontroll-2_e-commerce/public/cart/add-cart-item.php?productId=${productId}&quantity=${quantity}`,
        {
          method: "POST",
        }
      );

      // Testa om varan redan finns
      const buyElement = document.querySelector(`.cart-item-${productId}`);
      if (!buyElement) {
        // Lägg till varan i cart om den inte finns
        const cartBody = document.querySelector(".cart-body");
        cartBody.innerHTML += `
          <tr class="cart-item-${productId}">
            <td>
              <div class="cart-img">
                <img src="${img}">
              </div>
            </td>
            <td>
              <p class="cart-title">${title}</p>
          
           
                <p>${price}kr</p>
             
            </td>
            <td>
              <!-- UPDATE -->
              <form id="update-cart-form" class="updateCart">
                <input type="hidden" name="cartId" value="${productId}">
                <input type="hidden" name="price" value="${price}">
                <input type="number" class="total-amount-${productId} update-quantity" name="quantity" value="${quantity}" min="0">
              </form>
            </td>
            <td>
              <p class="total-price-${productId}">${price * quantity}kr </p>
            </td>
            <td>
              <!-- DELETE -->
              <form class="delete-button">
              <input type="hidden" name="cartId" value="<?= $cartId ?>">
              <button type="submit" class="hide" value=""><i class='fa-solid fa-trash-can'></i>
              </button>


            </form>
            </td>
          </tr>
        `;
      } else {
        // Öka antal om den finns
        const elementQty = document.querySelector(`.total-amount-${productId}`);
        const elementTotalPrice = document.querySelector(
          `.total-price-${productId}`
        );

        elementQty.value = parseInt(elementQty.value) + parseInt(quantity);
        elementTotalPrice.innerHTML = `${elementQty.value * price}kr`;
      }

      // Uppdatera totala varor + summor
      cartTotals().then((data) => {
        totalAmountProducts.innerHTML = `Produkter (${data.totalAmount})`;
        totalAmountHeader.innerHTML = ` (${data.totalAmount})`;
        totalAmountElements.forEach((element) => {
          element.innerHTML = `Antal: ${data.totalAmount}`;
        });
        totalPriceElements.forEach((element) => {
          element.innerHTML = `Att betala: ${data.totalSum}kr`;
        });
      });
    } catch (error) {
      console.log(error);
    }
  });
});

// Remove from cart
deleteButtonElements.forEach((element) => {
  element.addEventListener("submit", (event) => {
    event.preventDefault();

    const data = new FormData(element);
    const cartId = data.get("cartId");

    try {
      fetch(
        `/kunskapskontroll-2_e-commerce/public/cart/delete-cart-item.php?cartId=${cartId}`,
        {
          method: "POST",
        }
      );

      const cartItemsToDelete = document.querySelectorAll(
        `.cart-item-${cartId}`
      );
      cartItemsToDelete.forEach((element) => element.remove());

      // Uppdatera totala varor + summor
      cartTotals().then((data) => {
        totalAmountHeader.innerHTML = ` (${data.totalAmount})`;
        totalAmountProducts.innerHTML = `Produkter (${data.totalAmount})`;
        totalAmountElements.forEach((element) => {
          element.innerHTML = `Antal: ${data.totalAmount}`;
        });
        totalPriceElements.forEach((element) => {
          element.innerHTML = `Att betala: ${data.totalSum}kr`;
        });
      });
    } catch (error) {
      console.log(error);
    }
  });
});

// Update quantity
updateElements.forEach((element) => {
  element.addEventListener("change", (event) => {
    event.preventDefault();

    const data = new FormData(element);
    const cartId = data.get("cartId");
    const quantity = data.get("quantity");
    const price = data.get("price");

    const amountCartItem = document.querySelectorAll(`.total-amount-${cartId}`);
    const totalPriceCartItem = document.querySelectorAll(
      `.total-price-${cartId}`
    );

    try {
      fetch(
        `/kunskapskontroll-2_e-commerce/public/cart/update-cart-item.php?cartId=${cartId}&quantity=${quantity}`,
        {
          method: "POST",
        }
      );

      // Uppdatera DOM i cart + checkout
      amountCartItem.forEach((element) => (element.value = quantity));
      totalPriceCartItem.forEach(
        (element) => (element.innerHTML = `${quantity * price}kr`)
      );

      // Uppdatera totala varor + summor
      cartTotals().then((data) => {
        totalAmountProducts.innerHTML = `Produkter (${data.totalAmount})`;
        totalAmountHeader.innerHTML = ` (${data.totalAmount})`;
        totalAmountElements.forEach((element) => {
          element.innerHTML = `Antal: ${data.totalAmount}`;
        });
        totalPriceElements.forEach((element) => {
          element.innerHTML = `Att betala: ${data.totalSum}kr`;
        });
      });
    } catch (error) {
      console.log(error);
    }
  });
});
