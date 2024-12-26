<?php
require_once './validacionRutas.php';
?>
<!DOCTYPE html>
<style>
    input[type="image"] {
        border-style: outset;
        border-width: thin;
        box-shadow: 0px 0px 4px 1px black;
        padding-left: 1ch;
        padding-right: 1ch;
        height: 20ch;
    }

    div.title {
        text-align: -webkit-center;
        background-color: darkgrey;
        font-size: large;
        font-style: italic;
    }

    div#container-imag {
        display: grid;
        justify-content: center;
        width: fit-content;
        justify-items: center;
        align-items: center;
        align-content: space-around;
    }

    span#container-user {
        display: flex;
    }

    div#user-data {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin: 2ch;
        font-size: larger;
    }

    div#user-data span {
        margin: 2ch;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }

    div#user-data span h4 {
        margin: 1ch;
    }

    div#container-btn {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-evenly;
    }

    span.info-product {
        display: inline-grid;
        align-content: center;
        justify-items: center;
        align-items: center;
        justify-content: center;
        margin: 2ch;
    }

    div#container-hist {
        font-size: x-large;
        text-align: center;
    }

    dialog#modal-qr {
        border-style: dashed;
        border-radius: 2ch;
    }
    dialog#modal-qr div {
        display: grid;
        justify-items: center;
    }
    dialog#modal-qr button {
        margin: 1ch;
    }
    dialog:-internal-dialog-in-top-layer::backdrop {
        position: fixed;
        inset: 0px;
        background: rgba(0, 0, 0, 0.5);
    }
    .camera-ai {
        display: flex;
        flex-direction: column;
        align-content: center;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    input#capture {
        display: none;
    }
    .camera-ai label {
        border-style: hidden;
        box-shadow: 0px 0px 4px 0px #00000052;
        padding: 1ch;
        border-radius: 5ch;
        background-color: rgb(118 118 118 / 15%);
        border-style: solid;
        border-width: thin;
        border-color: rgb(118 118 118 / 59%);
    }
    .camera-ai:hover {
        transform: scale(1.05);
    }
    .button {
        border-style: hidden;
        box-shadow: 0px 0px 4px 0px #00000052;
        padding: 1ch;
        border-radius: 5ch;
        background-color: rgb(118 118 118 / 15%);
        border-style: solid;
        border-width: thin;
        border-color: rgb(118 118 118 / 59%);
    }
    .button:hover {
        transform: scale(1.05);
    }
    div#container-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-wrap: nowrap;
    }
    /* Maximum width */
@media (max-device-width: 430px) {
    * {
        font-size: x-large;
    }
}
dialog#modal-description {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
}
img.imag-desc {
    width: 13ch;
    margin: 1ch;
}
span.container-images {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    align-content: flex-start;
    flex-wrap: wrap;
}
span.container-desc {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: center;
    justify-content: center;
    align-items: center;
    text-decoration: underline;
}

</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ventas SAF</title>
        <link rel="stylesheet" href="footer.css" />
    </head>

    <body>
        <!-- header -->
        <?php include_once './header.php'; ?>
        <!-- datos del usuario -->
        <div id="container-global-user">
            <div class="title">
                <h3>Informacion personal</h3>
            </div>
            <span id="container-user">
                <div id="container-imag">
                    <h3>Foto de Perfil:</h3>
                    <input id="user-img" type="image" src="" alt="imagen de perfil" />
                </div>
                <div id="user-data">
                    <span>
                        <h4>Nombre de Usuario:</h4>
                        <p id="user-name">BrayRPGs</p>
                    </span>
                    <span>
                        <h4>Nombre:</h4>
                        <p id="name">Brayan</p>
                    </span>
                    <span>
                        <h4>Apellidos:</h4>
                        <p id="second-name">Rosales Pérez</p>
                    </span>
                    <span>
                        <h4>Rol:</h4>
                        <p id="user-rol">admin</p>
                    </span>
                    <span>
                        <h4>Dirreccion:</h4>
                        <p id="user-dir">datos</p>
                    </span>
                </div>
            </span>
        </div>
        <hr>
        <!-- botones de accion -->
        <div id="container-btn">
            <!-- escaner qr -->
            <input type="button" value="Escaner QR" class="button" onclick="showModalQR()"> 
            <!-- escaneo por foto -->
            <div class="camera-ai">
                <label for="capture">Captura por Camara AI</label>
                <input type="file" id="capture" capture="user" accept="image/*" onchange="checkImageLoaded()" >
            </div>
            <!-- finalizar la compra  -->
            <input type="button"class="button" value="Finalizar Compra" onclick="finalizaCompra()">
        </div>
        <hr>
        <div class="title">
            <h3>Lista de compra:</h3>
        </div>
        <div id="container-list">
            <!-- datos -->
        </div>
        <hr>
        <!-- este va llevernos al historial -->
        <div id="container-hist">
            <a href="../view/VentaHistorial.php">Ver Historial de Compras</a>
        </div>
        <hr>
        <!-- footer -->
        <?php include_once './footer.php'; ?>
    </body>

