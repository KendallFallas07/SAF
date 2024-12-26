<?php

include_once "../domain/Categoria.php";

include_once "./ControladoraCategoria.php";

function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        selectCategory();
        break;

    case 'POST':
        modifyCategory();
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}

function selectCategory() {
    if (isset($_GET['identifierCat'])) {
        $idCat = $_GET['identifierCat'];
        $controllerCat = new ControladoraCategoria();
        $categorySelected = new Categoria(0, $idCat, '', '', '', '', false);

        $category = $controllerCat->getCategory($categorySelected);

        if ($category !== null) {
            sendMessage($category);
        } else {
            sendMessage(null);
        }
    } else {
        sendJsonResponse(['error' => 'Identificador no proporcionado']);
    }
}

function modifyCategory() {
    $nameCat='';
    $identifier='';
    $dateH = new DateTime();

    if (isset($_POST['nameCat']) && !empty($_POST['nameCat']) && is_string($_POST['nameCat'])) {
        $nameCat = trim($_POST['nameCat']);
        $controllerCat = new ControladoraCategoria();

       

        $description = isset($_POST['descriptionCat']) && !empty($_POST['descriptionCat']) ? $_POST['descriptionCat'] : 'Sin descripcion';

        if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",$nameCat)||!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/",$description)){
            sendMessageModify(4);
        }

        $identifier = $_POST['identifier'];

        $id=$controllerCat->nextIdCat();

        $newCategory = new Categoria($id, $identifier, $nameCat, $description, '', $dateH, true);

        $categorySelected= $controllerCat->getCategory( $newCategory);


        if ($controllerCat->validationName($nameCat,$_POST['identifier'])||similitud ($nameCat)&& $nameCat !==$categorySelected->getNameCategory()) {
            sendMessageModify(3);
        }

        $newCategory->setCreatedAtCat($categorySelected->getCreatedAtCat());


        if ($controllerCat->updateCategory($newCategory)) {
            sendMessageModify(1);
        } else {
            sendMessageModify(-1);
        }
    } else {
        sendMessageModify(4);
    }
}

function sendMessage($categorySelect) {
    $response = [
        'Category' => $categorySelect ? $categorySelect->toArray() : null
    ];
    sendJsonResponse($response);
}

function sendMessageModify($code) {
    $messages = [
        1 => "Categoría modificada con éxito",
        3 => "Ya existe una categoría con ese nombre, no se puede realizar la modificacion.",
        4 => "El nombre se encuentra vacío o contiene datos inválidos.",
        -1 => "Error al modificar la categoría"
    ];

    sendJsonResponse(["message" => $messages[$code] ?? "Error desconocido"]);
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
    $controllerCat=new ControladoraCategoria();

$nombresRegistrados = $controllerCat->getNameCat();

$respuesta = "";

foreach ($nombresRegistrados as $key){

    $probabilidad = 0.0;

    $probabilidad = porcentajeIncidencia($palabra, $key['tbcategorianombre']);

    if($probabilidad > 0.75){

       return true;
    }

}

return false;
}