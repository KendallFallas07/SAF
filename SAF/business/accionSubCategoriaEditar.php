<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'ControladoraSubcategoria.php';
require_once '../domain/Subcategoria.php';


function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

function getTimestamp(DateTime $date): int {
    return $date->getTimestamp();
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        getSubCategory(trim($_GET['identifierSubcat']));
        break;

    case 'POST':
        $category=isset($_POST['categorySelect'])?$_POST['categorySelect']:'';
       actualizarSubcategoria($_POST['nameSubCat'], $_POST['descriptionSubCat'], $category,$_POST['identifier']);
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}


function getSubCategory($subIdentifer){

    if (empty($subIdentifer)) {
        sendJsonResponse(['error' => 'Identificador de subcategoría es requerido']);
        return;
    }

    $controllerSubCat = new ControladoraSubcategoria();
    $subCat = $controllerSubCat->obtenerSubcategoriaPorId($subIdentifer);

    $response = [
        'id' => $subCat->getIdentifierSubCat(),
        'name' => $subCat->getNameSubcategory(),
        'description' => $subCat->getDescriptionSubCat(),
        'categoria' => $subCat->getIdentifierCat()
    ];


    sendJsonResponse(["subcat"=>$response]);

}


function actualizarSubcategoria($nombre, $description, $categorySelect, $identifier){
    if (empty($nombre)  || empty($categorySelect)) {
        sendMessage(-2);
    }
    $descripcion=!empty($descripcion)? $descripcion:'Sin descripcion';

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $descripcion)) {
        sendMessage(2);
    }

    $controllerSubCat = new ControladoraSubcategoria();
    $subCat = $controllerSubCat->obtenerSubcategoriaPorId($identifier);

    if($controllerSubCat->validarNombre($nombre,$identifier)|| similitud ($nombre) && $nombre !== $subCat->getNameSubcategory()){
        sendMessage(3);
    }

    if ($subCat) {
        $subCat->setIdSubCat($controllerSubCat->obtenerSIguienteId());
        $subCat->setNameSubcategory($nombre);
        $subCat->setDescriptionSubCat($description);
        $subCat->setIdentifierCat($categorySelect);
        $subCat->setModifiedAtSubcat((new DateTime())->setTimezone(new DateTimeZone('America/Costa_Rica')));
    }

        if ($controllerSubCat->actualizar($subCat)) {
            sendMessage(1);
        }else{
            sendMessage(-1);
        }

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
    $controllerSubCat=new ControladoraSubcategoria();

$nombresRegistrados = $controllerSubCat->obtenerNombresSubcategorias();

$respuesta = "";

foreach ($nombresRegistrados as $key){

    $probabilidad = 0.0;

    $probabilidad = porcentajeIncidencia($palabra, $key['tbsubcategorianombre']);

    if($probabilidad > 0.75){

       return true;
    }

}

return false;
}


function sendMessage($code) {
    $messages = [
        1 => "Subcategoria actualizada con éxito",
        2 => "No se puede usar numeros ni caracteres especiales..",
        3 => "Ya existe una Subcategoria con ese nombre..",
        4 => "El nombre se encuentra vacío o contiene datos inválidos...",
        -2 => "El nombre se encuentra vacío o no se ha elegido categoria..",
        -1 => "Error al actualizar la Subcategoria"
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido"]);
}


function puedeModificar($nameUnit, $identifier): bool {
    $subCat = new ControladoraSubcategoria();
    $newUnitType = new Subcategoria(0,'',$identifier,'','',new DateTime(),new DateTime(),0);
    $nombreActual = ($subCat->obtenerSubcategoriaPorId($newUnitType))->getNameSubcategory();
    return $nameUnit == $nombreActual;
}