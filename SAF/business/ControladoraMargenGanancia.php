<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../data/MargenGananciaData.php';

include_once '../domain/MargenGanancia.php';


class ControladoraMargenGanancia{

private $margenData;

    public function __construct() {
        $this->margenData = new MargenGananciaData();
    }

    
    public function getAllLotes(){
        return $this->margenData->getAllLotes();
    }

    public function saveMargenGanancia($MargenGanancia): bool {

        return $this->margenData->saveMargenGanancia($MargenGanancia);
    }

    public function getNextId() {

        return $this->margenData->getNextId();
    }

    public function getALlMargens() {

        return $this->margenData->getAllMargen();
    }

    public function deleteMargen($id) {

        return $this->margenData->deleteMargen($id);
    }

    public function filterEnable($MargenGanancia) {

        return $this->margenData->getMargenesByIdentifier($MargenGanancia);
    }

     public function getMargenByFilter($MargenGanancia) {

        return $this->margenData->getMargenByIdentifier($MargenGanancia);
    }

    public function disableMargen(){
        return $this->margenData->getAllDisableMargen();
    }

    public function updateMargen($margen) {

        return $this->margenData->updateMargen($margen);
    }

    public function validateMargenActive ($identifier): bool{
        return $this->margenData->getMargenValidate($identifier);
    }

}