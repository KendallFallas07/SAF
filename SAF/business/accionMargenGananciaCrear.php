<?php

//require_once '../data/Conexion.php';
require_once 'ControladoraMargenGanancia.php';
require_once '../domain/MargenGanancia.php';


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
     
        deleteMargen($_GET['id']);
        break;

    case 'POST':
        if (!isset($_POST['loteSelect'])) {
            sendMessage(-6);
        }
        insertarMargen($_POST['loteSelect'], $_POST['porcentaje']);
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}


function insertarMargen($identificador, $porcentaje) {

  
    if (empty($porcentaje)  || empty($identificador)) {
        sendMessage(-2);
    }

    if (!is_numeric($porcentaje)){
        sendMessage(-4);
    }

    if ($porcentaje <= 0 && is_numeric($porcentaje)) {
        sendMessage(-3);
    }

   

    if(isset($identificador) && is_string($identificador)){
    $controllerMargen= new ControladoraMargenGanancia();

    $idMargen = $controllerMargen->getNextId();
    $identifier='MAG-'.getTimestamp(new DateTime());
    $date=(new DateTime())->setTimezone(new DateTimeZone('America/Costa_Rica'));

    $newMargen=new MargenGanancia($idMargen,$identifier,$porcentaje,$identificador,$date,$date,1);

    if($controllerMargen->validateMargenActive($identificador)){
        sendMessage(-5);
    }

    if ($controllerMargen->saveMargenGanancia($newMargen)) {
        sendMessage(1);
    } else {
        sendMessage(-1);
    }

    }

}


function deleteMargen($id) {
    if (!isset($id)) {
        sendMessageDelete(-4);
    }

    $controllerMargen = new ControladoraMargenGanancia();

    if ($controllerMargen->deleteMargen($id)) {
        sendMessageDelete(1);
    } else {
        sendMessageDelete(-1);
    }
}


function sendMessageDelete($code) {
    $messages = [
        1 => "Margen eliminado con éxito",
        2 => "Identificador no encontrado",
        -1 => "Error al eliminar el margen",
        -4 => "El identificador no es valido"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}




function sendMessage($code) {
    $messages = [
        1 => "Margen agregado con éxito",
        2 => "No se ha seleccionado el producto o el porcentaje a valorar..",
        4 => "El nombre se encuentra vacío o contiene datos inválidos...",
        5 => "El margen no existe",
        -3 => "El porcentaje debe ser un número mayor a 0",
        -4 => "El porcentaje no puede ser un número negativo o no numérico",
        -5 =>"Este producto ya tiene un margen asignado, por favor, eliminalo antes de agregar uno nuevo.",
        -6 => "Por favor, selecciona un Lote",
        -2 => "El porcentaje se encuentra vacío o no se ha elegido lote.",
        -1 => "Error al insertar el margen"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}


