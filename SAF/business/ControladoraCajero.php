<?php
include_once '../data/CajeroData.php';
class ControladoraCajero {
    private $cajeroData;
    
   public function __construct() {
        $this->cajeroData = new CajeroData();
    }
    
    public function obtenerDetallesVenta($ventaIdentificador) {
        try {
            if (empty($ventaIdentificador)) {
                throw new Exception("No se encontró el identificador de la venta");
            }
            
            return $this->cajeroData->obtenerDetallesVenta($ventaIdentificador);
            
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
     public function obtenerImpuestos() {
       return $this->cajeroData->obtenerImpuestos();
    }
    
    public function obtenerFactura($ventaIdentificador){
        return $this->cajeroData->obtenerDetallesFactura($ventaIdentificador);
    }
    
    public function obtenerVentasPorCLiente($identificadorUsuario){
        return $this->cajeroData->obtenerVentas($identificadorUsuario);
    }
    public function obtenerCliente($ventaIdentificador){
        return $this->cajeroData->obtenerUsuario($ventaIdentificador);
    }
    public function obtenerVentasPorfecha($identificadorUsuario){
        return $this->cajeroData->obtenerVentasPorfecha($identificadorUsuario);
    }
    public function pagarVenta($ventaIdentificador,$impuesto){
        return $this->cajeroData->pagarVenta($ventaIdentificador,$impuesto);
    }
    
    
}