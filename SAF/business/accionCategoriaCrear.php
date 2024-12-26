<?php

include_once "./ControladoraCategoria.php";
include_once "../domain/Categoria.php";

//header('Content-Type: application/json');

function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

$controllerCat;

$idCat; //para id de categoria
$nameCat; //para administrar el nombre
$identifier;
$dateH = new DateTime();
$statu = true;

if (isset($_POST['nameCat']) && !empty($_POST['nameCat']) && is_string($_POST['nameCat'])) {
    $nameCat = trim($_POST['nameCat']);
    $controllerCat = new ControladoraCategoria();
    if ($controllerCat->validationName($nameCat,'')) {
        sendMessage(3);
    }

    $description = isset($_POST['descriptionCat']) && !empty($_POST['descriptionCat']) ? $_POST['descriptionCat'] : 'Sin descripcion';

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nameCat) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $description)) {
        sendMessage(2);
    }

    $idCat = $controllerCat->nextIdCat();
    $date = new DateTime();
    $identifier = 'CAT-' . $date->format('dmYHis');
} else {
    sendMessage(4);
}

$newCategory = new Categoria($idCat, $identifier, $nameCat, $description, $dateH, $dateH, $statu);

if ($controllerCat->insert($newCategory)) {
    crearCarpeta($newCategory->getNameCategory());
    sendMessage(1);
} else {
    sendMessage(-1);
}

function sendMessage($code) {
    $messages = [
        1 => "Categoría agregada con éxito",
        2 => "No se puede usar numeros ni caracteres especiales..",
        3 => "Ya existe una categoria con ese nombre..",
        4 => "El nombre se encuentra vacío o contiene datos inválidos...",
        5 => "La categoría no existe",
        -1 => "Error al insertar la categoría"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}
function crearCarpeta( $nombreCarpeta) {
    $rutaCompleta = rtrim("../resource/", DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $nombreCarpeta;
    //sendJsonResponse(["message" => $rutaCompleta ?? "Error desconocido"]);
    if (!file_exists($rutaCompleta)) {

        if (mkdir($rutaCompleta, 0777, true)) {
           return 1;
        } else {
          return 0;
        }
    } else {
      return -1;
    }
}