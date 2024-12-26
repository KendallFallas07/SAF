
/**
 * @param string 
 */

document.getElementById("data").addEventListener("keyup", obtenerDatos);

function obtenerDatos() {
  let datos = document.getElementById("data").value.trim();
  let lista = document.getElementById("lista"); 

  if (datos.length > 0) {
      let url = "../business/accionLoteBuscar.php";
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

// Funcion para obtener la fecha en formato YYYY-MM-DD
function obtenerFechaFormateada(fecha) {
    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0');
    const dia = String(fecha.getDate()).padStart(2, '0');
    return `${anio}-${mes}-${dia}`;
}

// Funcion para obtener la fecha del dia siguiente en formato YYYY-MM-DD
function obtenerFechaSiguiente(fecha) {
    const siguienteDia = new Date(fecha);
    siguienteDia.setDate(fecha.getDate() + 1);
    return obtenerFechaFormateada(siguienteDia);
}

// Funcion para establecer las fechas minimas en "Fecha Expiracion"
function establecerFechasMinimas() {
    const fechaAdquisicion = document.getElementById('FechaAdquisicion');
    const fechaExpiracion = document.getElementById('FechaExp');

    // Establecer la fecha minima para "Fecha Adquisicion" como la fecha actual
    const hoy = new Date();
    fechaAdquisicion.setAttribute('min', obtenerFechaFormateada(hoy));

    // Establecer la fecha minima para "Fecha Expiracion" como la fecha actual + 1 dia
    fechaExpiracion.setAttribute('min', obtenerFechaSiguiente(hoy));

    // Funcion para habilitar/deshabilitar "Fecha Expiracion" y ajustar su fecha minima
    function alternarCampoExpiracion() {
        if (fechaAdquisicion.value) {
            const fechaAdq = new Date(fechaAdquisicion.value);
            fechaExpiracion.disabled = false;
            const fechaMinimaExpiracion = obtenerFechaSiguiente(fechaAdq);
            fechaExpiracion.setAttribute('min', fechaMinimaExpiracion);

            // Validar la fecha de expiracion actual
            if (fechaExpiracion.value) {
                const fechaExp = new Date(fechaExpiracion.value);
                if (fechaExp <= fechaAdq) {
                    // Si la fecha de expiracion es menor o igual a la fecha de adquisicion, limpiar el campo
                    fechaExpiracion.value = '';
                }
            }
        } else {
            fechaExpiracion.disabled = true;
            fechaExpiracion.value = ''; // Limpiar el valor si se deshabilita
        }
    }

    // Llamar a la funcion al cargar la pagina
    alternarCampoExpiracion();

    // Actualizar la fecha minima y habilitar/deshabilitar el campo cuando cambia "Fecha de Compra"
    fechaAdquisicion.addEventListener('change', alternarCampoExpiracion);
}

// Funcion para habilitar/deshabilitar el campo "Fecha Expiracion" durante la edicion
function manejarEdicion() {
    const fechaAdquisicion = document.getElementById('FechaAdquisicion');
    const fechaExpiracion = document.getElementById('FechaExp');

    // Habilitar el campo "Fecha Expiracion" si hay una fecha de adquisicion seleccionada
    if (fechaAdquisicion.value) {
        fechaExpiracion.disabled = false;
        // Actualizar la fecha minima de "Fecha Expiracion"
        fechaExpiracion.setAttribute('min', obtenerFechaSiguiente(new Date(fechaAdquisicion.value)));
    } else {
        fechaExpiracion.disabled = true;
        fechaExpiracion.value = ''; // Limpiar el valor si se deshabilita
    }
}

// Inicializar el script cuando el DOM este completamente cargado
document.addEventListener('DOMContentLoaded', () => {
    establecerFechasMinimas();
    manejarEdicion();
});
function deleteLote(identifierLot) {
    // Confirmación antes de eliminar
    if (!confirm("¿Estás seguro de que deseas eliminar este lote?")) {
        return;
    }

    fetch(`../business/accionLoteEliminar.php?code=${encodeURIComponent(identifierLot)}`, {
        method: 'GET'
    })
            .then(response => response.json())
            .then(data => {

                alert(data.message);
                location.reload();

            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al intentar eliminar el Lote.');
            });
}

function mostrarAlertaYRecargar(mensaje) {
    alert(mensaje);
    location.reload();
}


function saveData(event, id) {
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

function cancel(event) {
    event.preventDefault();
    location.reload();
}


function editData(event, id) {
    event.preventDefault();
    
    if (confirm("Desea Guardar Los cambios Realizados en el Lote?")) {
        const form = document.getElementById(id);
        const formData = new FormData(form);

        fetch("../business/accionLoteEditar.php", {
            method: form.method,
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); 
        })
        .then(data => {
            alert(data.message);
            // Redirigir o actualizar el contenido según sea necesario
             Ejemplo: window.location.href = "./lote.php";
        })
        .catch(error => {
            alert('Hubo un problema con la solicitud: ' + error.message);
        });
    }
}



