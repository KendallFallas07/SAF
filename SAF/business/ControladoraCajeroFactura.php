<?php

require "../data/CajeroFacturaData.php";
class ControladoraCajeroFactura{

    private $factura;

    public function __construct(){
        $this->factura = new CajeroFacturaData();
    }

    function enviarIdentificador($identificador){

        return $this->factura->capturarIdentificador($identificador);
    
    }

}
