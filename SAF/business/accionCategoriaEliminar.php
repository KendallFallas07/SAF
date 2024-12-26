<?php

include_once "../domain/Categoria.php";

include_once "./ControladoraCategoria.php";


function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}


$controllerCat;



if(isset($_GET['identifierCat'])){
    $idCat =  trim($_GET['identifierCat']);
    $controllerCat=new ControladoraCategoria();
    $categorySelected=new Categoria(0,$idCat,'','','','',false);
    if($controllerCat->deleteCategory($categorySelected)){
        sendMessage(1);
    }else{
        sendMessage(-1);
    }

}else{
    sendMessage(2);
}


function sendMessage($code) {
    $messages = [
        1 => "Categoría eliminada con éxito",
        2 => "El identificador no es valido",
        -1 => "Error al eliminar la categoría"
    ];

    sendJsonResponse(["message" => $messages[$code] ?? "Error desconocido"]);
}