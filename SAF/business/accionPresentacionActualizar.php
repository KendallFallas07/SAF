<?php
/*
 * Brayan rosales perez
 * modificado 06-08-2024
 */
require_once './ControladoraPresentacion.php';
require_once '../domain/Presentacion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controller = new PresentacionController();

//funcion para dar respuestas JSON
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

//Obtener datos del POST

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$identificador = $_POST['idAModificar'] ?? '';


//Validaciones backend

if(empty(trim($nombre))){

    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");

}

if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {

    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");
    
}

if(empty($descripcion)){

    $descripcion = "Sin descripción";

}

$presentacionOld = $controller->findByIdentifier($identificador);

$aux = $presentacionOld[0];

$nombresRegistrados = $controller->obtenerNombres();

foreach ($nombresRegistrados as $key){

    if($nombre === $key['tbpresentacionombre'] && $aux['tbpresentacionidentificador'] != $identificador){

        response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");

    }


}

//Datos
$id = $controller->getID();

$status = true;

$creadoEn = $aux['tbpresentacioncreadoen'];

$creadoEnDateFinal = new DateTime($creadoEn);

$presentacion = new Presentacion($id,$identificador,$nombre,$descripcion,$creadoEnDateFinal,new DateTime(),$status);

if($controller->update($presentacion)){
    //respondemos con la respuesta 
    response("200", "El registro fue actualizado con exito!");
}
else{
    response("404", "Lo sentimos el transacción no fue realizada.");
}

