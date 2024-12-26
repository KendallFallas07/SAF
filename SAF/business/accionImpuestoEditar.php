<?php

include_once "./ControladoraImpuesto.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Recupero el identificador
$identificador = $_GET['identificador'] ?? null;

if ($identificador) {

    $controladora = new ImpuestosController();

    // Recuperar los datos usando el identificador
    $impuestoData = $controladora->buscarPorIdentificador($identificador);

    // Verificar si se encontraron datos
    if (!empty($impuestoData)) {

        $impuestoData = $impuestoData[0]; // Tomar el primer resultado si hay múltiples

        // Preparar la respuesta
        $response = [
            'id' => $impuestoData['tbimpuestoid'],
            'identificador' => $impuestoData['tbimpuestoidentificador'],
            'nombre' => $impuestoData['tbimpuestonombre'], 
            'descripcion' => $impuestoData['tbimpuestodescripcion'],
            'valor' => $impuestoData['tbimpuestovalor'],
            'vigencia' => $impuestoData['tbimpuestovigencia'],
            
        ];
    } else {
        // Preparar respuesta de error si no se encontraron datos
        $response = [
            'error' => 'No se encontró ningún impuesto con el identificador proporcionado.',
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