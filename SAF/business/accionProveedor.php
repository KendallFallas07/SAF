<?php

include_once "./ControladoraProveedor.php";
include_once "./ControladoraPaisLocalizacion.php";

/**
 * Se encarga de recibir consultas y de devolver los datos solicitados
 * 
 * @author Daniel Briones
 * @version 1.0.1
 * @since 21-8-24
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
        if (isset($_GET['action']) && $_GET['action'] === 'getSupplier') {
            getSupplierById();
        } else {
            getAllSuppliers();
        }
        break;
    case 'POST':
        insertSupplier();
        break;
    case 'DELETE':
        deleteSupplier();
        break;
    case 'PUT':
        updateSupplier();
        break;
    default:
        $response = ['status' => 'error', 'message' => 'Método no disponible'];
        echo json_encode($response);
        exit();
}


/**
 * Se encarga de validar los datos antes de registrar el nuevo proveedor, y si pasa las validaciones llama a la controller para ir a guardar en BD
 * 
 * @return JSON Con un mensaje, ya sea de éxito o de error
 */
function insertSupplier()
{
    // Acceder a los datos enviados a través del formulario
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $supplierType = isset($_POST['supplierType']) ? $_POST['supplierType'] : '';
    $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
    $direction = isset($_POST['direction']) ? $_POST['direction'] : '';

    // Validar que todos los datos esten completos
    if (
        empty($name) || empty($phone) || empty($email) || empty($supplierType) || empty($postalCode) ||
        empty($direction)
    ) {
        $response = ['status' => 'error', 'message' => 'Debe completar todos los campos que sean requeridos.'];
        echo json_encode($response);
        exit();
    }


    $proveedorController = new ControladoraProveedor();
    $respuestaJson = $proveedorController->existeElNombreDelProveedor($name, "");
    if (isset($respuestaJson['existe']) && $respuestaJson['existe']) {
        if ($respuestaJson['activo'] === 1) {
            $response = ['status' => 'error', 'message' => 'El nombre del proveedor ya se encuentra registrado y está activo'];
        } else if ($respuestaJson['activo'] === 0) {
            $response = ['status' => 'error', 'message' => 'El nombre del proveedor ya se encuentra registrado y está inactivo'];
        }
        echo json_encode($response);
        exit();
    }

    $supplier = $proveedorController->_create_Proveedor($name, $phone, $email, $supplierType, $postalCode, $direction);
    $flag = $proveedorController->insert($supplier);
    if ($flag) {
        $response = ['status' => 'succesful', 'message' => 'Proveedor agregado correctamente.'];
        echo json_encode($response);
        exit();
    } else {
        $response = ['status' => 'error', 'message' => 'Error al agregar el proveedor.'];
        echo json_encode($response);
        exit();
    }
}


/**
 * Encargado de hacer la solicitud para eliminar un proveedor de la base de datos
 * 
 */
