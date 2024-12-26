
document.getElementById("name").addEventListener("keyup", validarNombre);
document.getElementById("data").addEventListener("keyup", obtenerDatos);

function obtenerDatos() {
    let datos = document.getElementById("data").value.trim();
    let lista = document.getElementById("lista");

    if (datos.length > 0) {
        let url = "../business/accionPresentacionBuscar.php";
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
        let url = "../business/accionPresentacionValidar.php";
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


function saveData() {

    if (confirm("Deseas agregar la presentación ingresada?")) {
        form = document.getElementById("guardar");
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


async function eliminarPresentacion(presentacion) {

    var result = confirm("Estás seguro que deseas eliminar esta presentacion?");

    if (result) {

        try {
            const response = await fetch(
                `../business/accionPresentacionEliminar.php?action=obtenerPresentacion&identificador=${presentacion}`
            );
            const data = await response.json();
            alert(data.message);
            window.location.reload();
        } catch (error) {
            console.log("Error", error);
        }

    }
}

async function recuperarPresentacion(presentacion) {

    var result = confirm("Estás seguro que deseas recuperar esta presentacion?");

    if (result) {

        try {
            const response = await fetch(
                `../business/accionPresentacionRecuperar.php?action=obtenerPresentacion&identificador=${presentacion}`
            );
            const data = await response.json();
            alert(data.message);
            window.location.reload();
        } catch (error) {
            console.log("Error", error);
        }

    }
}


async function modificarPresentacion(presentacion) {

    var cancelBtn = document.getElementById("boton-cancelar");
    cancelBtn.style.display = "inline";

    var submitBtn = document.getElementById("boton-cargar");
    submitBtn.textContent = "Modificar presentación";

    try {
        const response = await fetch(
            `../business/accionPresentacionEditar.php?action=obtenerPresentacion&identificador=${presentacion}`
        );
        const data = await response.json();

        document.getElementById('name').value = data.nombre;
        document.getElementById('description').value = data.descripcion;
        document.getElementById('idAModificar').value = data.identificador;

    } catch (error) {
        console.log("Error", error);
    }
}

function editarPresentacion() {

    var formData = new FormData();
    formData.append("nombre", document.getElementById("name").value);
    formData.append("descripcion", document.getElementById("description").value);
    formData.append("idAModificar", document.getElementById("idAModificar").value);

    // Envío del formulario a través de JS
    fetch("../business/accionPresentacionActualizar.php", {
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

function alternarDiv() {

    let texto = document.getElementById("botonCambiar").textContent;

    if (texto === "Mostrar presentaciones eliminadas") {

        mostrarDiv();

    } else if (texto === "Ocultar presentaciones eliminadas") {

        ocultarDiv();

    } else {

        document.getElementById("botonCambiar").disabled = true;

    }

}

function mostrarDiv() {

    document.getElementById("divOculto").style.display = "block";
    document.getElementById("botonCambiar").textContent = "Ocultar presentaciones eliminadas";
}

function ocultarDiv() {

    document.getElementById("divOculto").style.display = "none";
    document.getElementById("botonCambiar").textContent = "Mostrar presentaciones eliminadas";
}

//Logica de botones
var form = document.getElementById("guardar");
var submitBtn = document.getElementById("boton-cargar");
var cancelBtn = document.getElementById("boton-cancelar");
cancelBtn.style.display = "none";

function cancelButton(event) {
    event.preventDefault();
    var result = confirm("Estás seguro de cancelar la edición de la presentación?");

    if (result) {
        location.replace("presentacion.php");
    }
}

function submitButton(event) {
    event.preventDefault();

    if (submitBtn.textContent === "Agregar presentación") {
        if (form && form.checkValidity()) {
            saveData();
        } else {
            form.reportValidity(); // Muestra los mensajes de validación del navegador
        }
    } else if (submitBtn.textContent === "Modificar presentación") {
        if (form && form.checkValidity()) {
            if (confirm("Deseas actualizar la presentación ingresada?")) {
                editarPresentacion(); // Envía el formulario si el usuario confirma
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
