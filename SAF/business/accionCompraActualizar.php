<?php

include_once "../domain/Compra.php";

include_once "./ControladoraCompra.php";

$compraController = new CompraController();


function response(string $error, string $message)
{

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

//Obtener los datos del formulario
$supplierId = $_POST['supplierId'] ?? '';
$payMethod = $_POST['payMethod'] ?? '';
$idToModify = $_POST['idToModify'] ?? '';
$notes = $_POST['notes'] ?? '';
$date = $_POST['date'] ?? '';

//Validar datos
if (empty($supplierId) || empty($payMethod) || empty($date)) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

$inputDate = new DateTime($date);
$today = new DateTime();

$today->setTime(0, 0, 0);
$inputDate->setTime(0, 0, 0);

if ($today < $inputDate) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

//Llenado del resto de datos

$id = $compraController->getID();

if(empty($notes)){
    $notes = "Sin notas";
}

$dateNew = new DateTime();
$formattedModifiedAt = $dateNew->format('Y-m-d');
$formattedCreatedAt = $dateNew->format('Y-m-d');


$compra = new Compra($id, $idToModify, $supplierId, 0, 1, $notes, $payMethod, $date, $formattedCreatedAt, $formattedModifiedAt);


if($compraController->updateBuy($compra)) {

    response("200", "El registro fue actualizado con éxito!");

} else {
    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde.");
}

