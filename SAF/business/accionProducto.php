<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "./ControladoraProducto.php";
include_once "./ControladoraCategoria.php";
include_once "./ControladoraUnidadMedida.php";
include_once "./ControladoraPresentacion.php";
include_once "./ControladoraQR.php";


/**
 * Se encarga de recibir consultas y de devolver los datos solicitados
 * 
 * @author Daniel Briones
 * @version 1.0
 * @since 19-8-24
 */


// Para la fecha actual en Costa Rica
date_default_timezone_set('America/Costa_Rica');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');



$metodo = $_SERVER['REQUEST_METHOD'];
// Para obtener el identificador que viene en la consulta. 
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$searchIdentifier = explode('/', $path);
$id = ($path !== '/') ? end($searchIdentifier) : null;

switch ($metodo) {
    case 'GET':
        $action = $_GET['action'] ?? '';
        if ($action === 'getProduct' && isset($_GET['id'])) {
            getProductById($_GET['id']);
        } elseif ($_GET['searchProduct']) {
            searchProduct($_GET['searchProduct']);
        } else {
            getAllProduct();
        }
        break;
    case 'POST':
        insertSupplier();
        break;
    case 'DELETE':
        deleteSupplier();
        break;
    case 'PUT':
        updateProduct();
        break;
    default:
        $response = ['status' => 'error', 'message' => 'Método no disponible'];
        echo json_encode($response);
        exit();
}


/**
 * Se encarga de validar los datos antes de registrar el nuevo producto, y si pasa las validaciones llama a la controller para ir a guardar en BD
 * 
 * @return JSON Con un mensaje, ya sea de éxito o de error
 */
function insertSupplier()
{
    // Acceder a los datos enviados a través del formulario
    $name = isset($_POST['nombre-producto']) ? $_POST['nombre-producto'] : '';
    $description = isset($_POST['descripcion-producto']) ? $_POST['descripcion-producto'] : '';
    $category = isset($_POST['categoria-producto']) ? $_POST['categoria-producto'] : '';
    $unitM = isset($_POST['unidad-medida']) ? $_POST['unidad-medida'] : '';
    $presentation = isset($_POST['presentacion']) ? $_POST['presentacion'] : '';
    $supplier = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';


    // Validar que todos los datos esten completos
    if (empty($name) || empty($description) || empty($category) || empty($unitM) || empty($presentation) || empty($supplier)) {
        $response = ['status' => 'error', 'message' => 'Debe completar todos los campos que sean requeridos.'];
        echo json_encode($response);
        exit();
    }


    $productController = new ControladoraProducto();
    $respuestaJson = $productController->existeElNombreDelProducto($name, "");
    if (isset($respuestaJson['existe']) && $respuestaJson['existe']) {
        if ($respuestaJson['activo'] === 1) {
            $response = ['status' => 'error', 'message' => 'El nombre del producto ya se encuentra registrado y está activo'];
        } else if ($respuestaJson['activo'] === 0) {
            $response = ['status' => 'error', 'message' => 'El nombre del producto ya se encuentra registrado y está inactivo'];
        }
        echo json_encode($response);
        exit();
    }
    $newProduct = $productController->createProduct($name, $description, $category, $unitM, $presentation, $supplier);

    $flag = $productController->saveProduct($newProduct);
    if ($flag) {
        $qrController = new ControladoraQR();

        $dir = "../images/qr/";
        $imageName = $newProduct->getIdentificador() . ".png";
        $content = "" . $newProduct->getIdentificador();

        // Eliminar carcteres especiales del nombre de la imagen
        $imageName = str_replace([' ', ':'], '_', $imageName);

        $result = $qrController->generateImgQRPNG($dir, $imageName, $content);
        if ($result) {
            $response = ['status' => 'successful', 'message' => 'Producto agregado correctamente.'];
            echo json_encode($response);
        } else {
            $response = ['status' => 'error', 'message' => 'Producto agregado, pero se produjo error al generar el QR'];
            echo json_encode($response);
        }
        exit();
    } else {
        $response = ['status' => 'error', 'message' => 'Error al agregar el producto.'];
        echo json_encode($response);
        exit();
    }
}


/**
 * Encargado de hacer la solicitud para eliminar un producto de la base de datos
 * 
 */
function deleteSupplier()
{
    $action = $_GET['action'] ?? '';

    if ($action === 'deleteProduct') {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $productController = new ControladoraProducto();
            $product = $productController->findByIdentifier($id);
            $result = $productController->deleteProduct($product);

            if ($result) {
                echo json_encode(['status' => 'successful', 'message' => 'Eliminado correctamente', 'product' => $product ? "Si viene algo" : "Nada"]);
            } else {
                echo json_encode(['status' => 'failed', 'message' => 'Ha ocurrido un error, intentalo de nuevo más tarde']);
            }
        } else {
            echo json_encode(['status' => 'failed', 'message' => 'ID no proporcionado']);
        }
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Identificador requerido']);
    }
    exit();
}


