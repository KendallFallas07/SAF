<?php

//"America/Costa_Rica"
function getTimeZoneNow(string $timezone): string {
    $zone = new DateTimeZone($timezone);
    $date = new DateTime();
    $date->setTimezone($zone);
    return $date->format(DateTime::W3C);
}

function getTimestamp(DateTime $date): int {
    $date->setTimezone(new DateTimeZone("America/Costa_Rica"));
    return $date->getTimestamp();
}

function response(string $error, string $message) {
    $response = [
        'status' => $error,
        'message' => $message
    ];
    // Establecer el encabezado para JSON
    header('Content-Type: application/json');
    // Codificar el array a formato JSON
    echo json_encode($response);
    exit();
}

// Verificar si se ha enviado el formulario
if (isset($_POST['submit']) && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

    // Obtener el nombre de la carpeta desde el formulario y sanitizar
    $nombreCarpeta = $_POST['categoria'];
    $carpetaDestino = "/../resources/img/{$nombreCarpeta}/";

    // Crear la carpeta si no existe
    if (!is_dir( __DIR__ . "{$carpetaDestino}")) {
        if (!mkdir(__DIR__ . "{$carpetaDestino}", 0777, true)) {
            response("404", "Lo sentimos, en este momento no podemos procesar tu solicitud, intenta de nuevo más tarde.");
        }
    }

    // Obtener información del archivo subido
    $archivo = $_FILES['imagen'];
    $timeStanp = getTimestamp(new DateTime());
    $nombreArchivo = basename($archivo['name']);

    $rutaTemporal = $archivo['tmp_name'];

    $nombreFinal =  $nombreCarpeta . pathinfo($nombreArchivo, PATHINFO_FILENAME) . getTimestamp(new DateTime()); 
    
    // Validar que el archivo es una imagen válida
    $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($tipoArchivo, $tiposPermitidos)) {
        response("404","Formato de imagen no permitido. Solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }

    // Obtener archivo sin extensión y establecer el nombre de archivo WebP
    $nombreArchivoWebP = "{$nombreFinal}.webp";
    $carpetaDestinoCompleta = __DIR__ . $carpetaDestino;
    $rutaDestino = "{$carpetaDestinoCompleta}{$nombreArchivoWebP}";

    // Crear una imagen GD a partir del archivo subido
    $imagen = false;
    switch ($tipoArchivo) {
        case 'jpg':
        case 'jpeg':
            $imagen = imagecreatefromjpeg($rutaTemporal);
            break;
        case 'png':
            $imagen = imagecreatefrompng($rutaTemporal);
            break;
        case 'gif':
            $imagen = imagecreatefromgif($rutaTemporal);
            break;
    }

    if ($imagen) {
        // Guardar la imagen en formato WebP
        if (imagewebp($imagen, $rutaDestino)) {
            imagedestroy($imagen);

            response("200", "{$carpetaDestino}{$nombreFinal}");
        

        } else {
    
            response("404", "Error al guardar la imagen en formato WebP");

        }
    } else {
        
        response("404", "Lo sentimos, en este momento no podemos procesar tu solicitud, intenta de nuevo más tarde.");
    }
} else {
    
    response("404", "No se ha enviado una imagen válida.");
}

