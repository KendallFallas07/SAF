<?php

require_once '../data/ProveedorCreditoData.php';
require_once '../domain/ProveedorCredito.php';
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ProveedorCreditoController
 *
 * @author ceasarcalvo
 */
class ProveedorCreditoController {
   
    private $proveedorCData;

    public function __construct() {
        $this->proveedorCData = new ProveedorCreditoData();
    }
    
    public function create($proveedorCredito): bool {
        return $this->proveedorCData->createProveedorCredito($proveedorCredito);
        
    }
    public function obtenerTodosLosProveedores() {
        return $this->proveedorCData->obtenerTodosLosProveedores();
        
    }
    
    public function obtenerTodosLosProveedoresCredito(){
        return $this->proveedorCData->obetenerTodosLosProveedoresCredito();
    }
    
    public function buscarNombreProveedorPorIdentificador($identificador){
        return $this->proveedorCData->buscarNombreProveedorPorIdentificador($identificador);
    }
    
    public function obtenerProveedorCreditoPorIdentificador($identificador){
        return $this->proveedorCData->obtenerProveedorCreditoPorIdentificador($identificador);
    }
    
     public function borrarPorIdentificador($identificador){
        
        return $this->proveedorCData->borrarPorIdentificador($identificador);
    }
    
     public function obetenerNuevoId(){
        return $this->proveedorCData->obtenerUltimoId();
    }
    
    public function editar($proveedorCredito){
        
        return $this->proveedorCData->editar($proveedorCredito);
    }
    
    public function buscarPorPlazo(String $plazo): array {
        return $this->proveedorCData->encontrarPorPlazo($plazo);
    }
    
    public function autocompletado(string $datos){
         return $this->proveedorCData->autocompletado($datos);
    }
    public function filtrarProveedores(string $identificador){
        return $this->proveedorCData->filtrarProveedores($identificador);
    }     
     public function getSearch(string $data): array {
        return $this->proveedorCData->searchData($data); 
    }     
     
   
}
