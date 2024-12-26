<?php

include_once "../domain/TipoUnidad.php";

include_once "./ControladoraTipoUnidad.php";


function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}


$unitController;



if(isset($_GET['identifierUnit'])){
    $idUnit =  trim($_GET['identifierUnit']);
    $unitController=new ControladoraTipoUnidad();
    $unitTtypeSelect=new TipoUnidad(0,$idUnit,'','','','',false);
    if($unitController->deleteUnitType($unitTtypeSelect)){
        sendMessage(1);
    }else{
        sendMessage(-1);
    }

}else{
    sendMessage(2);
}


function sendMessage($code) {
    $messages = [
        1 => "Tipo de unidad eliminado con éxito",
        2 => "El identificador no es valido",
        -1 => "Error al eliminar el tipo de unidad"
    ];

    sendJsonResponse(["message" => $messages[$code] ?? "Error desconocido"]);
}