<?php

require_once './ControladoraProveedorCredito.php';
;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new ProveedorCreditoController();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletado($datos);

$datosFiltrados = [];

foreach ($datosEncontrados as $proveedores) {

    if($controladora->filtrarProveedores($proveedores['tbproveedoridentificador'])){
        $datosFiltrados[] = $proveedores;
    }

}

$respuesta = [] ;
foreach ($datosFiltrados as $key) {
    $respuesta[] = [
        "nombre" => $key['tbproveedornombre']
    ];
}


echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);