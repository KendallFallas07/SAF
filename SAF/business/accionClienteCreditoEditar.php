<?php

include_once "./ControladoraClienteCredito.php";

header('Content-Type: application/json');

// Recupero el identificador
$identificador = $_GET['identificador'] ?? null;

if ($identificador) {

    $controladora = new ClienteCreditoControladora();
    $usuarios = $controladora->obtenerClientes();

    // Recuperar los datos usando el identificador
    $clienteCreditoData = $controladora->buscarPorIdentificador($identificador);

    

    // Verificar si se encontraron datos
    if (!empty($clienteCreditoData)) {

        $clienteCreditoData = $clienteCreditoData[0]; // Tomar el primer resultado si hay múltiples

        // Preparar la respuesta
        $response = [
            'id' => $clienteCreditoData['tbclientecreditoid'],
            'identificador' => $clienteCreditoData['tbclientecreditoidentificador'],
            'clienteId' => $clienteCreditoData['tbclienteidentificador'], 
            'cantidad' => $clienteCreditoData['tbclientecreditocantidad'],
            'porcentaje' => $clienteCreditoData['tbclientecreditoporcentaje'],
            'plazo' => $clienteCreditoData['tbclientecreditoplazo'],
            'inicio' => $clienteCreditoData['tbclientecreditofechainicio'],
            'fin' => $clienteCreditoData['tbclientecreditofechavencimiento']
        ];
    } else {
        // Preparar respuesta de error si no se encontraron datos
        $response = [
            'error' => 'No se encontró ningún crédito con el identificador proporcionado.',
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