function deleteProduct(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        return;
    }
    fetch(`../business/accionProducto.php?action=deleteProduct&id=${encodeURIComponent(id)}`, {
        method: 'DELETE'
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                });
            }
        })
        .then(data => {
            console.log("Datos recibidos:", data);
            if (data.status === 'successful') {
                alert('Producto eliminado con éxito.');
                location.reload();
            } else {
                alert('No se pudo eliminar el producto.');
            }
        })
        .catch(error => console.error('Error:', error));
}

let isModifying = false;
function ModifyProduct(id) {
    if (isModifying) { return; }

    isModifying = true;
    const buttons = document.querySelectorAll('#btn-editar');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
    }

    fetch(`../business/accionProducto.php?action=getProduct&id=${id}`)
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.status === 'successful') {
                    document.querySelector('input[name="identificador-producto"]').value = data.product.identificador;
                    document.querySelector('input[name="nombre-producto"]').value = data.product.nombre;
                    document.querySelector('input[name="descripcion-producto"]').value = data.product.description;

                    document.querySelector('select[name="categoria-producto"]').value = data.product.categoria.identifier;
                    document.querySelector('select[name="unidad-medida"]').value = data.product.unidadmedida.identifier;
                    document.querySelector('select[name="presentacion"]').value = data.product.presentacion.identifier;
                    document.querySelector('select[name="proveedor"]').value = data.product.proveedor.identifier;

                    document.querySelector('#save').value = "Guardar cambios";
                    document.getElementById('btn-cancel').style.visibility = "visible";

                    const productForm = document.getElementById('product-form');
                    const url = `../business/accionProducto.php`;

                    productForm.setAttribute('action', url);

                    productForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        if (confirm('¿Estás seguro de actualizar el producto?')) {
                            const formData = new FormData(productForm);
                            const formObject = {};
                            formData.forEach((value, key) => {
                                formObject[key] = value;
                            });
                            const formJSON = JSON.stringify(formObject);

                            fetch('../business/accionProducto.php', {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: formJSON
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'successful') {
                                        alert(data.message);
                                        location.reload();
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => {
                                    alert("Error al actualizar los datos");
                                });
                        }
                    });
                } else {
                    console.error('Error:', data.message);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        })
        .catch(error => console.error('Error fetching product data:', error));
}


function cancelModiSupplier() {
    var supplierId = document.getElementById('identificador-producto').value;
    if (!supplierId) { //Si no tiene identificador no hay nada que cancelar
        return;
    }

    isModifying = false;
    alert("Se ha cancelado la modificación");
    window.location.href = 'productoVista.php';
}

/**
 * Se encarga de agregar un nuevo proveedor al sistema
 */
function addProduct() {

    document.getElementById('product-form').addEventListener('submit', function (event) {
        event.preventDefault();
        var productId = document.getElementById('identificador-producto').value;
        if (productId) { //Si esta tiene identificador es modificar
            return;
        }
        const formData = new FormData(this);

        fetch('../business/accionProducto.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'successful') {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Se produjo un error al procesar la solicitud.');
            });
    });
}

addProduct();


/**
 * Busca un producto por su nombre, siempre y cuando coincida con la busqueda del usuario.
 */
function searchProduct() {
    var search = document.getElementById('search-product').value;
    fetch(`../business/accionProducto.php?searchProduct=${encodeURIComponent(search)}`)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                });
            }
        })
        .then(data => {
            console.log("Datos recibidos:", data);
            updateTable(data.product);
        })
        .catch(error => console.error('Error:', error));
}

const inputSearch = document.getElementById('search-product');
inputSearch.addEventListener('input', function () {
    searchProduct();
});

/**
 * Se encarga de actualziar la tabla del front-end con los datos obtenidos de la BD
 * 
 * @param {*} productos Lista de todos los productos activos
 */
