<?php

require_once './ControladoraImpuesto.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new ImpuestosController();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletar($datos);

$respuesta = [];
foreach ($datosEncontrados as $key) {
    $respuesta[] = [
        "nombre" => $key['tbimpuestonombre']
    ];
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);