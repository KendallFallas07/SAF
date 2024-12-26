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
$notes = $_POST['notes'] ?? '';
$date = $_POST['date'] ?? '';



//Validar datos
if (empty($supplierId) || empty($payMethod)) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

if(empty($date)){

    $today = new DateTime();
    $today->setTime(0, 0, 0);
    $date = $today->format('Y-m-d');

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

$dateTime = new DateTime();
$timestamp = $dateTime->format('Y-m-d H:i:s');
$identifier = "BUY-{$timestamp}";

$totalBuy = 0;
$buyState = 1;

if(empty($notes)){
    $notes = "Sin notas";
}

$dateNew = new DateTime();
$formattedCreatedAt = $dateNew->format('Y-m-d');
$formattedModifiedAt = $dateNew->format('Y-m-d');


$compra = new Compra($id, $identifier, $supplierId, $totalBuy, $buyState, $notes, $payMethod, $date, $formattedCreatedAt, $formattedModifiedAt);

if($compraController->insert($compra)) {

    response("200", "El registro fue guardado con éxito!");
} else {
    response("404", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde.");
}
