<?php

require_once "Conexion.php";
require_once '../domain/TipoUnidad.php';


class UnitTypeData extends Conexion {

    public function getAllUnitTypes() {
        $conn = self::connect();
        $stmt = $conn->query("SELECT * FROM tbtipounidad WHERE tbtipounidadestado = 1");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $unitTypes = [];
    
        foreach ($result as $dates) {
            $unit = new TipoUnidad(
                $dates['tbtipounidadid'],
                $dates['tbtipounidadidentificador'],
                $dates['tbtipounidadnombre'],
                $dates['tbtipounidaddescripcion'],
                new DateTime($dates['tbtipounidadfechacreacion']),
                new DateTime($dates['tbtipounidadfechamodificacion']),
                $dates['tbtipounidadestado']
            );
            $unitTypes[] = $unit;
        }
    
        return $unitTypes??null;
    }

    public function saveUnitType(TipoUnidad $unitType): bool {
        // Obtengo la conexión
        $conn = self::connect();
        try {
            // Preparo la sentencia
            $stmt = $conn->prepare("INSERT INTO `tbtipounidad`(`tbtipounidadid`, `tbtipounidadidentificador`, `tbtipounidadnombre`, `tbtipounidaddescripcion`, `tbtipounidadfechacreacion`, `tbtipounidadfechamodificacion`, `tbtipounidadestado`) VALUES (:id, :identifier, :pName, :pDescription, :createdAt, :updatedAt, :pState);");
    
            // Asigno los valores a variables antes de pasarlas a bindParam
            $id = $unitType->getIdUnit();
            $identifier = $unitType->getIdentifierTU();
            $pName = $unitType->getNameUnit();
            $pDescription = $unitType->getDescriptionUnit();
    
            // Convierte DateTime a string
            $createdAt = $unitType->getCreatedAtUnit()->format('Y-m-d H:i:s');
            $updatedAt = $unitType->getModifiedAtUnit()->format('Y-m-d H:i:s');
    
            $pState = $unitType->getStatusUnit();
    
            // Coloco los parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->bindParam(':pName', $pName, PDO::PARAM_STR);
            $stmt->bindParam(':pDescription', $pDescription, PDO::PARAM_STR);
            $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':pState', $pState, PDO::PARAM_INT);
    
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

    public function getUnitTypeByFilter($searchT) {
        $conn = self::connect();
    
        // Preparar la consulta SQL con LIKE para filtrar los resultados si se proporciona un término de búsqueda
        $sql = "SELECT * FROM tbtipounidad WHERE tbtipounidadestado	 = 1 AND tbtipounidadnombre LIKE :search OR tbtipounidadestado = 1 AND tbtipounidaddescripcion LIKE :search";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':search', '%' . $searchT . '%');
        
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $unitList = [];
    
        // Construir el array de categorías
        foreach ($result as $dates) {
            $unit = new TipoUnidad(
                $dates['tbtipounidadid'],
                $dates['tbtipounidadidentificador'],
                $dates['tbtipounidadnombre'],
                $dates['tbtipounidaddescripcion'],
                new DateTime($dates['tbtipounidadfechacreacion']),
                new DateTime($dates['tbtipounidadfechamodificacion']),
                $dates['tbtipounidadestado']
            );
            $unitList[] = $unit;
        }
    
        return $unitList;
    }
    

    public function validateName(string $name): bool {
        $conn = self::connect();
        // Preparo la consulta
        $stmt = $conn->prepare("SELECT * FROM `tbtipounidad` WHERE `tbtipounidadnombre` = :name AND `tbtipounidadestado` != 0;");
        // Asigno el valor del nombre
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        // Ejecuto la consulta
        $stmt->execute();
        // Obtengo los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Retorno true si hay al menos un resultado, de lo contrario false
        return count($results) > 0;
    }

