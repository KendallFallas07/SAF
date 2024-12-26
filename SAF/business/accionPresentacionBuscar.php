<?php

require_once './ControladoraPresentacion.php';

$controladora = new PresentacionController();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletar($datos);

$respuesta = [];
foreach ($datosEncontrados as $key) {
    $respuesta[] = [
        "nombre" => $key['tbpresentacionombre']
    ];
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);