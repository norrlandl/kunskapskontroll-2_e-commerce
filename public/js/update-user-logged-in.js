// AJAX 2

const modalUserForm = document.querySelector("#modal-user-form");
modalUserForm.addEventListener("submit", updateUserModal);

async function updateUserModal (e) {
  e.preventDefault();

  const formData = new FormData(e.target);
  formData.set("updateUser", true);

  try {
    const response = await fetch("/kunskapskontroll-2_e-commerce/public/API/update-user-logged-in.php", { 
      method: "POST",
      body: formData
    });
    const data = await response.json();

    let errMsg = data["error"];

    // Saving old inputs in an object
    let inputs = document.querySelectorAll("#init-form input"); 
    let initFormInputs = {};
    
    for (let i = 0; i < inputs.length; i++) {
      initFormInputs[inputs[i].id] = inputs[i].value;
    }
 

    if(data["error"] == 0) {
      document.querySelector("#error-message").innerHTML = "";

      document.querySelector("#first_name").value = data["first_name"];
      document.querySelector("#last_name").value = data["last_name"];
      document.querySelector("#street").value = data["street"];
      document.querySelector("#city").value = data["city"];
      document.querySelector("#postal_code").value = data["postal_code"];
      document.querySelector("#country").value = data["country"];
      document.querySelector("#email").value = data["email"];
      document.querySelector("#phone").value = data["phone"];

      closeModalOnSucess();

    } else {
      document.querySelector("#success-message").innerHTML = "";

      document.querySelector("#modal-first-name").value = initFormInputs.first_name;
      document.querySelector("#modal-last-name").value = initFormInputs.last_name;
      document.querySelector("#modal-street").value = initFormInputs.street;
      document.querySelector("#modal-city").value = initFormInputs.city;
      document.querySelector("#modal-postal-code").value = initFormInputs.postal_code;
      document.querySelector("#modal-country").value = initFormInputs.country;
      document.querySelector("#modal-email").value = initFormInputs.email;
      document.querySelector("#modal-phone").value = initFormInputs.phone;
      
      document.querySelector("#error-message").innerHTML = `<ul class="alert alert-danger">${errMsg}</ul>`;
    }

  }
    catch (err) {
    console.log(err);
  }
}
