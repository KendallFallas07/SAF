<?php

require_once "../data/DireccionProveedorData.php";
class ControladoraDireccionProveedor {

    private $directionData;

    public function __construct() {
        $this->directionData = new DireccionProveedorData();
    }

    public function getNextId() {
        return $this->directionData->getNextId();
    }

    public function findOneElementByIdSupplier($idSupplier) {
        return $this->directionData->findOneElementByIdSupplier($idSupplier);
    }
}

?>