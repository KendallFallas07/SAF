<?php

require_once '../view/validacionRutas.php';
include_once "./ControladoraVenta.php";

header('Content-Type: application/json');

$saleIdentifier = $_GET['identifier'] ?? null;

if ($saleIdentifier) {
    $ventaController = new ControladoraVenta();

    // Recuperar los datos usando el identificador
    $ventaData = $ventaController->obtenerDatosUsuario($saleIdentifier); // Suponiendo que tienes un método para esto
    // Verificar si se encontraron datos
    if (!empty($ventaData)) {
        // Preparar la respuesta
        $response = [
            'fotoPerfil' => $ventaData['tbusuariofotoperfil'],
            'nombreUsuario' => $ventaData['tbusuarionombreusuario'],
            'nombre' => $ventaData['tbusuarionombre'],
            'apellidos' => $ventaData['tbusuarioapellidos'],
            'rol' => $ventaData['tbusuariorol'],
            'direccion' => $ventaData['tbusuariodireccion']
        ];
    } else {
        // Preparar respuesta de error si no se encontraron datos
        $response = [
            'error' => 'No se encontró ninguna venta con el identificador proporcionado.',
        ];
    }
} else {
    // Preparar respuesta de error si no se proporcionó el identificador
    $response = [
        'error' => 'Identificador no proporcionado.',
    ];
}

// Enviar la respuesta como JSON
echo json_encode($response, JSON_PRETTY_PRINT);
