var mostrarInactivos = false;

function saveSubcategory(event, id) {
    event.preventDefault();
    if (confirm("Desea guardar la Subcategoria en el sistema?")) {
        form = document.getElementById(id);
        formData = new FormData(form);
        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            alert(data.message);
            if (data.code === 1) {
                window.location.reload();
            }
        });
    }
}


//habilitar o no la vista

function enviarBuscador(event) {
    var palabra = event.target.value;
    buscarSubcategorias(palabra);
}

function enviarBuscadorAuto() {
    buscarSubcategorias(document.getElementById("search").value);
    document.getElementById("search").value='';
}

function buscarSubcategorias(searchTerm) {
    fetch('../business/accionSubcategoriaBuscar.php?action=search&searchSubcat=' + encodeURIComponent(searchTerm))
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

document.addEventListener('DOMContentLoaded', () => {
    /*
            const searchInput = document.getElementById('searchCat');
            searchInput.addEventListener('input', enviarBuscador);
           */
            const inpuName=document.getElementById('nameSubCat');
            inpuName.addEventListener('input', enviarBuscador);

            inpuName.addEventListener('input', validarNombre);

            const inpuDesc=document.getElementById('search');
            inpuDesc.addEventListener('input', obtenerDatos);

            buscarSubcategorias("");
        });


        function actualizarTablaSubCat(data){
            var tbody = document.querySelector("#enable-table tbody");
                    tbody.innerHTML = "";

                    data.forEach(function(subCat) {
                        var row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${subCat.name}</td>
                            <td>${subCat.description}</td>
                            <td>${subCat.categoria}</td>
                        `;
                        if(mostrarInactivos){
                            row.innerHTML += `
                           <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="habilitarSubcat('${subCat.id}')">Recuperar</button>
                           
                        </div>
                    </td>
                        `;
                        }else{
                            row.innerHTML += `
                                <td style="width: 150px;">
                                <div style="justify-content: space-between; display: flex;">
                                    <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="selectSubategory('${subCat.id}')">Editar</button>
                                    <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteSubcategory('${subCat.id}')">Eliminar</button>
                                </div>
                            </td>
                            `;
                        }
                        tbody.appendChild(row);
                    });
        }



/**
 * 
 * 
 * @param string identificador de la subcategoria que se desea eliminar
 */
function deleteSubcategory(identifierCat) {

    if (!confirm("¿Estás seguro de que deseas eliminar esta subcategoria?")) {
        return;
    }


    fetch(`../business/accionSubcategoriaCrear.php?identifierSubcat=${encodeURIComponent(identifierCat)}`, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {


            alert(data.message);
            window.location.href = '../view/subCategoriaVista.php';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al intentar eliminar la subCategoria.');
        });
}

function selectSubategory(identifierSubcat) {
    document.getElementById('btn-save').style.visibility = "hidden";
    document.getElementById('btn-finish').style.visibility = "visible";
    document.getElementById('btn-cancel').style.visibility = "visible";

    fetch(`../business/accionSubCategoriaEditar.php?identifierSubcat=${encodeURIComponent(identifierSubcat)}`, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.subcat) {
                document.querySelector('input[name="nameSubCat"]').value = data.subcat.name;
                document.querySelector('input[name="descriptionSubCat"]').value = data.subcat.description;
                document.querySelector('input[name="identifier"]').value = data.subcat.id;
                document.querySelector('select[name="categorySelect"]').value = data.subcat.categoria;
            } else {
                alert('No se encontraron datos de la subcategoria.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al intentar conseguir los datos de la subcategoria.');
        });
}

function cancel(event) {
    event.preventDefault();
    window.location.href = '../view/subCategoriaVista.php';
}


function editData(event, id) {
    event.preventDefault();
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        form = document.getElementById(id);
        form.action = '../business/accionSubCategoriaEditar.php';
        formData = new FormData(form);

        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            alert(data.message);
            if (data.code === 1) {
                window.location.href = '../view/subCategoriaVista.php';
            }
        }).catch(function (error) {
            alert(error);
        });
    }
}


function dataStatus(data) {
  mostrarInactivos ? actualizarTablaSubCat(data.disable) : actualizarTablaSubCat(data.subCat);
  if (mostrarInactivos) {
    document.getElementById('title-table').textContent = 'Subcategorias Inactivas';
  } else {
    document.getElementById('title-table').textContent = 'Subcategorias Activas';
  }
}



document.getElementById('btn-viewDisableSub').addEventListener('click', function () {

       mostrarInactivos=!mostrarInactivos;
      
       let message;
   
       if(mostrarInactivos){
        this.textContent= 'Ocultar subCategorias eliminadas';
        message = 'viewDisable';
    }else{
        this.textContent  = 'Ver subCategorias eliminadas';
         message = 'search';
        }
       
        fetch('../business/accionSubcategoriaBuscar.php?action='+encodeURIComponent(message))
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



function actualizarTablaSubCatDesh(data){
    var tbody = document.querySelector("#disable-table tbody");
            tbody.innerHTML = "";

            data.forEach(function(subCat) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${subCat.name}</td>
                    <td>${subCat.description}</td>
                    <td>${subCat.categoria}</td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="habilitarSubcat('${subCat.id}')">Recuperar</button>
                           
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
}


function habilitarSubcat(indentificador){
    if(confirm('Estas seguro que quieres habilitar esta subCategoria?')){
        fetch('../business/accionSubcategoriaBuscar.php?action=enableSubcat&id='+ encodeURIComponent(indentificador))
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


        fetch("../business/accionSubcategoriaBuscar.php?action=autocomplete&search="+encodeURIComponent(datos), {
            method: "GET",
            mode: "cors"
        }).then(response => response.json())
            .then(data => {

               // lista.style.display = 'block';
                lista.innerHTML = data.list;
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none';
    }
}



function cargar(id) {
    document.getElementById("search").value = id;
    lista.style.display = 'none';
}



function validarNombre() {

    let inputNombre = document.getElementById("nameSubCat");
    let nombre = inputNombre.value;

    if (nombre.length >= 3) {

        fetch("../business/accionSubcategoriaValidar.php?name="+encodeURIComponent(nombre), {
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

                    /*
                    inputNombre.setCustomValidity(data);
                    inputNombre.reportValidity();*/

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