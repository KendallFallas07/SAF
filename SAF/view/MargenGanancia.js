var mostrarInactivos = false;
function saveMargen(event, id) {
    event.preventDefault();
    if (confirm("Desea guardar Margen en el sistema?")) {
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



document.addEventListener('DOMContentLoaded', () => {
    const inpuName=document.getElementById('loteSelect');
        inpuName.addEventListener('input', enviarBuscador);
    buscarMargenes('');
        });


        function enviarBuscador(event) {
            var palabra = event.target.value;
            buscarMargenes(palabra);
        }
        
        function enviarBuscadorAuto() {
            buscarMargenes(document.getElementById("search").value);
            document.getElementById("search").value='';
        }
        
        function buscarMargenes(searchTerm) {
            fetch('../business/accionMargenGananciaBuscar.php?action=search&searchMargen=' + encodeURIComponent(searchTerm))
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


      



        function actualizarTablaMargen(data) {
            var tbody = document.querySelector("#enable-table tbody");
            tbody.innerHTML = "";
        
            if (data.length === 0) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td colspan="3" style="text-align: center;">No hay márgenes disponibles</td>
                `;
                tbody.appendChild(row);
            } else {
                data.forEach(function(margen) {
                    var row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${margen.port}</td>
                        <td>${margen.prod}</td>
                        <td style="width: 150px;">
                            <div style="justify-content: space-between; display: flex;">
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="deleteMargen('${margen.id}')">Eliminar</button>
                                <button style="cursor: pointer; flex: 0 0 49%;" type="button" onclick="selectMargen('${margen.id}')">Editar</button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }
        

        function editData(event, id) {
            event.preventDefault();
            if (confirm("Desea Guardar Los cambios Realizados?")) {
                form = document.getElementById(id);
                form.action = '../business/accionMargenGananciaEditar.php';
                formData = new FormData(form);
        
                response = fetch(form.action, {
                    method: form.method,
                    body: formData
                }).then(function (response) {
                    return response.json();
                }).then(function (data) {
                    alert(data.message);
                    if (data.code === 1) {
                        window.location.href = '../view/margenGanancia.php';
                    }
                }).catch(function (error) {
                    alert(error);
                });
            }
        }

        function deleteMargen(identifierCat) {

            if (!confirm("¿Estás seguro de que deseas eliminar este Margen?")) {
                return;
            }
        
        
            fetch(`../business/accionMargenGananciaCrear.php?id=${encodeURIComponent(identifierCat)}`, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
        
        
                    alert(data.message);
                    buscarMargenes('');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al intentar eliminar la subCategoria.');
                });
        }


      
     



        function dataStatus(data) {
             actualizarTablaMargen(data.margResp);
          }
          



          function selectMargen(identifierMargen) {
            document.getElementById('btn-save').style.visibility = "hidden";
            document.getElementById('btn-finish').style.visibility = "visible";
            document.getElementById('btn-cancel').style.visibility = "visible";
        
            fetch(`../business/accionMargenGananciaEditar.php?idMargen=${encodeURIComponent(identifierMargen)}`, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
        
                    if (data.marg) {
                        document.querySelector('select[name="loteSelect"]').value = data.marg.name;
                        document.querySelector('input[name="porcentaje"]').value = data.marg.port;
                        document.querySelector('input[name="identifier"]').value = data.marg.id;
                    } else {
                        alert('No se encontraron datos del margen.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al intentar conseguir los datos del margen.');
                });
        }


        function cancel(event) {
            event.preventDefault();
            window.location.href = '../view/margenGanancia.php';
        }