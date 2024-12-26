<?php

require_once 'Conexion.php';
require_once '../domain/DireccionProveedor.php';
require_once '../domain/Provincia.php';
require_once '../domain/Canton.php';
require_once '../domain/Distrito.php';
require_once '../domain/Pais.php';

class PaisLocalizacionData extends Conexion{
    
   
    public function getAllCountry()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los paises
        $stmt = $conn->query("SELECT * FROM tbpais");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllProvince()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos las provincias
        $stmt = $conn->query("SELECT * FROM tbprovincia");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllCanton()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los cantones
        $stmt = $conn->query("SELECT * FROM tbcanton");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    

    public function getidProvinceBD(Provincia $province)
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener el ID de la provincia basado en el identificador
        $stmt = $conn->prepare("SELECT tbprovinciaid FROM tbprovincia WHERE tbprovinciaidentificador = :provinceIdentifier");
        $variable = $province->getIdentifier();
        $stmt->bindParam(':provinceIdentifier', $variable);
        $stmt->execute();
        
        // Obtener un solo resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['tbprovinciaid'] : null;
    }

    public function getidCantonBD(Canton $canton)
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener el ID de la provincia basado en el identificador
        $stmt = $conn->prepare("SELECT tbcantonid FROM tbcanton WHERE tbcantonidentificador = :cantonIdent");
        $variable = $canton->getIdentifier();
        $stmt->bindParam(':cantonIdent', $variable);
        $stmt->execute();
        
        // Obtener un solo resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['tbcantonid'] : null;
    }

    public function getPostalCodeBD(Distrito $district)
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener el ID de la provincia basado en el identificador
        $stmt = $conn->prepare("SELECT tbcodigopostal FROM tbdistrito WHERE tbdistritoidentificador = :districtIdent");
        $variable = $district->getIdentifier();
        $stmt->bindParam(':districtIdent', $variable);
        $stmt->execute();
        
        // Obtener un solo resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (string)$result['tbcodigopostal'] : null;
    }

    public function getDistrictByCanton(Canton $canton)
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los districtos por canton
 
        $cantonId = $this->getidCantonBD($canton);
    
    if ($cantonId === null) {
        return []; // Si no se encuentra la provincia, retornamos un array vacío
    }

        $stmt = $conn->prepare("SELECT * FROM tbdistrito WHERE tbcantonid = :cantonId");
        $stmt->bindParam(':cantonId', $cantonId);
        $stmt->execute();
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function getCantonByProvince(Provincia $province)
{
    // Obtengo la conexión
    $conn = self::connect();
    // Obtengo el ID de la provincia usando el identificador
    $provinceId = $this->getidProvinceBD($province);
    
    if ($provinceId === null) {
        return []; // Si no se encuentra la provincia, retornamos un array vacío
    }
    
    // Consulta para obtener todos los cantones basados en el ID de la provincia
    $stmt = $conn->prepare("SELECT * FROM tbcanton WHERE tbprovinciaid = :provinceId");
    $stmt->bindParam(':provinceId', $provinceId);
    $stmt->execute();
    
    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}



    public function getAllDistrict()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los impuestos
        $stmt = $conn->query("SELECT * FROM tbdistrito");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getIdCountryByIdentifier(Pais $country){
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener el ID del país basado en el identificador
        $stmt = $conn->prepare("SELECT tbpaisid FROM tbpais WHERE tbpaisidentificador = :countryIdent");
        $variable = $country->getIdentifier();
        $stmt->bindParam(':countryIdent', $variable);
        $stmt->execute();
        
        // Obtener un solo resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result? (int)$result['tbpaisid'] : null;
    }

    public function getProvinceByCountry(Pais $country){
        // Obtengo la conexión
        $conn = self::connect();
        // Obtengo el ID del país usando el identificador
        $countryId = $this->getIdCountryByIdentifier($country);
        
        if ($countryId === null) {
            return []; // Si no se encuentra el país, retornamos un array vacío
        }
        
        // Consulta para obtener todas las provincias basados en el ID del país
        $stmt = $conn->prepare("SELECT * FROM tbprovincia WHERE tbidpais = :countryId");
        $stmt->bindParam(':countryId', $countryId);
        $stmt->execute();
        
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
       
    }

    //metodos para sobreescribir en los selects la localizacion del proveedor
    public function getDistrictByPostalCode($postalCode){
        $conn = self::connect();
       
        $stmt = $conn->prepare("SELECT * FROM tbdistrito WHERE tbcodigopostal = :postalCode");
        $stmt->bindParam(':postalCode', $postalCode);
        $stmt->execute();
        
        // Obtener el resultado como un objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetch();
    
        if (!$result) {
            return null; 
        }
    
        $district = new Distrito(
            $result->tbdistritoid,
            $result->tbdistritoidentificador,
            $result->tbdistritonombre,
            new DateTime($result->tbdistritofechacreacion),
            new DateTime($result->tbdistritofechamodificacion),
            $result->tbdistritoestado,
            $result->tbdistritodetalle, 
            $result->tbcodigopostal,
            $result->tbcantonid
        );
    
        return $district;
    }


    public function getCantonByDistrict(Distrito $district) {

        $conn = self::connect();

        $idDistrict=$district->getIdentCanton();
       
        $stmt = $conn->prepare("SELECT * FROM tbcanton WHERE tbcantonid = :districtCantonId");
        $stmt->bindParam(':districtCantonId',$idDistrict);
        $stmt->execute();
        
        // Obtener el resultado como un objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetch();

        if (!$result) {
            return null; 
        }

        $canton=new Canton($result->tbcantonid,
        $result->tbprovinciaid,
        $result->tbcantonidentificador,
        $result->tbcantonnombre,
        new DateTime($result->tbcantonfechacreacion),
        new DateTime($result->tbcantonfechamodificacion),
        $result->tbcantonestado);
        
      return $canton;
    }

    public function getProvinceByCanton(Canton $canton){
        $conn = self::connect();

        $idProv=$canton->getProvinceId();
       
        $stmt = $conn->prepare("SELECT * FROM tbprovincia WHERE tbprovinciaid = :provinceid");
        $stmt->bindParam(':provinceid',$idProv);
        $stmt->execute();
        
        // Obtener el resultado como un objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetch();

        if (!$result) {
            return null; 
        }

       $province=new Provincia(
        $result->tbprovinciaid,
        $result->tbprovinciaidentificador,
        $result->tbprovincianombre,
        new DateTime($result->tbprovinciafechacreacion),
        new DateTime($result->tbprovinciafechamodificacion),
        $result->tbprovinciaestado, 
        $result->tbidpais);
        
      return $province;

    }

    

    public function getCountryByProvince(Provincia $province){
        $conn = self::connect();
        $idProv=$province->getIdCountry();
        $stmt = $conn->prepare("SELECT * FROM tbpais WHERE tbpaisid = :countryid");
        $stmt->bindParam(':countryid', $idProv);
        $stmt->execute();
        
        // Obtener el resultado como un objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetch();
        
        if (!$result) {
            return null; 
        }

        $country=new Pais(
            $result->tbpaisid,
            $result->tbpaisidentificador,
            $result->tbpaisnombre,
            new DateTime($result->tbpaisfechacreacion),
            new DateTime($result->tbpaisfechamodificacion),
            $result->tbpaisestado
        );
        
      return $country;
    
    }

    public function getAllDateCountryByPostalCode($postalCode) {
        $district = $this->getDistrictByPostalCode($postalCode);
    
        if ($district !== null) {
            $canton = $this->getCantonByDistrict($district);
            $province = $this->getProvinceByCanton($canton);
            $country = $this->getCountryByProvince($province);

         if ($canton === null || $province === null || $country === null) {return null;}
            $response = [
                'status' => 'successful',
                'message' => 'Direccion obtenida correctamente',
                'pais' => $country->getIdentifier(),
                'provincia' => $province->getIdentifier(),
                'canton' => $canton->getIdentifier(),
                'distrito' => $district->getIdentifier()
            ];
            return $response;
        } 
            return null; 
    }
    

    public function getDistrictById($id){
        $conn = self::connect();
       
        $stmt = $conn->prepare("SELECT * FROM tbdistrito WHERE tbdistritoid = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Obtener el resultado como un objeto
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $stmt->fetch();
        
        if (!$result) {
            return null; 
        }
    
        $district = new Distrito(
            $result->tbdistritoid,
            $result->tbdistritoidentificador,
            $result->tbdistritonombre,
            new DateTime($result->tbdistritofechacreacion),
            new DateTime($result->tbdistritofechamodificacion),
            $result->tbdistritoestado,
            $result->tbdistritodetalle, 
            $result->tbcodigopostal,
            $result->tbcantonid
        );
    
        return $district;
    }




}