<?php

require_once "../data/Conexion.php";
require_once "../data/LoteData.php";
require_once "../domain/Lote.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


class LoteController {

    private $loteData;

    public function __construct() {
        $this->loteData = new LoteData();
    }

    public function insert(Lote $lote): bool {
        return $this->loteData->saveLote($lote); 
    }

    public function getID(): int {
        return $this->loteData->getNextId(); 
    }

    public function getAll(): array {
        return $this->loteData->getAll(); 
    }

    public function getSearch(string $data): array {
        return $this->loteData->searchData($data); 
    }

    public function searchByIdentifier(string $identifier) {
        return $this->loteData->searchByIdentifier($identifier);
    }

    public function updateLote(Lote $lote): bool {
        return $this->loteData->update($lote);
    }

    public function deleteLote(string $identifier): bool {
        return $this->loteData->delete($identifier);
    }

    public function getProductByIdentifier($identifier){
        return $this->loteData->getIdProductByIdentificador($identifier);
    }

    public function getProductById($id){
        return $this->loteData->getIdProductById($id);
    }

    public function getLote(Lote $id){
        return $this->loteData->getLote($id);
    }

    public function getProductsById($id){
        return $this->loteData->findById($id);
    }
    public function getAllProducto() {
        return $this->loteData->getAllProducts();
    }

    public function prueba($identificador){
        
        return $this->loteData->buscarNombreProductoPorIdentificador($identificador);
    }
    
    public function autocompletado(string $datos){
        
        return $this->loteData->autocompletado($datos);
    }
    
    public function filtrarProductos(string $identificador){
        return $this->loteData->filtrarProductos($identificador);
    }
    
   
}
