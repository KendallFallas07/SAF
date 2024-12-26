<?php

require_once 'ControladoraSubcategoria.php';
require_once '../domain/Subcategoria.php';


function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

function getTimestamp(DateTime $date): int {
    return $date->getTimestamp();
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        deleteSubCategory(trim($_GET['identifierSubcat']));
        break;

    case 'POST':
        insertarSubcategoria($_POST['nameSubCat'], $_POST['descriptionSubCat'], $_POST['categorySelect']);
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}


function insertarSubcategoria($nombre, $descripcion, $identifierCat) {


    $descripcion=!empty($descripcion)? $descripcion:'Sin descripcion';


    
    if (empty($nombre)  || empty($identifierCat)) {
        sendMessage(-2);
    }

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $descripcion)) {
        sendMessage(2);
    }

    if(isset($identifierCat) && is_string($identifierCat)){
    $controllerSubCat = new ControladoraSubcategoria();

    if($controllerSubCat->validarNombre($nombre,'')){
        sendMessage(3);
    }

    $idSubCat = $controllerSubCat->obtenerSIguienteId();
    $identifier='SCT-'.getTimestamp(new DateTime());
    $date=(new DateTime())->setTimezone(new DateTimeZone('America/Costa_Rica'));

    $subCat = new Subcategoria($idSubCat,$identifierCat, $identifier, $nombre, $descripcion, $date, $date, 1);

    if ($controllerSubCat->guardar($subCat)) {
        sendMessage(1);
    } else {
        sendMessage(-1);
    }

    }

}

function deleteSubCategory($subIdentifer){
    if (empty($subIdentifer)) {
        sendMessageDelete(2);
    }
    $controllerSubCat = new ControladoraSubcategoria();

    if ($controllerSubCat->eliminar($subIdentifer)) {
        sendMessageDelete(1);
    } else {
        sendMessageDelete(-1);
    }
}






function sendMessage($code) {
    $messages = [
        1 => "Subcategoria agregada con éxito",
        2 => "No se puede usar numeros ni caracteres especiales..",
        3 => "Ya existe una Subcategoria con ese nombre..",
        4 => "El nombre se encuentra vacío o contiene datos inválidos...",
        5 => "La Subcategoria no existe",
        -2 => "El nombre se encuentra vacío o no se ha elegido categoria..",
        -1 => "Error al insertar la Subcategoria"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}


function sendMessageDelete($code) {
    $messages = [
        1 => "Subcategoria eliminada con éxito",
        2 => "Identificador no encontrado",
        -1 => "Error al eliminar la Subcategoria"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}