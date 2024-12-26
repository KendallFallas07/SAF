/**
 * @author Daniel Briones
 * @version 1.0.0
 * @since 16-08-24
 */



/**
 * Busca un proveedor por su nombre, siempre y cuando coincida con la busqueda del usuario.
 */
function searchByName() {
    var name = document.getElementById('searchSupplier').value;

    fetch(`../business/accionProveedor.php?searchSupplier=${encodeURIComponent(name)}`)
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
            updateTable(data.suppliers);
        })
        .catch(error => console.error('Error:', error));
}

const inputSearch = document.getElementById('searchSupplier');
inputSearch.addEventListener('input', function () {
    searchByName();
});



/**
 * Se encarga de actualziar la tabla del front-end con los datos obtenidos de la BD
 * 
 * @param {*} proveedores Lista de todos los proveedores activos
 */
function updateTable(proveedores) {
    const tableBody = document.querySelector('#datatable tbody');
    tableBody.innerHTML = '';

    if (Array.isArray(proveedores)) {
        if (proveedores.length !== 0) {
            proveedores.forEach(proveedor => {
                const row = document.createElement('tr');
                if (proveedor.status) {
                    row.innerHTML = `
                        <td>${proveedor.name || 'N/A'}</td>
                        <td>${proveedor.phone.phone || 'N/A'}</td>
                        <td>${proveedor.email.email || 'N/A'}</td>
                        <td>${proveedor.supplierType.nameType || 'N/A'}</td>
                        <td>${proveedor.supplierDirection.distict.postalCode || 'N/A'}</td>
                        <td>${proveedor.supplierDirection.signalDirection || 'N/A'}</td>
                        <td style="width: 150px;">
                            <div style="justify-content: space-between; display: flex;">
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifySupplier('${proveedor.identifier}')" id="btn-editar">Editar</button>
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button" 
                                onclick="deleteSupplier('${proveedor.identifier}')">Eliminar</button>
                                
                            </div>
                        </td>
                    `;
                } else {
                    row.innerHTML = `
                        <td>${proveedor.name || 'N/A'}</td>
                        <td>${proveedor.phone.phone || 'N/A'}</td>
                        <td>${proveedor.email.email || 'N/A'}</td>
                        <td>${proveedor.supplierType.nameType || 'N/A'}</td>
                        <td>${proveedor.supplierDirection.distict.postalCode || 'N/A'}</td>
                        <td>${proveedor.supplierDirection.signalDirection || 'N/A'}</td>
                        <td style="width: 150px;">
                            <div style="justify-content: space-between; display: flex;">
                                <button style="cursor: pointer;" type="button" onclick="habilitarProveedor('${proveedor.identifier}')" id="btn-habilitar">Habilitar</button>
                            </div>
                        </td>
                    `;
                }
                tableBody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = `<div>No hay coincidencias</div>`;
            tableBody.appendChild(row);
        }
    } else {
        console.error('Los datos no son un array:', proveedores);
    }
}


/**
 * Se encarga de eliminar un proveedor por su identificador
 * 
 * @param string identificador del proveedor que se desea eliminar
 */
function deleteSupplier(identificador) {
    if (!confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
        return;
    }
    fetch(`../business/accionProveedor.php?action=deleteSupplier&id=${encodeURIComponent(identificador)}`, {
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
                alert('Proveedor eliminado con éxito.');
                location.reload();
            } else {
                alert('No se pudo eliminar el proveedor.');
            }
        })
        .catch(error => console.error('Error:', error));
}

/**
 * Se encarga de cargar en un formulario los datos del proveedor 
 * 
 * @param string id 
 */
let isModifying = false;
function ModifySupplier(id) {
    if (isModifying) { return; }

    isModifying = true;
    const buttons = document.querySelectorAll('#btn-editar');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
    }

    fetch(`../business/accionProveedor.php?action=getSupplier&id=${id}`)
        .then(response => response.text())
        .then(text => {

            try {
                const data = JSON.parse(text);
                if (data.status === 'successful') {
                    document.querySelector('input[name="name"]').value = data.supplier.name;
                    document.querySelector('input[name="phone"]').value = data.supplier.phone.phone;
                    document.querySelector('input[name="email"]').value = data.supplier.email.email;
                    document.querySelector('input[name="direction"]').value = data.supplier.supplierDirection.signalDirection;
                    document.querySelector('input[name="postalCode"]').value = data.supplier.supplierDirection.distict.postalCode;
                    document.querySelector('input[name="supplierId"]').value = data.supplier.identifier;

                    document.querySelector('#save').value = "Guardar cambios";
                    document.getElementById('btn-cancel').style.visibility = "visible";

                    updateLocationFields(data);

                    var formElement = document.getElementById('proveedorForm');

                    var url = `../business/accionProveedor.php`;
                    formElement.setAttribute('action', url);

                    formElement.addEventListener('submit', function (e) {
                        e.preventDefault();
                        if (confirm('¿Estás seguro de finalizar la edición del proveedor?')) {
                            const formData = new FormData(formElement);
                            const formObject = {};
                            formData.forEach((value, key) => {
                                formObject[key] = value;
                            });
                            const formJSON = JSON.stringify(formObject);

                            fetch('../business/accionProveedor.php', {
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
        .catch(error => console.error('Error fetching supplier data:', error));
}


function updateLocationFields(dataParam) {
    // Implementar la lógica para actualizar los campos de ubicación
    // Por ejemplo, cargar el país, provincia, cantón, distrito desde la respuesta
    // Y actualizar los selectores correspondientes
    // Selecciona el país

    // Tipo de proveedor
    const supplierTypeSelect = document.querySelector('select[name="supplierType"]');
    supplierTypeSelect.value = dataParam.supplier.supplierType.identifier;
    if (!supplierTypeSelect.value) { console.error('El tipo de proveedor no coincide con ninguna opción disponible.'); }

    //Pais
    const pais = document.querySelector('select[name="country"]');
    pais.value = dataParam.pais;
    if (!pais.value) { console.error('No se encontro el país del proveedor.'); }

    //Provincia
    fetch(`../business/accionCanton.php?countryIdent=${pais.value}`)

        .then(response => response.json())
        .then(data => {

            if (data.success) {
                getProvince(data.provinces);
                const provincia = document.querySelector('select[name="province"]');
                provincia.value = dataParam.provincia;
                if (!provincia.value) { console.error('No se puedo encontrar la provincia'); }
                //Cantones
                fetch(`../business/accionCanton.php?provinceIdent=${dataParam.provincia}`)
                    .then(response => response.json())
                    .then(datacanton => {
                        getCanton(datacanton.cantons);
                        const canton = document.querySelector('select[name="canton"]');
                        canton.value = dataParam.canton;
                        if (!canton.value) { console.error("No se pueden cargar los cantones"); }
                        //Distritos
                        fetch(`../business/accionDistrito.php?cantonIdent=${dataParam.canton}`)
                            .then(response => response.json())
                            .then(datadistrito => {
                                console.log(datadistrito);
                                getDistrict(datadistrito.district);
                                const distrito = document.querySelector('select[name="district"]');
                                distrito.value = dataParam.distrito;
                                if (!distrito.value) { console.error('El distrito no coincide con ninguna opción disponible. ' + dataParam.distrito); }
                            })
                            .catch(error => console.error('Error fetching districts:', error));
                    })
                    .catch(error => console.error('Error fetching cantons:', error));
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error fetching cantons:', error))

}


/**
 * Se encarga de agregar un nuevo proveedor al sistema
 */
function addSupplier() {

    document.getElementById('proveedorForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var supplierId = document.getElementById('supplierId').value;
        if (supplierId) { //Si esta tiene identificador es modificar
            return;
        }
        const formData = new FormData(this);

        fetch('../business/accionProveedor.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'succesful') {
                    alert(data.message);
                    window.location.href = 'proveedorVista.php';
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

addSupplier();


/**
 * 
 * Se encarga de cancelar la modificación del proveedor seleccionado.
 */
function cancelModiSupplier() {
    var supplierId = document.getElementById('supplierId').value;
    if (!supplierId) { //Si no tiene identificador no hay nada que cancelar
        return;
    }

    alert("Se ha cancelado la modificación");
    window.location.href = 'proveedorVista.php';
}

var mostrarInactivos = false;
function mostrarProveedores() {
    mostrarInactivos = mostrarInactivos ? false : true;
    var estado = 0;
    if (mostrarInactivos) { // Carga los proveedores inactivos
        // alert("Inactivos");
        estado = 0;
    } else if (!mostrarInactivos) { // Carga los proveedores activos
        // alert("activos");
        estado = 1;
    }

    fetch(`../business/accionProveedorEstados.php?estado=${encodeURIComponent(estado)}`)
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
                actualizarTablaProveedoresActivos(data, estado, tbody);
                const botonProveedores = document.getElementById("btn-viewDisable");
                const valor = mostrarInactivos ? 'Ver proveedores habilitados' : 'Ver proveedores deshabilitados';
                botonProveedores.innerText = valor;
            }

        })
        .catch(error => console.error('Error:', error));
}

function actualizarTablaProveedoresActivos(data, estado, tbody) {
    tbody.innerHTML = "";
    if (estado === 1) {
        data.supplier.forEach(proveedor => {
            const row = document.createElement('tr');
            row.innerHTML = `
                    <td>${proveedor.name || 'N/A'}</td>
                    <td>${proveedor.phone.phone || 'N/A'}</td>
                    <td>${proveedor.email.email || 'N/A'}</td>
                    <td>${proveedor.supplierType.nameType || 'N/A'}</td>
                    <td>${proveedor.supplierDirection.distict.postalCode || 'N/A'}</td>
                    <td>${proveedor.supplierDirection.signalDirection || 'N/A'}</td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="ModifySupplier('${proveedor.identifier}')" id="btn-editar">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" 
                            onclick="deleteSupplier('${proveedor.identifier}')">Eliminar</button>
                            
                        </div>
                    </td>
                `;
            tbody.appendChild(row);
        });
    } else {
        data.supplier.forEach(proveedor => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${proveedor.name || 'N/A'}</td>
                <td>${proveedor.phone.phone || 'N/A'}</td>
                <td>${proveedor.email.email || 'N/A'}</td>
                <td>${proveedor.supplierType.nameType || 'N/A'}</td>
                <td>${proveedor.supplierDirection.distict.postalCode || 'N/A'}</td>
                <td>${proveedor.supplierDirection.signalDirection || 'N/A'}</td>
                <td style="width: 150px;">
                    <div style="justify-content: space-between; display: flex;">
                        <button style="cursor: pointer;" type="button" onclick="habilitarProveedor('${proveedor.identifier}')" id="btn-habilitar">Habilitar</button>
                    </div>
                </td>
                `;
            tbody.appendChild(row);
        });
    }
}

function habilitarProveedor(identificadorProveedor) {
    const json = {
        identificador: identificadorProveedor
    };
    fetch('../business/accionProveedorEstados.php', {
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
            alert("Error al habilita el proveedor");
        });
}

//Validar el nombre del proveedor
const inputNombre = document.getElementById('newName');
inputNombre.addEventListener('input', function () {
    // searchByName();
    let mensajes = document.getElementById("mensajes-usuario-nombre");
    verificarExistencia("name", inputNombre.value, mensajes);
});

//Validar el telefono del proveedor
const inputTelefono = document.getElementById('newPhone');
inputTelefono.addEventListener('input', function () {
    // searchByName();
    let mensajes = document.getElementById("mensajes-usuario-telefono");
    verificarExistencia("phone", inputTelefono.value, mensajes);
});

//Validar el correo del proveedor
const inputCorreo = document.getElementById('newEmail');
inputCorreo.addEventListener('input', function () {
    // searchByName();
    let mensajes = document.getElementById("mensajes-usuario-correo");
    verificarExistencia("mail", inputCorreo.value, mensajes);
});


function verificarExistencia(input, valor, mensajes) {
    
    fetch(`../business/accionProveedorEstados.php?searchby=${encodeURIComponent(input)}&data=${encodeURIComponent(valor)}`)
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