<?php

include_once "../data/tipoUnidadData.php";

include_once "../domain/TipoUnidad.php";


class ControladoraTipoUnidad {

private $unitData;

    public function __construct() {
        $this->unitData = new UnitTypeData();
    }

    public function insert(TipoUnidad $unitType): bool {
        return $this->unitData->saveUnitType($unitType);
    }

    public function getAllUnitTypes(): array {
        return $this->unitData->getAllUnitTypes();
    }

    public function validationName($name,$identifier){
        return $this->unitData->validateUnitTypeName($name,$identifier);
    }

    public function deleteUnitType(TipoUnidad $unitType):bool{
        return $this->unitData->deleteUnitType($unitType);
    }

    public function nextIdUnit(){
        return $this->unitData->getNextIdUnit();
    }

    public function getUnitType(TipoUnidad $unitType): TipoUnidad {
        return $this->unitData->getUnitType($unitType);
    }

    public function updateUnitType(TipoUnidad $unitType): bool {
        return $this->unitData->updateUnitType($unitType);
    }

    public function getUnitTypeById($id){
        return $this->unitData->getUnitTypeById($id);
    }

    public function getUnitTypesByFilter($search){
        return $this->unitData->getUnitTypeByFilter($search);
    }

    public function getUnitTypeDisable(){
        return $this->unitData->getAllUnitTypesDisabled();
    }

    public function habilitar($search){
        return $this->unitData->activateLastUnitType($search);
    }

    public function autocompletar($search){
        return $this->unitData->autocompleteUnitTypes($search);
    }

    public function getUnitTypeDisableFilt($name){
        return $this->unitData->getAllUnitTypesDisabledFilter($name);
    }

    public function UniTypeName(){
        return $this->unitData->obtenerNombresTipoUnidad();
    }

    public function getUnitTypeByIdentifier($identifier){
        return $this->unitData->getNamesByTypeId($identifier);
    }
    

}