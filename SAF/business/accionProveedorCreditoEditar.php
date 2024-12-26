<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "./ControladoraProveedorCredito.php";

require_once "../domain/ProveedorCredito.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function sendJsonResponse($data)
{
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        seleccionarProCre();
        break;

    case 'POST':
 
        modifyProCre();
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}

function seleccionarProCre()
{
    if (isset($_GET['identificadorProCre'])) {
        $idProCre = $_GET['identificadorProCre'];
        $controProCre = new ProveedorCreditoController();
        $proCre = $controProCre->obtenerProveedorCreditoPorIdentificador($idProCre);

        if ($proCre != null) {
            sendMessage($proCre);
        } else {
            sendMessage(null);
        }
    } else {
        sendJsonResponse(['error' => 'Identificador no proporcionado']);
    }
}

function modifyProCre()
{
    $controProCre = new ProveedorCreditoController();

    // Obtener el próximo ID
    $id = $controProCre->obetenerNuevoId();


    // Obtener otros datos del formulario
    
    $proveedor = $_POST['proveedor'];
    
    $identificador = $_POST['identifier'];

    $cantidadCredito = $_POST['cantCre'];
    
    $porcentaje = $_POST['porcentaje'];

    $plazo = $_POST['plazo'];

    $fechIni = $_POST['fechIni'];

    $fechExp = $_POST['fechExp'];

    $fechaModificacion = (new DateTime())->format('Y-m-d');

    // Crear el objeto ProveedorCredito

    $proveedorCredito = new ProveedorCredito(
        $id,
        $proveedor,
        $identificador,
        $cantidadCredito,
        $porcentaje,
        $plazo,
        $fechIni,
        $fechExp,
        $fechaModificacion,
        $fechaModificacion,
        1 // Estado activo por defecto
    );
//    $proCreSelect=new ProveedorCredito();
//    $proCreSelect = $controProCre->obtenerProveedorCreditoPorIdentificador($proveedorCredito->getProveedorCIdentificador());
//
//    $proveedorCredito->setFechaCreacion($proCreSelect->getFechaCreacion());
    
    $controProCre = new ProveedorCreditoController ();

    if ($controProCre->editar($proveedorCredito)) {
        sendMessageModify(1);
    } else {
        sendMessageModify(-1);
    }

}

function sendMessage($proCreSelect)
{
    $response = [
        'ProveedorCredito' => $proCreSelect->toArray()
    ];
    sendJsonResponse($response);
}

function sendMessageModify($code)
{
    $messages = [
        1 => "ProveedorCredito modificado con éxito",
        3 => "Ya existe un ProveedorCredito con ese nombre, no se puede realizar la modificacion.",
        4 => "El nombre se encuentra vacío o contiene datos inválidos.",
        -1 => "Error al modificar el ProveedorCredito"
    ];

    sendJsonResponse(["message" => $messages[$code] ?? "Error desconocido"]);
}
