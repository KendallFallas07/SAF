<?php

include_once "./ControladoraVenta.php";
include_once "./ControladoraQR.php";

function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

function getTimestamp(DateTime $date): int {
    return $date->getTimestamp();
}


switch ($_SERVER['REQUEST_METHOD']) {
   
    case 'POST':
        $productos = $_POST['productos'];
        $datosVentas = $_POST['DATOSVENTAS'][0];
        if (!isset($datosVentas['metodoPago']) || empty(trim($datosVentas['metodoPago']))) {
            sendMessage(-1,'');
        }
        
        realizarVenta($datosVentas,$productos);
       
        break;

    default:
        sendJsonResponse(['error' => 'Método no soportado']);
        break;
}


function realizarVenta($datosVenta,$productos) {


   
    $identifier='VTN-'.getTimestamp(new DateTime());
    $date=(new DateTime())->setTimezone(new DateTimeZone('America/Costa_Rica'));

    $ventaData = [
        'id' => 0, 
        'identifier' => $identifier,
        'userIdentifier' => $datosVenta['Usuario'], 
        'createdAt' => $date->format('Y-m-d H:i:s'),
        'updatedAt' => $date->format('Y-m-d H:i:s'),
        'state' => 0 
    ];

    $ControllerVenta= new ControladoraVenta();
    if($ControllerVenta->agregarVenta($ventaData)){


        foreach($productos as $producto){
            if(!$ControllerVenta->agregarProductosVenta($producto,$identifier)){
            sendMessage(-2,'');
            }
        }

          if(!$ControllerVenta->guardarTransaccion($identifier,$datosVenta['totalVenta'],$datosVenta['metodoPago']=='Efectivo'? 0:1,'')){
            sendMessage(-3,'');
          }else{
            if(generarQR($identifier)){
                sendMessage(1,"../images/qrtv/$identifier.png");
            } else{
                sendMessage(-4,'');
            }
          }
    }
    
}




function generarQR(string $identifier): bool
{
    $qrController = new ControladoraQR();
    $dir = "../images/qrtv/";
    
    // Generar el nombre de la imagen basado en el identificador del producto
    $imageName = "$identifier.png";
    
    // El contenido del QR será el identificador del producto
    $content =$identifier;

    // Eliminar caracteres especiales del nombre de la imagen (espacios y dos puntos)
    $imageName = str_replace([' ', ':'], '_', $imageName);

    // Llamar a la función para generar la imagen QR y retornar el resultado (true/false)
    return $qrController->generateImgQRPNG($dir, $imageName, $content);
}



function sendMessage($code,$rutaImg) {
    $messages = [
        1 => "Por favor, ve al cajero para confirmar la compra",
        -1 => "Seleccione un metodo de pago",
        -2 => "error al procesar el producto",
        -3=>"Error al generar la transaccion",
        -4 => "Error al generar el codigo QR",
    ];

    sendJsonResponse(["message" => $messages[$code], "code"=> $code ?? "Error desconocido", "ruta" => $rutaImg??""]);
}
