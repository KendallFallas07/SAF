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

function editRol(id) {
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        body = new URLSearchParams();
        body.append("identificador", id);
        //envio del formulario araves de js
        response = fetch("", {
            method: form.method,
            body: body
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

function delRol(id) {
    if (confirm("Desea Eliminar el Registro?")) {
        body = new URLSearchParams();
        body.append("identificador", id);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: body, headers};
        //envio del formulario araves de js
        response = fetch("../business/accionRolEliminar.php", options).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}

function loadData(id) {
    if (confirm("Desea Editar el Registro?")) {
        body = new URLSearchParams();
        body.append("identificador", id);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: body, headers};
        //envio del formulario araves de js
        response = fetch("../business/accionRolEditar.php", options).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            console.debug(data);
            document.getElementById("name").value = data[0]["tbrolnombre"];
            document.getElementById("description").value = data[0]["tbroldescripcion"];
            //id = data[0]["tbrolidentificador"];
            document.getElementById("id-edit").style = "visibility : visible";
            document.getElementById("id-save").style = "visibility : hidden";
            document.getElementById("btn-edit").addEventListener("click", () => {
                if (confirm("Desea Guardar Los cambios Realizados?")) {
                    url = new URLSearchParams();
                    url.append("iden", id);
                    url.append("name", document.getElementById("name").value);
                    url.append("desc", document.getElementById("description").value);
                    headers = {'Content-Type': 'application/x-www-form-urlencoded'};
                    options = {method: "POST", body: url, headers};
                    //envio del formulario araves de js
                    response = fetch("../business/accionRolModificar.php", options).then(function (response) {
                        return response.json(); // Convierte la respuesta a JSON
                    }).then(function (data) {
                        alert(data.message);
                        window.location.reload();
                    }).catch(function (error) {
                        alert(error);
                    });
                }
            });

        }).catch(function (error) {
            alert(error);
        });
    }
}
