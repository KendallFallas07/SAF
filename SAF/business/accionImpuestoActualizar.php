<?php

require "./ControladoraImpuesto.php";

$controladora = new ImpuestosController();

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


$nombre = $_POST['name'] ?? '';
$descripcion = $_POST['description'] ?? '';
$valor = $_POST['value'] ?? '';
$fecha = $_POST['date'] ?? '';
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

if(empty($valor)){

    $valor = 0 ;

}

if(is_numeric($valor)){

    if ($valor < 0 || $valor > 100) {

        response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");
        
    } 

} else {

    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");
}

$inputDate = new DateTime($fecha);
$today = new DateTime();

$today->setTime(0, 0, 0);
$inputDate->setTime(0, 0, 0);

if ($today < $inputDate) {

    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde");
}

if(empty($fecha)){

    $fecha = "0000-00-00";

}

$state = true;
$id = $controladora->getID();

//listo ahora se puede guardar el registro con los nuevos datos
$impuesto = new Impuestos($id, $identificador, $nombre, $descripcion, $valor, $fecha, $state);



if ($controladora->edit($impuesto)) {
    response("200", "El registro fue actualizado con exito");
} else {
    response("200", "La solicitud no fue procesada, intentelo mas tarde!");
}