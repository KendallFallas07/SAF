<?php

include_once "../domain/ClienteCredito.php";
include_once "../business/ControladoraClienteCredito.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$clienteId = $_POST['clienteId'] ?? '';
$clienteCreditoCantidad = isset($_POST['clienteCreditoCantidad']) ? (float) $_POST['clienteCreditoCantidad'] : 0.1;
$clienteCreditoPorcentaje = isset($_POST['clienteCreditoPorcentaje']) ? (float) $_POST['clienteCreditoPorcentaje'] : 0.1;
$clienteCreditoPlazo = isset($_POST['clienteCreditoPlazo']) ? (int) $_POST['clienteCreditoPlazo'] : 1;
$clienteCreditoFechaInicio = $_POST['clienteCreditoFechaInicio'] ?? '';
$clienteCreditoFechaVencimiento = $_POST['clienteCreditoFechaVencimiento'] ?? '';

//Validar datos


if (empty($clienteId)) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

if ($clienteCreditoCantidad < 0) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

if ($clienteCreditoPorcentaje < 0 || $clienteCreditoPorcentaje > 100) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

if ($clienteCreditoPlazo < 0) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}

$inputDate = new DateTime($clienteCreditoFechaInicio);
$today = new DateTime();

$today->setTime(0, 0, 0);
$inputDate->setTime(0, 0, 0);

if ($today < $inputDate) {

    response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
}


if (!empty($clienteCreditoFechaInicio) && !empty($clienteCreditoFechaVencimiento)) {

    $fechaInicio = new DateTime($clienteCreditoFechaInicio);
    $intervalo = new DateInterval("P{$clienteCreditoPlazo}M");
    $fechaInicio->add($intervalo);
    $fechaResultado = $fechaInicio->format('Y-m-d');
    
    // Crear un objeto DateTime para sumar el plazo y un día adicional
    $fechaInicioConPlazoMasUnDia = new DateTime($clienteCreditoFechaInicio);
    $fechaInicioConPlazoMasUnDia->add($intervalo);
    $fechaInicioConPlazoMasUnDia->modify('+1 day');
    $fechaInicioConPlazoMasUnDiaFormatted = $fechaInicioConPlazoMasUnDia->format('Y-m-d');

    if ($fechaInicioConPlazoMasUnDiaFormatted === $clienteCreditoFechaVencimiento) {
    // la fecha de inicio con plazo más un día es igual a la fecha de vencimiento, todo bien

    } else if ($fechaResultado !== $clienteCreditoFechaVencimiento) {
        // La fecha de inicio no es igual a la fecha de vencimiento, mostrar mensaje de error
        response("404", "Vaya, algo ha salido mal! Intenta de nuevo más tarde.");
    }
}

//Llenado del resto de datos

$controladora = new ClienteCreditoControladora();

$id = $controladora->getID();

$dateTime = new DateTime();
$timestamp = $dateTime->format('Y-m-d H:i:s');
$identificador = "CRED-{$timestamp}";


if (empty($clienteCreditoCantidad)) {
    $clienteCreditoCantidad = 0;
}

if (empty($clienteCreditoPorcentaje)) {
    $clienteCreditoPorcentaje = 0;
}

if (empty($clienteCreditoPlazo)) {
    $clienteCreditoPlazo = 0;

} else {
    if(empty($clienteCreditoFechaInicio) || empty($clienteCreditoFechaVencimiento)){
        
        $clienteCreditoPlazo = 0; 
        $clienteCreditoFechaInicio = "0000-00-00";
        $clienteCreditoFechaVencimiento = "0000-00-00";  
    }
}

if(empty($clienteCreditoFechaInicio) || empty($clienteCreditoFechaVencimiento)){

    $clienteCreditoFechaInicio = "0000-00-00";
    $clienteCreditoFechaVencimiento = "0000-00-00";

}


$dateNew = new DateTime();
$formattedCreatedAt = $dateNew->format('Y-m-d');
$formattedModifiedAt = $dateNew->format('Y-m-d');

$ClienteCredito = new ClienteCredito($id, $clienteId ,$identificador, $clienteCreditoCantidad, $clienteCreditoPorcentaje, $clienteCreditoPlazo, $clienteCreditoFechaInicio, $clienteCreditoFechaVencimiento, $formattedCreatedAt, $formattedModifiedAt, 1);

if ($controladora->guardar($ClienteCredito)) {
    response("200", "El registro fue guardado con éxito!");
} else {
    response("400", "En este momento no podemos procesar tu solicitud, intenta de nuevo más tarde!");
}