    /** 
        * @return int 
        */
        public function getNextIdUnit(): int
        {
            $conn = self::connect();
            try {
                $stmt = $conn->query("SELECT tbtipounidadid FROM tbtipounidad ORDER BY tbtipounidadid DESC LIMIT 1");
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $lastId = $row ? $row['tbtipounidadid'] +1 : 1;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                $lastId = 0;
            } finally {
                $conn = null;
            }
            return $lastId;
        }
        
        
        public function getUnitType(TipoUnidad $unitType) {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM tbtipounidad WHERE tbtipounidadidentificador = :identifier AND tbtipounidadestado != 0 ");
            $identifier = $unitType->getIdentifierTU();
            $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $unit = new TipoUnidad(
                    $result['tbtipounidadid'],
                    $result['tbtipounidadidentificador'],
                    $result['tbtipounidadnombre'],
                    $result['tbtipounidaddescripcion'],
                    new DateTime($result['tbtipounidadfechacreacion']),
                    new DateTime($result['tbtipounidadfechamodificacion']),
                    $result['tbtipounidadestado']
                );
            } else {
                $unit = null; 
            }
            return $unit;
        }

        //por id autoincremental
        public function getUnitTypeById($unitType) {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM tbtipounidad WHERE tbtipounidadid = :id AND tbtipounidadestado != 0 ");
            $id = $unitType->getIdUnit();
            
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                $unit = new TipoUnidad(
                    $result['tbtipounidadid'],
                    $result['tbtipounidadidentificador'],
                    $result['tbtipounidadnombre'],
                    $result['tbtipounidaddescripcion'],
                    new DateTime($result['tbtipounidadfechacreacion']),
                    new DateTime($result['tbtipounidadfechamodificacion']),
                    $result['tbtipounidadestado']
                );
            } else {
                $unit = null; 
            }
        
            return $unit;
        }

        public function deleteUnitType(TipoUnidad $unitType) {
            // Obtengo la conexión
            $conn = self::connect();
            try {
                // Preparo la sentencia
                $stmt = $conn->prepare("UPDATE tbtipounidad SET tbtipounidadestado = :estado WHERE tbtipounidadidentificador = :identifier");
                // Asigno los valores a variables antes de pasarlas a bindParam
                $identifier = $unitType->getIdentifierTU();
                $estado = 0;
                // Coloco los parámetros
                $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
                $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
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


        public function updateUnitType(TipoUnidad $unitType){
            $this->deleteUnitType($unitType);
            return $this->saveUnitType($unitType);
            }

            public function getAllUnitTypesDisabled() {
                $conn = self::connect();
                $stmt = $conn->query("
                SELECT * 
                FROM tbtipounidad AS u1
                WHERE u1.tbtipounidadestado = 0
                  AND NOT EXISTS (
                      SELECT 1
                      FROM tbtipounidad AS u2
                      WHERE u2.tbtipounidadidentificador = u1.tbtipounidadidentificador
                        AND u2.tbtipounidadestado = 1
                  )
                  AND u1.tbtipounidadid = (
                      SELECT MAX(u3.tbtipounidadid)
                      FROM tbtipounidad AS u3
                      WHERE u3.tbtipounidadidentificador = u1.tbtipounidadidentificador
                        AND u3.tbtipounidadestado = 0
                  )
                ");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                $unitTypes = [];
            
                foreach ($result as $dates) {
                    $unit = new TipoUnidad(
                        $dates['tbtipounidadid'],
                        $dates['tbtipounidadidentificador'],
                        $dates['tbtipounidadnombre'],
                        $dates['tbtipounidaddescripcion'],
                        new DateTime($dates['tbtipounidadfechacreacion']),
                        new DateTime($dates['tbtipounidadfechamodificacion']),
                        $dates['tbtipounidadestado']
                    );
                    $unitTypes[] = $unit;
                }
            
                return $unitTypes;
            }

            private function getLastIdentifierByUnitType($unitTypeIdent)
            {
                $conn = self::connect();
                try {
                    $stmt = $conn->prepare("
                        SELECT tbtipounidadid 
                        FROM tbtipounidad 
                        WHERE tbtipounidadidentificador = :unitTypeIdent
                        ORDER BY tbtipounidadid DESC 
                        LIMIT 1
                    ");
                    $stmt->bindParam(':unitTypeIdent', $unitTypeIdent, PDO::PARAM_STR);
                    $stmt->execute();
                    $lastIdentifier = $stmt->fetchColumn();
                    
                    return $lastIdentifier ?: false;
                } catch (PDOException $e) {
                    // Manejo de errores
                    echo "Error: " . $e->getMessage();
                    return false;
                } finally {
                    // Cierre de la conexión
                    $conn = null;
                }
            }

            public function activateLastUnitType($unitTypeIdent): bool
            {
                $lastIdentifier = $this->getLastIdentifierByUnitType($unitTypeIdent);
                
                if ($lastIdentifier) {
                    $conn = self::connect();
                    try {
                        $stmt = $conn->prepare("
                            UPDATE tbtipounidad 
                            SET tbtipounidadestado = 1 
                            WHERE tbtipounidadid = :identifier
                        ");
                        $stmt->bindParam(':identifier', $lastIdentifier, PDO::PARAM_INT);
                        $result = $stmt->execute();
                    } catch (PDOException $e) {
                        // Manejo de errores
                        echo "Error: " . $e->getMessage();
                        $result = false;
                    } finally {
                        // Cierre de la conexión
                        $conn = null;
                    }
                    return $result;
                } else {
                    return false;
                }
            }

            
public function autocompleteUnitTypes(string $searchTerm)
{
    $conn = self::connect();

    
    $stmt = $conn->prepare("
        (
            SELECT * 
            FROM tbtipounidad AS u1
            WHERE u1.tbtipounidadestado = 0
              AND u1.tbtipounidadid = (
                  SELECT MAX(u3.tbtipounidadid)
                  FROM tbtipounidad AS u3
                  WHERE u3.tbtipounidadidentificador = u1.tbtipounidadidentificador
                    AND u3.tbtipounidadestado = 0
              )
              AND (u1.tbtipounidadnombre LIKE :search OR u1.tbtipounidaddescripcion LIKE :search)
              AND NOT EXISTS (
                  SELECT 1 
                  FROM tbtipounidad AS u2
                  WHERE u2.tbtipounidadidentificador = u1.tbtipounidadidentificador
                    AND u2.tbtipounidadestado = 1
              )
        )
        UNION ALL
        (
            SELECT * 
            FROM tbtipounidad AS u1
            WHERE u1.tbtipounidadestado = 1
              AND (u1.tbtipounidadnombre LIKE :search OR u1.tbtipounidaddescripcion LIKE :search)
        )
        ORDER BY tbtipounidadnombre ASC
        LIMIT 10
    ");

    // Assign the search term with wildcards for partial matching
    $likeSearchTerm = "%{$searchTerm}%";

    // Bind the search term parameter
    $stmt->bindParam(':search', $likeSearchTerm, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process results into UnitType objects
    $unitTypes = [];
    foreach ($results as $row) {
        $unitObj = new TipoUnidad(
            $row['tbtipounidadid'],
            $row['tbtipounidadidentificador'],
            $row['tbtipounidadnombre'],
            $row['tbtipounidaddescripcion'],
            new DateTime($row['tbtipounidadfechacreacion']),
            new DateTime($row['tbtipounidadfechamodificacion']),
            $row['tbtipounidadestado']
        );
        $unitTypes[] = $unitObj;
    }

    return $unitTypes;
}


public function getAllUnitTypesDisabledFilter($searchTerm) {
    $conn = self::connect();
    
    // Prepara la búsqueda con un parámetro para evitar SQL Injection
    $searchTerm = '%' . $searchTerm . '%';
    
    $stmt = $conn->prepare("
        SELECT * 
        FROM tbtipounidad AS u1
        WHERE u1.tbtipounidadestado = 0
          AND NOT EXISTS (
              SELECT 1
              FROM tbtipounidad AS u2
              WHERE u2.tbtipounidadidentificador = u1.tbtipounidadidentificador
                AND u2.tbtipounidadestado = 1
          )
          AND u1.tbtipounidadid = (
              SELECT MAX(u3.tbtipounidadid)
              FROM tbtipounidad AS u3
              WHERE u3.tbtipounidadidentificador = u1.tbtipounidadidentificador
                AND u3.tbtipounidadestado = 0
          )
          AND u1.tbtipounidadnombre LIKE ?
    ");
    
    // Ejecuta la consulta con el parámetro de búsqueda
    $stmt->execute([$searchTerm]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $unitTypes = [];
    
    foreach ($result as $dates) {
        $unit = new TipoUnidad(
            $dates['tbtipounidadid'],
            $dates['tbtipounidadidentificador'],
            $dates['tbtipounidadnombre'],
            $dates['tbtipounidaddescripcion'],
            new DateTime($dates['tbtipounidadfechacreacion']),
            new DateTime($dates['tbtipounidadfechamodificacion']),
            $dates['tbtipounidadestado']
        );
        $unitTypes[] = $unit;
    }
    
    return $unitTypes;
}

public function validateUnitTypeName(string $name, ?string $identifier): bool
{
     // La consulta SQL básica
     $sql = 'SELECT COUNT(*) FROM `tbtipounidad` WHERE `tbtipounidadnombre` = :name';
    
     // Añadir la condición del identificador si se proporciona
     if (!empty($identifier)) {
         $sql .= ' AND `tbtipounidadidentificador` != :identifier';
     }
     
     // Obtener la conexión
     $conn = self::connect();
     
     // Preparar la declaración
     $stmt = $conn->prepare($sql);
     
     // Vincular el parámetro del nombre
     $stmt->bindParam(':name', $name, PDO::PARAM_STR);
     
     // Vincular el parámetro del identificador si se proporciona
     if (!empty($identifier)) {
         $stmt->bindParam(':identifier', $identifier, PDO::PARAM_STR);
     }
     
     // Ejecutar la consulta
     $stmt->execute();
     
     // Obtener el número de filas que coinciden con los criterios
     $count = $stmt->fetchColumn();
     
     // Si el conteo es mayor que 0, significa que el nombre ya existe
     return $count > 0;
}


public function obtenerNombresTipoUnidad()
{

    $conn = self::connect();
    
    $stmt = $conn->query("SELECT tbtipounidadnombre FROM tbtipounidad");

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


public function getNamesByTypeId($typeId) {
    // Obtengo la conexión
    $conn = self::connect();
        
    $stmt = $conn->prepare("
        SELECT `tbunidadmedidanombreunidad`
        FROM `tbunidadmedida`
        WHERE `tbunidadmedidatipounidad` = :typeId AND `tbunidadmedidaestado` != 0
    ");
    $stmt->bindParam(':typeId', $typeId, PDO::PARAM_STR);

    // Intenta ejecutar la consulta
    try {
        $stmt->execute();
        // Devuelve un array de arrays
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
        return [];
    }
}



}

