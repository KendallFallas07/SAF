<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./ControladoraProveedorCredito.php";

require_once "../domain/ProveedorCredito.php";
function response(string $error, string $message) {
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

//verificamos que el identificador llegue
$identificador;
if (isset($_GET['code'])) {
$identificador = trim($_GET['code']);
} else {
    response("404", "Lo sentimos la accion NO pudo ser reaizada.");
}


$controller = new ProveedorCreditoController();
if ($controller->borrarPorIdentificador($identificador)) {
    response("200", "EL registro fue eliminado correctamente");
} else {
    response("404", "Lo sentimos la accion NO pudo ser reaizada intentelo mas tarde.");
}