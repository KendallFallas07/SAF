<?php

include_once "../domain/TipoUnidad.php";

include_once "./ControladoraTipoUnidad.php";

function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        selectUnitType();
        break;

    case 'POST':
        modifyUnitType();
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}

function selectUnitType() {
    if (isset($_GET['identifierUnit'])) {
        $idUnit = $_GET['identifierUnit'];
        $unitController = new ControladoraTipoUnidad();
        $unitSelected = new TipoUnidad(0, $idUnit, '', '', '', '', false);

        $unitType = $unitController->getUnitType($unitSelected);

        if ($unitType !== null) {
            sendMessage($unitType);
        } else {
            sendMessage(null);
        }
    } else {
        sendJsonResponse(['error' => 'Identificador no proporcionado']);
    }
}

function modifyUnitType() {
    $nameUnit='';
    $identifier='';
    $dateH = new DateTime();

    if (isset($_POST['nameUnit']) && !empty($_POST['nameUnit']) && is_string($_POST['nameUnit'])) {
        $nameUnit = trim($_POST['nameUnit']);
        $unitController = new ControladoraTipoUnidad();

        $description = isset($_POST['descriptionUnit']) && !empty($_POST['descriptionUnit']) ? $_POST['descriptionUnit'] : 'Sin descripcion';

        if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",$nameUnit)||!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",$description)){
            sendMessageModify(4);
        }

        $identifier = $_POST['identifier'];

        if($unitController->validationName($nameUnit,$identifier)||similitud ($nameUnit) && !puedeModificar($nameUnit, $identifier)){
            sendMessageModify(3);
        }

        $id=$unitController->nextIdUnit();

        $newUnitType = new TipoUnidad($id, $identifier, $nameUnit, $description, '', $dateH, true);

        $unitSelected= $unitController->getUnitType( $newUnitType);

        $newUnitType->setCreatedAtUnit($unitSelected->getCreatedAtUnit());


        if ($unitController->updateUnitType($newUnitType)) {
            sendMessageModify(1);
        } else {
            sendMessageModify(-1);
        }
    } else {
        sendMessageModify(4);
    }
}

function sendMessage($unitType) {
    $response = [
        'unitType' => $unitType ? $unitType->toArray() : null
    ];
    sendJsonResponse($response);
}

function sendMessageModify($code) {
    $messages = [
        1 => "Tipo de unidad modificado con éxito",
        3 => "Ya existe una Unidad con ese nombre, no se puede realizar la modificacion.",
        4 => "El nombre se encuentra vacío o contiene datos inválidos.",
        -1 => "Error al modificar la Unidad"
    ];

    sendJsonResponse(["message" => $messages[$code],"code"=>$code ?? "Error desconocido"]);
}



function porcentajeIncidencia(string $palabraEntrada, string $palabraBD) {
    // Se pasa a minúsculas
    $palabraEntradaNormalizada = strtolower($palabraEntrada);
    $palabraBDNormalizada = strtolower($palabraBD);
    
    // Divide las cadenas en palabras
    $palabraEntradaArray = explode(' ', $palabraEntradaNormalizada);
    $palabraBDArray = explode(' ', $palabraBDNormalizada);
    
    // Ordena las palabras
    sort($palabraEntradaArray);
    sort($palabraBDArray);
    
    // Une las palabras ordenadas en cadenas
    $palabraEntradaOrdenada = implode(' ', $palabraEntradaArray);
    $palabraBDOrdenada = implode(' ', $palabraBDArray);
    
    // Calcula la similitud
    similar_text($palabraEntradaOrdenada, $palabraBDOrdenada, $porcentajeSimilitud);
    
    return $porcentajeSimilitud / 100;
}


function similitud ($palabra): bool{
    $controllerUnit=new ControladoraTipoUnidad();

$nombresRegistrados = $controllerUnit->UniTypeName();

$respuesta = "";

foreach ($nombresRegistrados as $key){

    $probabilidad = 0.0;

    $probabilidad = porcentajeIncidencia($palabra, $key['tbtipounidadnombre']);

    if($probabilidad > 0.75){

       return true;
    }

}

return false;
}


function puedeModificar($nameUnit, $identifier): bool {
    $unitController = new ControladoraTipoUnidad();
    $newUnitType = new TipoUnidad(0, $identifier, '', '', '', null, true);
    $nombreActual = ($unitController->getUnitType($newUnitType))->getNameUnit();
    return $nameUnit == $nombreActual;
}