<?php
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
        getMargen(trim($_GET['idMargen']));
        break;

    case 'POST':


        ModifyMargen($_POST['loteSelect'], $_POST['porcentaje'],$_POST['identifier']);

        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}


function getMargen($ident){

    if (empty($ident)) {
        sendJsonResponse(['error' => 'Identificador del Margen es requerido']);
        return;
    }

    $controllerMargen = new ControladoraMargenGanancia();
    $margen = $controllerMargen->getMargenByFilter($ident);

    $response = [
        'id' => $margen->getIdentifierMargen(),
        'name' => $margen->getIdentifierLote(),
        'port' => $margen->getPorcentaje()
    ];


    sendJsonResponse(["marg"=>$response]);

}


function ModifyMargen($identificador, $porcentaje,$idMargen){
     $flag=false;
    if (empty($identificador) || empty($porcentaje) || empty($idMargen)) {
        sendMessage(4);
    }

    if (!isset($identificador)) {
        sendMessage(-4);
    }

    if (!is_numeric($porcentaje)){
        sendMessage(-4);
    }

    if ($porcentaje <= 0 && is_numeric($porcentaje)) {
        sendMessage(-3);
    }

    $controllerMargen = new ControladoraMargenGanancia();

    $margen = $controllerMargen->getMargenByFilter($idMargen);

    if (!$margen) {
        sendMessage(5);
        return;
    }
    $porcentaje = floatval($porcentaje);

    if(floatval($margen->getPorcentaje()) !== $porcentaje){
        $margen->setPorcentaje($porcentaje);
        $flag=true;
    }

    if($margen->getIdentifierLote() !== $identificador){
        $margen->setIdentifierLote($identificador);
        $flag=true;
    }

    if(!$flag){
       sendMessage(3);
        return;
    }
    

    $margen->setModifiedAtMargen((new DateTime())->setTimezone(new DateTimeZone('America/Costa_Rica')));

    if ($controllerMargen->updateMargen($margen)){
     sendMessage(1);
    }
}


function sendMessage($code) {
    $messages = [
        1 => "Margen actualizado con éxito",
        2 => "No se ha seleccionado el producto o el porcentaje a valorar..",
        3=> "No hay campos que actualizar",
        4 => "Rellene todos los campos.",
        5 => "El margen no existe",
        -3 => "El porcentaje debe ser un número mayor a 0",
        -4 => "El porcentaje no puede ser un número negativo o no numérico",
        -2 => "El porcentaje se encuentra vacío o no se ha elegido lote.",
        -1 => "Error al insertar el margen"
    ];
    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);

}