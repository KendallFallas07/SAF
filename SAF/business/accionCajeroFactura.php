<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./ControladoraQR.php";
require "./ControladoraCajeroFactura.php";

$controladora = new ControladoraQR();
$controladoraF = new ControladoraCajeroFactura();

// Crear un identificador 
$timestamp = time();
$identificador = "FAC-" . $timestamp;

$nombreDirectorio = "../images/facturaQr/";

//Crear un qr con ese identificador

$controladora->generateImgQRPNG($nombreDirectorio, $identificador, $identificador);

//Enviar el identificador a la bd
$controladoraF->enviarIdentificador($identificador);

echo "HOla";
