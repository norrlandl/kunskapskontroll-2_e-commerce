let productsArray = [];

const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("focus", async (event) => {
  event.preventDefault();

  try {
    const response = await fetch(
      "/kunskapskontroll-2_e-commerce/public/data/queryProducts.php"
    );

    const data = await response.json();
    productsArray = data["products"];
  } catch (error) {
    console.log(error);
  }
});

// searchInput.addEventListener("blur", (event) => {
//   document.getElementById("searchResults").innerHTML = "";
//   searchInput.value = "";
// });

searchInput.addEventListener("keyup", (event) => {
  const inputText = event.target.value;
  let html = "";

  if (inputText) {
    productsArray.map((product) => {
      if (product.title.toLowerCase().startsWith(inputText.toLowerCase())) {
        html += `
          <a class="search-result" href="/kunskapskontroll-2_e-commerce/public/product.php?id=${product.id}" name="productId">
            ${product.title}
          </a>
        `;
      }
    });
    return (document.getElementById("searchResults").innerHTML = html);
  }
  document.getElementById("searchResults").innerHTML = html;
});
