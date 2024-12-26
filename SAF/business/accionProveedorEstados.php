<?php
include_once "./ControladoraProveedor.php";

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
        obtenerProveedoresPorEstado();
        break;
    case 'PUT':
        habilitarProveedor();
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
function obtenerProveedoresPorEstado() {
    $parametetro = isset($_GET['estado']) ? $_GET['estado'] : 1;
    $estado = $parametetro ==='1' ? 1 : 0;
    
    $controllerProveedor = new ControladoraProveedor();
    $proveedores = $controllerProveedor->obtenerProveedoresPorEstado((int) $estado);
    if($proveedores) {
        $response = [
            'status' => 'successful',
            'message' => 'proveedores encontrados',
            'supplier' => array_map(function ($supplier) {
                return $supplier->toArray();
            }, $proveedores)
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Proveedores no encontrados'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}

/**
 * Habilita un proveedor.
 *
 * @return void
 */
function habilitarProveedor() {
    $requestData = file_get_contents('php://input');
    
    $data = json_decode($requestData, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $identificador = isset($data['identificador']) ? $data['identificador'] : '';

        if(!empty($identificador)) {
            $controllerProveedor = new ControladoraProveedor();
            if($controllerProveedor->habilitarProveedor($identificador)) {
                $response = [
                    'status' => 'successful',
                    'message' => 'Proveedor habilitado correctamente'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No se pudo habilitar el proveedor'
                ];
            }  
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Faltan datos para habilitar el proveedor'
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
    $controllerProveedor = new ControladoraProveedor();

    $buscarPor = isset($_GET['searchby']) ? $_GET['searchby'] : "";
    $datoBuscar = isset($_GET['data']) ? $_GET['data'] : "";
    if($buscarPor === "name") {
        $existeNombre = $controllerProveedor->existeElNombreDelProveedor($datoBuscar, "");
        if($existeNombre['existe']) {
            $response = [
                'status' => 'successful',
                'message' => 'Nombre del proveedor no disponible',
                'exist' => true,
            ];
        } else {
            $response = [
                'status' => 'successful',
                'message' => 'Nombre del proveedor está disponible',
                'exist' => false
            ];
        }
    } else if($buscarPor === "phone") {
        $existeTelefono = $controllerProveedor->existeElTelefonoEnProveedor($datoBuscar);
        if($existeTelefono) {
            $response = [
                'status' => 'successful',
                'message' => 'Teléfono del proveedor no disponible',
                'exist' => true
            ];
        } else {
            $response = [
                'status' => 'successful',
                'message' => 'Teléfono del proveedor está disponible',
                'exist' => false
            ];
        }
    } else if($buscarPor === "mail") {
        $existeCorreo = $controllerProveedor->existeElCorreoEnProveedor($datoBuscar);
        if($existeCorreo) {
            $response = [
                'status' => 'successful',
                'message' => 'Correo del proveedor no disponible',
                'exist' => true
            ];
        } else {
            $response = [
                'status' => 'successful',
                'message' => 'Correo del proveedor está disponible',
                'exist' => false
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No se encontro por que buscar',
            'exist' => true
        ];
    }
    
    echo json_encode($response);
    exit();
}