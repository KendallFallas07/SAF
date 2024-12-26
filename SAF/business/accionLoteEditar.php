<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "./ControladoraLote.php";

require_once "../domain/Lote.php";

////var_dump($_GET);
////exit();
//$_GET=["identifierLote"=>"LOTE-1724727050"] ;
////var_dump($_GET);
//$idLote = $_GET['identifierLote'];
////var_dump($idLote);
////exit();



function sendJsonResponse($data)
{
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        selectLote();
        break;

    case 'POST':
 
        modifyLote();
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}

function selectLote()
{
    if (isset($_GET['identifierLote'])) {
        $idLote = $_GET['identifierLote'];
        $loteController = new LoteController();
        $loteSelected = new Lote(0, $idLote, '', '', '', '', '', '', '', '', false);

        $lote = $loteController->getLote($loteSelected);

        if ($lote != null) {
            sendMessage($lote);
        } else {
            sendMessage(null);
        }
    } else {
        sendJsonResponse(['error' => 'Identificador no proporcionado']);
    }
}

function modifyLote()
{
    $loteController = new LoteController();

    // Obtener el próximo ID
    $id = $loteController->getID();


    // Obtener otros datos del formulario

    $identificador = $_POST['identifier'];

    $productoIdentificador = $_POST['producto'];

    $cantidadAdquirida = $_POST['cantAdq'];
    
    $precioCompra = $_POST['precCom'];

    $fechExp = $_POST['fechExp'];

    $fechadq = $_POST['fechAdq'];


    $fechaModificacion = (new DateTime())->format('Y-m-d');

    // Crear el objeto Lote

    $lote = new Lote(
        $id,
        $identificador,
        $productoIdentificador,
        $cantidadAdquirida,
        $cantidadAdquirida,
        $precioCompra,
        $fechadq,
        $fechExp,
        "",
        $fechaModificacion,
        1 // Estado activo por defecto
    );

    $loteSelect = $loteController->getLote($lote);

    $lote->setFechaCreacion($loteSelect->getFechaCreacion());
    
    $loteController = new LoteController(); 

    if ($loteController->updateLote($lote)) {
        sendMessageModify(1);
    } else {
        sendMessageModify(-1);
    }

}

function sendMessage($loteSelt)
{
    $response = [
        'Lote' => $loteSelt->toArray()
    ];
    sendJsonResponse($response);
}

function sendMessageModify($code)
{
    $messages = [
        1 => "Lote modificado con éxito",
        3 => "Ya existe un lote con ese nombre, no se puede realizar la modificacion.",
        4 => "El nombre se encuentra vacío o contiene datos inválidos.",
        -1 => "Error al modificar el lote"
    ];

    sendJsonResponse(["message" => $messages[$code] ?? "Error desconocido"]);
}