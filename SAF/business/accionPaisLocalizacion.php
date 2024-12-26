
<?php

include_once "./ControladoraPaisLocalizacion.php";

include_once "../domain/Country.php";



// Crea una instancia de la clase
$countryLocationData = new ControladoraPaisLocalizacion();

$countryData = $countryLocationData->getAllCountry();
$countryList=[];

foreach ($countryData as $countriesDates) {
  
        $countryList[] = new Pais($countriesDates['tbpaisid'],$countriesDates['tbpaisidentificador'],$countriesDates['tbpaisnombre'],
    new DateTime($countriesDates['tbpaisfechacreacion']),
        new DateTime($countriesDates['tbpaisfechamodificacion']),
        $countriesDates['tbpaisestado']);
}

$countryArray=array_map(function($country) {
    return [
        'id' => $country->getId(),
        'identifier' => $country->getIdentifier(),
        'name' => $country->getNameCountry(),
        'creation_date' => $country->getStrCreatedAt(),
        'modification_date' => $country->getStrModifiedAt(),
        'status' => $country->getStatus(),
    ];
}, $countryList);




// Prepara los datos para la respuesta
$response = [
    'countries' => $countryArray, 
    'success' => true,  // Indica que la operación fue exitosa
    'error' => false,
    'message' => 'Datos cargados correctamente'
];

// Configura el tipo de contenido para la respuesta
header('Content-Type: application/json');

// Imprime los datos en formato JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>

