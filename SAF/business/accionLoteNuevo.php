<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../business/ControladoraLote.php";
require_once "../domain/Lote.php";

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
if(isset($_POST["producto"])){
  $identificadorAux=$_POST["producto"];
}else{
    response("407", "Producto fuera de servicio");
}

$cantAdq;
if(isset($_POST["cantAdq"])){
  $cantAdq=(int)$_POST["cantAdq"];
  if($cantAdq<0)response("408", "Cantidad Invalidad");
}else{
    response("408", "Cantidad Invalidad");
}

$precCom=filter_input(INPUT_POST, "precCom");
if($precCom == false){
    $precCom = 0.0;
}
$fechAdq=$_POST["fechAdq"];
$fechExp= filter_input(INPUT_POST, "fechExp");

if ($fechExp == false || empty($fechExp)) {
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d');
    $fechExp=$formattedDate;
}
if ($fechAdq == null || empty($fechAdq)) {
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d');
    $fechAdq=$formattedDate;
}

$controller=new LoteController();
$date=new DateTime();
$lote=new Lote(0, "LOTE-" . $date->getTimestamp()  , $identificadorAux, $cantAdq, $cantAdq, $precCom, $fechAdq, $fechExp, $fechAdq, $fechAdq, 1);

if($controller->insert($lote)){
    response("200","Lote CREADO CORRECTAMENTE");
}else{
    
    response("409","Lo sentimos el Lote tuvo un error,Intentelo mas tarde");
}