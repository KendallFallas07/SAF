<?php

include_once "../data/PaisLocalizacionData.php";

class ControladoraPaisLocalizacion{
   
    private $location;

    public function __construct(){
        $this->location = new PaisLocalizacionData();
    }

    public function getAllCountry(){
        return $this->location->getAllCountry();
    }
  
    public function getAllProvince(){
    return $this->location->getAllProvince();
    }

    public function getAllCanton(){
    return $this->location->getAllCanton();
    }

    public function getAllDistrict(){
        return $this->location->getAllDistrict();
    }

    public function getCantonByProvince($province){
        return $this->location->getCantonByProvince($province);
    }

    public function getDistrictByCanton($canton){
        return $this->location->getDistrictByCanton($canton);
    }

    public function getPostalCodeBD(Distrito $dist){
        return $this->location->getPostalCodeBD($dist);
    }

    public function getDistrictByPostalCode($postalCode){
        return $this->location->getDistrictByPostalCode($postalCode);
    }

    public function getAllProvinceByCountry(Pais $country){
        return $this->location->getProvinceByCountry($country);
    }

    public function getDistrictById($id){
        return $this->location->getDistrictById($id);
    }

    public function obtenerDireccionCompletaPorCodigoPostal($codigoPostal) {
        return $this->location->getAllDateCountryByPostalCode($codigoPostal);
    }
}

?>