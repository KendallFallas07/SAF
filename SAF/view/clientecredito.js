document.getElementById("data").addEventListener("keyup", obtenerDatos);

function obtenerDatos() {
  let datos = document.getElementById("data").value.trim();
  let lista = document.getElementById("lista"); 

  if (datos.length > 0) {
      let url = "../business/accionClienteCreditoBuscar.php";
      let datosFormulario = new FormData();
      datosFormulario.append("datos", datos);

      fetch(url, {
          method: "POST",
          body: datosFormulario,
          mode: "cors"
      }).then(response => response.json())
          .then(data => {
              lista.innerHTML = ""; // Limpiar lista previa
              data.forEach(item => {
                
                  let option = document.createElement("option");
                  option.value = item.nombreCompleto; // Valor que se mostrará en el input
                  lista.appendChild(option); // Agregar la opción al datalist
              });
          })
          .catch(err => console.log(err))
  } else {
      lista.innerHTML = ''; // Limpiar lista cuando no hay datos
  }
}

function getMaxDay() {
  var maxDate = new Date();
  var year = maxDate.getFullYear();
  var month = ("0" + (maxDate.getMonth() + 1)).slice(-2);
  var day = ("0" + maxDate.getDate()).slice(-2);
  var finalDate = year + "-" + month + "-" + day;

  var dateInput = document.querySelector(
    'input[name="clienteCreditoFechaInicio"]'
  );
  if (dateInput) {
    dateInput.setAttribute("max", finalDate);
  }
}

// Ejecutar la función cuando el DOM esté completamente cargado
window.onload = getMaxDay;

const fechaInicio = document.getElementById("clienteCreditoFechaInicio");
const fechaFinal = document.getElementById("clienteCreditoFechaVencimiento");


// Función que se ejecuta cuando cambia el valor de la fecha
function handleDateChange(event) {

  const fechaInicioValue = fechaInicio.value;

  var plazo = document.getElementById("clienteCreditoPlazo").value;

  if (plazo === "") {
    alert(
      "Debes seleccionar un plazo para poder ingresar una fecha de inicio!"
    );
    fechaInicio.value = "";
    fechaFinal.value = "";

  } else {

    const plazoEnMeses = parseInt(
      document.getElementById("clienteCreditoPlazo").value,
      10
    );

    const fechaInicioAux = new Date(fechaInicioValue);

    const fechaFinalAux = new Date(fechaInicioAux);
    fechaFinalAux.setMonth(fechaFinalAux.getMonth() + plazoEnMeses);

    const fechaFinalFormatted = fechaFinalAux.toISOString().split("T")[0];

    // Establecer el valor de la fecha final en el campo correspondiente
    fechaFinal.value = fechaFinalFormatted;
  }
}

function handlePlazoChange() {
  
  fechaInicio.value = "";
  fechaFinal.value = "";
  
}

// Agregar el evento 'change' a los campos de fecha
fechaInicio.addEventListener("change", handleDateChange);

function guardar() {
  var form = document.getElementById("guardar");
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


  async function eliminarClienteCredito(clienteCredito){ 
  
    var result = confirm("Estás seguro que deseas eliminar este crédito?");
  
    if (result) {
      
      try {
        const response = await fetch(
          `../business/accionClienteCreditoEliminar.php?action=obtenerClienteCredito&identificador=${clienteCredito}`
        );
        const data = await response.json();
        alert(data.message);
        window.location.reload();
      } catch (error) {
        console.log("Error", error);
      }
      
    }
  }
  

  async function modificarClienteCredito(clienteCredito) {
    var cancelBtn = document.getElementById("boton-cancelar");
    cancelBtn.style.display = "inline";
  
    var submitBtn = document.getElementById("boton-cargar");
    submitBtn.textContent = "Modificar crédito";

    try {
      const response = await fetch(
        `../business/accionClienteCreditoEditar.php?action=obtenerClienteCredito&identificador=${clienteCredito}`
      );
      const data = await response.json();
  
      document.getElementById('clienteId').value = data.clienteId;
      document.getElementById('clienteCreditoCantidad').value = data.cantidad;
      document.getElementById('clienteCreditoPorcentaje').value = data.porcentaje;
      document.getElementById('clienteCreditoPlazo').value = data.plazo;
      
      if (data.inicio !== '0000-00-00') {
        document.getElementById('clienteCreditoFechaInicio').value = data.inicio;
    } else {
        document.getElementById('clienteCreditoFechaInicio').value = ''; 
    }
    
    if (data.fin !== '0000-00-00') {
        document.getElementById('clienteCreditoFechaVencimiento').value = data.fin;
    } else {
        document.getElementById('clienteCreditoFechaVencimiento').value = '';
    }
      document.getElementById('idAModificar').value = data.identificador;
      
    } catch (error) {
      console.log("Error", error);
    }
  }
  
  function editarCredito() {
    var formData = new FormData();
    formData.append("clienteId", document.getElementById("clienteId").value);
    formData.append("clienteCreditoCantidad", document.getElementById("clienteCreditoCantidad").value);
    formData.append("clienteCreditoPorcentaje", document.getElementById("clienteCreditoPorcentaje").value);
    formData.append("clienteCreditoPlazo", document.getElementById("clienteCreditoPlazo").value);
    formData.append("clienteCreditoFechaInicio", document.getElementById("clienteCreditoFechaInicio").value);
    formData.append("clienteCreditoFechaVencimiento", document.getElementById("clienteCreditoFechaVencimiento").value);
    formData.append("idAModificar", document.getElementById("idAModificar").value);
  
    // Envío del formulario a través de JS
    fetch("../business/accionClienteCreditoActualizar.php", {
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
var form = document.getElementById("guardar");
var submitBtn = document.getElementById("boton-cargar");
var cancelBtn = document.getElementById("boton-cancelar");
cancelBtn.style.display = "none";

function cancelButton(event) {
  event.preventDefault();
  var result = confirm("Estás seguro de cancelar la edición del crédito?");

  if (result) {
    location.replace("clientecredito.php");
  }
}

function submitButton(event) {
  event.preventDefault();

  if (submitBtn.textContent === "Agregar crédito") {
    if (form && form.checkValidity()) {
      if (confirm("Deseas agregar el crédito ingresado?")) {
        guardar(); // Envía el formulario si el usuario confirma
      }
    } else {
      form.reportValidity(); // Muestra los mensajes de validación del navegador
    }
  } else if (submitBtn.textContent === "Modificar crédito") {
    if (form && form.checkValidity()) {
      if (confirm("Deseas actualizar el crédito ingresado?")) {
        editarCredito(); // Envía el formulario si el usuario confirma
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