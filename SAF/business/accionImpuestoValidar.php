<?php

require_once './ControladoraImpuesto.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controladora = new ImpuestosController();

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


$nombre = $_POST["name"];

$nombresRegistrados = $controladora->obtenerNombres();

$respuesta = "";

foreach ($nombresRegistrados as $key){

    $probabilidad = 0.0;

    $probabilidad = porcentajeIncidencia($nombre, $key['tbimpuestonombre']);

    if($probabilidad > 0.8){

        $respuesta = "El nombre ingresado ya se encuentra registrado, intenta con otro nombre.";
        break;
    }

}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);