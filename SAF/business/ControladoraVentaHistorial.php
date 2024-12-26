<?php

include_once "../data/VentaHistorialData.php";

class ControladoraVentaHistorial{

private $ventHistCont;

    public function __construct() {
        $this->ventHistCont = new VentaHistorialData();
    }
    public function obtenerDatosUsuario(string $identificador) {
        return $this->ventHistCont->obtenerHistorialVentasUsuario($identificador);
    }

   
}