<?php
require_once "../domain/Distrito.php";
require_once "../domain/Canton.php";
require_once "./ControladoraPaisLocalizacion.php";

// Verifica si se recibió un parámetro de provincia
if (isset($_GET['cantonIdent'])) {
    $cantonIdentifier = $_GET['cantonIdent'];
    
    // Obtén la conexión y los datos
    $countryLocationData = new ControladoraPaisLocalizacion();
    
    // Obtener los cantones asociados a la provincia
    $districtData = $countryLocationData->getDistrictByCanton(new Canton(0,'',$cantonIdentifier,'','','',false));
    
    // Mapear los datos de cantones a un formato adecuado
    $districtArray = array_map(function($district) {
        return [
            'identifier' => $district['tbdistritoidentificador'],
            'name' => $district['tbdistritonombre'],
            'postalCode'=>$district['tbcodigopostal']
        ];
    }, $districtData);

    // Prepara los datos para la respuesta
    $response = [
        'district' => $districtArray,
        'success' => true,
        'error' => false,
        'message' => 'Datos cargados correctamente'
    ];
    
    // Configura el tipo de contenido para la respuesta
    header('Content-Type: application/json');
    
    // Imprime los datos en formato JSON
    echo json_encode($response, JSON_PRETTY_PRINT);
} else // Verifica si se recibió un parámetro de provincia
if (isset($_GET['districtIdent'])) {
    $districtIdentifier = $_GET['districtIdent'];
    
    // Obtén la conexión y los datos
    $countryLocationData = new ControladoraPaisLocalizacion();
    
    // Obtener los cantones asociados a la provincia
    $postalData = $countryLocationData->getPostalCodeBD(new Distrito(0, $districtIdentifier,'','','',false,'','',0));
    
    
    // Prepara los datos para la respuesta
    $response = [
        'postalData' => $postalData,
        'success' => true,
        'error' => false,
        'message' => 'Datos cargados correctamente'
    ];
    
    // Configura el tipo de contenido para la respuesta
    header('Content-Type: application/json');
    
    // Imprime los datos en formato JSON
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    // Maneja el caso donde no se recibe un parámetro de provincia
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => true, 'message' => 'Provincia no especificada']);
}


