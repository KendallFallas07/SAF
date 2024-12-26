<?php


include_once "../data/VentaData.php";




class ControladoraVenta{

private $ventasCont;

    public function __construct() {
        $this->ventasCont = new VentaData();
    }
    public function obtenerDatosUsuario(string $identificador) {
        return $this->ventasCont->obtenerDatosUsuario($identificador);
    }

    public function agregarVenta(array $datosVenta) {
        return $this->ventasCont->GuardarVenta( $datosVenta);
    }

    public function agregarProductosVenta(array $datosVentaProducto,$identifier) {
    return $this->ventasCont->GuardarVentaProducto( $datosVentaProducto,$identifier);
    }
   
    public function guardarTransaccion($identificador, $subTotal, $tipoPago,$impuesto): bool{
        return $this->ventasCont->GuardarTransaccionVenta($identificador, $subTotal, $tipoPago,$impuesto);
    }

}