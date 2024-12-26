<?php

include_once "./ControladoraPaisLocalizacion.php";

include_once "../domain/Provincia.php";


// Crea una instancia de la clase
$countryLocationData = new ControladoraPaisLocalizacion();

// Función para enviar una respuesta JSON
function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// Función para mapear los datos
function CreateMap($dataByBD, $identifierKey, $nameKey) {
    return array_map(function($dataInfo) use ($identifierKey, $nameKey) {
        return [
            'identifier' => $dataInfo[$identifierKey],
            'name' => $dataInfo[$nameKey]
        ];
    }, $dataByBD);
}

// Verifica los parámetros y ejecuta la lógica correspondiente
if (isset($_GET['countryIdent'])) {
    $countryIdentiFy = $_GET['countryIdent'];
    $provinceData = $countryLocationData->getAllProvinceByCountry(new Pais(0, $countryIdentiFy, '', '', '', false));
    $response = [
        'provinces' => CreateMap($provinceData, 'tbprovinciaidentificador', 'tbprovincianombre'),
        'success' => true,
        'error' => false,
        'message' => 'Datos cargados correctamente'
    ];
    sendJsonResponse($response);
} else if (isset($_GET['provinceIdent'])) {
    $provinceId = $_GET['provinceIdent'];
    $cantonsData = $countryLocationData->getCantonByProvince(new Provincia(0, $provinceId, '', '', '', '', ''));
    $response = [
        'cantons' => CreateMap($cantonsData, 'tbcantonidentificador', 'tbcantonnombre'),
        'success' => true,
        'error' => false,
        'message' => 'Datos cargados correctamente'
    ];
    sendJsonResponse($response);
} else {

    http_response_code(400);
    sendJsonResponse(['success' => false, 'error' => true, 'message' => 'Parámetro no especificado o inválido']);
}

