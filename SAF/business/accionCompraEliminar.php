<?php

include_once "./ControladoraCompra.php";

header('Content-Type: application/json');

// Recupero el identificador
$buyIdentifier = $_GET['identifier'] ?? null;

if ($buyIdentifier) {

    $compraController = new CompraController();

    // Verificar si se encontraron datos
    // Intentar eliminar la compra
    $deleted = $compraController->deleteBuy($buyIdentifier);

    // Preparar la respuesta
    $response = $deleted ? [
        'message' => 'La compra ha sido eliminada con éxito!'
    ] : [
        'error' => 'No se encontró ninguna compra con el identificador proporcionado.',
    ];
} else {
    // Preparar respuesta de error si no se proporcionó el identificador
    $response = [
        'error' => 'Identificador no proporcionado.',
    ];
}

// Enviar la respuesta como JSON
echo json_encode($response);
