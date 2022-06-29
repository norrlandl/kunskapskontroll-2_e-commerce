formSubmit = document.querySelector("#createNewSubmit");

formSubmit.addEventListener("submit", createNewProduct);

async function createNewProduct (e) {
  e.preventDefault();

  const formData = new FormData(e.target);
  formData.set("addNewProduct", true);

  try {
    const response = await fetch("/kunskapskontroll-2_e-commerce/public/admin/products/create-new-api.php", { 
      method: "POST",
      body: formData
    });
    const data = await response.json();

    let errMsg = data["error"];

    if (data["error"]) {
      document.querySelector("#success-msg").innerHTML = "";
      document.querySelector("#error-msg").innerHTML = `<ul class="alert alert-danger list-unstyled">${errMsg}</ul>`;
      } else {
        document.querySelector("#error-msg").innerHTML = "";
        document.querySelector("#success-msg").innerHTML = `<div class="alert alert-success">Du har lagt till en produkt.</div>`

        let redirectPage = () => {
          let tID = setTimeout(function () {
              window.location.href = "../index.php";
              window.clearTimeout(tID);
          }, 1500);
      }

      redirectPage();
      }
    }

    catch (err) {
    console.log(err);
  }
}
