<?php

include_once "../data/CompraData.php";

class CompraController {

    private $compraData;

    public function __construct() {
        $this->compraData = new CompraData();
    }

    public function insert($compra): bool {
        return $this->compraData->saveCompra($compra);
    }

    public function getID() {
        return $this->compraData->getNextId();
    }

    public function getAll() {
        return $this->compraData->getAll();
    }

    public function getAllSuppliers() {
        return $this->compraData->getAllSuppliers();
    }

    public function getSearch($data) {
        return $this->compraData->searchData($data);
    }

    public function serchByIdentifier(string $identifier) {
        return $this->compraData->searchByIdentifier($identifier);
    }

    public function updateBuy($data) {
        return $this->compraData->update($data);
    }

    public function deleteBuy(string $identifier) {
        return $this->compraData->delete($identifier);
    }

    public function autocompletar($datos) {
        return $this->compraData->autocompletado($datos);
    }

    public function filtrarProveedores($datos) {
        return $this->compraData->filtrarProveedores($datos);
    }
}
