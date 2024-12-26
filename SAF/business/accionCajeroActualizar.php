<?php

require_once "../domain/Factura.php";

require_once "./ControladoraFactura.php";

include_once './ControladoraCajero.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function response(string $error, string $message, $data) {
    $response = [
        'status' => $error,
        'message' => $message,
        'data' => $data
    ];

    // Establecer el encabezado para JSON
    header('Content-Type: application/json');

    // Codificar el array a formato JSON
    echo json_encode($response);
    exit();
}

$ventaIdentificador = filter_input(INPUT_POST, "ventaIdentificador");
$impuesto = filter_input(INPUT_POST, "impuesto");

if ($ventaIdentificador == false) {
    response("401", "No hay identificador de la venta", "");
} else {

    if ($impuesto == false) {
        response("403", "No hay impuesto de la venta", "");
    } else {
        $cont = new ControladoraCajero();
        $aux = $cont->pagarVenta($ventaIdentificador, $impuesto);
        if ($aux == true) {

            $controladoraF = new ControladoraFactura();
            $Factura = new Factura();
            $Factura->setVenta($ventaIdentificador);
            $controladoraF->guardarFactura($Factura);
            $aux2 = $cont->obtenerFactura($ventaIdentificador);
            response("200", "Ok", $aux2);
        } else {
            response("400", "NO SE PUEDE REALIZAR PORQUE YA ESTA PAGO", "");
        }
    }
}


