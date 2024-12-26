/**
 * Comment
 */
document.getElementById("btn-edit").hidden = true;
/**
 * Comment
 */
function isEmpresa() {
    checkempresa = document.getElementById("esempresa").checked;
    if (checkempresa) {
        const nombre = document.getElementById("noempresanombre");
        nombre.children[0].hidden = true;
        nombre.children[2].hidden = true;
        const apellidos = document.getElementById("noempresaapellidos");
        apellidos.children[0].hidden = true;
        apellidos.children[2].hidden = true;
        const empresa = document.getElementById("siempresanombre");
        empresa.children[0].hidden = false;
        empresa.children[2].hidden = false;
    } else {
        const nombre = document.getElementById("noempresanombre");
        nombre.children[0].hidden = false;
        nombre.children[2].hidden = false;
        const apellidos = document.getElementById("noempresaapellidos");
        apellidos.children[0].hidden = false;
        apellidos.children[2].hidden = false;
        const empresa = document.getElementById("siempresanombre");
        empresa.children[0].hidden = true;
        empresa.children[2].hidden = true;
    }
}

function saveData(event, id) {
    event.preventDefault();
    form = document.getElementById(id);
    formData = new FormData(form);
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    // Verificar si el formulario es válido
    if (confirm("Desea Guardar Los cambios Realizados?")) {
        //envio del formulario araves de js
        response = fetch(form.action, {
            method: form.method,
            body: formData
        }).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            if (data.status === "404") {
                alert(data.message);
                return;
            }
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}

function editSave(id) {
    if (confirm("Desea Guardar Los cambios Realizados en el Usuario?")) {
        form = document.getElementById(id);
        formData = new FormData(form);
        //envio del formulario araves de js
        response = fetch("../business/accionUsuariosEditar.php", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.json(); // Convierte la respuesta a JSON
        }).then(function (data) {
            if (data.status === "404") {
                alert(data.message);
                return;
            }
            alert(data.message);
            window.location.reload();
        }).catch(function (error) {
            alert(error);
        });
    }
}

function editData(id) {
    if (confirm("Desea Editar este Usuario?")) {
        element = document.getElementById(id);
        id = new String(element.childNodes[0].textContent);
        identificador = new String(element.childNodes[1].textContent);
        nombreUsuario = new String(element.childNodes[2].textContent);
        email = new String(element.childNodes[3].textContent);
        nombre = new String(element.childNodes[5].textContent);
        apellidos = new String(element.childNodes[6].textContent);
        rol = element.childNodes[11].textContent;
        telefono = element.childNodes[13].textContent;
        direccion = element.childNodes[14].textContent;

        document.getElementById("nombreusuario").value = nombreUsuario;
        document.getElementById("email").value = email;
        if (apellidos.trim() === "") {
            document.getElementById("esempresa").checked = true;
            isEmpresa();
            document.getElementById("empresa").value = nombre;

        } else {
            document.getElementById("esempresa").checked = false;
            isEmpresa();
            document.getElementById("nombre").value = nombre;
            document.getElementById("apellidos").value = apellidos;
        }
        roles = document.getElementById("rol");
        for (var i = 0; i < roles.childElementCount; i++) {
            if (rol === roles[i].label) {
                roles[i].selected = true;
            }
        }
        document.getElementById("telefono").value = telefono;
        document.getElementById("direccion").value = direccion;
        document.getElementById("btn-save").hidden = true;
        document.getElementById("btn-edit").hidden = false;
        document.getElementById("ident").value = identificador;
        document.getElementById("info").textContent = "Si no desea cambiar la contrasena no ingrese informacion en el campo Contrasena de lo contrario se escribira una nueva";
        document.getElementById("info").hidden = false;
        document.getElementById("info").style = "color : blue";
    }
}

