<?php

include_once './ControladoraCajero.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function response(string $error, string $message,$data) {
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
$usuarioIdentificador = filter_input(INPUT_POST, "idUsuario");

if ($usuarioIdentificador == false) {
    response("401", "No hay identificador del usuario","");
} else {
    $cont = new ControladoraCajero();
    $aux=$cont->obtenerVentasPorfecha($usuarioIdentificador);
    if(count($aux)>1){
        response("402", "EL CLIENTE TIENE CUENTAS POR PAGAR",$aux[0]);
    }else{
       response("200", "Ok",""); 
    }
}
