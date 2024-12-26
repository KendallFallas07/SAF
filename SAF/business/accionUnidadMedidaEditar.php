<?php

require_once "./ControladoraUnidadMedida.php";

function response(string $error, mixed $message) {
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

//capturar la peticion atraves de post
$identifier = filter_input(INPUT_POST, "id");
if ($identifier == false) {
    response("404", "Lo sentimos intentelo mas tarde!");
} else {
    $controladora = new ControladoraUnidadMedida();
    $data = $controladora->getByIdentifier($identifier);
    response("200", $data);
}