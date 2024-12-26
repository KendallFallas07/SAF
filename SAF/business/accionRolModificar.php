<?php

require_once "./ControladoraRol.php";
date_default_timezone_set("America/Costa_Rica");

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

$ident = filter_input(INPUT_POST, "iden");
$name = filter_input(INPUT_POST, "name");
$desc = filter_input(INPUT_POST, "desc");
$date = new DateTime();

if (!$ident || !$name || !$desc) {
    response("400", "lo sentimos intentelo mas tarde!");
} else {
    $controller = new ControladoraRol();
    $actual = $controller->getByIdentifierFull($ident);
    $controller = new ControladoraRol();
    $nuevo = array();
    $nuevo["identificador"] = $ident;
    $nuevo["nombre"] = $name;
    $nuevo["descripcion"] = $desc;
    $nuevo["fechacreacion"] = $actual[0]["tbrolfechacreacion"];
    $nuevo["fechamodificacion"] = $date->format("Y-m-d H:i:s");
    $nuevo["estado"] = 1;
    $nuevo["tbrolidentificador"] =  $ident;
    //validar que no sea el mismo
    /*
     * @todo
     */
    if($controller->update($nuevo)){
        response("200", "Rol modificado con exito!");
    }else{
        response("400", "lo sentimos intentelo mas tarde!");
    }
}
