<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../business/ControladoraSubcategoria.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $subcategory = new ControladoraSubcategoria();
    $action = $_GET["action"] ?? '';

    switch ($action) {
        case 'search':
            // Realiza la búsqueda de categorías
            $search = $_GET["searchSubcat"] ?? '';
            if (!empty(trim($search))) {
                $subCatList = $subcategory->buscarPorFiltro($search);
                $subDisableList = $subcategory->buscarDEshabilitadas($search);
            } else {
                $subCatList = $subcategory->ObtenerSubcategorias();
                $subDisableList = $subcategory->ObtenerSubcategoriasDeshabilitadas();
            }

            foreach ($subDisableList as $subObj) {
                $category = $subcategory->obtenerCategoriaPorIdentificador($subObj->getIdentifierCat());
                $nameAux = ($category !== null) ? $category->getNameCategory() : 'deshabilitada';

                $subObj->setCategoryName($nameAux);
            }

            foreach ($subCatList as $subObj) {
                $category = $subcategory->obtenerCategoriaPorIdentificador($subObj->getIdentifierCat());
                $nameAux = ($category !== null) ? $category->getNameCategory() : 'deshabilitada';

                $subObj->setCategoryName($nameAux);
            }

            $response = array_map(function ($subCat) {
                return [
                    'id' => $subCat->getIdentifierSubCat(),
                    'name' => $subCat->getNameSubcategory(),
                    'description' => $subCat->getDescriptionSubcat(),
                    'categoria' => $subCat->getCategoryName()
                ];
            }, $subCatList);

            $responseDisable = array_map(function ($subCat) {
                return [
                    'id' => $subCat->getIdentifierSubCat(),
                    'name' => $subCat->getNameSubcategory(),
                    'description' => $subCat->getDescriptionSubcat(),
                    'categoria' => $subCat->getCategoryName()
                ];
            }, $subDisableList);

            header('Content-Type: application/json');
            echo json_encode([
                "subCat" => $response,
                "disable" => $responseDisable
            ]);


            break;

        case 'viewDisable':

            $disableCat = $subcategory->obtenerSubcategoriasDeshabilitadas();

            foreach ($disableCat as $subObj) {
                $category = $subcategory->obtenerCategoriaPorIdentificador($subObj->getIdentifierCat());
                $nameAux = ($category !== null) ? $category->getNameCategory() : 'deshabilitada';

                $subObj->setCategoryName($nameAux);
            }

            $response = array_map(function ($subCat) {
                return [
                    'id' => $subCat->getIdentifierSubCat(),
                    'name' => $subCat->getNameSubcategory(),
                    'description' => $subCat->getDescriptionSubcat(),
                    'categoria' => $subCat->getCategoryName()
                ];
            }, $disableCat);

            sendMessage("disable", $response);

            break;

        case 'enableSubcat':

            $identificador = $_GET['id'] ?? '';
            if ($identificador) {
                $activate = $subcategory->habilitar($identificador);
                if ($activate) {

                    //lista de deshabilitados
                    $disableCat = $subcategory->obtenerSubcategoriasDeshabilitadas();

                    foreach ($disableCat as $subObj) {
                        $category = $subcategory->obtenerCategoriaPorIdentificador($subObj->getIdentifierCat());
                        $nameAux = ($category !== null) ? $category->getNameCategory() : 'deshabilitada';

                        $subObj->setCategoryName($nameAux);
                    }

                    $response = array_map(function ($subCat) {
                        return [
                            'id' => $subCat->getIdentifierSubCat(),
                            'name' => $subCat->getNameSubcategory(),
                            'description' => $subCat->getDescriptionSubcat(),
                            'categoria' => $subCat->getCategoryName()
                        ];
                    }, $disableCat);

                    //lista de habilitados
                    $subCatList = $subcategory->ObtenerSubcategorias();


                    foreach ($subCatList as $subObj) {

                        $category = $subcategory->obtenerCategoriaPorIdentificador($subObj->getIdentifierCat());
                        $nameAux = ($category !== null) ? $category->getNameCategory() : 'deshabilitada';

                        $subObj->setCategoryName($nameAux);
                    }

                    $responsesubCat = array_map(function ($subCat) {
                        return [
                            'id' => $subCat->getIdentifierSubCat(),
                            'name' => $subCat->getNameSubcategory(),
                            'description' => $subCat->getDescriptionSubcat(),
                            'categoria' => $subCat->getCategoryName()
                        ];
                    }, $subCatList);



                    header('Content-Type: application/json');
                    echo json_encode([
                        "message" => 'la subcategoria se ha activado correctamente',
                        "subcat" => $responsesubCat,
                        "disable" => $response,
                        "code" => 1
                    ]);
                } else {
                    $response = ["message" => "Error al habilitar la subcategoria", "code" => 0];
                }
            }

            break;

        case 'autocomplete':

            $search = $_GET["search"] ?? '';

            // Initialize $respuesta as an empty string
            $respuesta = '';

            if (!empty(trim($search))) {
                // Call the autocomplete method
                $subCatList = $subcategory->autocompletar($search);

                foreach ($subCatList as $key) {
                    // Build the response list
                    $respuesta .= "<option value=\"" . htmlspecialchars($key->getNameSubcategory(), ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($key->getNameSubcategory(), ENT_QUOTES, 'UTF-8') . "</option>";
                }//<option value='${value}'>${value}</option>

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



function sendMessage($label, $response)
{
    header('Content-Type: application/json');
    echo json_encode([$label => $response]);
}
