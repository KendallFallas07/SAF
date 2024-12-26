<?php

require_once "../domain/UnidadMedida.php";
require_once "./ControladoraUnidadMedida.php";

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

//verificamos que el identificador llegue
$identificador = filter_input(INPUT_POST, "ident");
if ($identificador == false) {
    response("404", "Lo sentimos no se pudo eliminar el tipo de unidad!");
}

//mandamos a eliminar
$controller = new ControladoraUnidadMedida();
$data = new UnidadMedida(null, $identificador, null, null, null, null, null, null, null);
if ($controller->deleteData($data)) {
    response("200", "EL registro fue eliminado correctamente");
} else {
    response("404", "Lo sentimos no se pudo eliminar el tipo de unidad!");
}

