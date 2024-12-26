<style>

    .div-search{
        text-align: right;
        }

        #search{
            width: 175px;
        }

       

        #listaDiv{
            text-align: left;
            position: fixed; 
            right: 0; 
            margin-right: 70px;
            margin-top: -8px;
        }

        ul {
            
            list-style-type: none;
            width: 175px;
            height: 10px;
        }

        li {
            background-color: #EEEEEE;
            border-top: 1px solid #ffff;
            padding: 6px;
            cursor: pointer;
        }
</style>

<form class="div-search">
<datalist id="autocomplete">
</datalist>
        <label for="searchCat">Buscar:</label>
        <input type="search" id='searchCat' list="autocomplete" name="searchCat" placeholder="Buscar Categoria" >
        <button type="button" onclick="busqueda()">Buscar</button>
       
</form>




<script>
    var mostrarInactivos = false;
  function enviarBuscador(event) {
    var palabra = event.target.value;
    buscarCategorias(palabra);
}

function buscarCategorias(searchTerm) {
    fetch('../business/accionCategoriaBuscar.php?action=search&searchCat=' + encodeURIComponent(searchTerm))
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
          const searchInput = document.getElementById('searchCat');
          searchInput.addEventListener('input', obtenerDatos);
           
            const inpuName=document.getElementById('nameCat');
            inpuName.addEventListener('input', enviarBuscador);
            inpuName.addEventListener('input', validarNombre);

            buscarCategorias("");
        });


        function busqueda() {
            let inpuName=document.getElementById('searchCat').value;
            buscarCategorias(inpuName);
           document.getElementById('searchCat').value='';
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




function obtenerDatos() {

let datos = document.getElementById("searchCat").value.trim();
let lista = document.getElementById("autocomplete");

if (datos.length > 0) {


    fetch("../business/accionCategoriaBuscar.php?action=autocomplete&search="+encodeURIComponent(datos), {
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


function seleccionar(word){
document.getElementById("searchCat").value = word;
document.getElementById("lista").style.display = 'none';
}



function validarNombre() {

let inputNombre = document.getElementById("nameCat");
let nombre = inputNombre.value;

if (nombre.length >= 3) {

    fetch("../business/accionCategoriaValidar.php?name="+encodeURIComponent(nombre), {
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
    mostrarInactivos ? actualizarTablaCategoria(data.disable) : actualizarTablaCategoria(data.category);
  }
</script>
//
