function validateLogin() {
    form = document.getElementById("login");
    formData = new FormData(form);
    //envio del formulario araves de js
    response = fetch(form.action, {
        method: form.method,
        body: formData
    }).then(function (response) {
        return response.json(); // Convierte la respuesta a JSON
    }).then(function (data) {
        console.debug(data.status);
        if (data.status === "404") {
            error = document.getElementById("error-login");
            error.hidden = false;
            error.innerHTML = `<h4 >${data.message}</h4>`;
            error.style = "color: red;";
        } else {
            document.getElementById("modal-login").close();
            window.location.reload();
        }
    }).catch(function (error) {
        alert(error);
    });

}

function handleKeyDown(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('modal-login');
        modal.close(); // Cierra el modal
        location.reload(); // Recarga la página
    }
}

/**
 * mostrar el model
 */
function showModal() {
    try {
        document.getElementById("modal-login").showModal();
    } catch (e) {
        window.alert("Ya has iniciado session.");
    }
}