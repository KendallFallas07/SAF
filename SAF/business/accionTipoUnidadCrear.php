<?php

include_once "./ControladoraTipoUnidad.php";
include_once "../domain/TipoUnidad.php";

//header('Content-Type: application/json');

function getTimestamp(DateTime $date): int {
    return $date->getTimestamp();
}

function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

$unitController;

$idUnit; //para id de categoria
$nameUnit; //para administrar el nombre
$identifier;
$dateH = new DateTime();
$statu = true;

if (isset($_POST['nameUnit']) && !empty($_POST['nameUnit']) && is_string($_POST['nameUnit'])) {
    $nameUnit = trim($_POST['nameUnit']);
    $unitController = new ControladoraTipoUnidad();
    if ($unitController->validationName($nameUnit,'')) {
        sendMessage(3);
    }


    $description = isset($_POST['descriptionUnit']) && !empty($_POST['descriptionUnit']) ? $_POST['descriptionUnit'] : 'Sin descripcion';

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nameUnit) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $description)) {
        sendMessage(2);
    }

    $idUnit = $unitController->nextIdUnit();
    $date = new DateTime();
    $identifier = 'UNT-' .getTimestamp($date);
} else {
    sendMessage(4);
}

$newUnit = new TipoUnidad($idUnit, $identifier, $nameUnit, $description, $dateH, $dateH, $statu);

if ($unitController->insert($newUnit)) {
    sendMessage(1);
} else {
    sendMessage(-1);
}

function sendMessage($code) {
    $messages = [
        1 => "Unidad agregada con exito",
        2 => "No se puede usar numeros ni caracteres especiales",
        3 => "Ya existe una unidad con ese nombre",
        4 => "El nombre de esta unidad se encuentra vacio o contiene datos invalidos",
        5 => "La unidad no existe",
        -1 => "Error al insertar la unidad"
    ];

    sendJsonResponse(["message" => $messages[$code],"code"=>$code ?? "Error desconocido"]);
}
