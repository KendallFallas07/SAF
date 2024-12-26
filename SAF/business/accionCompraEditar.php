<?php

include_once "./ControladoraCompra.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Recupero el identificador
$buyIdentifier = $_GET['identifier'] ?? null; 

if ($buyIdentifier) {

    $compraController = new CompraController();

    // Recuperar los datos usando el identificador
    $buyData = $compraController->serchByIdentifier($buyIdentifier);
    
    $supplierId = $buyData[0]['tbcompraidentificadorproveedor'];

    // Verificar si se encontraron datos
    if (!empty($buyData)) {
        
        $buyData = $buyData[0]; // Tomar el primer resultado si hay múltiples

        // Preparar la respuesta
        $response = [
            'id' => $buyData['tbcompraid'],
            'identifier' => $buyData['tbcompraidentificador'],  
            'idSupplier' => $supplierId, 
            'notes' => $buyData['tbcompranotas'], 
            'payMethod' => $buyData['tbcomprametodopago'],
            'date' => $buyData['tbcomprafecha']
        ];
    } else {
        // Preparar respuesta de error si no se encontraron datos
        $response = [
            'error' => 'No se encontró ninguna compra con el identificador proporcionado.',
        ];
    }
} else {
    // Preparar respuesta de error si no se proporcionó el identificador
    $response = [
        'error' => 'Identificador no proporcionado.',
    ];
}

// Enviar la respuesta como JSON
echo json_encode($response);
