document.getElementById("data").addEventListener("keyup", obtenerDatos);

function obtenerDatos() {
  let datos = document.getElementById("data").value.trim();
  let lista = document.getElementById("lista"); 

  if (datos.length > 0) {
      let url = "../business/accionCompraBuscar.php";
      let datosFormulario = new FormData();
      datosFormulario.append("datos", datos);

      fetch(url, {
          method: "POST",
          body: datosFormulario,
          mode: "cors"
      }).then(response => response.json())
          .then(data => {
              console.log(data);
              lista.innerHTML = ""; // Limpiar lista previa
              data.forEach(item => {
                  
                  let option = document.createElement("option");
                  option.value = item.nombre; // Valor que se mostrará en el input
                  lista.appendChild(option); // Agregar la opción al datalist
              });
          })
          .catch(err => console.log(err))
  } else {
      lista.innerHTML = ''; // Limpiar lista cuando no hay datos
  }
}


// Método para obtener el día máximo para la compra
function getMaxDay() {
  var maxDate = new Date();
  var year = maxDate.getFullYear();
  var month = ("0" + (maxDate.getMonth() + 1)).slice(-2);
  var day = ("0" + maxDate.getDate()).slice(-2);
  var finalDate = year + "-" + month + "-" + day;

  var dateInput = document.querySelector('input[name="date"]');
  if (dateInput) {
    dateInput.setAttribute("max", finalDate);
  }
}

// Ejecutar la función cuando el DOM esté completamente cargado
window.onload = getMaxDay;

function saveData() {
  var form = document.getElementById("save");
  if (!form) return;
  var formData = new FormData(form);

  // Envío del formulario a través de JS
  fetch(form.action, {
    method: form.method,
    body: formData,
  })
    .then(function (response) {
      return response.json(); // Convierte la respuesta a JSON
    })
    .then(function (data) {
      alert(data.message);
      window.location.reload();
    })
    .catch(function (error) {
      alert(error);
    });
}

async function deleteBuy(buy){ 

  var result = confirm("Estás seguro que deseas eliminar esta compra?");

  if (result) {
    
    try {
      const response = await fetch(
        `../business/accionCompraEliminar.php?action=getBuy&identifier=${buy}`
      );
      const data = await response.json();
      alert(data.message);
      window.location.reload();
    } catch (error) {
      console.log("Error", error);
    }
    
  }
}

async function ModifyBuy(buy) {
  
  var cancelBtn = document.getElementById("cancel-btn");
  cancelBtn.style.display = "inline";

  var submitBtn = document.getElementById("submit-btn");
  submitBtn.textContent = "Modificar compra";

  try {
    const response = await fetch(
      `../business/accionCompraEditar.php?action=getBuy&identifier=${buy}`
    );
    const data = await response.json();

    document.getElementById("supplierId").value = data.idSupplier;
    document.getElementById("payMethod").value = data.payMethod;
    document.getElementById("notes").value = data.notes;
    document.getElementById("date").value = data.date;
    document.getElementById("idToModify").value = data.identifier;
    
  } catch (error) {
    console.log("Error", error);
  }
}

function editBuy() {
  
  var formData = new FormData();
  formData.append("supplierId", document.getElementById("supplierId").value);
  formData.append("payMethod", document.getElementById("payMethod").value);
  formData.append("idToModify", document.getElementById("idToModify").value);
  formData.append("notes", document.getElementById("notes").value);
  formData.append("date", document.getElementById("date").value);
  
  // Envío del formulario a través de JS
  fetch("../business/accionCompraActualizar.php", {
    method: 'POST',
    body: formData,
  })
    .then(function (response) {
      return response.json(); // Convierte la respuesta a JSON
    })
    .then(function (data) {
      alert(data.message);
      window.location.reload();
    })
    .catch(function (error) {
      alert(error);
    });
}

//Logica de botones
var form = document.getElementById("save");
var submitBtn = document.getElementById("submit-btn");
var cancelBtn = document.getElementById("cancel-btn");
cancelBtn.style.display = "none";

function cancelButton(event) {
  event.preventDefault();
  var result = confirm("Estás seguro de cancelar la edición de la compra?");

  if (result) {
    location.replace("compra.php");
  }
}

function submitButton(event) {
  event.preventDefault();

  if (submitBtn.textContent === "Agregar compra") {
    if (form && form.checkValidity()) {
      if (confirm("Deseas agregar la compra ingresada?")) {
        saveData(); // Envía el formulario si el usuario confirma
      }
    } else {
      form.reportValidity(); // Muestra los mensajes de validación del navegador
    }
  } else if (submitBtn.textContent === "Modificar compra") {
    if (form && form.checkValidity()) {
      if (confirm("Deseas actualizar la compra ingresada?")) {
        editBuy(); // Envía el formulario si el usuario confirma
      }
    } else {
      form.reportValidity(); // Muestra los mensajes de validación del navegador
    }
  }
}

if (cancelBtn) {
  cancelBtn.addEventListener("click", cancelButton);
}

if (submitBtn) {
  submitBtn.addEventListener("click", submitButton);
}
