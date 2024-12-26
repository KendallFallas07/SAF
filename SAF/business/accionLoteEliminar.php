<?php
require_once "./ControladoraLote.php";

require_once "../domain/Lote.php";
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
$identifier;
if (isset($_GET['code'])) {
$identifier = trim($_GET['code']);
} else {
    response("404", "Lo sentimos la accion NO pudo ser reaizada.");
}


$controller = new LoteController();
if ($controller->deleteLote($identifier)) {
    response("200", "EL registro fue eliminado correctamente");
} else {
    response("404", "Lo sentimos la accion NO pudo ser reaizada intentelo mas tarde.");
}