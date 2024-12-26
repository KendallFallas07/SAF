var mostrarInactivos = false;

function saveUnitType(event, id) {
    event.preventDefault();
    if (confirm("Desea guardar el tipo de unidad en el sistema?")) {
        form = document.getElementById(id);
        formData = new FormData(form);

        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json(); 
        }).then(function (data) {
            alert(data.message);

            if(data.code === 1){
                window.location.href='../view/tipoUnidadVista.php';
            }
           
        });
    }
}



/**
 * 
 * 
 * @param string identificador de la unidad que se desea eliminar
 */
function deleteUnitType(identifierUnit) {

    if (!confirm("¿Estás seguro de que deseas eliminar este tipo de unidad?")) {
        return;
    }


    fetch(`../business/accionTipoUnidadEliminar.php?identifierUnit=${encodeURIComponent(identifierUnit)}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
      

        alert(data.message);
        window.location.href='../view/tipoUnidadVista.php';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al intentar eliminar la unidad.');
    });
}



function selectUnitType(identifierCat) {
    document.getElementById('btn-save').style.visibility = "hidden";
    document.getElementById('btn-finish').style.visibility = "visible";
    document.getElementById('btn-cancel').style.visibility = "visible";

    fetch(`../business/accionTipoUnidadModificar.php?identifierUnit=${encodeURIComponent(identifierCat)}`, {
        method: 'GET'
    })
    .then(response => response.json())  
    .then(data => {
        console.log(data);  

        if (data.unitType && data.unitType.name) {
            document.querySelector('input[name="nameUnit"]').value = data.unitType.name;
            document.querySelector('input[name="descriptionUnit"]').value = data.unitType.description;
            document.querySelector('input[name="identifier"]').value = data.unitType.identifier;
            verAsociados(data.unitType.identifier);
        } else {
            alert('No se encontraron datos de la unidad.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al intentar conseguir los datos de la unidad.');
    });
}


function cancel(event){
    event.preventDefault();
    window.location.href='../view/tipoUnidadVista.php';
}


function editData(event, id) {
    event.preventDefault();
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        form = document.getElementById(id);
        form.action='../business/accionTipoUnidadModificar.php';
        formData = new FormData(form);

        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json(); 
        }).then(function (data) {
            alert(data.message);
            if(data.code === 1){
                window.location.href='../view/tipoUnidadVista.php';
            }
            
        }).catch(function (error) {
            alert(error);
        });
    }
}



function enviarBuscador(event) {
    var palabra = event.target.value;
    buscarSubcategorias(palabra);
}

function buscarPalabra(){
   let word=document.getElementById("search").value;
    buscarSubcategorias(word);
    document.getElementById("search").value='';
}


function buscarSubcategorias(searchTerm) {
    fetch('../business/accionTipoUnidadBuscar.php?action=search&searchUnit=' + encodeURIComponent(searchTerm))
                .then(response => {
                  
                    return response.json();
                })
                .then(data => {
                   
                    dataStatus(data);

                  
                })
                .catch(error => {
                    console.error('Error', error);
                });
   
}



function actualizarTablaUnitType(data){
    var tbody = document.querySelector("#datatable tbody");
            tbody.innerHTML = "";

            data.forEach(function(unit) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${unit.name}</td>
                    <td>${unit.description}</td>
                `;

                if(mostrarInactivos){
                    row.innerHTML += `
                  <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="cargar('${unit.id}')">Recuperar</button>
                        </div>
                    </td>
                `;
                }else{
                    row.innerHTML += `
                         <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="selectUnitType('${unit.id}')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteUnitType('${unit.id}')">Eliminar</button>
                        </div>
                    </td>
                    `;
                }

                tbody.appendChild(row);
            });
}