function deleteSupplier()
{
    $action = $_GET['action'] ?? '';

    if ($action === 'deleteSupplier') {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $proveedorController = new ControladoraProveedor();
            $result = $proveedorController->deleteSupplierByidentifier($id);

            if ($result) {
                echo json_encode(['status' => 'successful', 'message' => 'Eliminado correctamente']);
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


/**
 * Encargado de hacer la solicitud para modificar un proveedor de la base de datos
 * 
 */
function updateSupplier()
{

    $requestData = file_get_contents('php://input');
    $data = json_decode($requestData, true);

    $identifier = isset($data['supplierId']) ? $data['supplierId'] : '';
    $name = isset($data['name']) ? $data['name'] : '';
    $phone = isset($data['phone']) ? $data['phone'] : '';
    $email = isset($data['email']) ? $data['email'] : '';
    $supplierType = isset($data['supplierType']) ? $data['supplierType'] : '';
    $postalCode = isset($data['postalCode']) ? $data['postalCode'] : '';
    $direction = isset($data['direction']) ? $data['direction'] : '';


    if (empty($identifier) || empty($name) || empty($phone) || empty($email) || empty($supplierType) || empty($postalCode) || empty($direction)) {
        $response = ['status' => 'error', 'message' => 'Debe completar todos los campos requeridos.'];
        echo json_encode($response);
        exit();
    }

    $proveedorController = new ControladoraProveedor();
    $respuestaJson = $proveedorController->existeElNombreDelProveedor($name, $identifier);
    if (isset($respuestaJson['existe']) && $respuestaJson['existe']) {
        if ($respuestaJson['activo'] === 1) {
            $response = ['status' => 'error', 'message' => 'El nombre del proveedor ya se encuentra registrado y está activo'];
        } else if ($respuestaJson['activo'] === 0) {
            $response = ['status' => 'error', 'message' => 'El nombre del proveedor ya se encuentra registrado y está inactivo'];
        }
        echo json_encode($response);
        exit();
    }
    $supplier = $proveedorController->findByIdentifier($identifier);

    // Modificar los datos del objeto ya creado
    $modifiedAt = new DateTime();
    $supplier->setName($name);
    $supplier->setModifiedAt($modifiedAt);
    $supplier->getPhone()->setPhone($phone);
    $supplier->getPhone()->setModifiedAt($modifiedAt);
    $supplier->getEmail()->setEmail($email);
    $supplier->getEmail()->setModifiedAt($modifiedAt);
    $supplier->getSupplierType()->setIdentifier($supplierType);
    $supplier->getSupplierType()->setModifiedAt($modifiedAt);
    $supplier->getSupplierDirection()->getDistrict()->setPostalCode($postalCode);
    $supplier->getSupplierDirection()->setSignalDirection($direction);

    $flag = $proveedorController->updateSupplier($supplier);
    if ($flag) {
        $response = ['status' => 'successful', 'message' => 'Proveedor actualizado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error al actualizar el proveedor. El teléfono o correo no se puede repetir.'];
    }
    echo json_encode($response);
    exit();
}


/**
 * Encargado de hacer la solicitud para obtener un proveedor por identificador de la base de datos
 * 
 */
function getSupplierById()
{
    if (isset($_GET['action']) && $_GET['action'] === 'getSupplier') {
        $idSearch = $_GET['id'] ?? '';
        $proveedorController = new ControladoraProveedor();
        $supplier = $proveedorController->findByIdentifier($idSearch);

        if ($supplier) {
            $direccionesController = new ControladoraPaisLocalizacion();
            $direccionProveedor = $supplier->getSupplierDirection();

            $direccionJson = $direccionesController->obtenerDireccionCompletaPorCodigoPostal($direccionProveedor->getDistrict()->getPostalCode());
            // Verifica si la respuesta no es null
            if ($direccionJson !== null && $direccionJson['status'] === 'successful') {
                $pais = $direccionJson['pais'];
                $provincia = $direccionJson['provincia'];
                $canton = $direccionJson['canton'];
                $distrito = $direccionJson['distrito'];
                $response = [
                    'status' => 'successful',
                    'message' => 'Proveedor encontrado.',
                    'supplier' => $supplier->toArray(),
                    'pais' => $pais,
                    'provincia' => $provincia,
                    'canton' => $canton,
                    'distrito' => $distrito
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'No se encontro la dirección del proveedor']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Proveedor no encontrado']);
        }
    }
    exit();
}

/**
 * Se encarga de obtener todos los proveedores con sus respectivos datos. Si en la solicitud GET viene un nombre de proveedor para buscar
 * trae todos los proveedores que coincidan
 * 
 * 
 * @return JSON Todos los proveedores o todos los proveedores que coincidan con la busqueda
 */
function getAllSuppliers()
{
    $proveedorController = new ControladoraProveedor();
    $searchName = isset($_GET['searchSupplier']) ? $_GET['searchSupplier'] : '';

    if (!empty($searchName)) {
        $suppliers = $proveedorController->getSuppliersByName($searchName);
        $response = [
            'status' => 'successful',
            'message' => '',
            'suppliers' => array_map(function ($supplier) {
                return $supplier->toArray();
            }, $suppliers)
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $suppliers = $proveedorController->getAllSuppliers();
        $response = [
            'status' => 'successful',
            'message' => '',
            'suppliers' => array_map(function ($supplier) {
                return $supplier->toArray();
            }, $suppliers)
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}



// Respuesta por defecto es ejecutada en caso que el sitio no se encuentre
$response = ['status' => 'error', 'message' => 'El sitio no fue encontrado.'];
echo json_encode($response);
// header("Location: ../view/proveedorVista.php");
exit();
