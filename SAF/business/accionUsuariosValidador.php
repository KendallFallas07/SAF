<?php
session_start();
require_once "./ControladoraUsuarios.php";

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

date_default_timezone_set("America/Costa_Rica");
$user = $_POST["user"];
$pass = (string) $_POST["pass"];
$controller = new ControladoraUsuarios();
if ($controller->verifyUser($user, $pass)) {
    $_SESSION["id"] = $_COOKIE["PHPSESSID"];
    response("200", "ok");
} else {
    response("404", "datos incorrectos intentelo de nuevo");
}