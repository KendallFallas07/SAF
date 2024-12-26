<?php

require_once './ControladoraLote.php';
;

$controladora = new LoteController();

$datos = $_POST["datos"];

$datosEncontrados = $controladora->autocompletado($datos);

$datosFiltrados = [];

foreach ($datosEncontrados as $productos) {

    if($controladora->filtrarProductos($productos['tbproductoidentificador'])){
        $datosFiltrados[] = $productos;
    }

}

$respuesta = [] ;
foreach ($datosFiltrados as $key) {
    $respuesta[] = [
        "nombre" => $key['tbproductonombreproducto']
    ];
}


echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);