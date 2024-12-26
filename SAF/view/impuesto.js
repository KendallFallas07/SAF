
document.getElementById("name").addEventListener("keyup", validarNombre);
document.getElementById("data").addEventListener("keyup", obtenerDatos);

function obtenerDatos() {
    let datos = document.getElementById("data").value.trim();
    let lista = document.getElementById("lista");

    if (datos.length > 0) {
        let url = "../business/accionImpuestoBuscar.php";
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
                    option.value = item.nombre; // Valor que se mostrará en el input
                    lista.appendChild(option); // Agregar la opción al datalist
                });
            })
            .catch(err => console.log(err))
    } else {
        lista.innerHTML = ''; // Limpiar lista cuando no hay datos
    }
}

function validarNombre() {

    let inputNombre = document.getElementById("name");
    let nombre = inputNombre.value;

    if (nombre.length > 0) {

        //Datos por enviar
        let url = "../business/accionImpuestoValidar.php";
        let datosFormulario = new FormData();
        datosFormulario.append("name", nombre);

        fetch(url, {
            method: "POST",
            body: datosFormulario,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {

                if (data === 'El nombre ingresado ya se encuentra registrado, intenta con otro nombre.') {
                    inputNombre.setCustomValidity(data);
                    inputNombre.reportValidity();

                } else {
                    inputNombre.setCustomValidity('');
                    inputNombre.reportValidity();
                }
            })
            .catch(err => console.log(err))

    }

}

async function recuperarImpuesto(impuesto) {

    var result = confirm("Estás seguro que deseas recuperar este impuesto?");

    if (result) {

        try {
            const response = await fetch(
                `../business/accionImpuestoRecuperar.php?action=obtenerImpuesto&identificador=${impuesto}`
            );
            const data = await response.json();
            alert(data.message);
            window.location.reload();
        } catch (error) {
            console.log("Error", error);
        }

    }
}

function alternarDiv() {

    let texto = document.getElementById("botonCambiar").textContent;

    if (texto === "Mostrar impuestos eliminados") {

        mostrarDiv();

    } else if (texto === "Ocultar impuestos eliminados") {

        ocultarDiv();

    } else {

        document.getElementById("botonCambiar").disabled = true;

    }

}

function mostrarDiv() {

    document.getElementById("divOculto").style.display = "block";
    document.getElementById("botonCambiar").textContent = "Ocultar impuestos eliminados";
}

function ocultarDiv() {

    document.getElementById("divOculto").style.display = "none";
    document.getElementById("botonCambiar").textContent = "Mostrar impuestos eliminados";
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

function editData(event, id) {
    event.preventDefault();
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        form = document.getElementById(id);
        formData = new FormData(form);
        //envio del formulario araves de js
        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}

function saveData() {

    if (confirm("Deseas agregar el impuesto ingresado?")) {
        form = document.getElementById("save");
        formData = new FormData(form);
        
        //envio del formulario araves de js
        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}

async function eliminarImpuesto(impuesto) {

    var result = confirm("Estás seguro que deseas eliminar este impuesto?");

    if (result) {

        try {
            const response = await fetch(
                `../business/accionImpuestosEliminar.php?action=obtenerPresentacion&identificador=${impuesto}`
            );
            const data = await response.json();
            alert(data.message);
            window.location.reload();
        } catch (error) {
            console.log("Error", error);
        }

    }
}

async function modificarImpuesto(impuesto) {

    var cancelBtn = document.getElementById("boton-cancelar");
    cancelBtn.style.display = "inline";
  
    var submitBtn = document.getElementById("boton-cargar");
    submitBtn.textContent = "Modificar impuesto";
  
    try {
      const response = await fetch(
        `../business/accionImpuestoEditar.php?action=getImpuesto&identificador=${impuesto}`
      );
      const data = await response.json();

      document.getElementById("name").value = data.nombre;
      document.getElementById("description").value = data.descripcion;
      document.getElementById("value").value = data.valor;

      if (data.vigencia !== '0000-00-00') {
        document.getElementById('date').value = data.vigencia;
    } else {
        document.getElementById("date").value = ''; 
    }

      document.getElementById("idAModificar").value = data.identificador;
      
    } catch (error) {
      console.log("Error", error);
    }
      
  }

//Logica de botones
var form = document.getElementById("save");
var submitBtn = document.getElementById("boton-cargar");
var cancelBtn = document.getElementById("boton-cancelar");
cancelBtn.style.display = "none";

function cancelButton(event) {
    event.preventDefault();
    var result = confirm("Estás seguro de cancelar la edición del impuesto?");

    if (result) {
        location.replace("impuesto.php");
    }
}

function editarImpuesto(){

    var formData = new FormData();
    formData.append("name", document.getElementById("name").value);
    formData.append("description", document.getElementById("description").value);
    formData.append("value", document.getElementById("value").value);
    formData.append("date", document.getElementById("date").value);
    formData.append("idAModificar", document.getElementById("idAModificar").value);

    // Envío del formulario a través de JS
    fetch("../business/accionImpuestoActualizar.php", {
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

function submitButton(event) {
    event.preventDefault();

    if (submitBtn.textContent === "Agregar impuesto") {
        if (form && form.checkValidity()) {
            saveData();
        } else {
            form.reportValidity(); // Muestra los mensajes de validación del navegador
        }
    } else if (submitBtn.textContent === "Modificar impuesto") {
        if (form && form.checkValidity()) {
            if (confirm("Deseas actualizar el impuesto ingresado?")) {
                editarImpuesto(); // Envía el formulario si el usuario confirma
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