<?php

require_once "./ControladoraRol.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

date_default_timezone_set("America/Costa_Rica");

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
$name;
if(isset($_POST["nombre"]) && !empty($_POST["nombre"])){
    $name = $_POST["nombre"];
}
else{
    response("404", "lo sentimos, intentelode nuevo 1");
}

$description;
if(isset($_POST["description"]) && !empty($_POST["description"])){
    $description = $_POST["description"];
}


$data = $_POST;
$date = new DateTime();
$data["identificador"] = "ROL-" . $date->getTimestamp();
$data["fechacreacion"] = $date->format("Y-m-d");
$data["fechamodificacion"] = $date->format("Y-m-d");
$data["estado"] = 1;


$controller = new ControladoraRol();
if($controller->save($data)){
    response("200", "Rol Guardado con Exito");
}else{
    response("404", "lo sentimos, intentelode nuevo");
}
