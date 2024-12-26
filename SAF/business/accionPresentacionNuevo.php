<?php
/*
 * Brayan rosales perez
 * modificado 06-08-2024
 */
require_once './ControladoraPresentacion.php';
require_once '../domain/Presentacion.php';

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

$nombre = $_POST['name'] ?? '';
$descripcion = $_POST['description'] ?? '';


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

$nombresRegistrados = $controller->obtenerNombres();

foreach ($nombresRegistrados as $key){

    if($nombre === $key['tbpresentacionombre']){

        response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");

    }
}


//Datos
$id = $controller->getID();

$datetime = new DateTime("now", null);
$identifier = "PRESENTACION-" . $datetime->getTimestamp();

$status = true;

$presentacion = new Presentacion($id,$identifier,$nombre,$descripcion,new DateTime(),new DateTime(),$status);

//Validar si recibe un nombre de un registro muy viejo
$nombresRegistradosViejos = $controller->nombresSimples();

foreach ($nombresRegistradosViejos as $key){

    if($nombre === $key['tbpresentacionombre']){

        response("200", "El nombre {$nombre} ya se encuentra registrado y es un registro historico de otro nombre.");

    }
}

if($controller->insert($presentacion)){
    //respondemos con la respuesta 
    response("200", "El registro fue guardado con exito!");
}
else{
    response("404", "Lo sentimos el transacción no fue realizada.");
}

