<?php

require "../data/ImpuestoData.php";

class ImpuestosController {

    private $impuestosData;

    public function __construct() {
        $this->impuestosData = new ImpuestosData();
    }

    public function insert(Impuestos $impuestos) {
        return $this->impuestosData->save($impuestos);
    }

    public function delete($impuestos) {
        return $this->impuestosData->delete($impuestos);
    }

    public function eliminar(string $identificador) {
        return $this->impuestosData->eliminar($identificador);
    }

    public function getAll() {
        return $this->impuestosData->getAll();
    }

    public function getID() {
        return $this->impuestosData->getNextId();
    }

    public function getValidateName(string $name): int {
        return $this->impuestosData->validateName($name);
    }

    public function getSearch(string $data) {
        return $this->impuestosData->searchData($data);
    }
    
    public function edit(Impuestos $impuestos):bool {
        $this->impuestosData->delete($impuestos);
        $this->impuestosData = new ImpuestosData();
        return $this->insert($impuestos);
    }

    public function buscarPorIdentificador(string $identificador){

        return $this->impuestosData->buscarPorIdentificador($identificador);
    }

    public function obtenerNombres(){
        return $this->impuestosData->obtenerNombres();
    }

    public function autocompletar(string $data){
        return $this->impuestosData->autocompletar($data);
    }
    public function getSearchEliminated(string $data){
        return $this->impuestosData->getSearchEliminated($data);
    }
    public function getAllEliminated(){
        return $this->impuestosData->getAllEliminated();
    }

    public function recuperar(string $identificador){
        return $this->impuestosData->recuperar($identificador);
    }
}
