<?php

include_once "Conexion.php";
include_once "../domain/TipoProveedor.php";


/**
 * @author Kendall Fallas
 */

class TipoProveedorData extends Conexion
{   

    
    public function saveType(TipoProveedor $supplierType)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO tbtipoproveedor (tbtipoproveedorid ,tbtipoproveedoridentificador, tbtipoproveedornombre, tbtipoproveedorcreadoen, tbtipoproveedormodificadoen, tbtipoproveedorestado) VALUES (:id, :identifier, :sName, :createdAt, :modifiedAt, :TypeState)");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $supplierType->getId();
            $identifier = (string)$supplierType->getIdentifier();
            $sName = (string)$supplierType->getNameType();
            $createdAt = $supplierType->getStrCreatedAt();
            $modifiedAt = $supplierType->getStrModifiedAt();
            $TypeState = $supplierType->getStatus();

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':sName', $sName, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam('modifiedAt', $modifiedAt, PDO::PARAM_STR);
            $stmt->bindParam('TypeState', $TypeState, PDO::PARAM_INT);

            // Ejecuto
            $result = $stmt->execute();

        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }
    public function getNextId()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener el último ID insertado
        $stmt = $conn->query("SELECT tbtipoproveedorid FROM tbtipoproveedor ORDER BY tbtipoproveedorid DESC LIMIT 1");
        // Obtener el resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $row ? $row['tbtipoproveedorid'] : 0;
        // Calcular el nuevo ID
        $newId = $lastId + 1;
        return $newId;
    }

    public function getAll()
    {
        // Obtengo la conexión
        $conn = self::connect();
        // Consulta para obtener todos los tipos de proveedor
        $stmt = $conn->query("SELECT * FROM tbtipoproveedor");
        // Obtener todos los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Convertir el resultado a una lista de objetos TipoProveedor
        $supplierTypes = [];
        foreach ($result as $row) {
            $supplierTypes[] = new TipoProveedor(
                $row['tbtipoproveedorid'],
                $row['tbtipoproveedoridentificador'],
                $row['tbtipoproveedornombre'],
                new DateTime($row['tbtipoproveedorcreadoen']),
                new DateTime($row['tbtipoproveedormodificadoen']),
                (bool)$row['tbtipoproveedorestado']
            );
        }
    
        return $supplierTypes;
    }

    public function update(TipoProveedor $supplierType)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbtipoproveedor SET tbtipoproveedornombre = :sName, tbtipoproveedormodificadoen = :modifiedAt WHERE tbtipoproveedoridentificador = :identifier");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $identifier = (string)$supplierType->getIdentifier();
            $sName = (string)$supplierType->getNameType();
            $modifiedAt = $supplierType->getStrModifiedAt();

            // Coloco los parámetros
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':sName', $sName, PDO::PARAM_STR);
            $stmt->bindParam('modifiedAt', $modifiedAt, PDO::PARAM_STR);
            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }

    public function delete(TipoProveedor $supplierType)
    {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("UPDATE tbtipoproveedor SET tbtipoproveedorestado = :estado WHERE tbtipoproveedoridentificador = :identifier");
            // Asigno los valores a variables antes de pasarlas a bindParam
            $identifier = $supplierType->getIdentifier();
            $estado = $supplierType->getStatus();
            // Coloco los parámetros
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            // Ejecuto
            $result = $stmt->execute();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            $result = false;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
        return $result;
    }

    public function findOneElement($supplierIdentifier) {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("SELECT * FROM tbtipoproveedor WHERE tbtipoproveedoridentificador = :supplierIdentifier");

            // Coloco los parámetros
            $stmt->bindParam(':supplierIdentifier', $supplierIdentifier, PDO::PARAM_STR);
            // Ejecuto
            $stmt->execute();
    
            // Obtengo el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result === false) {
                // No se encontró ningún elemento
                return null;
            }
    
            $id = $result['tbtipoproveedorid'];
            $identifier = $result['tbtipoproveedoridentificador'];
            $nameType = $result['tbtipoproveedornombre'];
            $createdAt = new DateTime($result['tbtipoproveedorcreadoen']);
            $modifiedAt = new DateTime($result['tbtipoproveedormodificadoen']);
            $status = (bool)$result['tbtipoproveedorestado'];
            return new TipoProveedor($id, $identifier, $nameType, $createdAt, $modifiedAt, $status);
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
    }

    public function findOneElementById($id) {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("SELECT * FROM tbtipoproveedor WHERE tbtipoproveedorid = :id");

            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            // Ejecuto
            $stmt->execute();
    
            // Obtengo el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result === false) {
                // No se encontró ningún elemento
                return null;
            }
    
            $id = $result['tbtipoproveedorid'];
            $identifier = $result['tbtipoproveedoridentificador'];
            $nameType = $result['tbtipoproveedornombre'];
            $createdAt = new DateTime($result['tbtipoproveedorcreadoen']);
            $modifiedAt = new DateTime($result['tbtipoproveedormodificadoen']);
            $status = (bool)$result['tbtipoproveedorestado'];
            return new TipoProveedor($id, $identifier, $nameType, $createdAt, $modifiedAt, $status);
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            // Cierro la conexión siempre 
            $conn = null;
        }
    }
}
