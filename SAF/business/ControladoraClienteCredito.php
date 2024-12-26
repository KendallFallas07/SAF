<?php 
include_once "../data/ClienteCreditoData.php";;

class ClienteCreditoControladora {

    private $ClienteCreditoData;

    public function __construct() {
        $this->ClienteCreditoData = new ClienteCreditoData();
    }

    public function guardar($ClienteCompra): bool {
        return $this->ClienteCreditoData->guardarClienteCredito($ClienteCompra); 
        
    }

    public function getID() {
        return $this->ClienteCreditoData->getNextId(); 
        
    }

    public function getAll() {
        return $this->ClienteCreditoData->getAll(); 
        
    }

    public function getSearch($data) {
        return $this->ClienteCreditoData->searchData($data); 
        
    }

    public function buscarPorIdentificador(string $identificador) {
        return $this->ClienteCreditoData->searchByIdentifier($identificador);
    }

    public function actualizar($data): bool {
        return $this->ClienteCreditoData->actualizar($data);
    }

    public function eliminar(string $identificador) {
        return $this->ClienteCreditoData->eliminar($identificador);
    }

    public function obtenerClientes(){
        return $this->ClienteCreditoData->obtenerClientes();
    }

    public function encontrarPorId(int $id){
        return $this->ClienteCreditoData->encontrarPorId($id);

    }

    public function clienteIdentificadorPorId(int $id){
        return $this->ClienteCreditoData->ObtenerIdentificadorClientePorId($id);

    }

    public function ObtenerIdClientePorIdentificador(string $identificador){
        return $this->ClienteCreditoData->ObtenerIdClientePorIdentificador($identificador);

    }

    public function autocompletado(string $datos){
        return $this->ClienteCreditoData->autocompletado($datos);
    }

    public function filtrarUsuarios(string $identificador): bool{
        return $this->ClienteCreditoData->filtrarUsuarios($identificador);
    }
}