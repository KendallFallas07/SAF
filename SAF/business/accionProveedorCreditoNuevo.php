<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../business/ControladoraProveedorCredito.php";
require_once "../domain/ProveedorCredito.php";

date_default_timezone_set('America/Costa_Rica');


function response(string $error, string $message) {
    $response = [
        'status' => $error,
        'message' => $message
    ];

    // Establecer el encabezado para JSON
    header('Content-Type: application/json');

    // Codificar el array a formato JSON
    echo json_encode($response);
    exit();
}

function getDateStr($date) {
    return !empty($date) ? $date : (new DateTime())->format('Y-m-d');
}

$identificadorAux;
if(isset($_POST["proveedor"])){
  $identificadorAux=$_POST["proveedor"];
}else{
    response("407", "Proovedor fuera de servicio");
};


$cantCre;
if(isset($_POST["cantCre"])){
  $cantCre=$_POST["cantCre"];
  if($cantCre<0)response("408", "Cantidad Invalidad");
}else{
    response("408", "Cantidad Invalida");
};

if(isset($_POST["porcentaje"])&&!empty($_POST["porcentaje"])){
$porcentaje=$_POST["porcentaje"];
}else{
    response("409", "porcentaje Invalido");
};

if(isset($_POST["plazo"])&&!empty($_POST["plazo"])){
$plazo=$_POST["plazo"];
}else{
    response("409", "plazo Invalido");
};
$fechIni=$_POST["fechIni"];
$fechExp=$_POST["fechExp"];

if ($fechExp == null) {
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d');
    $fechExp=$formattedDate;
}
if ($fechIni == null) {
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d');
    $fechIni=$formattedDate;
}
$date = new DateTime();
$formattedDate = $date->format('Y-m-d');
$controller=new ProveedorCreditoController();
$date=new DateTime();
$proCre=new ProveedorCredito(0,$identificadorAux ,"PROVEEDORCREDITO-".$date->getTimestamp() , $cantCre, $porcentaje, $plazo, $fechIni, $fechExp, $formattedDate, $formattedDate, 1);

 

if($controller->create($proCre)){
    response("200","CREDITO CREADO CORRECTAMENTE");
}else{
    
    response("409","Lo sentimos el Lote tuvo un error,Intentelo mas tarde");
}


?>