<?php

include_once './ControladoraFactura.php';
require_once "../domain/Factura.php";

$controladoraF = new ControladoraFactura();

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

$Factura = new Factura();

$ventaIdentificador = filter_input(INPUT_POST, "ventaIdentificador");

if ($ventaIdentificador == false) {
    response("401", "No hay identificador de la venta");
} else {
    $Factura->setVenta($ventaIdentificador);
    $cont = new ControladoraFactura();
    $cont->guardarFactura($Factura);
    response("200","Factura creada");
}




