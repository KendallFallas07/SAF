<?php

include_once "./ControladoraClienteCredito.php";

header('Content-Type: application/json');

// Recupero el identificador
$identificador = $_GET['identificador'] ?? null;

if ($identificador) {

    $controladora = new ClienteCreditoControladora();

    // Verificar si se encontraron datos
    // Intentar eliminar el credito
    $deleted = $controladora->eliminar($identificador);

    // Preparar la respuesta
    $response = $deleted ? [
        'message' => 'El crédito ha sido eliminado con éxito!'
    ] : [
        'error' => 'No se encontró ningún crédito con el identificador proporcionado.',
    ];
} else {
    // Preparar respuesta de error si no se proporcionó el identificador
    $response = [
        'error' => 'Identificador no proporcionado.',
    ];
}

// Enviar la respuesta como JSON
echo json_encode($response);
