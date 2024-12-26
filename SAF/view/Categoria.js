var mostrarInactivos = false;

function saveCategory(event, id) {
    event.preventDefault();
    if (confirm("Desea guardar la categoria en el sistema?")) {
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




/**
 * 
 * 
 * @param string identificador de la categoria que se desea eliminar
 */
function deleteCategory(identifierCat) {

    if (!confirm("¿Estás seguro de que deseas eliminar esta categoría?")) {
        return;
    }


    fetch(`../business/accionCategoriaEliminar.php?identifierCat=${encodeURIComponent(identifierCat)}`, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {


            alert(data.message);
            window.location.href = '../view/categoriaVista.php';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al intentar eliminar la categoría.');
        });
}



function selectCategory(identifierCat) {
    document.getElementById('btn-save').style.visibility = "hidden";
    document.getElementById('btn-finish').style.visibility = "visible";
    document.getElementById('btn-cancel').style.visibility = "visible";

    fetch(`../business/accionCategoriaModificar.php?identifierCat=${encodeURIComponent(identifierCat)}`, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.Category && data.Category.name) {
                document.querySelector('input[name="nameCat"]').value = data.Category.name;
                document.querySelector('input[name="descriptionCat"]').value = data.Category.description;
                document.querySelector('input[name="identifier"]').value = data.Category.identifier;
            } else {
                alert('No se encontraron datos de la categoría.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al intentar conseguir los datos de la categoría.');
        });
}


function cancel(event) {
    event.preventDefault();
    location.reload();
}


function editData(event, id) {
    event.preventDefault();
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        form = document.getElementById(id);
        form.action = '../business/accionCategoriaModificar.php';
        formData = new FormData(form);

        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            alert(data.message);
            window.location.href = '../view/categoriaVista.php';
        }).catch(function (error) {
            alert(error);
        });
    }
}

function statusAction(action) {
    var disableTableDiv = document.getElementById('disable-table');
    disableTableDiv.style.visibility = action;
}


document.getElementById('btn-viewDisable').addEventListener('click', function () {
   
    mostrarInactivos=!mostrarInactivos;
      
    let message;

    if(mostrarInactivos){
     this.textContent = 'Ocultar Categorias eliminadas';
     message = 'viewDisable';
 }else{
    this.textContent = 'Ver Categorias eliminadas';
      message = 'search';
     }
    
        fetch('../business/accionCategoriaBuscar.php?action='+encodeURIComponent(message))
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


function actualizarTablaCategoriaDesh(data){
    var tbody = document.querySelector("#disabled-table tbody");
            tbody.innerHTML = "";

            data.forEach(function(category) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${category.name}</td>
                    <td>${category.description}</td>
                    <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                           <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="enableCategory('${category.id}')">Recuperar</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
}


function enableCategory(id) {

    if(confirm('Estas seguro que quieres habilitar esta categoria?')){
    fetch('../business/accionCategoriaBuscar.php?action=enableCategory&id='+ encodeURIComponent(id))
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

function actualizarTablaCategoria(data){
    var tbody = document.querySelector("#datatable tbody");
            tbody.innerHTML = "";

            data.forEach(function(category) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td>${category.name}</td>
                    <td>${category.description}</td>
                `;

                if(mostrarInactivos){
                    row.innerHTML += `
                   <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                           <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="enableCategory('${category.id}')">Recuperar</button>
                        </div>
                    </td>
                `;
                }else{
                    row.innerHTML += `
                        <td style="width: 150px;">
                        <div style="justify-content: space-between; display: flex;">
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="selectCategory('${category.id}')">Editar</button>
                            <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteCategory('${category.id}')">Eliminar</button>
                        </div>
                    </td>
                    `;
                }


                tbody.appendChild(row);
            });
}

function dataStatus(data) {
    mostrarInactivos ? actualizarTablaCategoria(data.disable) : actualizarTablaCategoria(data.category);
    if (mostrarInactivos) {
      document.getElementById('title-table').textContent = 'Categorias Inactivas';
    } else {
      document.getElementById('title-table').textContent = 'Categorias Activas';
    }
  }