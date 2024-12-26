<?php

require_once "./ControladoraRol.php";

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

$controller = new ControladoraRol();
$identificador = filter_input(INPUT_POST, "identificador");
if ($identificador == false) {
    response("400", "lo sentimos intentelo mas tarde.");
} elseif ($controller->deleteByIdentyfier($identificador)) {
    response("200", "Rol eliminado con exito");
} else {
    response("404", "Rol NO pudo ser eliminado, intentelo mas tarde");
}

