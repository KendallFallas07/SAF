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

$search = filter_input(INPUT_POST, "search");
if ($search == false) {
    response("400", "no hay coincidencias");
} else {
    $controller = new ControladoraUsuarios();
    $data = $controller->search($search);
    if (empty($data)) {
        response("200", "no hay coincidencias");
    }
    // Establecer el encabezado para JSON
    header('Content-Type: application/json');
    // Codificar el array a formato JSON
    echo json_encode($data);
    exit();
}