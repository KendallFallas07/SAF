<?php

include_once './ControladoraCajero.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$ventaIdentificador = filter_input(INPUT_POST, "ventaIdentificador");

if ($ventaIdentificador == false) {
    response("401", "No hay identificador del usuario");
} else {
    $cont = new ControladoraCajero();
    $data=$cont->obtenerCliente($ventaIdentificador);
    //var_dump($data);
    response("200", $data["tbventausuarioidentificador"]);
}
