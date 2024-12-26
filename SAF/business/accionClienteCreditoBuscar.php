<?php

require_once './ControladoraClienteCredito.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new ClienteCreditoControladora();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletado($datos);

$datosFiltrados = [];
$contador = 0;

foreach ($datosEncontrados as $usuario) {

    if ($contador < 10) {

        if ($controladora->filtrarUsuarios($usuario['tbusuarioidentificador'])) {
            $datosFiltrados[] = $usuario;
            $contador++;
        }
    } else {
        break;
    }
}

$respuesta = [];
foreach ($datosFiltrados as $key) {
    $respuesta[] = [
        "nombreCompleto" => $key['tbusuarionombre'] . " " . $key['tbusuarioapellidos'],
        "identificador" => $key['tbusuarioidentificador']
    ];
}

// Devolver la respuesta en formato JSON
echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
