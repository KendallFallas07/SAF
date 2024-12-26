<?php

include_once "../domain/Presentacion.php";

include_once "./ControladoraPresentacion.php";

header('Content-Type: application/json');

// Recupero el identificador
$identificador = $_GET['identificador'] ?? null;

if ($identificador) {

    $controladora = new PresentacionController();

    // Recuperar los datos usando el identificador
    $presentacionData = $controladora->findByIdentifier($identificador);

    // Verificar si se encontraron datos
    if (!empty($presentacionData)) {

        $presentacionData = $presentacionData[0]; // Tomar el primer resultado si hay múltiples

        // Preparar la respuesta
        $response = [
            'id' => $presentacionData['tbpresentacionid'],
            'identificador' => $presentacionData['tbpresentacionidentificador'],
            'nombre' => $presentacionData['tbpresentacionombre'], 
            'descripcion' => $presentacionData['tbpresentaciondescripcion'],
        ];
    } else {
        // Preparar respuesta de error si no se encontraron datos
        $response = [
            'error' => 'No se encontró ningúna presentación con el identificador proporcionado.',
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
