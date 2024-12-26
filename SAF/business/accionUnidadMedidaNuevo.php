<?php
require_once "../domain/UnidadMedida.php";
require_once "./ControladoraUnidadMedida.php";

//"America/Costa_Rica"
function getTimeZoneNow(string $timezone): string {
    $zone = new DateTimeZone($timezone);
    $date = new DateTime();
    $date->setTimezone($zone);
    return $date->format('Y-m-d H:i:s');
}

function getTimestamp(DateTime $date): int {
    return $date->getTimestamp();
}

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

//intercepcion de peticiones
//nombre de la unidad
$nameUnit = $_POST["nameUnit"];
if (isset($_POST["nameUnit"])) {
    $nameUnit = (string) $_POST["nameUnit"];
    if ($nameUnit === "") {
        response("404", "Lo sentimos debe de ingresar un nombre valido!");
    }
} else {
    response("404", "Lo sentimos debe de ingresar un nombre valido!");
}
//abreviatura
$abbreviation;

if (isset($_POST["abbreviation"])) {
    $abbr = (string) $_POST["abbreviation"];
    $abbreviation = strtoupper($abbr);
    if (strlen($abbreviation) > 5 || strlen($abbreviation) <= 0) {
        response("404", "Lo sentimos debe de ingresar una abreviaturaque cumpla un formato valido maximo 5 letras!");
    }
} else {
    response("404", "Lo sentimos debe de ingresar una abreviaturaque cumpla un formato valido de al menos 5 letrasd!");
}

//sistema de medida
$systemMeasurement;
if (isset($_POST["systemMeasurement"])) {
    $systemMeasurement = $_POST["systemMeasurement"];
} else {
    $systemMeasurement = "";
}

//sistema de medida
$typeUnit;
if (isset($_POST["typeUnit"])) {
    $typeUnit = $_POST["typeUnit"];
} else {
    $typeUnit = "";
}
//
$controller = new ControladoraUnidadMedida();
//hasta aca la validacion
$UnitMeasurement = new UnidadMedida(1, "UNIDAD-MEDIDA-" . getTimestamp(new DateTime()), $nameUnit, $abbreviation, $systemMeasurement, $typeUnit, getTimeZoneNow("America/Costa_Rica"), getTimeZoneNow("America/Costa_Rica"), 1);
//
if ($controller->saveData($UnitMeasurement,true)) {
    response("200", "Los Datos Fueron Guardados Con Exitos");
} else {
    response("200", "los sentimos el nombre esta registrado");
}
