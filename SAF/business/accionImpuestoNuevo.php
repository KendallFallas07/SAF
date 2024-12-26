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

//validar el estado 
$state = true;
$dateIdent = new DateTime();
$ident = "IMPUESTO-" . $dateIdent->getTimestamp();
$id = $controladora->getID();

//listo ahora se puede guardar el registro con los nuevos datos
$impuesto = new Impuestos($id, $ident, $nombre, $descripcion, $valor, $fecha, $state);


if ($controladora->insert($impuesto)) {
    response("200", "El registro fue guardado con exito");
} else {
    response("200", "La solicitud no fue procesada, intentelo mas tarde!");
}




