<?php
require_once "./ControladoraImagenes.php";
require_once "./ControladoraProducto.php";

$cI = new ControladoraImagenes();
$cP = new ControladoraProducto();

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

// Verificar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se han subido imágenes

    $idP = str_replace([' ', ':'], '_', $_POST['identifier']);
    $idP2 = $_POST['identifier'];

    if (isset($_FILES['images'])) {
        $uploadedFiles = $_FILES['images'];
        // Procesar cada archivo subido
        for ($i = 0; $i < count($uploadedFiles['name']); $i++) {

            $file = [
                'name' => $uploadedFiles['name'][$i],
                'type' => $uploadedFiles['type'][$i],
                'tmp_name' => $uploadedFiles['tmp_name'][$i],
                'error' => $uploadedFiles['error'][$i],
                'size' => $uploadedFiles['size'][$i]
            ];

            if (!$cI->saveImageWithFolder($file, '../images/productos/' . $idP, $uploadedFiles['name'][$i])) {
                response('error', 'Método de solicitud no permitido.');
            }
            $cP->guardarImagen($idP2, '../images/productos/' . $idP . '/' . $uploadedFiles['name'][$i]);
        }
    } else {
        response('error', 'No se han subido imágenes.');
    }
} else {
    response('error', 'Método de solicitud no permitido.');
}