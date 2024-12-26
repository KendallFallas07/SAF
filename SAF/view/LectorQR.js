//crea elemento
const video = document.createElement("video");
//nuestro camvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");
//div donde llegara nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");
//lectura desactivada
let scanning = false;
//funcion para encender la camara
const encenderCamara = () => {
    navigator.mediaDevices
            .getUserMedia({video: {facingMode: "environment"}})
            .then(function (stream) {
                scanning = true;
                btnScanQR.hidden = true;
                canvasElement.hidden = false;
                video.setAttribute("playsinline", true);
                video.srcObject = stream;
                video.play();
                tick();
                scan();
            });
};
//funciones para levantar las funiones de encendido de la camara
function tick() {
    canvasElement.height = 175;
    canvasElement.width = 235;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    scanning && requestAnimationFrame(tick);
}

function scan() {
    try {
        qrcode.decode();
    } catch (e) {
        setTimeout(scan, 300);
    }
}

//apagara la camara
const cerrarCamara = () => {
    video.srcObject.getTracks().forEach((track) => {
        track.stop();
    });
    canvasElement.hidden = true;
    btnScanQR.hidden = false;
};
//activar el sonido cuando detecta el qr
const activarSonido = () => {
    var audio = document.getElementById('audioScaner');
    audio.play();
}

//callback cuando termina de leer el codigo QR
qrcode.callback = (respuesta) => {
    if (respuesta) {
        activarSonido(); // Pone el sonido para notificar que se detecto el qr

        cerrarCamara(); // Cierra la cámara

        buscarProductoPorIdentificador(respuesta);
        //podria ser una funcion mas adelante
        setTimeout(encenderCamara, 3000); // Espera 3 seg y la vuelve a encender
    }
};
////evento para mostrar la camara sin el boton 
//window.addEventListener('load', (e) => {
//  encenderCamara();
//})


//función para llamar a API que devuelve el producto escaneado
function buscarProductoPorIdentificador(identificador) {
    const url = '../business/accionLectorQR.php?identificador=' + identificador;
    fetch(url)
            .then(response => response.json())
            .then(data => {
                agregarAListaCompra(data);
            })
            .catch(error => console.error('Error:', error));
}

function agregarAListaCompra(data) {
    const producto = data.producto;
    const margen = data.margenVenta;
    const isEmpty = sessionStorage.getItem(producto.identificador);
    if (isEmpty === null) {
        producto.cantidad = 1;
        const item = {
            ...producto,
            margenVenta: margen
        };
        data = JSON.stringify(item);
        sessionStorage.setItem(producto.identificador, data);
    } else {
        const override = JSON.parse(isEmpty);
        override.cantidad++;
        data = JSON.stringify(override);
        sessionStorage.setItem(override.identificador, data);
    }
    window.location.reload();
}






