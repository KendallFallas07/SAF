<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "./ControladoraUnidadMedida.php";
date_default_timezone_set("America/Costa_Rica");

function response(string $error, mixed $message) {
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

$data;

//busco por el id al registro
$identifier = filter_input(INPUT_POST, "ident");
if ($identifier == false) {
    response("400", "lo sentimos intentelo mas tarde!");
} else {
    $controller = new ControladoraUnidadMedida();
    $data = $controller->getByIdentifier($identifier);
    //valido si el nombre es el mismo
    $newName = filter_input(INPUT_POST, "nameUnit");
    if ($newName == false) {
        response("400", "lo sentimos intentelo mas tarde!");
    }

    //abreviaturas
    $newAbrev = filter_input(INPUT_POST, "abbreviation");
    if ($newAbrev == false) {
        $newAbrev = "";
    }

    //sistemas de medida
    $newSys = filter_input(INPUT_POST, "systemMeasurement");
    if ($newSys == false) {
        $newSys = "";
    }

    //tipo de unidad
    $newTypeU = filter_input(INPUT_POST, "typeUnit");
    if ($newTypeU == false) {
        response("400", "lo sentimos intentelo mas tarde!");
    }
    $date = new DateTime();
    $controller = new ControladoraUnidadMedida();
    $unidadMedida = new UnidadMedida($data[0]["tbunidadmedidaid"], $data[0]["tbunidadmedidaidentificador"], $data[0]["tbunidadmedidanombreunidad"], $data[0]["tbunidadmedidaabreviatura"], $data[0]["tbunidadmedidasistemamedida"], $data[0]["tbunidadmedidatipounidad"], $data[0]["tbunidadmedidafechacreacion"], $data[0]["tbunidadmedidafechamodificacion"], $data[0]["tbunidadmedidaestado"]);

    //aca validadr cuando son diferentes nombres 
    if ($data[0]["tbunidadmedidanombreunidad"] != $newName) {
        $unidadMedida->setNameUnit($newName);
        $unidadMedida->setAbbreviation($newAbrev);
        $unidadMedida->setSystemMeasurement($newSys);
        $unidadMedida->setTypeUnit($newTypeU);
        $unidadMedida->setDateUpdated($date->format("Y-m-d H:i:s"));
        if ($controller->updateData($unidadMedida, true)) {
            response("200", "Unidad de medida actualizada con exito!");
        } else {
            response("400", "lo sentimos intentelo mas tarde!");
        }
    } else {
        $unidadMedida->setNameUnit($newName);
        $unidadMedida->setAbbreviation($newAbrev);
        $unidadMedida->setSystemMeasurement($newSys);
        $unidadMedida->setTypeUnit($newTypeU);
        $unidadMedida->setDateUpdated($date->format("Y-m-d H:i:s"));
        if ($controller->updateData($unidadMedida, false)) {
            response("200", "Unidad de medida actualizada con exito!");
        } else {
            response("400", "lo sentimos intentelo mas tarde!");
        }
    }
}


//si es el mismo no debo validar el nombre
//valido que el nombre no este repetido en caso que no sea el mismo
//capturo el resto de datos
//actualizo las fechas de modificacion