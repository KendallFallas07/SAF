<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'ControladoraTipoUnidad.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $unitController = new ControladoraTipoUnidad();
    $action = $_GET["action"] ?? '';

    switch ($action) {
        case 'search':

            $search = $_GET["searchUnit"] ?? '';
            if (!empty(trim($search))) {
                $UnitList = $unitController->getUnitTypesByFilter($search);
                $unitListDisable=$unitController->getUnitTypeDisableFilt($search);
             } else {
                 $UnitList = $unitController->getAllUnitTypes();
                 $unitListDisable=$unitController->getUnitTypeDisable();
             }

            

            $response = array_map(function($unit) {
                return [
                    'id' => $unit->getIdentifierTU(),
                    'name' => $unit->getNameUnit(),
                    'description' => $unit->getDescriptionUnit(),
                ];
            }, $UnitList);

            $responseDisable = array_map(function($unit) {
                return [
                    'id' => $unit->getIdentifierTU(),
                    'name' => $unit->getNameUnit(),
                    'description' => $unit->getDescriptionUnit(),
                ];
            }, $unitListDisable);

            header('Content-Type: application/json');
            echo json_encode(["unit"=>$response,"disable"=>$responseDisable]);

           
            break;

        case 'viewDisable':
        
            $UnitList = $unitController->getUnitTypeDisable();

            $response = array_map(function($unit) {
                return [
                    'id' => $unit->getIdentifierTU(),
                    'name' => $unit->getNameUnit(),
                    'description' => $unit->getDescriptionUnit(),
                ];
            }, $UnitList);

            sendMessage("disable",$response);
           
            break;

            case 'enableUnit':

                $identificador= $_GET['id']??'';
                if($identificador){
                    $activate = $unitController->habilitar($identificador);
                    if($activate){

                        //lista de deshabilitados
                        $UnitList = $unitController->getUnitTypeDisable();

                        $response = array_map(function($unit) {
                            return [
                                'id' => $unit->getIdentifierTU(),
                                'name' => $unit->getNameUnit(),
                                'description' => $unit->getDescriptionUnit(),
                            ];
                        }, $UnitList);

                        //lista de habilitados
                        $UnitList = $unitController->getAllUnitTypes();
                    
       
                   $responseHabit = array_map(function($unit) {
                       return [
                           'id' => $unit->getIdentifierTU(),
                           'name' => $unit->getNameUnit(),
                           'description' => $unit->getDescriptionUnit(),
                       ];
                   }, $UnitList);
                


                        header('Content-Type: application/json');
                        echo json_encode(["message"=>'El tipo de unidad se ha activado correctamente',
                        "unit"=>$responseHabit,
                        "disable"=>$response,"code"=>1]);
                    
                    
                    }else{
                        $response = ["message"=>"Error al habilitar la subcategoria","code"=>0];
                    }
                }

            break;

           case 'autocomplete':

    $search = $_GET["search"] ?? '';

    // Initialize $respuesta as an empty string
    $respuesta = '';

    if (!empty(trim($search))) {
        // Call the autocomplete method
        $subCatList = $unitController->autocompletar($search);

        foreach ($subCatList as $key) {
            // Build the response list
            $respuesta .= "<option value=\"" . htmlspecialchars($key->getNameUnit(), ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($key->getNameUnit(), ENT_QUOTES, 'UTF-8') . "</option>";
        }

        // Encode the result as JSON
        echo json_encode(['list' => $respuesta], JSON_UNESCAPED_UNICODE);
    }

    break;


    case 'listComplete':

        $search = $_GET["search"] ?? '';
    
        // Initialize $respuesta as an empty string
        $respuesta = '';
    
        if (!empty(trim($search))) {
            // Call the autocomplete method
            $subCatList = $unitController->getUnitTypeByIdentifier($search);
    
            foreach ($subCatList as $key) {
                // Verificar que `$key` es un array
                
                    $respuesta .= "<li>" . htmlspecialchars($key['tbunidadmedidanombreunidad'], ENT_QUOTES, 'UTF-8') . "</li>";
                
            }
            
    
            // Encode the result as JSON
            echo json_encode(['list' => $respuesta], JSON_UNESCAPED_UNICODE);
        }
    
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



function sendMessage($label,$response){
    header('Content-Type: application/json');
            echo json_encode([$label => $response]);
}