function updateTable(products) {
    // Obtén la referencia al cuerpo de la tabla y al mensaje de "No hay datos"
    const tbody = document.querySelector("#datatable tbody");

    // Limpia el cuerpo de la tabla
    tbody.innerHTML = '';

    if (products) {
        // Crea una nueva fila para cada producto
        products.forEach(product => {
            const row = document.createElement("tr");

            if(product.estado) {
                row.innerHTML = `
                <td>${product.nombre}</td>
                <td>${product.description}</td>
                <td>${product.categoria.name || 'N/D'}</td>
                <td>${product.unidadmedida.nameUnit || 'N/D'}</td>
                <td>${product.presentacion.name || 'N/D'}</td>
                <td>${product.proveedor.name || 'N/D'}</td>
                <td style="width: 150px;">
                    <div style="justify-content: space-between; display: flex;">
                        <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifyProduct('${product.identificador}')" id="btn-editar">Editar</button>
                        <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteProduct('${product.identificador}')">Eliminar</button>
                    </div>
                </td>
            `;
            } else {
                row.innerHTML = `
                <td>${product.nombre}</td>
                <td>${product.description}</td>
                <td>${product.categoria.name || 'N/D'}</td>
                <td>${product.unidadmedida.nameUnit || 'N/D'}</td>
                <td>${product.presentacion.name || 'N/D'}</td>
                <td>${product.proveedor.name || 'N/D'}</td>
                <td style="width: 150px;">
                    <div style="justify-content: space-between; display: flex;">
                        <button style="cursor: pointer;" type="button" onclick="habilitarProducto('${product.identificador}')" id="btn-habilitar">Habilitar</button>
                    </div>
                </td>
            `;
            }
            // Agrega la nueva fila al cuerpo de la tabla
            tbody.appendChild(row);
        });
    } else {
        const row = document.createElement('tr');
        row.innerHTML = `<div>No hay coincidencias</div>`;
        tbody.appendChild(row);
    }
}

var mostrarInactivos = false;
function mostrarProductos() {
    mostrarInactivos = mostrarInactivos ? false : true;
    var estado = 0;
    if (mostrarInactivos) { // Carga los productos inactivos
        // alert("Inactivos");
        estado = 0;
    } else if (!mostrarInactivos) { // Carga los productos activos
        // alert("activos");
        estado = 1;
    }

    fetch(`../business/accionProductoEstados.php?estado=${encodeURIComponent(estado)}`)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                });
            }
        })
        .then(data => {
            console.log('Data:', data);
            if (data.status === 'error') {
                console.log(data.message);
            } else {
                const tbody = document.getElementById("tbody-table");
                actualizarTablaProductosActivos(data, estado, tbody);
                const botonProductos = document.getElementById("btn-item-disable");
                const valor = mostrarInactivos ? 'Ver productos habilitados' : 'Ver productos deshabilitados';
                botonProductos.innerText = valor;
            }

        })
        .catch(error => console.error('Error:', error));
}

