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

function loadData(event, ident) {
    event.preventDefault();
    if (confirm("Desea editar este campo?")) {
        url = new URLSearchParams();
        url.append("id", ident);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: url, headers};
        fetch('../business/accionUnidadMedidaEditar.php', options)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    document.getElementById("nameUnit").value = data.message[0].tbunidadmedidanombreunidad;
                    document.getElementById("abbreviation").value = data.message[0].tbunidadmedidaabreviatura;
                    document.getElementById("systemMeasurement").value = data.message[0].tbunidadmedidasistemamedida;
                    document.getElementById("typeUnit").value = data.message[0].tbunidadmedidatipounidad;
                    document.getElementById("btn-s").hidden = true;
                    document.getElementById("btn-e").hidden = false;
                    document.getElementById("btn-e").addEventListener("click", (event) => {
                        event.preventDefault();
                        if (confirm("Desea editar el campo?")) {
                            form = document.getElementById("data");
                            formData = new FormData(form);
                            formData.append("ident", ident);
                            //envio del formulario araves de js
                            response = fetch("../business/accionUnidadMedidaModificar.php", {
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
                    });
                })
                .catch((error) => {
                    alert(error);
                });
    }
}

function editData(event, id, ident) {
    event.preventDefault();
    if (confirm("Desea editar el campo?")) {
        form = document.getElementById(id);
        formData = new FormData(form);
        formData.append("ident", ident);
        //envio del formulario araves de js
        response = fetch("../business/accionUnidadMedidaModificar.php", {
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

function delData(event, ident) {
    event.preventDefault();
    if (confirm("Desea Eliminar el Registro?")) {
        url = new URLSearchParams();
        url.append("ident", ident);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: url, headers};
        //envio del formulario araves de js
        response = fetch("../business/accionUnidadMedidaEliminar.php", options).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}