async  function deleteData(id) {
    if (confirm("Desea Eliminar el Registro?")) {
        data = new URLSearchParams();
        data.append("identificador", id);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: data, headers};
        promise = await fetch("../business/accionUsuariosEliminar.php", options)
                .then(function (response) {
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(function (data) {
                    alert(data.message);
                    window.location.reload();
                })
                .catch(function (error) {
                    alert(error);
                });
    }
}

let checkUser;
let emailUser;
async function checkNombreUsuario() {
    data = new URLSearchParams();
    nombreUsuario = new String(document.getElementById("nombreusuario").value);
    //primera validacion
    if (nombreUsuario.trim() === "") {
        document.getElementById("info").textContent = "NO PUEDE ESTAR VACIO EL NOMBRE DE USUARIO";
        document.getElementById("info").style = "color: red";
        document.getElementById("info").hidden = false;
        document.getElementById("btn-save").disabled = true;
        document.getElementById("btn-edit").disabled = true;
        checkUser = false;
    } else {
        document.getElementById("info").hidden = true;
        data.append("nombreusuario", nombreUsuario);
        data.append("code", "1");
        data.append("identificador", document.getElementById("ident").value);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: data, headers};
        promise = await fetch("../business/accionUsuariosValidacion.php", options)
                .then(function (response) {
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(function (data) {
                    if (data.status === "400") {
                        message = new String(data.message);
                        document.getElementById("info").textContent = message.toUpperCase();
                        document.getElementById("info").style = "color: red";
                        document.getElementById("info").hidden = false;
                        document.getElementById("btn-save").disabled = true;
                        document.getElementById("btn-edit").disabled = true;
                        checkUser = false;
                    } else {
                        message = new String(data.message);
                        document.getElementById("info").textContent = message.toUpperCase();
                        document.getElementById("info").style = "color: green";
                        document.getElementById("info").hidden = false;
                        document.getElementById("btn-edit").disabled = false;
                        checkUser = true;
                    }
                })
                .catch(function (error) {
                    alert(error);
                });
    }

}

async function checkEmail() {
    if (!document.getElementById("save").checkValidity()) {

    }
    data = new URLSearchParams();
    email = new String(document.getElementById("email").value);
    //primera validacion
    if (email.trim() === "") {
        document.getElementById("info").textContent = "NO PUEDE ESTAR VACIO EL EMAIL";
        document.getElementById("info").style = "color: red";
        document.getElementById("info").hidden = false;
        document.getElementById("btn-save").disabled = true;
        document.getElementById("btn-edit").disabled = true;
        emailUser = false;
    } else {
        document.getElementById("info").hidden = true;
        data.append("email", email);
        data.append("code", "2");
        data.append("identificador", document.getElementById("ident").value);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: data, headers};
        promise = await fetch("../business/accionUsuariosValidacion.php", options)
                .then(function (response) {
                    return response.json(); // Convierte la respuesta a JSON
                })
                .then(function (data) {

                    if (data.status === "400") {
                        message = new String(data.message);
                        document.getElementById("info").textContent = message.toUpperCase();
                        document.getElementById("info").style = "color: red";
                        document.getElementById("info").hidden = false;
                        document.getElementById("btn-save").disabled = true;
                        document.getElementById("btn-edit").disabled = true;
                        emailUser = false;
                    } else {
                        message = new String(data.message);
                        document.getElementById("info").textContent = message.toUpperCase();
                        document.getElementById("info").style = "color: green";
                        document.getElementById("info").hidden = false;
                        emailUser = true;
                        if (checkUser && emailUser) {
                            document.getElementById("btn-save").disabled = false;
                            document.getElementById("btn-edit").disabled = false;
                        }
                    }
                })
                .catch(function (error) {
                    alert(error);
                });
    }

}

/**
 * Comment
 */
async function autocompleteSearch() {

    //soliciotar los datos segun lo que haya escrito
    valor = document.getElementById("search").value;
    //si esta vacio no muestro nada sino traigo los registros asociados
    if (valor === "") {
        document.getElementById("autocomplete").innerHTML = "";
    } else {
        data = new URLSearchParams();
        data.append("search", valor);
        headers = {'Content-Type': 'application/x-www-form-urlencoded'};
        options = {method: "POST", body: data, headers};
        response = await fetch("../business/accionUsuariosAutocompletar.php", options).then(
                function (response) {
                    return response.json(); // Convierte la respuesta a JSON
                }).then(
                function (data) {
                    dataFinal = "";
                    for (var i = 0; i < data.length; i++) {
                        value = data[i]["tbusuarionombreusuario"];
                        dataFinal += `<option value='${value}'>${value}</option>`;
                    }
                    document.getElementById("autocomplete").innerHTML = dataFinal;
                }).catch(
                function (error) {
                    alert(error);
                });
    }
}