function actualizarTablaUnitTypeDesh(data){
    var tbody = document.querySelector("#datatable-disable tbody");
            tbody.innerHTML = "";

            data.forEach(function(unit) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${unit.name}</td>
                    <td>${unit.description}</td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="cargar('${unit.id}')">Recuperar</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
}

document.addEventListener('DOMContentLoaded', () => {
  
            const inpuName=document.getElementById('nameUnit');
            inpuName.addEventListener('input', enviarBuscador);
            inpuName.addEventListener('input', validarNombre);
            
            const inpuSe=document.getElementById('search');
            inpuSe.addEventListener('input', obtenerDatos);

            buscarSubcategorias("");
        });



        
        document.getElementById('btn-viewDisableUnit').addEventListener('click', function () {
        
            mostrarInactivos=!mostrarInactivos;
      
       let message;
   
       if(mostrarInactivos){
        this.textContent = 'Ocultar Unidades eliminadas';
        message = 'viewDisable';
    }else{
        this.textContent = 'Ver Unidades eliminadas';
         message = 'search';
        }
          
                
                
                fetch('../business/accionTipoUnidadBuscar.php?action='+encodeURIComponent(message))
                .then(response => {
                  
                    return response.json();
                })
                .then(data => {
                   
                    dataStatus(data);
        
                  
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        
            
        });




        function cargar(id) {
            if(confirm('Estas seguro que quieres habilitar este tipo de unidad?')){
                fetch('../business/accionTipoUnidadBuscar.php?action=enableUnit&id='+ encodeURIComponent(id))
                .then(response => {
                  
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    console.log(data);
                    if(data.code ===1){
                    dataStatus(data);
                    }
                })
                .catch(error => {
                    console.error('Error', error);
                });
                }
        }


        function obtenerDatos() {

            let datos = document.getElementById("search").value.trim();
            let lista = document.getElementById("autocomplete");
        
            if (datos.length > 0) {
        
        
                fetch("../business/accionTipoUnidadBuscar.php?action=autocomplete&search="+encodeURIComponent(datos), {
                    method: "GET",
                    mode: "cors"
                }).then(response => response.json())
                    .then(data => {
        
                        lista.innerHTML = data.list;
                    })
                    .catch(err => console.log(err))
        
            } else {
                lista.style.display = 'none';
            }
        }


        function verAsociados(valor) {

            let lista = document.getElementById("listaSimilar");
            let div = document.getElementById("list-similar");
        
                fetch("../business/accionTipoUnidadBuscar.php?action=listComplete&search="+encodeURIComponent(valor), {
                    method: "GET",
                    mode: "cors"
                }).then(response => response.json())
                    .then(data => {
                        div.style.visibility = 'visible';
                        lista.style.display = 'block';
                        lista.innerHTML = data.list;
                    })
                    .catch(err => console.log(err))
        
           
        }
        

        function seleccionar(word){
        document.getElementById("search").value = word;
        document.getElementById("lista").style.display = 'none';
        }



        function validarNombre() {

            let inputNombre = document.getElementById("nameUnit");
            let nombre = inputNombre.value;
        
            if (nombre.length >= 3) {
        
                fetch("../business/accionTipoUnidadValidar.php?name="+encodeURIComponent(nombre), {
                    method: "GET",
                    mode: "cors"
                }).then(response => response.json())
                    .then(data => {
                    console.log(data);
                        if (data === 'El nombre ingresado ya se encuentra registrado, intenta con otro nombre.') {
                            let span=document.getElementById('message');
                            span.style.color ='red';
                            span.textContent = 'Nombre ya registrado';
                            span.style.visibility = 'visible';
                            let button=document.getElementById('btn-save');
                            button.disabled = true;
        
        
                        } else {
                            let span=document.getElementById('message');
                            span.style.color = 'green';
                            span.textContent = 'Nombre Valido';
                            span.style.visibility = 'visible';
                            let button=document.getElementById('btn-save');
                            button.disabled = false;
                           // inputNombre.setCustomValidity(''); 
                           // inputNombre.reportValidity();
                        }
                    })
                    .catch(err => console.log(err))
        
            }else{
                let span=document.getElementById('message');
                span.style.visibility = 'hidden';
                let button=document.getElementById('btn-save');
                button.disabled = false;
            }
        
        }

        function dataStatus(data) {
            mostrarInactivos ? actualizarTablaUnitType(data.disable) : actualizarTablaUnitType(data.unit);
            if (mostrarInactivos) {
              document.getElementById('title-table').textContent = 'Tipo de unidades Inactivos';
            } else {
              document.getElementById('title-table').textContent = 'Tipo de unidades Activos';
            }
          }