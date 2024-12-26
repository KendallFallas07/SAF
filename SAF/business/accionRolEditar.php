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

$identificador = filter_input(INPUT_POST, "identificador");
if (!$identificador) {
    response("400", "lo sentimos intentelo mas tarde!.");
} else {
    $controller = new ControladoraRol();
    $data = $controller->getByIdentifier($identificador);
    // Establecer el encabezado para JSON
    header('Content-Type: application/json');
    // Codificar el array a formato JSON
    echo json_encode($data);
    exit();
}
