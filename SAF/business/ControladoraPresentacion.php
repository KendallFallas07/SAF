
<?php

include_once "../domain/Presentacion.php";

include_once "../data/PresentationData.php";

class PresentacionController {

    private $presentacionData;

    public function __construct() {
        $this->presentacionData = new PresentationData();
    }

    public function insert(Presentacion $presentacion): bool {
        return $this->presentacionData->savePresentation($presentacion);
    }

    public function delete(string $presentacion) {
        return $this->presentacionData->delete($presentacion);
    }

    public function update($presentacion): bool {
        return $this->presentacionData->update($presentacion);
    }

    public function getAll() {
        return $this->presentacionData->getAll();
    }

    public function getAllEliminated() {
        return $this->presentacionData->getAllEliminated();
    }

    public function getID() {
        return $this->presentacionData->getNextId();
    }

    public function getSearch(string $presentacion) {
        return $this->presentacionData->searchData($presentacion);
    }public function getSearchEliminated(string $presentacion) {
        return $this->presentacionData->searchDataEliminated($presentacion);
    }

    public function getOneSearch(string $presentacion) {
        return $this->presentacionData->searchOneData($presentacion);
    }

    public function validateName(string $identifier) {
        return $this->presentacionData->validateIdentifier($identifier);
    }

    public function findById($id) : Presentacion {
        return $this->presentacionData->findById($id);
    }

    public function findByIdentifier($identifier) {
        return $this->presentacionData->findByIdentifier($identifier);
    }
 
    public function autocompletar($datos){
        return $this->presentacionData->autocompletar($datos);
    }

    public function obtenerNombres(){
        return $this->presentacionData->obtenerNombres();
    }

    public function nombresSimples(){
        return $this->presentacionData->nombresSimples();
    }

    public function recuperar(string $identificador): bool{
        return $this->presentacionData->recuperar($identificador);
    }

}