</html>
<script defer="">
    function showModal() {
        try {
            document.getElementById("modal-login").showModal();
        } catch (e) {
            window.alert("Ya has iniciado session.");
        }
    }

    function showModalQR() {
        document.getElementById("modal-qr").showModal();
    }
    function closeModalQR() {
        cerrarCamara();
        document.getElementById("modal-qr").close();
    }
    const id = "<?php echo $_SESSION["identificador"] ?>";
    const getData = async (id) => {
        const res = await fetch(`../business/accionVentasMostrar.php?identifier=${id}`);
        const resJso = await res.json();
        document.getElementById("user-img").src = resJso.fotoPerfil;
        document.getElementById("user-name").textContent = resJso.nombreUsuario;
        document.getElementById("name").textContent = resJso.nombre;
        document.getElementById("second-name").textContent = resJso.apellidos;
        document.getElementById("user-rol").textContent = resJso.rol;
        document.getElementById("user-dir").textContent = resJso.direccion;
    };
    getData(id);
</script>

<script defer="">
    const object = document.getElementById("container-list");
    for (var i = 0; i < sessionStorage.length; i++) {
        var productString = sessionStorage.getItem(sessionStorage.key(i));
        const product = JSON.parse(productString);
        object.innerHTML += `
            <span>
                <!-- input despliega un modal para ver la foto en mejor resolución -->
                <input type="image" src="${product.imagenes[3]["tbproductoimagenruta"]}" width="200px" height="100px" alt="imagen de producto" id="${i}" onclick="loadImagesDesc('${product.identificador}')">

                <span class="info-product">
                    <label for="${i}">Nombre artículo:</label>
                    <label>${product.nombre}</label>
                </span>

                <span class="info-product">
                    <label for="${i}">Cantidad de producto:</label>
                    <label>${product.cantidad}</label>
                </span>

                <span class="info-product">
                    <label for="${i}">Presentación del producto:</label>
                    <label>${product.presentacion.name}</label>
                </span>

                <span class="info-product">
                    <label>Eliminar:</label>
                    <input type="button" class="button" value="Eliminar Producto" onclick="eliminar('${product.identificador}')">
                </span>
            </span>`;

    }
</script>
<script defer="">
    function finalizaCompra() {
    window.location.href = "finalizarCompra.php";
}
function eliminar(identificador){
    if(window.confirm("desea eliminar este producto de su lista de compra")){
        sessionStorage.removeItem(identificador);
        window.location.reload();
    }
    
}
async function checkImageLoaded() {
    const fileInput = document.getElementById('capture');
    
    if (fileInput.files && fileInput.files.length > 0) {
        try {
            const url = "../business/accionEjecutarModeloIA.php";
            const formData = new FormData();
            formData.append('image', fileInput.files[0]); // 'image' será el nombre con el que recibirás el archivo en PHP
            /*opciones para fetch api*/
            const options = {
                method: "POST",
                body: formData
            };
            
            const response = await fetch(url, options);
            const responseJson = await response.json();
            //alert(responseJson.identifier);
            buscarProductoPorIdentificador(responseJson.identifier);
        } catch (e) {
            alert("Fallo al realizar la operacion intentelo mas tarde!");
            console.error(e);
        }
        
    } else {
        alert("No hay imagen cargada.");
    }
}

</script>

<dialog id="modal-qr">
    <script src="../assets/plugins/qrCode.min.js"></script> 
    <div>
        <div>
            <h5>Escanear código QR</h5>
            <div>
                <a id="btn-scan-qr" href="#">
                    <img src="../assets/img/qr_icon.svg" width="75">
                    <a />
                    <canvas hidden="" id="qr-canvas"></canvas>
            </div>
            <div>
                <button class="button" onclick="encenderCamara()">Encender camara</button>
                <button class="button" onclick="cerrarCamara()">Detener camara</button>
                <button class="button" onclick="closeModalQR()">Cerrar ventana</button>
            </div>
        </div>
    </div>
    <audio id="audioScaner" src="../assets/sound/sonido.mp3"></audio>
    <script src="LectorQR.js"></script>
</dialog>

<dialog id="modal-description">
</dialog>

<script defer="true">
    function loadImagesDesc(identifier) {
        const data = JSON.parse(sessionStorage.getItem(identifier));
        document.getElementById("modal-description").showModal();
        document.getElementById("modal-description").innerHTML = 
            `<span class="container-images">
                <img src="${data.imagenes[0]["tbproductoimagenruta"]}" class="imag-desc"/>
                <img src="${data.imagenes[1]["tbproductoimagenruta"]}" class="imag-desc"/>
                <img src="${data.imagenes[2]["tbproductoimagenruta"]}" class="imag-desc"/>
                <img src="${data.imagenes[3]["tbproductoimagenruta"]}" class="imag-desc"/>
            </span>
            <span class="container-desc">
                <p class="imag-desc">${data.categoria.description}</p>
                <p class="imag-desc">${data.description}</p>
                <p class="imag-desc">${data.nombre}</p>
                <p class="imag-desc">${data.presentacion.description}</p>
                <p class="imag-desc">${data.unidadmedida.nameUnit}</p>
                <input type="button" value="Cerrar Ventana" onclick="closeModal()"/>
            </span>`;
    }

    function closeModal() {
        const modal = document.getElementById("modal-description");
        modal.close();
        modal.innerHTML = "";  // Limpia el contenido del modal
    }
</script>
