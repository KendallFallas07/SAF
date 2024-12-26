<?php

require_once './ControladoraImpuesto.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Recupero el identificador
$identificador = $_GET['identificador'] ?? null;

if ($identificador) {

    $controladora = new ImpuestosController();

    $recuperado = $controladora->recuperar($identificador);

    // Preparar la respuesta
    $response = $recuperado ? [
        'message' => 'El impuesto ha sido recuperado con éxito!'
    ] : [
        'error' => 'No se encontró ningún impuesto con el identificador proporcionado.',
    ];
} else {
    // Preparar respuesta de error si no se proporcionó el identificador
    $response = [
        'error' => 'Identificador no proporcionado.',
    ];
}

// Enviar la respuesta como JSON
echo json_encode($response);