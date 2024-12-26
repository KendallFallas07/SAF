<?php

require_once './ControladoraCompra.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new CompraController();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletar($datos);

$datosFiltrados = [];
$contador = 0;

foreach ($datosEncontrados as $proveedor) {

    if($contador < 10){

        if($controladora->filtrarProveedores($proveedor['tbproveedoridentificador'])){
            $datosFiltrados[] = $proveedor;
            $contador++;
        }

    } else {
        break;
    }
}

$respuesta = [];

foreach ($datosFiltrados as $key) {
    $respuesta[] = [
        "nombre" => $key['tbproveedornombre'] ,
        "identificador" => $key['tbproveedoridentificador']
    ];
}

// Devolver la respuesta en formato JSON
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);