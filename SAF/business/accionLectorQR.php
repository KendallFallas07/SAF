<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Se encarga de recibir el identificador del producto obtenido de leer el QR
 * 
 * @author Daniel Briones
 * @version 1.0
 * @since 7-10-24
 */
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        $productoId = $_GET['identificador'];
        if (isset($productoId)) {
            include_once "./ControladoraProducto.php";
            $controladoraProducto = new ControladoraProducto();
            $producto = $controladoraProducto->findByIdentifier($productoId);
            $producto->setImagenes($controladoraProducto->obtenerImagenesProductos($productoId));
            $margenVenta = $controladoraProducto->getLoteYMargen($producto->getIdentificador());
            if ($producto) {
                $response = ['status' => 'successful', 'message' => 'Producto encontrado.', 'producto' => $producto->toArray(), 'margenVenta' => $margenVenta];
                echo json_encode($response);
            } else {
                $response = ['status' => 'error', 'message' => 'Producto no encontrado. Asegurate de enviar el identificador correcto.'];
                echo json_encode($response);
            }
            exit();
        } else {
            $response = ['status' => 'error', 'message' => 'Producto no identificado. Asegurate de enviar el identificador correcto.'];
            echo json_encode($response);
            exit();
        }
        break;
    default:
        $response = ['status' => 'error', 'message' => 'Método no disponible'];
        echo json_encode($response);
        exit();
}
?>