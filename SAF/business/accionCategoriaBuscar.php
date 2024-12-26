<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../business/ControladoraCategoria.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoryController = new ControladoraCategoria();
    $action = $_GET["action"] ?? '';

    switch ($action) {
        case 'search':
            // Realiza la búsqueda de categorías
            $search = $_GET["searchCat"] ?? '';
            if (!empty(trim($search))) {
                $categoriesList = $categoryController->getCategoryByFilter($search);
                $disableCat = $categoryController->getdisableFilt($search);
            } else {
                $categoriesList = $categoryController->getAllCategories();
                $disableCat = $categoryController->getDisableCategory();
            }

            $response = array_map(function($category) {
                return [
                    'id' => $category->getIdentifierCat(),
                    'name' => $category->getNameCategory(),
                    'description' => $category->getDescriptionCat()
                ];
            }, $categoriesList);


            $responseDisable = array_map(function($category) {
                return [
                    'id' => $category->getIdentifierCat(),
                    'name' => $category->getNameCategory(),
                    'description' => $category->getDescriptionCat()
                ];
            }, $disableCat);

            header('Content-Type: application/json');
                        echo json_encode(["message"=>'a categoría se ha activado correctamente',
                        "category"=>$response,
                        "disable"=>$responseDisable,"code"=>1]);
            break;

        case 'viewDisable':
        
            $disableCat = $categoryController->getDisableCategory();

            $responseDisable = array_map(function($category) {
                return [
                    'id' => $category->getIdentifierCat(),
                    'name' => $category->getNameCategory(),
                    'description' => $category->getDescriptionCat()
                ];
            }, $disableCat);
            sendMessage("disable",$responseDisable);
           
            break;

            case 'enableCategory':

                $identificador= $_GET['id']??'';
                if($identificador){
                    $activate = $categoryController->getActivateLastCategory($identificador);
                    if($activate){

                        //lista de deshabilitados
                        $disableCat = $categoryController->getDisableCategory();

                        $responseDisable = array_map(function($category) {
                            return [
                                'id' => $category->getIdentifierCat(),
                                'name' => $category->getNameCategory(),
                                'description' => $category->getDescriptionCat()
                            ];
                        }, $disableCat);

                        //lista de habilitados
                        $categoriesList = $categoryController->getAllCategories();

                        $response = array_map(function($category) {
                            return [
                                'id' => $category->getIdentifierCat(),
                                'name' => $category->getNameCategory(),
                                'description' => $category->getDescriptionCat()
                            ];
                        }, $categoriesList);
                


                        header('Content-Type: application/json');
                        echo json_encode(["message"=>'La categoría se ha activado correctamente',
                        "category"=>$response,
                        "disable"=>$responseDisable,"code"=>1]);
                    
                    
                    }else{
                        $response = ["message"=>"Error al habilitar la categoria","code"=>0];
                    }
                }

            break;


            case 'autocomplete':

                $search = $_GET["search"] ?? '';
            
                // Initialize $respuesta as an empty string
                $respuesta = '';
            
                if (!empty(trim($search))) {
                    // Call the autocomplete method
                    $subCatList = $categoryController->autocompletar($search);
            
                    foreach ($subCatList as $key) {
                        // Build the response list
                        $respuesta .= "<option value=\"" . htmlspecialchars($key->getNameCategory(), ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($key->getNameCategory(), ENT_QUOTES, 'UTF-8') . "</option>";
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