function getProductById($id)
{
    if ($id) {
        $productoController = new ControladoraProducto();
        $products = $productoController->findByIdentifier($id);
        if ($products) {
            $imagenesProducto = $productoController->obtenerImagenesProductos($id);
            $response = [
                'status' => 'successful',
                'message' => 'Producto encontrado.',
                'product' => $products->toArray(),
                'imagenesProducto' => $imagenesProducto
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'ID del producto no proporcionado']);
    }
    exit();
}



function getAllProduct()
{
    $productoController = new ControladoraProducto();
    $products = $productoController->searchProduct("");

    if ($products) {
        $response = [
            'status' => 'successful',
            'message' => 'Producto encontrado.',
            'product' => $products
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    }
    exit();
}

function searchProduct($search)
{
    $productoController = new ControladoraProducto();
    $products = $productoController->searchProduct($search);

    if ($products) {
        $response = [
            'status' => 'successful',
            'message' => 'Producto encontrado.',
            'product' => $products
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    }
    exit();
}



// /**
//  * Encargado de hacer la solicitud para modificar un producto de la base de datos
//  * 
//  */
function updateProduct()
{

    $requestData = file_get_contents('php://input');
    $data = json_decode($requestData, true);

    $identifier = isset($data['identificador-producto']) ? $data['identificador-producto'] : '';
    $name = isset($data['nombre-producto']) ? $data['nombre-producto'] : '';
    $description = isset($data['descripcion-producto']) ? $data['descripcion-producto'] : '';
    $category = isset($data['categoria-producto']) ? $data['categoria-producto'] : '';
    $unitM = isset($data['unidad-medida']) ? $data['unidad-medida'] : '';
    $presentation = isset($data['presentacion']) ? $data['presentacion'] : '';
    $supplier = isset($data['proveedor']) ? $data['proveedor'] : '';


    if (empty($name) || empty($description) || empty($category) || empty($unitM) || empty($presentation) || empty($supplier)) {
        $response = ['status' => 'error', 'message' => 'Debe completar todos los campos que sean requeridos.'];
        echo json_encode($response);
        exit();
    }

    $productController = new ControladoraProducto();
    $respuestaJson = $productController->existeElNombreDelProducto($name, $identifier);
    if (isset($respuestaJson['existe']) && $respuestaJson['existe']) {
        if ($respuestaJson['activo'] === 1) {
            $response = ['status' => 'error', 'message' => 'El nombre del producto ya se encuentra registrado y está activo'];
        } else if ($respuestaJson['activo'] === 0) {
            $response = ['status' => 'error', 'message' => 'El nombre del producto ya se encuentra registrado y está inactivo'];
        }
        echo json_encode($response);
        exit();
    }

    $productSearch = $productController->findByIdentifier($identifier);

    // Modificar los datos del objeto ya creado
    $modifiedAt = new DateTime();
    $productSearch->setNombre($name);
    $productSearch->setDescription($description);
    $productSearch->setActualizadoEn($modifiedAt);


    // Otras controller
    $categoryController = new ControladoraCategoria();
    $unidadMedidaController = new ControladoraUnidadMedida();
    $presentationController = new PresentacionController();
    $proveedorController = new ControladoraProveedor();

    $categorySearch = $categoryController->getCategoryByIdentifier($category);
    $productSearch->setCategoria($categorySearch);

    $unidadMedidaSearch = $unidadMedidaController->findByidentifier($unitM);
    $productSearch->setUnidadMedida($unidadMedidaSearch);

    $presentationSearch = $presentationController->findById($presentation);
    $productSearch->setPresentacion($presentationSearch);

    $proveedor = $proveedorController->findByIdentifier($supplier);
    $productSearch->setProveedor($proveedor);

    $flag = $productController->updateProduct($productSearch);
    if ($flag) {
        $response = ['status' => 'successful', 'message' => 'Producto modificado correctamente.'];
        echo json_encode($response);
        exit();
    } else {
        $response = ['status' => 'error', 'message' => 'Error al modificar el producto.'];
        echo json_encode($response);
        exit();
    }
}



// Respuesta por defecto es ejecutada en caso que el sitio no se encuentre
$response = ['status' => 'error', 'message' => 'El sitio no fue encontrado.'];
echo json_encode($response);
exit();