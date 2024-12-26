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

// Callback cuando termina de leer el código QR
qrcode.callback = (respuesta) => {
    if (respuesta) {
        activarSonido(); // Reproduce el sonido para notificar que se detectó el QR
        cerrarCamara();  // Apaga la cámara
        mostrarIdentificadorVenta(respuesta);
    }
};

// saco el identificador
function mostrarIdentificadorVenta(identificadorVenta) {
    const url = new URL(window.location.href);
    url.searchParams.set('venta', identificadorVenta); //saca el identificador
    window.location.href = url; 
}
