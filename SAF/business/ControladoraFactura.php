<?php
require_once "../data/FacturaData.php";

class ControladoraFactura {

    private $facturaData;

    public function __construct() {
        $this->facturaData = new FacturaData();
    }

    public function guardarFactura(Factura $factura) {
        return $this->facturaData->guardarFactura($factura);
    }

    public function eliminarFactura($idFactura) {
        return $this->facturaData->eliminarFactura($idFactura);
    }

    public function modificarFactura($identificador){
        return $this->facturaData->modificarFactura($identificador);
    }

    public function obtenerNuevoId(){
        return $this->facturaData->obtenerNuevoId();
    }

    public function habilitarFactura($identificador) {
        return $this->facturaData->habilitarFactura($identificador);
    }

    public function obtenerFacturaXIdentificador($identificador) {
        return $this->facturaData->obtenerFacturaXIdentificador($identificador);
    }

}
