<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "./ControladoraProducto.php";

// Para la fecha actual en Costa Rica
date_default_timezone_set('America/Costa_Rica');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        if(isset($_GET['searchby'])) {
            validarExistenciaDeDatos();
            exit();
        }
        obtenerProductosPorEstado();
        break;
    case 'PUT':
        habilitarProducto();
        break;
    default:
        $response = ['status' => 'error', 'message' => 'Método no disponible'];
        echo json_encode($response);
        exit();
}

/**
 * 
 * @return JSON
 */
function obtenerProductosPorEstado() {
    $parametetro = isset($_GET['estado']) ? $_GET['estado'] : 1;
    $estado = $parametetro ==='1' ? 1 : 0;
    
    $controllerProducto = new ControladoraProducto();
    $productos = $controllerProducto->obtenerProveedoresPorEstado((int) $estado);
    if($productos) {
        $response = [
            'status' => 'successful',
            'message' => 'Productos encontrados',
            'producto' => array_map(function ($producto) {
                return $producto->toArray();
            }, $productos)
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Productos no encontrados'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}

/**
 * Habilita un producto.
 *
 * @return void
 */
function habilitarProducto() {
    $requestData = file_get_contents('php://input');
    
    $data = json_decode($requestData, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $identificador = isset($data['identificador']) ? $data['identificador'] : '';

        if(!empty($identificador)) {
            $controllerProducto = new ControladoraProducto();
            if($controllerProducto->habilitarProducto($identificador)) {
                $response = [
                    'status' => 'successful',
                    'message' => 'Producto habilitado correctamente'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No se pudo habilitar el producto'
                ];
            }  
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Faltan datos para habilitar el producto'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al decodificar JSON'
        ];
    }
    echo json_encode($response);
    exit();
}

function validarExistenciaDeDatos() {
    $controllerProducto = new ControladoraProducto();

    $buscarPor = isset($_GET['searchby']) ? $_GET['searchby'] : "";
    $datoBuscar = isset($_GET['data']) ? $_GET['data'] : "";
    if($buscarPor === "name") {
        $existeNombre = $controllerProducto->existeElNombreDelProducto($datoBuscar, "");
        if($existeNombre['existe']) {
            $response = [
                'status' => 'successful',
                'message' => 'Nombre del producto no disponible',
                'exist' => true,
            ];
        } else {
            $response = [
                'status' => 'successful',
                'message' => 'Nombre del producto está disponible',
                'exist' => false
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No se encontro por que buscar el producto',
            'exist' => true
        ];
    }
    
    echo json_encode($response);
    exit();
}