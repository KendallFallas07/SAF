<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../business/ControladoraMargenGanancia.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $margenController = new ControladoraMargenGanancia();
    $action = $_GET["action"] ?? '';

    switch ($action) {
        case 'search':
            // Realiza la búsqueda de categorías
            $search = $_GET["searchMargen"] ?? '';
            if (!empty(trim($search))) {
                $margenList = $margenController->filterEnable($search);
            } else {
                $margenList = $margenController->getALlMargens();
            }

            $response = array_map(function ($margen) {
                return [
                    'id' => $margen->getIdentifierMargen(),
                    'port' => $margen->getPorcentaje(),
                    'prod' => $margen->getNameProduct()
                ];
            }, $margenList);

        
            header('Content-Type: application/json');
            echo json_encode([
                "margResp" => $response
            ]);


            break;
        default:
            // Maneja las acciones desconocidas o muestra un mensaje de error
            header('Content-Type: application/json');
            echo json_encode(["error" => "Invalid action"]);
            break;
    }
} else {
    // Maneja el caso en el que el request no es GET
    header('Content-Type: application/json');
    echo json_encode(["error" => "Only GET requests are allowed"]);
}



function sendMessage($label, $response)
{
    header('Content-Type: application/json');
    echo json_encode([$label => $response]);
}
