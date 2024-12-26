<?php

require_once "./ControladoraUsuarios.php";

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
if ($identificador == false) {
    response("404", "Lo sentimos intentelo de nuevo o mas tarde");
}
$controller = new ControladoraUsuarios();
if ($controller->delete($identificador)) {
    response("200", "Usuario eliminado con exito!");
} else {
    response("404", "Lo sentimos intentelo de nuevo o mas tarde");
}