function actualizarTablaProductosActivos(data, estado, tbody) {
    tbody.innerHTML = "";
    if (estado === 1) {
        if (data) {
            // Crea una nueva fila para cada producto
            data.producto.forEach(product => {
                const row = document.createElement("tr");
    
                row.innerHTML = `
                    <td>${product.nombre}</td>
                    <td>${product.description}</td>
                    <td>${product.categoria.name || 'N/D'}</td>
                    <td>${product.unidadmedida.nameUnit || 'N/D'}</td>
                    <td>${product.presentacion.name || 'N/D'}</td>
                    <td>${product.proveedor.name || 'N/D'}</td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifyProduct('${product.identificador}')" id="btn-editar">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteProduct('${product.identificador}')">Eliminar</button>
                        </div>
                    </td>
                `;
                // Agrega la nueva fila al cuerpo de la tabla
                tbody.appendChild(row);
            });
        }
    } else {
        data.producto.forEach(product => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${product.nombre}</td>
                <td>${product.description}</td>
                <td>${product.categoria.name || 'N/D'}</td>
                <td>${product.unidadmedida.nameUnit || 'N/D'}</td>
                <td>${product.presentacion.name || 'N/D'}</td>
                <td>${product.proveedor.name || 'N/D'}</td>
                <td style="width: 150px;">
                    <div style="justify-content: space-between; display: flex;">
                        <button style="cursor: pointer;" type="button" onclick="habilitarProducto('${product.identificador}')" id="btn-habilitar">Habilitar</button>
                    </div>
                </td>
            `;
            // Agrega la nueva fila al cuerpo de la tabla
            tbody.appendChild(row);
        });
    }
}

function habilitarProducto(identificadorProducto) {
    const json = {
        identificador: identificadorProducto
    };
    fetch('../business/accionProductoEstados.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'successful') {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            alert("Error al habilita el producto");
        });
}

//Validar el nombre del producto
const inputNombre = document.getElementById('nombre-producto');
inputNombre.addEventListener('input', function () {
    let mensajes = document.getElementById("mensajes-usuario-nombre");
    verificarExistencia("name", inputNombre.value, mensajes);
});


function verificarExistencia(input, valor, mensajes) {
    
    fetch(`../business/accionProductoEstados.php?searchby=${encodeURIComponent(input)}&data=${encodeURIComponent(valor)}`)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                });
            }
        })
        .then(data => {
            if (data.status === 'successful' && data.exist === true) {
                mensajes.innerText = data.message;
            }else if(data.status === 'successful' && data.exist === false){
                mensajes.innerText = "";
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));

}

//Agregar imagenes

var selectedFiles = []; // Asegúrate de tener esta variable definida para almacenar los archivos

function addImageToList() {
    var input = document.getElementById('images');
    var imageList = document.getElementById('image-list');

    // Obtener el archivo seleccionado
    var file = input.files[0];

    if (file) {
        // Agregar el archivo a la lista de archivos seleccionados
        selectedFiles.push(file);

        // Crear un nuevo contenedor para el nombre del archivo y el botón
        var listItem = document.createElement('div');
        listItem.style.display = 'flex'; // Usar flexbox para alinear elementos
        listItem.style.justifyContent = 'space-between'; // Espaciado entre elementos
        listItem.style.alignItems = 'center'; // Centrar verticalmente
        listItem.style.marginBottom = '10px'; // Espacio debajo de cada elemento de lista

        // Crear un elemento de texto para mostrar el nombre del archivo
        var fileName = document.createElement('span');
        fileName.textContent = file.name;
        listItem.appendChild(fileName);

        // Crear un botón de eliminar
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Eliminar';
        removeButton.style.marginLeft = '10px'; // Mueve el botón a la derecha
        removeButton.onclick = function() {
            // Eliminar el archivo de la lista
            selectedFiles = selectedFiles.filter(f => f !== file);
            imageList.removeChild(listItem); // Remover el elemento de la lista

            // Verificar si no hay más imágenes y mostrar el mensaje
            if (selectedFiles.length === 0) {
                showNoImagesMessage();
            }
        };

        // Añadir el botón de eliminar al contenedor
        listItem.appendChild(removeButton);

        // Añadir el contenedor y la línea a la lista
        imageList.appendChild(listItem); // Añadir el contenedor a la lista

        // Limpiar el input para permitir agregar más imágenes
        input.value = ''; // Esto vacía el campo de entrada
        input.files = new DataTransfer().files;

        // Si es la primera imagen, quitar el mensaje de "No imágenes cargadas"
        if (selectedFiles.length === 1) {
            removeNoImagesMessage();
        }
    } else {
        alert("Por favor selecciona una imagen.");
    }
}

function showNoImagesMessage() {
    var imageList = document.getElementById('image-list');
    var noImagesMessage = document.createElement('div');
    noImagesMessage.id = 'no-images-message';
    noImagesMessage.textContent = 'No hay imágenes cargadas.';
    imageList.appendChild(noImagesMessage);
}

function removeNoImagesMessage() {
    var noImagesMessage = document.getElementById('no-images-message');
    if (noImagesMessage) {
        noImagesMessage.remove();
    }
}


// Función para abrir el modal
function addImage(identifier) {
    var modal = document.getElementById("modal-add-image");
    var hiddenInput = document.getElementById("identifierProduct");
    
    // Mostrar el modal
    modal.style.display = "block";
    
    // Guardar el identificador del producto en el campo oculto
    hiddenInput.value = identifier;
    showNoImagesMessage();
}

// Cerrar el modal al hacer clic en la 'X'
var closeModal = document.getElementsByClassName("close")[0];
closeModal.onclick = function() {
    var modal = document.getElementById("modal-add-image");
    modal.style.display = "none";
}

// Cerrar el modal al hacer clic fuera de él
window.onclick = function(event) {
    var modal = document.getElementById("modal-add-image");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.getElementById('form-upload-images').onsubmit = function(event) {
    // Prevenir el envío automático del formulario
    event.preventDefault();
    
    // Verificar si se han seleccionado al menos 4 imágenes
    if (selectedFiles.length < 4) {
        alert("Debes agregar al menos 4 imágenes.");
        return; // Evitar que el formulario se envíe si no hay suficientes imágenes
    }

    // Crear un objeto FormData para enviar los archivos
    var formData = new FormData(this);

    // Agregar todos los archivos seleccionados
    selectedFiles.forEach(function(file, index) {
        formData.append('images[]', file);
    });

    var idP = document.getElementById('identifierProduct');

    formData.append('identifier', idP.value);
    // Enviar los datos con fetch (o puedes usar el comportamiento predeterminado de los formularios)
    fetch("../business/accionProductoAgregarImagen.php", {
        method: 'POST',
        body: formData
    }).then(response => {
        return response.text();
    }).then(result => {
        
        alert('Imágenes guardadas con éxito');
    }).catch(error => {
        console.error(error);
        alert('Error al subir las imágenes');
    });
};